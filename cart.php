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
    <link rel="stylesheet" href="./css/cart.css?v=<?php echo time();?>">
    <title>Giỏ hàng</title>
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
                                    <span>Giỏ hàng (<?php echo $count; ?>)</span>
                                </span>
                                <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="cart-page">
                    <div class="heading-page">
                        <div class="header-page">
                            <h1>Giỏ hàng của bạn</h1>
                            <p class="count-cart">
                                Có <span><?php echo $count; ?> sản phẩm</span> trong giỏ hàng
                            </p>
                        </div>
                    </div>
                    <div class="cart-content-wrap">
                        <div class="notifications">
                            <?php 
                                if ($count == 0) {
                                    echo 'Giỏ hàng của bạn đang trống';
                                    echo '<p class="link-continue">
                                    <a href="./collections.php" class="button dark">
                                        <button>
                                            <i class="fa fa-reply"></i>
                                            TIẾP TỤC MUA HÀNG
                                        </button>
                                    </a>
                                </p>';
                                }
                            ?>
                        </div>
                        <div class="cart-container">
                            <div class="main-content-cart">
                                <form action="./function/get_bill_note.php" id="cartformpage" method="POST">
                                    <div class="display-items">
                                        <table class="table-cart">
                                            <tbody>
                                                <?php 
                                                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                                        foreach ($_SESSION['cart'] as $product_id => $quantity) {
                                                            // Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm dựa trên product_id
                                                            $query = "SELECT p.*, pi.img_name 
                                                                        FROM Product p 
                                                                        LEFT JOIN `Product-Images` pi ON p.product_id = pi.id_product 
                                                                        WHERE p.product_id = $product_id 
                                                                        LIMIT 1";
                                                            $result = mysqli_query($conn, $query);
                                                    
                                                            if ($result) {
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $total_price += $row['product_price'] * $quantity;  
                                                                    // Hiển thị thông tin sản phẩm trong giỏ hàng
                                                                    echo '<tr class="line-item-container">';
                                                                        echo '<td class="image">';
                                                                            echo '<div class="product-img">';
                                                                                echo '<a href="">';
                                                                                    echo '<img src="img/prdImg/' . $row['img_name'] . '" alt="' . $row['product_name'] . '">';
                                                                                echo '</a>';
                                                                            echo '</div>';
                                                                        echo '</td>';
                                                                        echo '<td class="item">';
                                                                            echo '<a href="./product.php?product_id='. $row['product_id'] .'">' . $row['product_name'] . '</a>';
                                                                            echo '<p>';
                                                                                echo '<span>' . number_format($row['product_price'], 0, ',', '.') . '₫</span>';
                                                                            echo '</p>';
                                                                            echo '<div class="qty-click">';
                                                                                echo '<button type="button" class="qtyminus qty-btn" data-product-id="'. $product_id .'">-</button>';
                                                                                echo '<input type="text" size="4" min="1" data-price="' . $row['product_price'] . '" value="' . $quantity . '" class="item-quantity" data-product-id="'. $product_id .'"> ';
                                                                                echo '<button type="button" class="qtyplys qty-btn" data-product-id="'. $product_id .'">+</button>';
                                                                            echo '</div>';
                                                                            echo '<p class="price">';
                                                                                echo '<span class="text">Thành tiền</span>';
                                                                                echo '<span class="line-iem-total">' . number_format($row['product_price'] * $quantity, 0, ',', '.') . '₫</span>';
                                                                            echo '</p>';
                                                                        echo '</td>';
                                                                        echo '<td class="remove">';
                                                                            echo '<a href="#" class="remove-from-cart" data-product-id="'. $product_id .'">';
                                                                                echo '<ion-icon name="close-outline"></ion-icon>';
                                                                            echo '</a>';
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
                                        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                            echo '<div class="cart-others">
                                            <div class="note-wrap">
                                                <div class="checkout-note">
                                                    <textarea name="bill_note" id="note" cols="50" rows="8" placeholder="Ghi chú"></textarea>
                                                </div>
                                            </div>
                                            <div class="order-actions-wrap">
                                                <p class="order-infor">
                                                    Tổng tiền
                                                    <span class="total-price">
                                                        <b id="total-cart">'. number_format($total_price, 0, ',', '.').'₫</b>
                                                    </span>
                                                </p>
                                                <div class="cart-buttons">
                                                    <a href="./collections.php">
                                                        <button>
                                                            <i class="fa fa-reply"></i>
                                                            TIẾP TỤC MUA HÀNG
                                                        </button>
                                                    </a>
                                                    <button type="button" id="update-cart" class="btn-update" name="update">
                                                        Cập nhật
                                                    </button>
                                                
                                                    <button type="submit" id="checkout" class="btn-checkout" name="checkout">
                                                        Thanh toán
                                                    </button>
                                                    
                                                </div>
                                            </div>
                                        </div>';
                                        }
                                        $_SESSION['total_price'] = $total_price;
                                    ?>
                                    
                                </form>
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