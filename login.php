<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/39b6b90061.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Tài khoản</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
    <script src="js/validLoginAndRegistry.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php";
        ?>
        <!--------------------------------------------LOGIN----------------------------------------------------->
        <div class="login-wrap">
            <div class="login-title-wrap">
                <div class="header">
                    <h1>Đăng nhập</h1>
                </div>
            </div>
            <div class="form-wrap"> 
                <div class="form">
                    <form action="./function/login_function.php" method="post" onsubmit="return checkLogin()">
                    <?php
                        if(isset($_GET['fail'])) {
                            echo '<div class="errors-wrap">';
                                echo '<span class="show-error" id="error-all" style="display: block;">*Thông tin đăng nhập không hợp lệ<br>Mời bạn kiểm tra lại</span>';
                            echo '</div>';
                        }
                        if (isset($_GET['block'])) {
                            echo '<div class="errors-wrap">';
                                echo '<span class="show-error" id="error-all" style="display: block;">*Tài khoản của bạn đã bị khóa<br>Vui lòng liên hệ admin để được hỗ trợ</span>';
                            echo '</div>';
                        }
                    ?>  
                            
                        <div class="input-wrap">
                            <input type="email" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="errors-wrap">
                            <span class="show-error" id="error-email">*Vui lòng nhập Email của bạn</span>
                        </div>
                        <div class="input-wrap">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu">
                        </div>
                        <div class="errors-wrap">
                            <span class="show-error" id="error-password">*Vui lòng nhập mật khẩu của bạn</span>
                        </div>
                        <div class="others-wrap">
                            <div class="button-wrap">
                                <button class="sign-in-btn" type="submit" value="login">ĐĂNG NHẬP</button>
                            </div>
                            <div class="reg-pass">
                                <a href="#">Quên mật khẩu?</a>
                                <br>
                                hoặc
                                <a href="register.php">Đăng ký</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
        <!--------------------------------------------FOOTER----------------------------------------------------->
        <?php 
            require_once "./template/footer.php";
        ?>
    </div>
    <?php
        require_once "./template/site-nav.php";
    ?>
</body>
</html>