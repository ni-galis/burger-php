<?php
session_start();

// Защита: проверяем, авторизован ли администратор
if (empty($_SESSION['login'])) {
  exit("Ошибка доступа: Вы не авторизованы!");
}

require_once "./../db.php";

$id       = (int)($_POST['id'] ?? 1);
$suptitle = trim($_POST['suptitle'] ?? '');
$title    = trim($_POST['title'] ?? '');

// Валидация текста
if (mb_strlen($suptitle) < 2) {
  exit("Ошибка: Название suptitle слишком короткое!");
}
if (mb_strlen($title) < 2) {
  exit("Ошибка: Название title слишком короткое!");
}

// Сначала запрашиваем из базы текущие имена файлов, чтобы знать, что удалять
$old_sql = 'SELECT burger, bottle, snack FROM reservation WHERE id = :id';
$old_stmt = $pdo->prepare($old_sql);
$old_stmt->execute(['id' => $id]);
$current_images = $old_stmt->fetch(PDO::FETCH_ASSOC) ?: [];

$burger = null;
$bottle = null;
$snack  = null;
$upload_dir = '../image/reservation/';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
  $allowed_types = [
    'image/jpeg' => 'jpg',
    'image/jpg'  => 'jpg',
    'image/png'  => 'png',
    'image/webp' => 'webp'
  ];

  $files_to_upload = [
    'im_1' => 'burger',
    'im_2' => 'bottle',
    'im_3' => 'snack'
  ];

  foreach ($files_to_upload as $input_name => $var_name) {
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {

      $file_tmp  = $_FILES[$input_name]['tmp_name'];
      $file_name = $_FILES[$input_name]['name'];
      $file_size = $_FILES[$input_name]['size'];

      $img_info = @getimagesize($file_tmp);
      if (!$img_info || !array_key_exists($img_info['mime'], $allowed_types)) {
        exit("Тип файла $file_name не подходит. Разрешены только JPG, PNG, WEBP.");
      }

      if ($file_size > 1024 * 1000) {
        exit("Размер файла $file_name слишком большой (более 1МБ).");
      }

      $extension = $allowed_types[$img_info['mime']];
      $final_name = uniqid('img_', true) . '.' . $extension;

      if (move_uploaded_file($file_tmp, $upload_dir . $final_name)) {
        $$var_name = $final_name;

        // УДАЛЕНИЕ СТАРОГО МУСОРА: Если в базе было старое имя и файл физически существует — удаляем его
        if (!empty($current_images[$var_name])) {
          $old_file_path = $upload_dir . $current_images[$var_name];
          if (file_exists($old_file_path)) {
            @unlink($old_file_path);
          }
        }
      } else {
        exit("Ошибка при перемещении файла $file_name.");
      }
    }
  }
}

// Формируем SQL
$sql = 'UPDATE reservation SET suptitle = :suptitle, title = :title';
$params = ['suptitle' => $suptitle, 'title' => $title, 'id' => $id];

if ($burger !== null) {
  $sql .= ', burger = :burger';
  $params['burger'] = $burger;
}
if ($bottle !== null) {
  $sql .= ', bottle = :bottle';
  $params['bottle'] = $bottle;
}
if ($snack !== null) {
  $sql .= ', snack = :snack';
  $params['snack'] = $snack;
}

$sql .= ' WHERE id = :id';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

// Перенаправляем обратно в админку с флагом успеха
header("Location: /admin-pages/reservation.php?success=1");
exit();
