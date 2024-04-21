<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/39b6b90061.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/cart-search.css">
    <title>Tạo tài khoản</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js" defer></script>
</head>
<body>
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
                <form action="">
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="fullname">Họ và tên*</label>
                        </div>
                        <input required type="text" name="fullname" id="" placeholder="Họ và tên">
                        <div class="errors-wrap">
                            <span class="show-error">*Vui lòng nhập Họ tên của bạn</span>
                        </div>
                    </div>
                    <div class="gender-wrap">
                        <div class="label-wrap">
                            <label for="gender">Giới tính</label>
                        </div>
                        <div class="radio-wrap">
                            <input type="radio" id="radio1" name="gender" value="female">
                            <label for="radio1">Nữ</label>
                            <input type="radio" id="radio2" name="gender" value="male">
                            <label for="radio2">Nam</label>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="birthday">Ngày sinh</label>
                        </div>
                        <input type="text" name="birthday" id="" placeholder="mm/dd/yyyy">
                        <div class="errors-wrap">
                            <span class="show-error">*Ngày sinh của bạn không hợp lệ</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="email">Email*</label>
                        </div>
                        <input type="email" name="email" id="" placeholder="Email">
                        <div class="errors-wrap">
                            <span class="show-error">*Vui lòng nhập Email của bạn</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="password">Mật khẩu*</label>
                        </div>
                        <input required type="password" name="password" id="" placeholder="Mật khẩu">
                        <div class="errors-wrap">
                            <span class="show-error">*Vui lòng nhập Mật khẩu của bạn</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="address">Địa chỉ</label>
                        </div>
                        <input required type="text" name="address" id="" placeholder="Địa chỉ">
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
        <footer>
            <div class="footerWrap">
                <div class="mainFooter">
                    <div class="col">
                        <div class="footer-contentWrap">
                            <h4 class="footer-title">Giới thiệu</h4>
                            <div class="footer-content">
                                <p>A Little Leaf Tiệm tạp hóa của Tình yêu: dành cho những góc bạn yêu ở nơi được gọi là "Nhà"</p>
                            </div>
                            <div class="footerLogo">
                                <img src="../img/footerLogo.webp" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="footer-contentWrap">
                            <h4 class="footer-title">Liên kết</h4>
                            <div class="footer-content">
                                <ul>
                                    <li class="items">
                                        <a href="">Tìm kiếm</a>
                                    </li>
                                    <li class="items">
                                        <a href="">Giới thiệu</a>
                                    </li>
                                    <li class="items">
                                        <a href="">Chính sách đổi trả</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                
                    <div class="col">
                        <div class="footer-contentWrap">
                            <h4 class="footer-title">Showroom</h4>
                            <div class="footer-content">
                                <ul>
                                    <li class="contact">
                                        <p><ion-icon name="location-outline"></ion-icon> 212/A51 Nguyễn Trãi, P. Nguyễn Cư Trinh, Quận 1</p>
                                    </li>
                                    <li class="contact">
                                        <p><ion-icon name="call-outline"></ion-icon> 098.873.55.00</p>
                                    </li>
                                    <li class="contact">
                                        <p><ion-icon name="mail-outline"></ion-icon> alittleleaf.homedecor@gmail.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="footer-contentWrap">
                            <h4 class="footer-title">Mạng xã hội</h4>
                            <div class="footer-content">
                                <div class="wrapSocial">
                                    <ion-icon name="logo-facebook"></ion-icon>
                                </div>
                                <div class="wrapSocial">
                                    <ion-icon name="logo-instagram"></ion-icon>
                                </div>
                                <div class="wrapSocial">
                                    <ion-icon name="logo-tiktok"></ion-icon>
                                </div>
                                <div class="wrapSocial">
                                    <ion-icon name="logo-youtube"></ion-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footerBottom">
                    <p>Copyright © 2024 A Little Leaf. Powered by Haravan</p>
                </div>
            </div>
        </footer>
    </div>
    <?php
        require_once "./template/site-nav.php";
    ?>
</body>
</html>