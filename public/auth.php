<?php require_once "./db.php"; ?>
<?php
$title = 'АВТОРИЗАЦИЯ';
require_once "./blocks/header-top.php"
?>

<body style="background: linear-gradient(45deg, 
#f7f7f7,
#b9a0a0,
#794747,
#4e2020,
#111111
);
 height:100vh;">


  <h3 style="color:#1fec0cff; text-align: center; padding-top:80px;font-size:35px">АВТОРИЗАЦИЯ НА САЙТЕ</h3>

  <style>
    .lab {
      color: aqua;
      font-size: 20px;
    }

    .inp {
      padding: 15px 300px 15px 10px;
      border-radius: 5px;
      background-color: #ccc;
    }

    ::placeholder {
      font-size: 18px;
      color: blue;
    }

    .auth-btn {
      padding: 15px 50px 15px 50px;
      border-radius: 15px;
      background-color: #62c6e7ff;
      color: #150b46ff;
      cursor: pointer;
      font-weight: 700;
    }
  </style>

  <form style="text-align:center;padding-top: 20px;" action="/lib/auth.php" method="post">

    <label class="lab">логин</label><br>
    <input class="inp" type="text" name="login" placeholder="Введите логин"><br><br>
    <label class="lab">password</label><br>
    <input class="inp" type="password" name="password" placeholder="Введите пароль"><br><br>
    <button class="auth-btn" type="submit">ВОЙТИ</button>
  </form>

</body>