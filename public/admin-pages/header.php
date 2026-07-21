<?php session_start() ?>
<?php require_once "./../db.php"; ?>
<?php
$title = 'Редактирование главной страницы';
require_once "./../blocks/header-top.php"
?>

<?php
$sql = 'SELECT * FROM header';
$sql = $pdo->prepare($sql);
$sql->execute();
$header = $sql->fetch(PDO::FETCH_ASSOC);
?>


<body style="background: linear-gradient(180deg, 
#2a2d3e,
#fecb6e);
 min-height:100vh;">

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:50px;font-size: 35px">РЕДАКТИРОВАНИЕ ИНФОРМАЦИИ HEADER</h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

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
      <form action="./../lib-admin/header.php" method="post" enctype="multipart/form-data">
        <!--<input type="hidden" name="id" value="<?= $header['id'] ?>">-->

        <div style="display:flex;justify-content: center;gap:50px;">
          <div>
            <label class="lab">subtitle</label><br>
            <input class="inp" type="text" name="subtitle" value="<?= $header['subtitle'] ?>"><br><br>

            <label class="lab">rectangle</label><br>
            <input class="inp" type="text" name="rectangle" value="<?= $header['rectangle'] ?>"><br><br>

            <label class="title">title</label><br>
            <input class="inp" type="text" name="title" value="<?= $header['title'] ?>">

          </div>
          <div>
            <label class="lab">suptitle</label><br>
            <input class="inp" type="text" name="suptitle" value="<?= $header['suptitle'] ?>"><br><br>

            <label class="lab">fond</label><br>
            <input class="inp" type="text" name="fond" value="<?= $header['fond'] ?>"><br><br>

          </div>
          <div>
            <input type="file" name="im"><br><br><br>

            <input class="inp" style="color: yellow;  font-weight: 700; background-color:#7e7cc5ff" type="submit" name="save" value="СОХРАНИТЬ"><br><br><br><br>
            <img src="./../image/header/<?= $header['picframe'] ?>" alt="logo">
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