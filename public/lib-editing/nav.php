<?php session_start() ?>
<?php require_once "./../db.php"; ?>
<?php
$title = "Редактирование nav";
require_once "./../blocks/header-top.php";
 ?>
<h3 style="color: green;">lib-editing/nav.php</h3>

<?php
$express = trim(filter_var($_POST["nav-span"], FILTER_SANITIZE_SPECIAL_CHARS));
$num = trim(filter_var($_POST["phone-num"], FILTER_SANITIZE_SPECIAL_CHARS));
$home = trim(filter_var($_POST['page-home'], FILTER_SANITIZE_SPECIAL_CHARS));
$menu = trim(filter_var($_POST["page-menu"], FILTER_SANITIZE_SPECIAL_CHARS));
$story = trim(filter_var($_POST["page-story"], FILTER_SANITIZE_SPECIAL_CHARS));
$contact = trim(filter_var($_POST["page-contact"], FILTER_SANITIZE_SPECIAL_CHARS));


if (strlen($express) <= 2) {
  echo "express error";
  exit;
}

if (strlen($num) <= 8) {
  echo "num error";
  exit;
}

if (strlen($home) <= 2) {
  echo "home error";
  exit;
}

if (strlen($menu) <= 2) {
  echo "menu error";
  exit;
}

if (strlen($story) <= 2) {
  echo "story error";
  exit;
}

if (strlen($contact) <= 2) {
  echo "contact error";
  exit;
}

$sql = 'UPDATE nav SET express=:express, num=:num, home=:home, menu=:menu, story=:story, contact=:contact';
$stmt = $pdo->prepare($sql);
$stmt->execute(['express' => $express, 'num' => $num, 'home' => $home, 'menu' => $menu, 'story' => $story, 'contact' => $contact]);
echo "успешно добавлено";

// Перенаправление через
echo '<meta http-equiv="refresh" content="8;url=/index.php">';
exit();
