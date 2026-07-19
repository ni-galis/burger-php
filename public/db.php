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

}
