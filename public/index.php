<?php require_once "./db.php" ?>
<?php
$sql = "SELECT * FROM header";
$sql = $pdo->prepare($sql);
$sql->execute();
$header = $sql->fetch(PDO::FETCH_ASSOC);
?>

<?php require_once "./pages/nav.php"; ?>

<header class="header">
  <div class="container">
    <div class="header__row" style="background-image: url('./image/header/<?= $header['fond'] ?>');">
      <div class="header__row">
        <div class="header__info">
          <div class="header__subtitle"><?= $header['subtitle'] ?></div>
          <img class="sub-retangle" src="./image/header/<?= $header['rectangle'] ?>" alt="restangle">
          <h1 class="header__title"><?= $header['title'] ?></h1>
          <div class="header__suptitle"><?= $header['suptitle'] ?></div>
        </div><!--header__info-->

        <div class="header-img">
          <img src="./image/header/<?= $header['filename'] ?>" alt="burger">
        </div>

      </div><!--header__row-->
    </div><!--container-->
</header>

<?php require_once "./pages/burger.php" ?>
<?php require_once "./pages/choce.php" ?>
<?php require_once "./pages/discover.php" ?>
<?php require_once "./pages/reservation.php" ?>
<?php require_once "./pages/footer.php" ?>