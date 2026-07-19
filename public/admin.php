<?php session_start() ?>
<?php require_once "./db.php"; ?>
<?php
$title = 'Административная панель';
require_once "./blocks/header-top.php"
?>

<body style="background: linear-gradient(45deg, 
#8a2be2,
#0000cd, 
#228b22,
#ccff00);
 height:100vh;">

  <h3 style="color:#eeaf3bff; text-align: center; padding-top:80px;font-size: 35px">АДМИНИСТРАТИВНЫЙ КАБИНЕТ</h3>

  <div style="font-size: 25px; color: #f1e608ff; text-align: center; padding-top:20px;">

    <!--ЕСЛИ СЕССИЯ ЗАКРЫТА Т.Е. ПУСТАЯ ТО НИКТО НЕ ДОЛЖЕН ПОПАСТЬ В admin ДЕЛАЕМ ДЛЯ ЭТОГО СОКРАЩЕННУЮ ЗАПИСЬ-->

    <?php if (!empty($_SESSION['login'])) : ?>

      <?php
      echo "Резвись аккуратно " . $_SESSION['login'], " и осторожно."
      ?>

      <br><br><a href="./logout.php" style="color:#f02b2bff">Выйти</a><br><br>

      <style>
        .page {
          color: #f79708ff;
        }
      </style>
      <a class="page" href="./admin-pages/nav.php">Nav</a> |
      <a class="page" href="./lib-editing/burger.php">Burger</a> |
      <a class="page" href="./lib-editing/choce.php">Choce</a> |
      <a class="page" href="./lib-editing/discover.php">Discover</a> |
      <a class="page" href="./lib-editing/reservation.php">Reservation</a> |
      <a class="page" href="./lib-editing/footer.php">Footer</a> |

  </div>

<?php else:
      echo "<h3>НИ-НИ, НЕЛЬЗЯЯЯЯ</h3>"
?>
  <br><a href="./logout.php" style="color:#f02b2bff">ВЫЙТИ</a>

  <!-- ПРОДОЛЖЕНИЕ СОКРАЩЕННОЙ ЗАПИСИ Т.Е. ЗАКРЫВАЕМ-->
<?php endif ?>

</div>

</body>

</html>