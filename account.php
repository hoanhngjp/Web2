<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }   
    /*if ($_SESSION['logged'] && $_SESSION['email'] && $_SESSION['fullname'] && $_SESSION['addresses']) {
        echo $_SESSION['logged'];
        echo '<br>';
        echo $_SESSION['email'];
        echo '<br>';
        echo $_SESSION['fullname'];
        echo '<br>';
        echo $_SESSION['addresses'];
    }*/
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
    <link rel="stylesheet" href="css/account.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Tài khoản</title>
    <link rel="icon" type="image/x-icon" href="./img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <div id="main-body" class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php";
            require_once "./function/db_connect.php";
            $conn = connectDatabase();
            $user_id = $_SESSION['user_id'];

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
                                            <a href="./account.php">Thông tin tài khoản</a>
                                        </li>
                                        <li><a href="./address.php">Danh sách địa chỉ</a></li>
                                        <li><a href="./function/log_out.php">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer-sidebar-wrap">
                        <div class="row-inside">
                            <div class="customer-sidebar">
                                <p class="title-detail">Thông tin tài khoản</p>
                                <?php
                                    if (isset($_SESSION['logged']) && isset($_SESSION['email']) && isset($_SESSION['fullname'])) {
                                        echo '<h2 class="account-name">'. $_SESSION['fullname'] .'</h2>';
                                        echo '<p class="account-email">'. $_SESSION['email'] .'</p>';
                                    }
                                    else {
                                        echo 'Chưa có dữ liệu';
                                    }
                                ?>
                                
                                
                                <div class="address">
                                    <a id="view-address" href="./address.php">Xem địa chỉ</a>
                                </div>
                            </div>
                            <div class="customer-table-wrap">
                                <div class="customer-table-bg">
                                <?php
                                    require_once "./function/database_function.php";
                                    $result = getBill($conn, $user_id);
                                    if (mysqli_num_rows($result) == 0) {
                                        echo '<p>Bạn chưa đặt mua sản phẩm</p>';
                                    }
                                    else {
                                ?>
                                    <p class="title-detail"> Danh sách các đơn hàng </p>
                                    <div class="table-wrap">
                                        <table class="table">
                                            <thead>
                                                <th class="order-number text-center">Mã đơn hàng</th>
                                                <th class="date text-center">Ngày đặt</th>
                                                <th class="total text-center">Thành tiền</th>
                                                <th class="payment-status text-center">Trạng thái thanh toán</th>
                                                <th class="fulfillment-status text-center">Vận chuyển</th>
                                                <th class="order-detail text-center">Chi tiết đơn hàng</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<tr class="order">';
                                                        echo '<td class="text-center">';
                                                            echo '<a href="">'. $row['bill_id'] .'</a>';
                                                        echo '</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<span>'. date("d/m/Y", strtotime($row['date_created'])) .'</span>';
                                                        echo '</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<span class="total-money">'.number_format($row['total_amount'], 0, ',', '.') .'₫</span>';
                                                        echo '</td>';
                                                        echo '<td class="text-center">';    
                                                            echo '<span class="status-'.$row['payment_status'].'">'. $row['payment_status'] .'</span>';
                                                        echo '</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<span class="status-'.$row['shipping_status'].'">'.$row['shipping_status'].'</span>';
                                                        echo '</td>';
                                                        echo '<td class="text-center">';
                                                            echo '<span class="detail-'.$row['shipping_status'].'"><a href="./order-detail.php?bill-id='. $row['bill_id'] .'">Chi tiết</a></span>';
                                                        echo '</td>';
                                                    echo '</tr>';
                                                }
                                            ?>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                <?php
                                    }
                                ?>
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