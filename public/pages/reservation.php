<?php 
// 1. Проверяем и запускаем сессию (если файл подключается отдельно)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<?php 
require_once "./db.php"; 

// 1. Получаем данные для оформления самой секции (заголовки, картинки)
$sql = "SELECT * FROM reservation LIMIT 1"; 
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rev = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$rev) {
    $rev = [
        'suptitle' => 'Default Suptitle',
        'title' => 'Default Title',
        'burger' => 'burger.png',
        'bottle' => 'bottle.png',
        'snack' => 'snack.png'
    ];
}

// 2. Обработка отправки формы
$form_errors = [];

// Достаем сообщение об успехе из сессии (если оно там есть) и сразу удаляем из сессии
$success_message = $_SESSION['booking_success'] ?? "";
unset($_SESSION['booking_success']);

// Расширяем массив для сохранения всех введенных пользователем полей
$form_values = ['name' => '', 'email' => '', 'data' => '', 'time' => '', 'people' => '']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['find'])) {
    $form_values['name']   = trim($_POST['name'] ?? '');
    $form_values['email']  = trim($_POST['email'] ?? '');
    $form_values['data']   = trim($_POST['data'] ?? '');
    $form_values['time']   = trim($_POST['time'] ?? '');
    $form_values['people'] = trim($_POST['people'] ?? '');
    
    // Валидация
    if (empty($form_values['name'])) {
        $form_errors[] = "Пожалуйста, введите имя.";
    }
    if (!filter_var($form_values['email'], FILTER_VALIDATE_EMAIL)) {
        $form_errors[] = "Некорректный формат Email.";
    }
    if (empty($form_values['data'])) {
        $form_errors[] = "Пожалуйста, выберите дату.";
    }
    if (empty($form_values['time'])) {
        $form_errors[] = "Пожалуйста, выберите время.";
    }
    if (empty($form_values['people']) || (int)$form_values['people'] < 1) {
        $form_errors[] = "Количество людей должно быть не менее 1.";
    }

    // Если ошибок нет, записываем бронь в базу данных
    if (empty($form_errors)) {
        try {
            $insert_sql = "INSERT INTO bookings (name, email, date, time, people) VALUES (?, ?, ?, ?, ?)";
            $insert_stmt = $pdo->prepare($insert_sql);
            $insert_stmt->execute([
                $form_values['name'],
                $form_values['email'],
                $form_values['data'],
                $form_values['time'],
                (int)$form_values['people']
            ]);

            // Записываем флаг успеха в сессию перед редиректом
            $_SESSION['booking_success'] = "Столик успешно забронирован!";
            
            // БЕЗОПАСНОСТЬ: Редирект на эту же страницу (очищает POST-данные в браузере)
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit();


        } catch (PDOException $e) {
            //$form_errors[] = "Ошибка при сохранении бронирования. Попробуйте позже.";
        }
    }
}
?>

<section class="reservation">
  <div class="container">
    <div class="reservation__content">

      <!-- Вывод ошибок валидации, если они есть -->
      <?php if (!empty($form_errors)): ?>
        <div class="form-errors" style="color: red; margin-bottom: 20px;">
          <?php foreach ($form_errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <!-- Вывод уведомления об успешном бронировании -->
      <?php if (!empty($success_message)): ?>
        <div class="form-success" style="color: green; margin-bottom: 20px; font-weight: bold;">
          <p><?= htmlspecialchars($success_message) ?></p>
        </div>
      <?php endif; ?>

      <div class="reservation-top">
        <div class="content-suptitle">
          <h3 class="reservation__content-suptitle"><?= htmlspecialchars($rev['suptitle'] ?? '') ?></h3>
        </div>
        <div class="content-title">
          <h2 class="reservation__content-title"><?= htmlspecialchars($rev['title'] ?? '') ?></h2>
        </div>
      </div>

      <!-- Картинки секции -->
      <img style="width: 400px;" class="burger__img" src="./image/reservation/<?= htmlspecialchars($rev['burger'] ?? 'burger.png') ?>" alt="burger">
      <img class="bottle__img" src="./image/reservation/<?= htmlspecialchars($rev['bottle'] ?? 'bottle.png') ?>" alt="bottle">
      <img class="assorted__img" src="./image/reservation/<?= htmlspecialchars($rev['snack'] ?? 'snack.png') ?>" alt="pic11">
      
      <!-- Форма бронирования (action="#" отправляет данные на текущий URL) -->
      <form class="reservation-form" action="#" method="post">

        <input class="input__name" type="text" name="name" placeholder="NAME" value="<?= htmlspecialchars($form_values['name']) ?>" required>

        <input class="input__email" type="email" name="email" placeholder="EMAIL" value="<?= htmlspecialchars($form_values['email']) ?>" required>

        <input class="input__data" type="date" name="data" value="<?= htmlspecialchars($form_values['data']) ?>" required>

        <input class="input__time" type="time" name="time" value="<?= htmlspecialchars($form_values['time']) ?>" required>

        <input class="input__people" type="number" name="people" placeholder="PEOPLE" min="1" value="<?= htmlspecialchars($form_values['people']) ?>" required>

        <input class="input__find" type="submit" value="FIND A TABLE" name="find">

      </form>
    </div>
  </div>
</section>
