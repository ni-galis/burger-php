<h1 style="color:yellowgreen;font-size:16px;">lib-admin/header.php</h1>
<?php
$title = "Обработка header";
require_once "./../blocks/header-top.php"
?>
<?php require_once "./../db.php" ?>

<?php
$subtitle = trim(filter_var($_POST['subtitle'], FILTER_SANITIZE_SPECIAL_CHARS));
$rectangle = trim(filter_var($_POST["rectangle"], FILTER_SANITIZE_SPECIAL_CHARS));
$title = trim(filter_var($_POST["title"], FILTER_SANITIZE_SPECIAL_CHARS));
$suptitle = trim(filter_var($_POST["suptitle"], FILTER_SANITIZE_SPECIAL_CHARS));
$fond = trim(filter_var($_POST["fond"], FILTER_SANITIZE_SPECIAL_CHARS));

if (strlen($subtitle) <= 2) {
  echo "phone error";
  exit;
}

if (strlen($rectangle) <= 8) {
  echo "num error";
  exit;
}

if (strlen($title) <= 3) {
  echo "express error";
  exit;
}

if (strlen($suptitle) <= 2) {
  echo "home error";
  exit;
}

if (strlen($fond) <= 2) {
  echo "menu error";
  exit;
}
?>

<?php
$sql = 'SELECT * FROM header LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$header = $stmt->fetch(PDO::FETCH_ASSOC);

$id = $header['id'];
if (!isset($filename)) {
  $filename = $header['filename']; // По умолчанию оставляем старое имя файла
}
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

$sql = 'UPDATE header SET
            subtitle=:subtitle, 
            rectangle=:rectangle, 
            title=:title, 
            suptitle=:suptitle, 
            fond=:fond, 
            filename=:filename 
             WHERE id=:id';  // Теперь WHERE снова работает

$stmt = $pdo->prepare($sql);
$stmt->execute([
  'subtitle' => $subtitle,
  'rectangle' => $rectangle,
  'title' => $title,
  'suptitle' => $suptitle,
  'fond' => $fond,
  'filename' => $filename,
  'id' => $id      // Обязательно возвращаем id для WHERE
]);
echo '<meta http-equiv="refresh" content="1;url=/index.php">';
exit;

?>