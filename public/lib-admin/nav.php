<h1 style="color:yellowgreen;font-size:16px;">lib-admin/nav.php</h1>
<?php
$title = "Обработка nav";
require_once "./../blocks/header-top.php"
?>
<?php require_once "./../db.php" ?>
<?php
$phone = trim(filter_var($_POST['phone'], FILTER_SANITIZE_SPECIAL_CHARS));
$num = trim(filter_var($_POST["num"], FILTER_SANITIZE_SPECIAL_CHARS));
$ting = trim(filter_var($_POST["ting"], FILTER_SANITIZE_SPECIAL_CHARS));
$home = trim(filter_var($_POST["home"], FILTER_SANITIZE_SPECIAL_CHARS));
$menu = trim(filter_var($_POST["menu"], FILTER_SANITIZE_SPECIAL_CHARS));
$story = trim(filter_var($_POST["story"], FILTER_SANITIZE_SPECIAL_CHARS));
$contact = trim(filter_var($_POST["contact"], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($phone) <= 2) {
  echo "phone error";
  exit;
}

if (strlen($num) <= 8) {
  echo "num error";
  exit;
}

if (strlen($ting) <= 3) {
  echo "express error";
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
?>

<?php
$sql = 'SELECT * FROM nav LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$nav = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $nav['id'];
$filename = $nav['filename']; // По умолчанию оставляем старое имя файла

if (isset($_POST['save'])) {

  // расширения для картинки которые нельзя будет загружать
  $list = ['.html', '.zip', '.rar', '.js', '.php'];
  // перебор на запрещенные файлы
  foreach ($list as $item) {
    if (preg_match("/$item$/", $_FILES['im']['name'])) exit("Расширение файла не подходит");
  }
  $type = @getimagesize($_FILES['im']['tmp_name']);

  if ($type && ($type['mime'] != 'image/jpg' || $type['mime'] != 'image/jpeg')) {
    if ($_FILES['im']['size'] < 1024 * 1000) {
      $upload = './../image/nav/';
      $filename = $_FILES['im']['name'];
      $uploadPath = $upload . $filename;

      if (move_uploaded_file($_FILES['im']['tmp_name'], $uploadPath)) echo "Файл загружен";
      else echo "Ошибка при загрузке файла";
    } else exit("Размер файла превышен");
  } else exit("Тип файла не подходит");
}
?>
<?php

$sql = 'UPDATE nav SET 
            phone=:phone, 
            num=:num, 
            ting=:ting, 
            `page-home`=:home, 
            `page-menu`=:menu, 
            `page-story`=:story, 
            `page-contact`=:contact, 
            filename=:filename 
        WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->execute([
  'phone'    => $phone,
  'num'      => $num,
  'ting'     => $ting,
  'home'     => $home,
  'menu'     => $menu,
  'story'    => $story,
  'contact'  => $contact,
  'filename' => $filename,
  'id'       => $id
]);
echo '<meta http-equiv="refresh" content="1;url=/index.php">';
exit;

?>