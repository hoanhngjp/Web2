<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once "./function/db_connect.php";
    $conn = connectDatabase();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/39b6b90061.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/checkout.css?v=<?php echo time();?>">
    <title>Thanh toán</title>
    <link rel="icon" type="image/x-icon" href="./img/footerLogo.webp">
    <script src="js/showCheckOutMethods.js?v=<?php echo time();?>" defer></script>
    <script src="js/checkout.js?v=<?php echo time();?>" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <!--------------------------------------------CHECKOUT-CONTENT----------------------------------------------------->
        <div class="checkout-wrap">
            <div class="checkout-main">
                <div class="main-header">
                    <a href="" class="logo">
                        <h1 class="logo-text">A Little Leaf</h1>
                    </a>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="./cart.php">Giỏ hàng</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="./orderInfo.php">Thông tin giao hàng</a>
                        </li>
                        <li class="breadcrumb-item">
                            Phương thức thanh toán
                        </li>
                    </ul>
                </div>
                <div class="main-content">
                    <div class="step">
                        <div class="step-actions" step="2">
                            <div id="section-shipping-rate" class="section">
                                <div class="section-header">
                                    <h2 class="section-title">Phương thức vận chuyển</h2>
                                </div>
                                <div class="section-content">
                                    <div class="content-box">
                                        <div class="content-box-row">
                                            <div class="radio-wrapper">
                                                <label for="">
                                                    <div class="radio-input">
                                                        <input class="input-radio" type="radio" checked>
                                                    </div>
                                                    <span class="radio-label-primary">
                                                        Để phí vận chuyển được chính xác nhất, tụi mình sẽ liên hệ báo phí vận chuyển sau khi xác nhận đơn hàng ạ
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="section-payment-method" class="section">
                                <div class="section-header">
                                    <h2 class="section-title">Phương thức thanh toán</h2>
                                </div>
                                <div class="section-content">
                                    <div class="content-box">
                                        <div class="radio-wrapper content-box-row">
                                            <label for="" class="two-page">
                                                <div class="radio-input payment-method-checkbox">
                                                    <input name="checkoutMethod" type="radio" class="input-radio" value="online" checked>
                                                </div>
                                                <div class="radio-content-input">
                                                    <img src="img/other.svg" alt="" class="main-img">
                                                    <div class="content-wrapper">
                                                        <span class="radio-label-primary">Chuyển khoản qua ngân hàng</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="radio-wrapper content-box-row content-box-row-secondary">
                                            <div class="blank-slate">STK của tụi mình:

                                                STK 27560067 
                                                La Hoành Nghiệp 
                                                Ngân hàng thương mại cổ phần Á Châu
                                                
                                                NOTE: Phần nội dung bạn ghi tên đặt hàng của bạn để tụi mình dễ check nha. Bạn kiểm tra hàng trước khi nhận giúp tụi mình với nhé. Cảm ơn bạn ạ ❤️</div>
                                        </div>
                                        <div class="radio-wrapper content-box-row">
                                            <label for="" class="two-page">
                                                <div class="radio-input payment-method-checkbox">
                                                    <input name="checkoutMethod" type="radio" class="input-radio" value="cod">
                                                </div>
                                                <div class="radio-content-input">
                                                    <img src="img/cod.svg" alt="" class="main-img">
                                                    <div class="content-wrapper">
                                                        <span class="radio-label-primary">Thanh toán khi giao hàng (COD)</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="radio-wrapper content-box-row content-box-row-secondary" style="display: none;">
                                            <div class="blank-slate">
                                                Tụi mình nhận ship cod với đơn hàng dưới 1tr và không có sản phẩm dễ vỡ.							
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-footer" id="step-footer-checkout">
                            <form id="checkout_complete">
                                <button type="submit" class="step-footer-continue-btn btn">
                                    <span class="btn-content">Hoàn tất đơn hàng</span>
                                </button>
                            </form>
                            <a href="" class="step-footer-previous-link">Thông tin đặt hàng</a>
                        </div>
                    </div>
                </div>
                <div class="main-footer footer-powered-by">Powered by HoanhNgjp</div>
            </div>
            <div class="checkout-sidebar">
                <?php 
                    require_once './template/sidebar-content.php';
                 ?>    
            </div>

        </div>
</body>
</html>