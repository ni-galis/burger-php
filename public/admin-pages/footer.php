<?php
// Инициализация сессии должна быть на самой первой строчке кода
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование footer</title>
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
    </style>
</head>

<body style="background: linear-gradient(90deg, #f7f7f7, #b9a0a0, #794747, #4e2020, #111111); min-height:100vh;">

  <h1 style="color:yellowgreen;font-size:16px; margin: 10px;">admin-pages/footer.php</h1>

  <?php
  // Включаем раскомментирование защиты при переносе на рабочий сервер
  if (empty($_SESSION['login'])) {
      // header("Location: ./../logout.php");
      // exit("Доступ запрещен!");
  }

  require_once "./../db.php";
  $title = 'Редактирование footer';
  require_once "./../blocks/header-top.php";

  // Получаем текущие данные из БД (id = 1 или единственная запись)
  try {
      $sql = 'SELECT * FROM footer LIMIT 1';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $footer = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      exit("Ошибка загрузки данных: " . $e->getMessage());
  }
  ?>

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:30px; font-size: 35px; text-transform: uppercase; margin-top: 0;">
    Редактирование информации footer
  </h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

    <!-- Приветствие администратора -->
    <?= "Аккуратненько &nbsp;" . htmlspecialchars($_SESSION['login'] ?? 'Администратор') . ",&nbsp; аккуратненько." ?>
    <br><br>
    <a href="./../logout.php" style="color:#f02b2bff; text-decoration: none; font-weight: bold;">Выйти</a><br><br>

    <!-- Вывод уведомления об успешном сохранении -->
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
      <div style="color: #ccff00; font-size: 20px; font-weight: bold; margin-bottom: 20px;">
        Изменения успешно сохранены!
      </div>
    <?php endif; ?>

    <!-- ФОРМА ОТПРАВКИ ДАННЫХ -->
    <form class="form-container" action="/lib-admin/footer.php" method="post" enctype="multipart/form-data">

      <div style="display: flex; justify-content: center; align-items: flex-start; gap:100px; text-align: left; max-width: 1200px; margin: 0 auto;">

        <!-- Колонка 1: Общая инфо -->
        <div>
            <label class="lab">footer-logo</label><br><br>
            <img src="./../image/footer/<?= htmlspecialchars($footer['logo'] ?? '') ?>" alt="logo" style="max-width:200px; display:block; margin-bottom:10px;">
            <input type="file" name="im_1"><br><br><br>

            <label class="lab">text</label><br>
            <!-- ИСПРАВЛЕНО: значение выводится внутри тегов, а не через атрибут value -->
            <textarea name="textarea" style="width: 220px; height: 100px; padding: 10px; border-radius: 5px; font-size: 16px; box-sizing: border-box;"><?= htmlspecialchars($footer['textarea'] ?? $footer['textarea'] ?? '') ?></textarea><br><br>

            <label class="lab">copyright</label><br>
            <input class="inp" type="text" name="copyright" value="<?= htmlspecialchars($footer['copyright'] ?? '') ?>"><br><br>
        </div>

        <!-- Колонка 2: Локация и Контакты -->
        <div>    

          <label class="lab">location</label><br><br>
          <img src="./../image/footer/<?= htmlspecialchars($footer['location'] ?? '') ?>" alt="location" style="max-width:200px; display:block; margin-bottom:10px;">
          <input type="file" name="im_2"><br><br><br>

          <label class="lab">address-location</label><br>
          <input class="inp" type="text" name="address" value="<?= htmlspecialchars($footer['location_text'] ?? $footer['address'] ?? '') ?>"><br><br>

          <label class="lab">email</label><br><br>
          <img src="./../image/footer/<?= htmlspecialchars($footer['email'] ?? '') ?>" alt="email" style="max-width:200px; display:block; margin-bottom:10px;">
          <input type="file" name="im_3"><br><br><br>

          <label class="lab">address-email</label><br>
          <input class="inp" type="email" name="email_address" value="<?= htmlspecialchars($footer['email_address'] ?? '') ?>"><br><br>
        </div>

        <!-- Колонка 3: Соцсети -->
        <div>
          <label class="lab">instagram</label><br>
          <img src="./../image/footer/<?= htmlspecialchars($footer['instagram'] ?? '') ?>" alt="instagram" style="max-width:200px; display:block; margin-bottom:10px;">
          <input type="file" name="im_4"><br><br>

          <label class="lab">facebook</label><br>
          <img src="./../image/footer/<?= htmlspecialchars($footer['facebook'] ?? '') ?>" alt="facebook" style="max-width:200px; display:block; margin-bottom:10px;">
          <input type="file" name="im_5"><br><br>

          <label class="lab">twitter</label><br>
          <img src="./../image/footer/<?= htmlspecialchars($footer['twitter'] ?? '') ?>" alt="twitter" style="max-width:200px; display:block; margin-bottom:10px;">
          <input type="file" name="im_6"><br><br>

          <label class="lab">whatsapp</label><br>
          <img src="./../image/footer/<?= htmlspecialchars($footer['whatsapp'] ?? '') ?>" alt="whatsapp" style="max-width:200px; display:block; margin-bottom:10px;">
          <input type="file" name="im_7"><br><br>
        </div>
      </div>

      <!-- Кнопка отправки -->
      <div style="margin-top: 40px;">
        <input class="inp" style="background-color:blue; color:white; font-size:18px; font-weight: 600; display: block; margin:0 auto; cursor:pointer; width: auto; padding: 12px 40px;" type="submit" name="save" value="Сохранить всё">
      </div>
    </form>

  </div><br>
</body>
</html>
