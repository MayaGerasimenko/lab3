<?php
  require 'config.php';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];  // Валидация данных (проверка на пустоту, формат email и т.д.)
  if (empty($username) || empty($password) || empty($email)) {
      echo "Пожалуйста, заполните все поля.";
      exit;
  }

  // Проверка, существует ли уже пользователь с таким именем или email
  $stmt = $db-&gt;prepare("SELECT * FROM users WHERE username = :username OR email = :email");
  $stmt-&gt;execute(['username' =&gt; $username, 'email' =&gt; $email]);
  if ($stmt-&gt;rowCount() &gt; 0) {
      echo "Пользователь с таким именем или email уже существует.";
      exit;
  }

  // Хеширование пароля (используйте bcrypt или другую безопасную функцию хеширования)
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Добавление пользователя в базу данных
  $stmt = $db-&gt;prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
  $stmt-&gt;execute(['username' =&gt; $username, 'password' =&gt; $hashedPassword, 'email' =&gt; $email]);

  echo "Регистрация прошла успешно!";
  }

  ?>