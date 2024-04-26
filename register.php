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
    <link rel="stylesheet" href="css/register.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Tạo tài khoản</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
    <script src="js/validLoginAndRegistry.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <?php
        session_start();
    ?>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
        require_once "./template/header.php";
        ?>
        <!--------------------------------------------REGISTER----------------------------------------------------->
        <div class="register-wrap">
        <div class="register-title-wrap">
            <div class="header">
                <h1>Tạo tài khoản</h1>
            </div>
        </div>
        <div class="form-wrap"> 
            <div class="form">
                <form action="./function/registry.php" method="post" onsubmit="return checkRegistry()">
                <?php 
                    if(isset($_GET['fail'])) {
                        $fail = $_GET['fail'];
                        if ($fail) {
                            echo '<div class="errors-wrap">
                            <span class="show-error" id="isExist-error" style="display: block;">Email đã tồn tại.</span>
                        </div>' ;
                        }
                    }
                ?>
                    
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="fullname">Họ và tên*</label>
                        </div>
                        <input  type="text" name="fullname" id="fullname" placeholder="Họ và tên">
                        <div class="errors-wrap">
                            <span class="show-error" id="fullname-error">*Vui lòng nhập Họ tên của bạn</span>
                        </div>
                    </div>
                    <div class="gender-wrap">
                        <div class="label-wrap">
                            <label for="gender">Giới tính*</label>
                        </div>
                        <div class="radio-wrap">
                            <input type="radio" id="radio1" name="gender" value="Nữ" checked>
                            <label for="radio1">Nữ</label>
                            <input type="radio" id="radio2" name="gender" value="Nam">
                            <label for="radio2">Nam</label>
                        </div>
                        <div class="errors-wrap">
                            <span class="show-error" id="gender-error">*Vui lòng chọn Giới tính của bạn</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="birthday">Ngày sinh*</label>
                        </div>
                        <input  type="text" name="birthday" id="birthday" placeholder="dd/mm/yyyy">
                        <div class="errors-wrap">
                            <span class="show-error" id="birthday-error"></span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="email">Email*</label>
                        </div>
                        <input  type="text" name="email" id="email" placeholder="Email">
                        <div class="errors-wrap">
                            <span class="show-error" id="email-error"></span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="password">Mật khẩu*</label>
                        </div>
                        <input  type="password" name="password" id="password" placeholder="Mật khẩu">
                        <div class="errors-wrap">
                            <span class="show-error" id="password-error">*Vui lòng nhập Mật khẩu của bạn</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="address">Địa chỉ*</label>
                        </div>
                        <input  type="text" name="address" id="address" placeholder="Địa chỉ">
                        <div class="errors-wrap">
                            <span class="show-error" id="address-error">*Vui lòng nhập Địa chỉ của bạn</span>
                        </div>
                    </div>
                    <div class="others-wrap">
                        <div class="button-wrap">
                            <button class="sign-in-btn" type="submit" value="login">ĐĂNG KÝ</button>
                        </div>
                        <div class="return">
                            <a href="login.php">
                                <i class="fa-solid fa-arrow-left-long"></i>
                                Quay lại đăng nhập
                            </a>
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