<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FoundationRequestController extends Controller
{
    /**
     * Обработать заявку с лендинга
     */
    public function store(Request $request)
    {
        // Валидация
        $validated = $request->validate([
            'phone' => 'required|string|min:10',
            'typep' => 'nullable|string|max:255', // тип постройки
            'typef' => 'nullable|string|max:255', // тип фундамента
            'size1' => 'nullable|numeric|min:1', // длина
            'size2' => 'nullable|numeric|min:1', // ширина
            'name' => 'nullable|string|max:255', // имя формы
        ]);

        // Формирование сообщения для Telegram
        $message = "📩 <b>Новая заявка с лендинга \"Фундаменты\"</b>\n\n";
        $message .= "📞 Телефон: {$validated['phone']}\n";

        if (!empty($validated['typep'])) {
            $message .= "🏠 Тип постройки: {$validated['typep']}\n";
        }

        if (!empty($validated['typef'])) {
            $message .= "📐 Тип фундамента: {$validated['typef']}\n";
        }

        if (!empty($validated['size1']) || !empty($validated['size2'])) {
            $message .= "📏 Размеры: ";
            $message .= !empty($validated['size1']) ? "{$validated['size1']}м × " : '';
            $message .= !empty($validated['size2']) ? "{$validated['size2']}м" : '';
            $message .= "\n";
        }

        $message .= "\n📅 Дата: " . now()->format('d.m.Y H:i');

        // Отправка в Telegram
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
                \Log::error('Ошибка отправки в Telegram: ' . $e->getMessage());
            }
        }

        // Логирование заявки (опционально, можно сохранить в базу)
        \Log::info('Новая заявка с лендинга', $validated);

        return response()->json([
            'success' => true,
            'message' => 'Ваша заявка успешно отправлена!'
        ]);
    }
}
