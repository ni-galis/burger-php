<?php
session_start();

// 1. Защита: если пользователь не авторизован, выкидываем его
if (empty($_SESSION['login'])) {
    die("Доступ запрещен!");
}

// 2. Подключаем базу данных (корректируйте путь, если db.php в другом месте)
require_once "./../db.php"; 

// 3. Проверяем, что форма была отправлена методом POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {

    // Очищаем текстовые поля от лишних пробелов и опасных символов
    $subtitle = trim(filter_var($_POST['subtitle'] ?? '', FILTER_DEFAULT));
    $title    = trim(filter_var($_POST['title'] ?? '', FILTER_DEFAULT));
    $text     = trim(filter_var($_POST['text'] ?? '', FILTER_DEFAULT));

    // Папка для загрузки картинок (относительно этого файла)
    $uploadDir = "./../image/discover/";

    // Массив для хранения итоговых имён файлов, которые запишем в БД
    $slides = [
        'slide_1' => $_POST['slide_1'] ?? '',
        'slide_2' => $_POST['slide_2'] ?? '',
        'slide_3' => $_POST['slide_3'] ?? ''
    ];

    // Соответствие: какой инпут файла отвечает за какое поле в БД
    $fileFields = [
        'im_1' => 'slide_1',
        'im_2' => 'slide_2',
        'im_3' => 'slide_3'
    ];

    // 4. Логика обработки и загрузки файлов
    foreach ($fileFields as $inputName => $dbField) {
        // Проверяем, загружен ли файл без ошибок
        if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] === UPLOAD_ERR_OK) {
            
            $fileTmpPath = $_FILES[$inputName]['tmp_name'];
            $fileName    = $_FILES[$inputName]['name'];
            
            // Получаем расширение файла и делаем его маленькими буквами
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Список разрешенных форматов
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (in_array($fileExtension, $allowedExtensions)) {
                // Генерируем уникальное имя файла, чтобы они не перезаписывали друг друга
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $destPath = $uploadDir . $newFileName;

                // Переносим файл из временной папки в постоянную
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // Если загрузка успешна, обновляем имя файла для базы данных
                    $slides[$dbField] = $newFileName;
                }
            }
        }
    }

    // 5. Запись в базу данных
    // Используем UPDATE, так как запись в таблице discover у вас уже одна
    $sql = "UPDATE discover SET 
            subtitle = :subtitle, 
            title = :title, 
            text = :text, 
            slide_1 = :slide_1, 
            slide_2 = :slide_2, 
            slide_3 = :slide_3";

    $stmt = $pdo->prepare($sql);
    
    $result = $stmt->execute([
        ':subtitle' => $subtitle,
        ':title'    => $title,
        ':text'     => $text,
        ':slide_1'  => $slides['slide_1'],
        ':slide_2'  => $slides['slide_2'],
        ':slide_3'  => $slides['slide_3']
    ]);

    // 6. Перенаправление обратно на страницу редактирования
    if ($result) {
        // Успешно обновили — возвращаем админа назад
        header("Location: /admin-pages/discover.php?status=success");
        exit;
    } else {
        echo "Ошибка при обновлении данных в базе.";
    }

} else {
    // Если на файл зашли просто так, а не через форму
    header("Location: /admin-pages/discover.php");
    exit;
}