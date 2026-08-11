<?php session_start(); ?>
<h1 style="color:yellowgreen;font-size:16px;">admin-pages/chooce.php</h1>
<?php require_once "./../db.php"; ?>
<?php
$title = 'Редактирование chooce';
require_once "./../blocks/header-top.php";

// Запрашиваем все данные ОДИН раз
$sql = 'SELECT * FROM chooce';
$stmt = $pdo->query($sql);
$all_rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Берем первую строку для общих заголовков (если записи вообще есть)
$main_data = $all_rows[0] ?? [];
?>

<body style="background: linear-gradient(90deg, #ba8b02, #181818); min-height:100vh;">

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:80px;font-size: 35px">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ CHOOSE</h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

    <?php if (!empty($_SESSION['login'])) : ?>

      <?= "Резвись аккуратно " . htmlspecialchars($_SESSION['login']) . " и осторожно." ?>
      <br><br><a href="./logout.php" style="color:#f02b2bff">Выйти</a><br><br>

      <style>
        .lab {
          font-style: italic;
          font-size: 20px;
          color: #fff;
        }

        .inp {
          padding: 10px 20px;
          border-radius: 5px;
          border: 1px solid #ccc;
        }

        .row-container {
          display: flex;
          justify-content: center;
          gap: 30px;
          margin-bottom: 20px;
          padding: 15px;
          border: 1px solid rgba(255, 255, 255, 0.2);
          border-radius: 8px;
        }
      </style>

      <form action="/lib-admin/chooce.php" method="post" enctype="multipart/form-data">

        <!-- Общая часть (заголовки) -->
        <div style="margin-bottom: 40px;padding: 20px; border-radius: 10px;">
          <label class="lab">subtitle</label><br>
          <input class="inp" type="text" name="subtitle" value="<?= htmlspecialchars($main_data['subtitle'] ?? '') ?>"><br><br>
          <label class="lab">title</label><br>
          <input class="inp" type="text" name="title" value="<?= htmlspecialchars($main_data['title'] ?? '') ?>"><br><br>
          <label class="lab">suptitle</label><br>
          <input class="inp" type="text" name="suptitle" value="<?= htmlspecialchars($main_data['suptitle'] ?? '') ?>"><br><br>
        </div>

        <!-- Цикличная часть для колонок -->
        <?php foreach ($all_rows as $row) : ?>
          <div class="row-container">

            <!-- Скрытый ID строки -->
            <input type="hidden" name="ids[]" value="<?= $row['id'] ?>">

            <div>
              <label class="lab">column_title (ID: <?= $row['id'] ?>)</label><br>
              <input class="inp" type="text" name="column_title[<?= $row['id'] ?>]" value="<?= htmlspecialchars($row['column_title'] ?? '') ?>"><br><br>

              <label class="lab">column_suptitle</label><br>
              <input class="inp" type="text" name="column_suptitle[<?= $row['id'] ?>]" value="<?= htmlspecialchars($row['column_suptitle'] ?? '') ?>"><br><br>
            </div>

            <div>
              <label class="lab">shadow</label><br>
              <input class="inp" type="text" name="shadow[<?= $row['id'] ?>]" value="<?= htmlspecialchars($row['shadow'] ?? '') ?>"><br><br>

              <label class="lab">column_order</label><br>
              <input class="inp" type="text" name="column_order[<?= $row['id'] ?>]" value="<?= htmlspecialchars($row['column_order'] ?? '') ?>"><br><br>
            </div>

            <div>
              <label class="lab">Изображение</label><br>
              <input type="file" name="im[<?= $row['id'] ?>]"><br><br>
              <?php if (!empty($row['filename'])): ?>
                <img style="width:120px; height: auto; object-fit: cover; border-radius: 5px;" src="./../image/choose/<?= htmlspecialchars($row['filename']) ?>" alt="">
              <?php endif; ?>
            </div>

          </div>
        <?php endforeach; ?>

        <br>
        <input style="color: aqua; background-color:blue; font-size:18px; font-weight: 600; cursor: pointer;" class="inp" type="submit" name="save" value="Сохранить всё"><br>

      </form>

    <?php else: ?>
      <h3>НИ-НИ, НЕЛЬЗЯЯЯЯ</h3>
      <br><a href="./logout.php" style="color:#f02b2bff">ВЫЙТИ</a>
    <?php endif ?>

  </div>
</body>