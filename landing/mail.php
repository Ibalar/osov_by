<?php
// Настройки
$token = "7969696339:AAGxhd_sIMnlGIZwdAna3oRBHhLZbEDWciM";
$chat_id = "-4811997846";

// Получение данных из формы
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$form_name = $_POST['name'] ?? $_POST['go'] ?? 'Без имени формы';

// Проверка на номер телефона
if ($phone === '') {
    exit('Не заполнен номер телефона.');
}

// Подписи к полям
$labels = [
    'phone' => '📞 Телефон',
    'name' => '👤 Имя',
    'typep' => '🏠 Тип постройки',
    'typef' => '📐 Тип фундамента',
    'size1' => '📏 Длина (м)',
    'size2' => '📏 Ширина (м)',
];

// Формируем сообщение
$message = "📩 Новый запрос с формы: <b>{$form_name}</b>\n";

foreach ($_POST as $key => $value) {
    $value = trim($value);
    if ($value === '' || $key === 'go') continue;

    $label = $labels[$key] ?? $key;
    $message .= "<b>{$label}:</b> {$value}\n";
}

// Отправка в Telegram через curl
$ch = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'HTML'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Проверка успешности
if ($httpCode == 200) {
    echo "OK";
} else {
    echo "Ошибка при отправке";
}
?>
