<?php

$db_host = "MySQL-5.7";
$db_name = "php-Gerasimenko";
$db_user = "maya";
$db_password = "";

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Успешное подключение
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit;
}

?>