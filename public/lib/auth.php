<?php session_start(); ?>
<?php require_once "./../db.php"; ?>
<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($login) <= 2) {
  echo "login error";
  exit;
}

if (strlen($password) <= 2) {
  echo "password error";
  exit;
}

$sql = 'SELECT * FROM users WHERE login = :login';
$stmt = $pdo->prepare($sql);
$stmt->execute(['login' => $login]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
//var_dump($user);
$_SESSION['login'] = $user['login']; 

if (empty($user)) {
  // то:
  echo "Таких нет у нас";
  header('Location: /auth.php');
  exit();
}

// ПРОВЕРЯЕМ ПАРОЛЬ

if (!password_verify($password, $user['password'])) {
  echo  "Неверный пароль";
  exit;
}

// ПРОВЕРЯЕМ ПАРОЛЬ

if (!password_verify($password, $user['password'])) {
  echo  "Неверный пароль";
  exit;
} else {

  header('Location: /admin.php');
}
?>