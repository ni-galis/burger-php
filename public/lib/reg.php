<?php
$db_host = 'MySQL-8.0';
$db_user = 'root';
$db_password = '';
$db_name = 'burger-php';

$options = [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Массивы по умолчанию
  PDO::ATTR_EMULATE_PREPARES   => false,            // Честные подготавливаемые запросы
];

try {

  $pdo = new PDO("mysql:host=$db_host; dbname=$db_name", $db_user, $db_password);
} catch (PDOException $exception) {
  echo "Error: {$exception->getMessage()}";
  echo "НЕТ";
}
?>

<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($username) <= 2) {
  echo "username error";
  exit;
}

if (strlen($login) <= 2) {
  echo "login error";
  exit;
}

if (strlen($password) <= 2) {
  echo "password error";
  exit;
}

if (strlen($email) < 2 && !str_contains($email, '@') || empty($_POST['email'])) {
  echo "email error";
  exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// ЗАПРОС
$sql = 'INSERT INTO users (username, login, password, email) VALUE (:username, :login, :password, :email)';
// ПОДГОТОВКА
$stmt = $pdo->prepare($sql);
// ИСПОЛНЕНИЕ ОБЕРНУТЬ В TRY ДЛЯ ОШИБОК
try {
  $stmt->execute([
    'username' => $username,
    'login' => $login,
    'password' => $hashed_password,
    'email' => $email
  ]);
} catch (PDOException $exception) {
  echo "Ошибка при добавлении нового пользователя: {$exception->getMessage()}";
  echo '<meta http-equiv="refresh" content="1;url=/auth.php">';
  exit;
}
echo "успешно добавлен";
 echo '<meta http-equiv="refresh" content="1;url=/auth.php">';
exit;
