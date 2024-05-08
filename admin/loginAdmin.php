<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login & Registration Form</title>
  <link rel="stylesheet" href="loginregister.css?v=<?php echo time();?>">
  <script src="./js/login.js?v=<?php echo time();?>" defer></script>
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login Admin</header>
      <form action="./function/loginAdminFunc.php" method="POST" onsubmit="return checkLogin()">
        <p id="error-username" class="show-error" style="display: none; color: red;">Vui lòng nhập Username</p>
        <input id="email" type="text" name="admin_username" placeholder="Enter your username">
        <p id="error-password" class="show-error" style="display: none; color: red;">Vui lòng nhập Mật khẩu</p>
        <input id="password" type="password" name="admin_password" placeholder="Enter your password">
        <input type="submit" class="button" value="Login">
      </form>
    </div>
  </div>
</body>
</html>