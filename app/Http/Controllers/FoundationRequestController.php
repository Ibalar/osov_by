<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FoundationRequestController extends Controller
{
    /**
     * Обработать заявку с лендинга
     */
    public function store(HttpRequest $request)
    {
        // Валидация
        $validated = $request->validate([
            'phone' => [
                'required',
                'string',
                'min:10',
                function ($attribute, $value, $fail) {
                    // Валидация для белорусских номеров
                    // Формат: +375 (XX) XXX-XX-XX
                    $phone = preg_replace('/[^0-9]/', '', $value);
                    
                    // Проверяем, что начинается с 375
                    if (strlen($phone) >= 3 && substr($phone, 0, 3) === '375') {
                        $code = substr($phone, 3, 2);
                        $validCodes = ['25', '29', '33', '44'];
                        
                        if (!in_array($code, $validCodes)) {
                            $fail('Введите номер с кодом 25, 29, 33 или 44');
                        }
                    }
                },
            ],
            'source_type' => ['nullable', 'string', 'max:50'],
            'source_id' => ['nullable', 'integer'],
            'source_title' => ['nullable', 'string', 'max:255'],
            'name' => ['nullable', 'string', 'max:255'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        // Определяем тип источника и название
        $sourceType = $validated['source_type'] ?? 'unknown';
        $sourceId = $validated['source_id'] ?? null;
        $sourceTitle = $validated['source_title'] ?? null;

        // Если источник не указан, пытаемся определить из URL
        if (!$sourceTitle) {
            $referer = $request->headers->get('referer', '');
            
            if (str_contains($referer, '/services/item/')) {
                $sourceType = 'service';
            } elseif (str_contains($referer, '/services/category/')) {
                $sourceType = 'service_category';
            } elseif (str_contains($referer, '/landing/')) {
                $sourceType = 'landing';
            }
        }

        // Формирование сообщения для Telegram
        $message = $this->formatTelegramMessage($validated, $sourceType, $sourceTitle);

        // Отправка в Telegram
        $this->sendToTelegram($message);

        // Сохранение в базу данных
        $savedRequest = $this->saveRequest($validated, $sourceType, $sourceId, $sourceTitle);

        // Логирование
        Log::info('Новая заявка с лендинга', [
            'request_id' => $savedRequest->id,
            'phone' => $validated['phone'],
            'source_type' => $sourceType,
            'source_title' => $sourceTitle,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ваша заявка успешно отправлена!'
        ]);
    }

    /**
     * Формирование сообщения для Telegram
     */
    private function formatTelegramMessage(array $data, string $sourceType, ?string $sourceTitle): string
    {
        // Заголовок в зависимости от типа источника
        $sourceLabel = match ($sourceType) {
            'service' => 'Услуга',
            'service_category' => 'Категория услуг',
            'landing' => 'Лендинг',
            default => 'Страница',
        };

        $message = "📩 <b>Новая заявка</b>\n\n";
        $message .= "📞 Телефон: {$data['phone']}\n";

        if (!empty($data['name'])) {
            $message .= "👤 Имя: {$data['name']}\n";
        }

        if ($sourceTitle) {
            $message .= "🏷️ {$sourceLabel}: {$sourceTitle}\n";
        }

        if (!empty($data['comment'])) {
            $message .= "💬 Комментарий: {$data['comment']}\n";
        }

        // Дополнительные поля для фундаментов (legacy)
        if (!empty($data['typep'])) {
            $message .= "🏠 Тип постройки: {$data['typep']}\n";
        }

        if (!empty($data['typef'])) {
            $message .= "📐 Тип фундамента: {$data['typef']}\n";
        }

        if (!empty($data['size1']) || !empty($data['size2'])) {
            $message .= "📏 Размеры: ";
            $message .= !empty($data['size1']) ? "{$data['size1']}м × " : '';
            $message .= !empty($data['size2']) ? "{$data['size2']}м" : '';
            $message .= "\n";
        }

        $message .= "\n📅 Дата: " . now()->format('d.m.Y H:i');

        return $message;
    }

    /**
     * Отправка сообщения в Telegram
     */
    private function sendToTelegram(string $message): void
    {
        $telegramToken = config('services.telegram.bot_token');
        $telegramChatId = config('services.telegram.chat_id');

        if ($telegramToken && $telegramChatId) {
            try {
                Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
                    'chat_id' => $telegramChatId,
                    'text' => $message,
                    'parse_mode' => 'HTML',
                ]);
            } catch (\Exception $e) {
                Log::error('Ошибка отправки в Telegram: ' . $e->getMessage());
            }
        }
    }

    /**
     * Сохранение заявки в базу данных
     */
    private function saveRequest(array $data, string $sourceType, ?int $sourceId, ?string $sourceTitle): Request
    {
        return Request::create([
            'name' => $data['name'] ?? null,
            'phone' => $data['phone'],
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'source_title' => $sourceTitle,
            'comment' => $data['comment'] ?? null,
            'status' => 'new',
        ]);
    }
}
