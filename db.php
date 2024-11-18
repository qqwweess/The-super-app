<?php
$servername = "localhost"; // Обычно localhost
$username = "root"; // Ваше имя пользователя MySQL
$password = ""; // Ваш пароль MySQL
$dbname = "zaz"; // Имя вашей базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>