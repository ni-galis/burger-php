<body style="background: linear-gradient(45deg, 
#333333,
#dd1818 );
 height:100vh;">

  <h3 style="color:#89c40bff; text-align:center;font-size:35px; padding-top:100px">РЕГИСТРАЦИЯ НА САЙТЕ</h3>

  <style>
    .lab {
      color: aqua;
      font-size: 20px;
    }

    .inp {
      padding: 15px 300px 15px 10px;
      border-radius: 5px;
      background-color: #ccc;
      font-size: 18px;
    }

    ::placeholder {
      font-size: 18px;
      color: blue;
    }

    .reg-btn {
      padding: 15px 15px 15px 15px;
      border-radius: 15px;
      background-color: #62c6e7ff;
      color: #150b46ff;
      cursor: pointer;
      font-weight: 700;
    }
  </style>

  <form style="text-align:center;padding-top: 20px;" action="./lib/reg.php" method="post">
    <label class="lab">имя</label><br>
    <input class="inp" type="text" name="username" placeholder="введите имя"><br><br>
    <label class="lab">login</label><br>
    <input class="inp" type="text" name="login" placeholder="введите логин"><br><br>
    <label class="lab">пароль</label><br>
    <input class="inp" type="password" name="password" placeholder="введите пароль"><br><br>
    <label class="lab">email</label><br>
    <input class="inp" type="email" name="email" placeholder="введите email"><br><br>
    <button class="reg-btn" type="submit" name="reg-btn">РЕГИСТРАЦИЯ</button>
  </form>

  </body>