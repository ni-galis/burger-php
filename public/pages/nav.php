<?php require_once "./db.php"; ?>
<?php
$sql = "SELECT * FROM nav";
$sql = $pdo->prepare($sql);
$sql->execute();
$nav = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="./img/favicon/favicon (10).ico" type="image/x-icon">
  <link rel="stylesheet" href="./swiper-bundle.css">
  <link rel="stylesheet" href="./css/style.css">
  <title>BURGER</title>

</head>

<body>

  <nav class="nav">
    <div class="container">
      <div class="nav__row">

        <div class="nav__row-logo">
          <img class="logo__img" src="./image/nav/<?php echo $nav['filename'] ?>" alt="logo">
        </div>

        <form action="./auth.php" method="post">
          <input style="padding:10px 20px;border:1px solid #beb17cff;text-align:center;background-color:#efefef;opacity:.5; cursor: pointer;color:#b11adfff" type="submit" value="ВХОД">
        </form>

        <div class="nav__row-info">
          <div class="row-info__top">
            <img class="info__top-img" src="./image/nav/<?php echo $nav['car'] ?>" alt="phone-img">
            <span class="ting"><?php echo $nav['ting'] ?></span>
            <a class="num" name="num" href="tel:+1234567890"><?php echo $nav['num'] ?></a>
          </div><!--row-info__top-->

          <div class="burger-btn">
            <span></span>
            <span></span>
            <span></span>
          </div>

          <div class="row-info__bottom">
            <ul class="nav__menu">
              <li class="nav__item"><a href="#" class="nav__link"><?php echo $nav['page-home'] ?></a></li>
              <li class="nav__item"><a href="#" class="nav__link"><?php echo $nav['page-menu'] ?></a>
              </li>
              <li class="nav__item"><a href="#" class="nav__link"><?php echo $nav['page-story'] ?></a>
              </li>
              <li class="nav__item"><a href="#" class="nav__link"><?php echo $nav['page-contact'] ?></a>
              </li>
            </ul>
          </div>
        </div><!--nav__row-info-->
      </div><!--nav__row-->
    </div><!--container-->
  </nav>