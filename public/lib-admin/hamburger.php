<?php
session_start();
require_once "./../db.php";
?>

<h1 style="color:yellowgreen;font-size:16px;">lib-admin/hamburger.php</h1>

<?php

$filename_1 = trim(filter_var($_POST['filename_1'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
$filename_2 = trim(filter_var($_POST['filename_2'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));
$filename_3 = trim(filter_var($_POST['filename_3'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS));

  if (strlen($filename_1) <= 2) {
    exit("Ошибка: Название бургера-1 слишком короткое!");
}

if (strlen($filename_2) <= 2) {
    exit("Ошибка: Название бургера-2 слишком короткое!");
}
if (strlen($filename_3) <= 2) {
    exit("Ошибка: Название бургера-3 слишком короткое!");
}

//if (strlen($filename_1) <= 2) { $filename_1 = 'default_1.jpg'; }
//if (strlen($filename_2) <= 2) { $filename_2 = 'default_2.jpg'; }
//if (strlen($filename_3) <= 2) { $filename_3 = 'default_3.jpg'; }

// Теперь скрипт не упадет с ошибкой, а продолжит загрузку файлов!
$title = "Обработка hamburger";
require_once "./../blocks/header-top.php";


// Проверка: имена файлов не должны быть пустыми
if (strlen($filename_1) <= 2 || strlen($filename_2) <= 2 || strlen($filename_3) <= 2) {
    exit("Ошибка: Неверные имена файлов в базе данных.");
}

$title = "Обработка hamburger";
require_once "./../blocks/header-top.php";

if (isset($_POST['save'])) {
    $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $upload_dir = '../image/hamburger/'; // Путь относительно этого файла к папке с картинками

    // Массив для сопоставления полей формы и переменных
    $files_to_upload = [
        'im_1' => &$filename_1,
        'im_2' => &$filename_2,
        'im_3' => &$filename_3
    ];

    foreach ($files_to_upload as $input_name => &$filename_variable) {
        // Проверяем, загружен ли файл в это конкретное поле
        if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
            
            $file_tmp = $_FILES[$input_name]['tmp_name'];
            $file_name = $_FILES[$input_name]['name'];
            $file_size = $_FILES[$input_name]['size'];

            // Валидация типа
            $img_info = @getimagesize($file_tmp);
            if (!$img_info || !in_array($img_info['mime'], $allowed_types)) {
                exit("Тип файла $file_name не подходит. Разрешены только JPG, PNG, WEBP.");
            }

            // Валидация размера (до 1 МБ)
            if ($file_size > 1024 * 1000) {
                exit("Размер файла $file_name слишком большой (более 1МБ).");
            }

            // Чтобы файлы не перезаписывали друг друга, можно оставить оригинальное имя
            // или сгенерировать уникальное. Оставим оригинальное:
            $final_name = basename($file_name);
            
            if (move_uploaded_file($file_tmp, $upload_dir . $final_name)) {
                // Если файл успешно загружен, меняем имя файла для записи в БД
                $filename_variable = $final_name;
                echo "Файл $final_name успешно загружен.<br>";
            } else {
                echo "Ошибка при перемещении файла $file_name.<br>";
            }
        }
    }
}

// Обновляем запись в БД (предполагаем, что у вас одна строка настроек с id=1)
// Если ID другой или его нет, убавьте "WHERE id = 1" или замените на ваш идентификатор
$sql = 'UPDATE hamburger SET filename_1 = :f1, filename_2 = :f2, filename_3 = :f3 WHERE id = 1';
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'f1' => $filename_1,
    'f2' => $filename_2,
    'f3' => $filename_3
]);

echo '<meta http-equiv="refresh" content="1;url=/index.php">';
?>