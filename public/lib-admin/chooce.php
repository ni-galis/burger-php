<?php
session_start();

// 1. Защита: если пользователь не авторизован, выкидываем его
if (empty($_SESSION['login'])) {
  header("Location: /admin-pages/chooce.php");
  exit();
}

// 2. Подключение к базе данных (путь скорректируйте под вашу структуру)
require_once __DIR__ . "/../db.php";

// Директория для загрузки картинок
$upload_dir = __DIR__ . "/../image/choose/";

// 3. Проверяем, была ли нажата кнопка "Сохранить всё"
if (isset($_POST['save'])) {

  // --- ШАГ А: Обновление общих заголовков (один раз) ---
  $subtitle = trim($_POST['subtitle'] ?? '');
  $title    = trim($_POST['title'] ?? '');
  $suptitle = trim($_POST['suptitle'] ?? '');

  // Обновляем общие поля во ВСЕХ записях (или можно обновить в конкретной, если они привязаны к ID)
  $sql_main = "UPDATE chooce SET subtitle = ?, title = ?, suptitle = ?";
  $stmt_main = $pdo->prepare($sql_main);
  $stmt_main->execute([$subtitle, $title, $suptitle]);


  // --- ШАГ Б: Обновление циклических колонок по ID ---
  if (!empty($_POST['ids']) && is_array($_POST['ids'])) {

    foreach ($_POST['ids'] as $id) {
      $id = (int)$id; // Безопасность: приводим ID к числу

      // Собираем данные конкретной колонки из массивов POST
      $col_title    = trim($_POST['column_title'][$id] ?? '');
      $col_suptitle = trim($_POST['column_suptitle'][$id] ?? '');
      $shadow       = trim($_POST['shadow'][$id] ?? '');
      $col_order    = trim($_POST['column_order'][$id] ?? '');

      // Обновляем текстовые поля для текущего ID
      $sql_row = "UPDATE chooce SET 
                            column_title = ?, 
                            column_suptitle = ?, 
                            shadow = ?, 
                            column_order = ? 
                        WHERE id = ?";
      $stmt_row = $pdo->prepare($sql_row);
      $stmt_row->execute([$col_title, $col_suptitle, $shadow, $col_order, $id]);

      // --- ШАГ В: Обработка загрузки картинки для этого ID ---
      if (isset($_FILES['im']['name'][$id]) && $_FILES['im']['error'][$id] === UPLOAD_ERR_OK) {

        $file_tmp  = $_FILES['im']['tmp_name'][$id];
        $file_name = $_FILES['im']['name'][$id];

        // Получаем расширение файла и генерируем уникальное имя, чтобы избежать дублей
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_types = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        if (in_array(strtolower($ext), $allowed_types)) {
          $new_filename = uniqid('img_', true) . '.' . $ext;
          $dest_path = $upload_dir . $new_filename;

          // Перемещаем файл из временной папки в целевую
          if (move_uploaded_file($file_tmp, $dest_path)) {

            // Удаляем старый файл с сервера, чтобы не копился мусор
            $sql_old = "SELECT filename FROM chooce WHERE id = ?";
            $stmt_old = $pdo->prepare($sql_old);
            $stmt_old->execute([$id]);
            $old_file = $stmt_old->fetchColumn();

            if ($old_file && file_exists($upload_dir . $old_file)) {
              unlink($upload_dir . $old_file);
            }

            // Записываем имя нового файла в БД
            $sql_img = "UPDATE chooce SET filename = ? WHERE id = ?";
            $stmt_img = $pdo->prepare($sql_img);
            $stmt_img->execute([$new_filename, $id]);
          }
        }
      }
    }
  }

  // Перенаправляем обратно на страницу формы с флагом успешного сохранения
  header("Location: " . $_SERVER['HTTP_REFERER']);
  exit();
} else {
  // Если зашли на файл напрямую без отправки формы
  header("Location: /admin-pages/chooce.php");
  exit();
}
