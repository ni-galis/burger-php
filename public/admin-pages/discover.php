<?php session_start() ?>
<h1 style="color:yellowgreen;font-size:16px;">admin-pages/discover.php</h1>
<?php require_once "./../db.php"; ?>
<?php
$title = 'Редактирование discover';
require_once "./../blocks/header-top.php"
?>

<body style="background: linear-gradient(45deg, #2a2d3e, #fecb6e); min-height:100vh;">

  <h3 style="color:#16ee48ff; text-align: center; padding-top:80px;font-size: 35px">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ DISCOVER</h3>

  <!--добавлен или нет новый файл  -->
  <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; text-align: center; max-width: 400px; margin: 20px auto; font-size: 18px; font-weight: bold;">
      Данные успешно сохранены!
    </div>
  <?php endif; ?>

  <div style="font-size: 25px; color:#0bacf1ff; text-align: center; padding-top:20px;">

    <?php if (!empty($_SESSION['login'])) : ?>

      <?php echo "Резвись аккуратно " . htmlspecialchars($_SESSION['login']) .  " и осторожно."; ?>

      <br><br><a href="./../logout.php" style="color:#f02b2bff">Выйти</a><br><br>

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
      $sql = 'SELECT * FROM discover';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $discover = $stmt->fetch(PDO::FETCH_ASSOC);
      ?>

      <form action="/lib-admin/discover.php" method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 40px; padding: 20px; border-radius: 10px; display: flex; justify-content: center; gap:100px">

          <div>
            <label class="lab">subtitle</label><br>
            <input class="inp" type="text" name="subtitle" value="<?= htmlspecialchars($discover['subtitle'] ?? '') ?>"><br><br>
            <label class="lab">title</label><br>
            <input class="inp" type="text" name="title" value="<?= htmlspecialchars($discover['title'] ?? '') ?>"><br><br>
            <label class="lab">text</label><br>
            <input class="inp" type="text" name="text" value="<?= htmlspecialchars($discover['text'] ?? '') ?>"><br><br>
          </div>

          <!-- ИСПРАВЛЕНО: убрана лишняя кавычка в теге div -->
          <div>
            <!-- Скрытые поля для сохранения старых имен файлов -->
            <input type="hidden" name="slide_1" value="<?= htmlspecialchars($discover['slide_1'] ?? '') ?>">
            <input type="hidden" name="slide_2" value="<?= htmlspecialchars($discover['slide_2'] ?? '') ?>">
            <input type="hidden" name="slide_3" value="<?= htmlspecialchars($discover['slide_3'] ?? '') ?>">

            <!-- Блок 1 -->
            <label style="font-size: 18px;">slide_1</label><br>
            <img src="./../image/discover/<?= htmlspecialchars($discover['slide_1'] ?? '') ?>" alt="slide_1" style="max-width:200px;"><br><br>
            <input type="file" name="im_1"><br><br>

            <!-- Блок 2 -->
            <label style="font-size: 18px;">slide_2</label><br>
            <img src="./../image/discover/<?= htmlspecialchars($discover['slide_2'] ?? '') ?>" alt="more" style="max-width:200px;"><br><br>
            <input type="file" name="im_2"><br><br>

            <!-- Блок 3 -->
            <label style="font-size: 18px;">slide_3</label><br>
            <img src="./../image/discover/<?= htmlspecialchars($discover['slide_3'] ?? '') ?>" alt="fresh" style="max-width:200px;"><br><br>
            <input type="file" name="im_3"><br>
          </div>

        </div>

        <!-- ИСПРАВЛЕНО: убрана точка с запятой из структуры тегов -->
        <input style="color: aqua; background-color:blue; font-size:18px; font-weight: 600; display:block; margin: 0 auto;" class="inp" type="submit" name="save" value="Сохранить всё"><br><br><br>
      </form>

    <?php else: ?>
      <!-- ИСПРАВЛЕНО: блок кода для неавторизованных пользователей теперь изолирован -->
      <h3>НИ-НИ, НЕЛЬЗЯЯЯЯ</h3>
      <br><a href="./../logout.php" style="color:#f02b2bff">ВЫЙТИ</a>
    <?php endif ?>

  </div>
</body>

</html>