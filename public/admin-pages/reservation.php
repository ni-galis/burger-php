<?php
session_start();

// Защита: Если сессия пустая, сразу перенаправляем или жестко прекращаем выполнение.
if (empty($_SESSION['login'])) {
    header("Location: ./../logout.php");
    exit("Доступ запрещен!");
}

require_once "./../db.php";
$title = 'Редактирование reservation';
require_once "./../blocks/header-top.php";

// Получаем текущие данные из БД (id = 1)
$sql = 'SELECT * FROM reservation WHERE id = 1';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reservation) {
    $reservation = [];
}
?>

<body style="background: linear-gradient(200deg, #8a2be2, #000000, #0000cd, #228b22, #ccff00); min-height:100vh; 
font-family: sans-serif; margin: 0; padding: 0;">

  <h1 style="color:yellowgreen; font-size:16px; margin: 10px;">admin-pages/reservation.php</h1>

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:30px; font-size: 35px; text-transform: uppercase; margin-top: 0;">
    Редактирование информации reservation
  </h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

    <!-- Приветствие администратора -->
    <?= "Аккуратненько &nbsp;" . htmlspecialchars($_SESSION['login'] ?? '') . ",&nbsp; аккуратненько." ?>
    <br><br>
    <a href="./../logout.php" style="color:#f02b2bff; text-decoration: none; font-weight: bold;">Выйти</a>

    <style>
      .lab {
        font-style: italic;
        font-size: 20px;
        display: inline-block;
        margin-bottom: 5px;
      }
      .inp {
        padding: 10px 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        width: 220px;
        box-sizing: border-box;
      }
      .form-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
      }
    </style>

    <!-- Вывод уведомления об успешном сохранении -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div style="color: #ccff00; font-size: 20px; font-weight: bold; margin-bottom: 20px;">
        Изменения успешно сохранены!
      </div>
    <?php endif; ?>

    <!-- ФОРМА: Относительный путь action изменен на "../lib-admin/reservation.php" -->
    <form class="form-container" action="/lib-admin/reservation.php" method="post" enctype="multipart/form-data">

      <input type="hidden" name="id" value="<?= htmlspecialchars($reservation['id'] ?? 1) ?>">

      <!-- БЛОК 1: Заголовки сайта -->
      <div style="display: flex; justify-content: center; gap:50px; margin-bottom: 30px;">
        <div>
          <label class="lab">suptitle</label><br>
          <input class="inp" type="text" name="suptitle" value="<?= htmlspecialchars($reservation['suptitle'] ?? '') ?>">
        </div>

        <div>
          <label class="lab">title</label><br>
          <input class="inp" type="text" name="title" value="<?= htmlspecialchars($reservation['title'] ?? '') ?>">
        </div>
      </div>

      <!-- БЛОК 2: Загрузка картинок -->
      <div style="display: flex; justify-content: center; gap:50px; margin-bottom: 40px;">
        <div style="text-align: center;">
          <label class="lab" style="font-size: 18px;">Картинка (burger)</label><br>
          <?php if (!empty($reservation['burger'])): ?>
            <img src="./../image/reservation/<?= htmlspecialchars($reservation['burger']) ?>" alt="burger" style="max-width:150px; max-height:150px; display:block; margin: 10px auto; border-radius: 8px;"><br>
          <?php endif; ?>
          <input type="file" name="im_1">
        </div>

        <div style="text-align: center;">
          <label class="lab" style="font-size: 18px;">Картинка (bottle)</label><br>
          <?php if (!empty($reservation['bottle'])): ?>
            <img src="./../image/reservation/<?= htmlspecialchars($reservation['bottle']) ?>" alt="bottle" style="max-width:150px; max-height:150px; display:block; margin: 10px auto; border-radius: 8px;"><br>
          <?php endif; ?>
          <input type="file" name="im_2">
        </div>

        <div style="text-align: center;">
          <label class="lab" style="font-size: 18px;">Картинка (snack)</label><br>
          <?php if (!empty($reservation['snack'])): ?>
            <img src="./../image/reservation/<?= htmlspecialchars($reservation['snack']) ?>" alt="snack" style="max-width:150px; max-height:150px; display:block; margin: 10px auto; border-radius: 8px;"><br>
          <?php endif; ?>
          <input type="file" name="im_3">
        </div>
      </div>

      <!-- Кнопка отправки -->
      <div style="margin-top: 20px;">
        <input class="inp" style="background-color:blue; color:white; font-size:18px; font-weight: 600; display: block; margin:0 auto; cursor:pointer; width: auto; padding: 12px 40px;" type="submit" name="save" value="Сохранить всё">
      </div>
    </form>

  </div><br>
</body>
</html>
