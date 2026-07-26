<?php session_start() ?>
<h1 style="color:yellowgreen;font-size:16px;">admin-pages/hamburger.php</h1>
<?php require_once "./../db.php"; ?>
<?php
$title = 'Редактирование hamburger';
require_once "./../blocks/header-top.php"
?>

<body style="background: linear-gradient(270deg, 
#f7f7f7,
#b9a0a0,
#794747,
#4e2020,
#111111);
 min-height:100vh;">

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:50px;font-size: 35px">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ HAMBURGER</h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

    <?php if (!empty($_SESSION['login'])) : ?>

      <?php
      echo "Аккуратненько &nbsp;" . $_SESSION['login'], ",&nbsp; аккуратненько."
      ?>

      <br><br><a href="./../logout.php" style="color:#f02b2bff">Выйти</a>

      <style>
        .lab {
          font-style: italic;
          font-size: 20px;
        }

        .inp {
          padding: 10px 50px 10px 50px;
          border-radius: 5px;
        }
      </style>

      <?php
      $sql = 'SELECT * FROM hamburger';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $hamburger = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>

     <form action="/lib-admin/hamburger.php" method="post" enctype="multipart/form-data"><br>
  
  <!-- Скрытые поля, чтобы передать текущие имена файлов в $_POST -->
  <input type="hidden" name="filename_1" value="<?= htmlspecialchars($hamburger['filename_1'] ?? '') ?>">
  <input type="hidden" name="filename_2" value="<?= htmlspecialchars($hamburger['filename_2'] ?? '') ?>">
  <input type="hidden" name="filename_3" value="<?= htmlspecialchars($hamburger['filename_3'] ?? '') ?>">

  <!-- Блок 1 -->
  <label style="font-size: 18px;">Картинка 1 (filename_1)</label><br><br>
  <img src="./../image/hamburger/<?= $hamburger['filename_1'] ?>" alt="most" style="max-width:200px;"><br><br>
  <input type="file" name="im_1"><br><br><br>

  <!-- Блок 2 -->
  <label style="font-size: 18px;">Картинка 2 (filename_2)</label><br><br>
  <img src="./../image/hamburger/<?= $hamburger['filename_2'] ?>" alt="more" style="max-width:200px;"><br><br>
  <input type="file" name="im_2"><br><br><br>

  <!-- Блок 3 -->
  <label style="font-size: 18px;">Картинка 3 (filename_3)</label><br><br>
  <img src="./../image/hamburger/<?= $hamburger['filename_3'] ?>" alt="fresh" style="max-width:200px;"><br><br>
  <input type="file" name="im_3"><br><br>

  <!-- Одна общая кнопка для сохранения всего -->
  <input style="color: aqua; background-color:blue; font-size:18px; font-weight: 600;" class="inp" type="submit" name="save" value="Сохранить всё"><br><br><br>

</form>

    <?php else:
      echo "<h3>НИ-НИ, НЕЛЬЗЯЯЯЯ</h3>"
    ?>
      <br><a href="./../logout.php" style="color:#f02b2bff">ВЫЙТИ</a>

    <?php endif ?>

  </div>

</body>

</html>