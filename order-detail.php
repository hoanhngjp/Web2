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
    <link rel="stylesheet" href="./css/header.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./css/footer.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./css/cart-search.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="./css/order-detail.css?v=<?php echo time();?>">
    <title>Chi tiết đơn hàng</title>
    <link rel="icon" type="image/x-icon" href="./img/footerLogo.webp">
    <script src="./js/showCartSearch.js?v=<?php echo time();?>" defer></script>
    <script src="./js/cart_function.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php";
            require_once "./function/db_connect.php";
            $conn = connectDatabase();

            $total_price = 0;

            $count = 0;

            if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0 ) {
                $count = 0;
            }
            else {
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    $count += $quantity;
                }
            }


        ?>
        <!--------------------------------------------LAYOUT-CART----------------------------------------------------->
        <div class="layout-cart">
            <div class="container-fluid">
                <div class="nav-header-wrap">
                    <div class="nav-header">
                        <ol>
                            <li>
                                <a href="./home.php">
                                    <span>Trang chủ</span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li class="active">
                                <span>
                                    <span>Chi tiết đơn hàng (<?php echo $count; ?>)</span>
                                </span>
                                <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="cart-page">
                    <div class="heading-page">
                        <div class="header-page">
                            <h1>Chi tiết đơn hàng</h1>
                        </div>
                    </div>
                    <div class="cart-content-wrap">
                        <div class="cart-container">
                            <div class="main-content-cart">
                                <div class="display-items">
                                    <table class="table-cart">
                                        <tbody>
                                            <?php 
                                                if (isset($_GET['bill-id'])) {

                                                    $total_price = 0;

                                                    $bill_id = $_GET['bill-id'];

                                                    $query_bill_detail = "SELECT * FROM `Bill-Detail` WHERE id_bill = '$bill_id'";

                                                    $result_bill_detail = mysqli_query($conn, $query_bill_detail);

                                                    while ($row = mysqli_fetch_assoc($result_bill_detail)) {
                                                        $query = "SELECT p.*, pi.img_name 
                                                                    FROM Product p 
                                                                    LEFT JOIN `Product-Images` pi ON p.product_id = pi.id_product 
                                                                    WHERE p.product_id = {$row['id_product']} 
                                                                    LIMIT 1";
                                                        $result = mysqli_query($conn, $query);

                                                        if ($result) {
                                                            while ($row2 = mysqli_fetch_assoc($result)) {
                                                                $total_price += $row2['product_price'] * $row['quantity'];
                                                                echo '<tr class="line-item-container">';
                                                                    echo '<td class="image">';
                                                                        echo '<div class="product-img">';
                                                                            echo '<a href="">';
                                                                                echo '<img src="img/prdImg/' . $row2['img_name'] . '" alt="' . $row2['product_name'] . '">';
                                                                            echo '</a>';
                                                                        echo '</div>';
                                                                    echo '</td>';
                                                                    echo '<td class="item">';
                                                                        echo '<a href="./product.php?product_id='. $row2['product_id'] .'">' . $row2['product_name'] . '</a>';
                                                                        echo '<p>';
                                                                            echo '<span>' . number_format($row2['product_price'], 0, ',', '.') . '₫</span>';
                                                                        echo '</p>';
                                                                        echo '<div class="qty-click">';
                                                                            echo '<input type="text" size="4" min="1" data-price="' . $row2['product_price'] . '" value="' . $row['quantity'] . '" class="item-quantity" data-product-id="'. $product_id .'" disabled> ';
                                                                        echo '</div>';
                                                                        echo '<p class="price">';
                                                                            echo '<span class="text">Thành tiền</span>';
                                                                            echo '<span class="line-iem-total">' . number_format($row['total_price'], 0, ',', '.') . '₫</span>';
                                                                        echo '</p>';
                                                                    echo '</td>';
                                                                echo '</tr>';  
                                                            }
                                                        }
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php    
                                    if (isset($_GET['bill-id'])) {
                                        echo '<div class="cart-others">
                                        <div class="order-actions-wrap">
                                            <p class="order-infor">
                                                Tổng tiền
                                                <span class="total-price">
                                                    <b id="total-cart">'. number_format($total_price, 0, ',', '.').'₫</b>
                                                </span>
                                            </p>
                                        </div>
                                    </div>';
                                    }
                                ?>
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
    <?php
        require_once "./template/site-nav.php";
    ?>
</body>
</html>