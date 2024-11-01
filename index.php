<?php
require 'vendor/autoload.php'; // Включаем автозагрузку Composer

session_start();

require 'config.php'; // Подключаем файл конфигурации

if (isset($_COOKIE['user_id'])) {
    // Проверка, существует ли пользователь с таким ID в базе данных
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $_COOKIE['user_id']]); 

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "<p>Привет, " . $_SESSION['username'] . "!</p>";
        echo "<a href='logout.php'>Выход</a>";
        echo "<a href='user.php'>Мой профиль</a>";
    } else {
        // Пользователь не найден в базе данных (возможно, Cookie устарело)
        // Предложите пользователю войти снова.
        echo "<p>Пожалуйста, войдите в систему.</p>";
        echo "<a href='login.php'>Вход</a>";
    }
} else {
    // Пользователь не авторизован
    echo "<a href='registration.php'>Регистрация</a>";
    echo "<a href='login.php'>Вход</a>";
}

?>