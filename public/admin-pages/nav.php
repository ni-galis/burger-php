<?php session_start() ?>
<?php require_once "./../db.php"; ?>
<?php
$title = 'Редактирование информации nav';
require_once "./../blocks/header-top.php"
?>

<?php
$sql = 'SELECT * FROM nav';
$sql = $pdo->prepare($sql);
$sql->execute();
$nav = $sql->fetch(PDO::FETCH_ASSOC);
?>


<body style="background: linear-gradient(45deg, 
#000000,
#0f9b0f);
 min-height:100vh;">

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:50px;font-size: 35px">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ NAV</h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

    <!--ЕСЛИ СЕССИЯ ЗАКРЫТА Т.Е. ПУСТАЯ ТО НИКТО НЕ ДОЛЖЕН ПОПАСТЬ В admin ДЕЛАЕМ ДЛЯ ЭТОГО СОКРАЩЕННУЮ ЗАПИСЬ-->

    <?php if (!empty($_SESSION['login'])) : ?>

      <?php
      echo "Аккуратненько &nbsp;" . $_SESSION['login'], ",&nbsp; аккуратненько."
      ?>

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
      <form action="./../lib-admin/nav.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $nav['id'] ?>">
          
        <div style="display:flex;justify-content: center;gap:50px;">
          <div>
            <label class="lab">phone</label><br>
            <input class="inp" type="text" name="phone" value="<?= $nav['phone'] ?>"><br><br>
            <label class="lab">num</label><br>
            <input class="inp" type="text" name="num" value="<?= $nav['num'] ?>"><br><br>
            <label class="lab">ting</label><br>
            <input class="inp" type="text" name="ting" value="<?= $nav['ting'] ?>">
          </div>
          <div>
            <label class="lab">home</label><br>
            <input class="inp" type="text" name="home" value="<?= $nav['page-home'] ?>"><br><br>
            <label class="lab">menu</label><br>
            <input class="inp" type="text" name="menu" value="<?= $nav['page-menu'] ?>"><br><br>
            <label class="lab">story</label><br>
            <input class="inp" type="text" name="story" value="<?= $nav['page-story'] ?>"><br><br>
            <label class="lab">contact</label><br>
            <input class="inp" type="text" name="contact" value="<?= $nav['page-contact'] ?>"><br><br>
          </div>
          <div>
            <input type="file" name="im"><br><br><br>

            <input class="inp" style="color: yellow;  font-weight: 700; background-color:#7e7cc5ff" type="submit" name="save" value="СОХРАНИТЬ"><br><br><br><br>
            <img src="./../image/nav/<?= $nav['filename'] ?>" alt="logo">
          </div>
        </div>
      </form>

  </div>

<?php else:
      echo "<h3>НИ-НИ, НЕЛЬЗЯЯЯЯ</h3>"
?>
  <br><a href="./../logout.php" style="color:#f02b2bff">ВЫЙТИ</a>

  <!-- ПРОДОЛЖЕНИЕ СОКРАЩЕННОЙ ЗАПИСИ Т.Е. ЗАКРЫВАЕМ-->
<?php endif ?>

</div>

</body>

</html>