<?php 
// Включаем буферизацию вывода (это полностью решает проблему "headers already sent")
ob_start();

// 1. Инициализация сессии и проверка прав администратора
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['login'])) {
    exit("Ошибка доступа: Вы не авторизованы!");
}

// 2. Подключение к базе данных
require_once "./../db.php"; 
?>

<h1 style="color:yellowgreen;font-size:16px;">lib-admin/footer.php</h1>

<?php
// 3. Получение и очистка текстовых данных из формы
$textarea     = trim($_POST['textarea'] ?? '');
$copyright    = trim($_POST['copyright'] ?? '');
$locationText = trim($_POST['address'] ?? '');
$emailText    = trim($_POST['email_address'] ?? '');

// 4. Валидация текста
if (mb_strlen($textarea) < 2) {
    exit("Ошибка: Название textarea слишком короткое!");
}
if (mb_strlen($copyright) < 2) {
    exit("Ошибка: Название copyright слишком короткое!");
}
if (mb_strlen($locationText) < 2) {
    exit("Ошибка: Название locationText слишком короткое!");
}
if (empty($emailText) || !filter_var($emailText, FILTER_VALIDATE_EMAIL)) {
    exit("Ошибка: Некорректный формат Email!");
}

try {
    // 5. Запрашиваем текущие данные из БД для удаления старых файлов
    $sql_select = "SELECT logo, location, email, instagram, facebook, twitter, whatsapp FROM footer LIMIT 1";
    $stmt_select = $pdo->query($sql_select);
    $current_footer = $stmt_select->fetch(PDO::FETCH_ASSOC);

    if (!$current_footer) {
        exit("Ошибка: Запись в таблице footer не найдена.");
    }

    // 6. Массив соответствия: HTML-инпут => колонка в БД
    $files_map = [
        'im_1' => 'logo',
        'im_2' => 'location',
        'im_3' => 'email',
        'im_4' => 'instagram',
        'im_5' => 'facebook',
        'im_6' => 'twitter',
        'im_7' => 'whatsapp'
    ];

    $file_sql_parts = [];
    $execute_params = [
        'textarea'      => $textarea,
        'copyright'     => $copyright,
        'address'       => $locationText, 
        'email_address' => $emailText     
    ];

    $upload_dir = "./../image/footer/";

    // 7. Цикл обработки загрузки картинок
    foreach ($files_map as $html_input_name => $db_column_name) {
        if (isset($_FILES[$html_input_name]) && $_FILES[$html_input_name]['error'] === UPLOAD_ERR_OK) {
            
            $file_tmp  = $_FILES[$html_input_name]['tmp_name'];
            $file_name = $_FILES[$html_input_name]['name'];
            $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'];
            if (!in_array($file_ext, $allowed_extensions)) {
                exit("Ошибка: Недопустимый формат файла для поля {$html_input_name}.");
            }

            $new_file_name = uniqid($db_column_name . '_', true) . '.' . $file_ext;
            $destination = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $destination)) {
                $old_file_name = $current_footer[$db_column_name];
                if (!empty($old_file_name) && file_exists($upload_dir . $old_file_name)) {
                    unlink($upload_dir . $old_file_name);
                }

                $file_sql_parts[] = "`{$db_column_name}` = :{$db_column_name}";
//                $execute_params[$db_column_name] = $new_$execute_params[$db_column_name] = $new_file_name;
//file_name;
            } else {
                exit("Ошибка при сохранении файла на server.");
            }
        }
    }

    // 8. Сборка SQL-запроса
    $sql_update = "UPDATE footer SET 
                    textarea = :textarea, 
                    copyright = :copyright, 
                    location_text = :address, 
                    `email_address` = :email_address";

    if (!empty($file_sql_parts)) {
        $sql_update .= ", " . implode(", ", $file_sql_parts);
    }

    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute($execute_params);

    // 9. БЕЗОПАСНЫЙ РЕДИРЕКТ ЧЕРЕЗ JAVASCRIPT (функция header() полностью удалена)
    echo "<script>window.location.href = '/admin-pages/footer.php?success=1';</script>";
    exit();

} catch (PDOException $e) {
    exit("Ошибка базы данных: " . $e->getMessage());
} 
?>
