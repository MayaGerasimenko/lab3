<?php
  require 'config.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];  // Валидация данных (проверка на пустоту)
  if (empty($username) || empty($password)) {
      echo "Пожалуйста, заполните все поля.";
      exit;
  }

  // Проверка, существует ли пользователь с таким именем
  $stmt = $db-&gt;prepare("SELECT * FROM users WHERE username = :username");
  $stmt-&gt;execute(['username' =&gt; $username]);

  if ($stmt-&gt;rowCount() === 0) {
      echo "Пользователь с таким именем не найден.";
      exit;
  }

  $user = $stmt-&gt;fetch(PDO::FETCH_ASSOC);

  // Проверка пароля
  if (!password_verify($password, $user['password'])) {
      echo "Неверный пароль.";
      exit;
  }

  // Авторизация пользователя с использованием Cookies
  session_start();
  $_SESSION['user_id'] = $user['id']; 
  $_SESSION['username'] = $user['username'];

  // Установка Cookies
  setcookie('user_id', $user['id'], time() + (86400 * 30), '/'); // 30 дней
  setcookie('username', $user['username'], time() + (86400 * 30), '/'); 

  echo "Вход выполнен успешно!";
  }

  ?>