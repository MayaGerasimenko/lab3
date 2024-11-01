<?php

  session_start();
  session_destroy();

  // Удаление Cookies
  setcookie('user_id', '', time() - 3600, '/');
  setcookie('username', '', time() - 3600, '/');

  header('Location: index.php'); // Перенаправляем пользователя на главную страницу

  ?>