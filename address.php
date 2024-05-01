<?php
    session_start();
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
    <link rel="stylesheet" href="css/address.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Tài khoản</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
    <script src="js/showEditAddAddress.js?v=<?php echo time();?>" defer></script>
    <script src="js/delete_address.js?v=<?php echo time();?>" defer></script>
</head>
<body>

    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
        require_once "./template/header.php";
        ?>
        <!--------------------------------------------LAYOUT-ADDRESS----------------------------------------------------->
        <div class="layout-address">
            <div class="address-header">
                <h1>Thông tin địa chỉ</h1>
            </div>
            <div class="address-content">
                <div class="row">
                    <div class="sidebar-account">
                        <div class="AccountSidebar">
                            <h3 class="account-title">Tài khoản</h3>
                            <div class="account-content">
                                <div class="account-list">
                                    <ul>
                                        <li>
                                            <a href="">Thông tin tài khoản</a>
                                        </li>
                                        <li><a href="./address.php">Danh sách địa chỉ</a></li>
                                        <li><a href="./function/log_out.php">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="content-wrap">
                        <div class="">
                            <div class="content-page">
                    <?php
                        if (isset($_SESSION['addresses']) && !empty($_SESSION['addresses'])) {        
                            foreach ($_SESSION['addresses'] as $address) { ?>
                                <div class="address-table-wrap">
                                    <div id="address-table">
                                        <div class="row">
                                            <div class="address-title-wrap">
                                                <div class="address-title">
                                                    <h3>
                                                        <strong><?php echo isset($address['adrs_fullname']) ? $address['adrs_fullname'] : ''; ?></strong>
                                                    </h3>
                                                    <p class="adrress_actions">
                                                        <span class="action_link action_edit">
                                                            <a href="" class="showEdit">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                        </span>
                                                        <span class="action_link action_delete">
                                                            <a href="#" class="delete-address" data-address-id="<?php echo isset($address['adrs_id']) ? $address['adrs_id'] : ''; ?>">
                                                                <i class="fa fa-times" aria-hidden="true"></i>
                                                            </a>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>   
                                        </div>
                                        <!--Hiện danh sách địa chỉ-->
                                        <div class="address_table">
                                            <div id="view_address" class="customer_address">
                                                <div class="view_address">
                                                    <div class="customer-infor-wrap">
                                                        <div class="customer_name row">
                                                            <p>
                                                                <strong><?php echo isset($address['adrs_fullname']) ? $address['adrs_fullname'] : ''; ?></strong>
                                                            </p>
                                                        </div>
                                                        <div class="customer_name_infor"></div>
                                                    </div>
                                                    <div class="customer-infor-wrap">
                                                        <div class="customer_address row">
                                                            <p>
                                                                <b>Địa chỉ</b>
                                                            </p>
                                                        </div>
                                                        <div class="customer_address_infor">
                                                            <p><?php echo isset($address['adrs_address']) ? $address['adrs_address'] : ''; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="customer-infor-wrap">
                                                        <div class="customer_phone row">
                                                            <p>
                                                                <b>Số điện thoại</b>
                                                            </p>
                                                        </div>
                                                        <div class="customer_phone_infor">
                                                            <p><?php echo isset($address['adrs_phone']) ? $address['adrs_phone'] : ''; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Bảng sửa địa chỉ-->
                                            <div id="edit_address" class="customer_address edit_address" style="display: none;">
                                                <form id="address_form" accept-charset="UTF-8" action="./function/update_address.php" method="POST">
                                                    <input type="hidden" name="address_list_id" value="<?php echo isset($address['adrs_id']) ? $address['adrs_id'] : ''; ?>">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <ion-icon name="person-circle-outline"></ion-icon>
                                                        </span>
                                                        <input id="address_fullname" class="form-control textbox" name="adrs_fullname" type="text" size="40" value="<?php echo isset($address['adrs_fullname']) ? $address['adrs_fullname'] : ''; ?>" placeholder="Họ Tên">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <ion-icon name="home-outline"></ion-icon>
                                                        </span>
                                                        <input id="address_address" class="form-control textbox" name="adrs_address" type="text" size="40" value="<?php echo isset($address['adrs_address']) ? $address['adrs_address'] : ''; ?>" placeholder="Địa chỉ">
                                                    </div>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <ion-icon name="person-circle-outline"></ion-icon>
                                                        </span>
                                                        <input id="address_phone" class="form-control textbox" name="adrs_phone" type="text" size="40" value="<?php echo isset($address['adrs_phone']) ? $address['adrs_phone'] : ''; ?>" placeholder="Số điện thoại">
                                                    </div>
                                                    <div class="input-group">
                                                        <?php if(isset($address['adrs_isDefault']) && $address['adrs_isDefault'] == 1 ) {
                                                            echo '<input type="checkbox" id="address_default_address_new" name="address_default" value="1" checked>';
                                                        }
                                                        else {
                                                            echo '<input type="checkbox" id="address_default_address_new" name="address_default" value="1">';
                                                        } ?>
                                                        <label for="address_default">Đặt làm địa chỉ mặc định</label>
                                                    </div>
                                                    <div class="action_bottom">
                                                        <input type="submit" class="btn bt-primary" value="CẬP NHẬT">
                                                        <span>
                                                            hoặc
                                                            <a href="#">Hủy</a>
                                                        </span>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } 
                        } else {
                            // Hiển thị thông báo nếu không có địa chỉ nào được lưu trong session
                            echo "Không có địa chỉ nào được lưu.";
                        } ?>
                            </div>
                        </div>
                    </div>
                    <div class="add-address-wrap">
                        <a href="#" id="add-new-address" class="add-new-address">Nhập địa chỉ mới</a>
                        <div id="add_address" class="customer_address edit_address" style="display: none;">
                            <form accept-charset="UTF-8" action="./function/add_address.php" id="address_form_new" method="POST">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                    </span>
                                    <input id="address_fullname" name="address_fullname" class="form-control textbox" type="text" size="40" value="" placeholder="Họ Tên">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <ion-icon name="home-outline"></ion-icon>
                                    </span>
                                    <input id="address_address" name="address_address" class="form-control textbox" type="text" size="40" value="" placeholder="Địa chỉ">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <ion-icon name="person-circle-outline"></ion-icon>
                                    </span>
                                    <input id="address_phone" name="address_phone" class="form-control textbox" type="text" size="40" value="" placeholder="Số điện thoại">
                                </div>
                                <div class="input-group">
                                    <input type="checkbox" id="address_default_address_new" name="address_default" value="1">
                                    <label for="address_default">Đặt làm địa chỉ mặc định</label>
                                </div>
                                <div class="action_bottom">
                                    <input type="submit" class="btn bt-primary" value="THÊM MỚI">
                                    <span>
                                        hoặc
                                        <a href="">Hủy</a>
                                    </span>
                                </div>
                            </form>
                        </div>  
                    </div>
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
    <!--------------------------------------------SITE NAV----------------------------------------------------->
    <?php
        require_once "./template/site-nav.php";
    ?>
</body>
</html>