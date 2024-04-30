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
    <link rel="stylesheet" href="../css/header.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="../css/footer.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="../css/cart-search.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="../css/cart.css?v=<?php echo time();?>">
    <title>Giỏ hàng</title>
    <link rel="icon" type="image/x-icon" href="../img/footerLogo.webp">
    <script src="../js/showCartSearch.js" defer></script>
</head>
<body>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php"
        ?>
        <!--------------------------------------------LAYOUT-CART----------------------------------------------------->
        <div class="layout-cart">
            <div class="container-fluid">
                <div class="nav-header-wrap">
                    <div class="nav-header">
                        <ol>
                            <li>
                                <a href="">
                                    <span>Trang chủ</span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li class="active">
                                <span>
                                    <span>Giỏ hàng (4)</span>
                                </span>
                                <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="cart-page">
                    <div class="heading-page">
                        <div class="header-page">
                            <h1>Giỏa hàng của bạn</h1>
                            <p class="count-cart">
                                Có <span>4 sản phẩm</span> trong giỏ hàng
                            </p>
                        </div>
                    </div>
                    <div class="cart-content-wrap">
                        <div class="notifications">
                            Giỏ hàng của bạn đang trống
                            <p class="link-continue">
                                <a href="home.html" class="button dark">
                                    <button>
                                        <i class="fa fa-reply"></i>
                                        TIẾP TỤC MUA HÀNG
                                    </button>
                                </a>
                            </p>
                        </div>
                        <div class="cart-container">
                            <div class="main-content-cart">
                                <form action="" id="cartformpage">
                                    <div class="display-items">
                                        <table class="table-cart">
                                            <tbody>
                                                <tr class="line-item-container">
                                                    <td class="image">
                                                        <div class="product-img">
                                                            <a href="">
                                                                <img src="img/cart-inside.webp" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="item">
                                                        <a href="">
                                                            <h3>Túi Đa Năng Màu Sắc</h3>
                                                        </a>
                                                        <p>
                                                            <span>85,000đ</span>
                                                        </p>
                                                        <p class="variant"></p>
                                                        <div class="qty-click">
                                                            <button type="button" class="qtyminus qty-btn">-</button>
                                                            <input type="text" size="4" min="1" data-price="85000" value="2" class="item-quantity">
                                                            <button type="button" class="qtyplys qty-btn">+</button>
                                                        </div>
                                                        <p class="price">
                                                            <span class="text">Thành tiền</span>
                                                            <span class="line-iem-total">170,000đ</span>
                                                        </p>
                                                    </td>
                                                    <td class="remove">
                                                        <a href="">
                                                            <ion-icon name="close-outline"></ion-icon>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr class="line-item-container">
                                                    <td class="image">
                                                        <div class="product-img">
                                                            <a href="">
                                                                <img src="img/cart-inside.webp" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="item">
                                                        <a href="">
                                                            <h3>Túi Đa Năng Màu Sắc</h3>
                                                        </a>
                                                        <p>
                                                            <span>85,000đ</span>
                                                        </p>
                                                        <p class="variant"></p>
                                                        <div class="qty-click">
                                                            <button type="button" class="qtyminus qty-btn">-</button>
                                                            <input type="text" size="4" min="1" data-price="85000" value="2" class="item-quantity">
                                                            <button type="button" class="qtyplys qty-btn">+</button>
                                                        </div>
                                                        <p class="price">
                                                            <span class="text">Thành tiền</span>
                                                            <span class="line-iem-total">170,000đ</span>
                                                        </p>
                                                    </td>
                                                    <td class="remove">
                                                        <a href="">
                                                            <ion-icon name="close-outline"></ion-icon>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr class="line-item-container">
                                                    <td class="image">
                                                        <div class="product-img">
                                                            <a href="">
                                                                <img src="img/cart-inside.webp" alt="">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td class="item">
                                                        <a href="">
                                                            <h3>Túi Đa Năng Màu Sắc</h3>
                                                        </a>
                                                        <p>
                                                            <span>85,000đ</span>
                                                        </p>
                                                        <p class="variant"></p>
                                                        <div class="qty-click">
                                                            <button type="button" class="qtyminus qty-btn">-</button>
                                                            <input type="text" size="4" min="1" data-price="85000" value="2" class="item-quantity">
                                                            <button type="button" class="qtyplys qty-btn">+</button>
                                                        </div>
                                                        <p class="price">
                                                            <span class="text">Thành tiền</span>
                                                            <span class="line-iem-total">170,000đ</span>
                                                        </p>
                                                    </td>
                                                    <td class="remove">
                                                        <a href="">
                                                            <ion-icon name="close-outline"></ion-icon>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="cart-others">
                                        <div class="note-wrap">
                                            <div class="checkout-note">
                                                <textarea name="" id="note" cols="50" rows="8" placeholder="Ghi chú"></textarea>
                                            </div>
                                        </div>
                                        <div class="order-actions-wrap">
                                            <p class="order-infor">
                                                Tổng tiền
                                                <span class="total-price">
                                                    <b>1,100,000đ</b>
                                                </span>
                                            </p>
                                            <div class="cart-buttons">
                                                <a href="home.html">
                                                    <button>
                                                        <i class="fa fa-reply"></i>
                                                        TIẾP TỤC MUA HÀNG
                                                    </button>
                                                </a>
                                                <button type="button" id="update-cart" class="btn-update" name="update">
                                                    Cập nhật
                                                </button>
                                                <button type="button" id="checkout" class="btn-checkout" name="checkout">
                                                    Thanh toán
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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