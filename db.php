<?php
$host = "localhost";
$user = "root";   // kendi kullanıcı adın
$pass = "";       // şifre (XAMPP için genelde boş)
$db   = "qrmenu";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}
?>



