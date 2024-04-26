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
    <link rel="stylesheet" href="css/account.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Tài khoản</title>
    <link rel="icon" type="image/x-icon" href="../img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <?php
        session_start();
    ?>
    <div id="main-body" class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php"
        ?>
        <!--------------------------------------------LAYOUT-ACCOUNT----------------------------------------------------->
        <div class="layout-account">
            <div class="account-header">
                <h1>Tài khoản của bạn</h1>
            </div>
            <div class="account-content">
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
                                        <li><a href="">Danh sách địa chỉ</a></li>
                                        <li><a href="">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer-sidebar-wrap">
                        <div class="row-inside">
                            <div class="customer-sidebar">
                                <p class="title-detail">Thông tin tài khoản</p>
                                <h2 class="account-name">La Hoành Nghiệp</h2>
                                <p class="account-email">hoanhnghiep2704@gmail.com</p>
                                <div class="address">
                                    <a id="view-address" href="">Xem địa chỉ</a>
                                </div>
                            </div>
                            <div class="customer-table-wrap">
                                <div class="customer-table-bg">
                                    <p class="title-detail"> Danh sách đơn hàng mới nhất </p>
                                    <div class="table-wrap">
                                        <table class="table">
                                            <thead>
                                                <th class="order-number text-center">Mã đơn hàng</th>
                                                <th class="date text-center">Ngày đặt</th>
                                                <th class="total text-center">Thành tiền</th>
                                                <th class="payment-status text-center">Trạng thái thanh toán</th>
                                                <th class="fulfillment-status text-center">Vận chuyển</th>
                                            </thead>
                                            <tbody>
                                                <tr class="order">
                                                    <td class="text-center">
                                                        <a href="">#194877</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <span>18/03/2024</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="total-money">360,000đ</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="status-pending">pending</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="status-fulfilled">not fulfilled</span>
                                                    </td>
                                                </tr>
                                                <tr class="order">
                                                    <td class="text-center">
                                                        <a href="">#194877</a>
                                                    </td>
                                                    <td class="text-center">
                                                        <span>18/03/2024</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="total-money">360,000đ</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="status-pending">pending</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="status-fulfilled">not fulfilled</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--------------------------------------------FOOTER----------------------------------------------------->
        <?php
            require_once "./template/footer.php";
        ?>
    </div>
    <!--------------------------------------------SITE-NAV----------------------------------------------------->
    <?php
        require_once "./template/site-nav.php";
    ?>
</body>
</html>