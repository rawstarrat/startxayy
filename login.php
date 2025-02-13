<?php
include 'config.php';

$telegram = $_POST['telegram'];
$password = $_POST['password'];

$result = file_get_contents("users.txt");

if (strpos($result, $telegram) !== false) {
    echo "✅ Login berhasil!";
} else {
    echo "❌ Akun tidak ditemukan!";
}
?>
