<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/39b6b90061.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/checkout.css">
    <title>Thanh toán</title>
    <link rel="icon" type="image/x-icon" href="../img/footerLogo.webp">
    <script src="js/showCheckOutMethods.js" defer></script>
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
                            <a href="">Giỏ hàng</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">Thông tin giao hàng</a>
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
                                                    <input name="checkoutMethod" type="radio" class="input-radio" checked>
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
                                                    <input name="checkoutMethod" type="radio" class="input-radio">
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
                            <form action="" id="checkout_complete">
                                <button type="submit" class="step-footer-continue-btn btn">
                                    <span class="btn-content">Hoàn tất đơn hàng</span>
                                </button>
                            </form>
                            <a href="" class="step-footer-previous-link">Giỏ hàng</a>
                        </div>
                    </div>
                </div>
                <div class="main-footer footer-powered-by">Powered by HoanhNgjp</div>
            </div>
            <div class="checkout-sidebar">
                <div class="sidebar-content">
                    <div class="order-summary-sections">
                        <!--------------------------------------------LIST-PRODUCTS----------------------------------------------------->
                        <div class="order-summary-section order-summary-section-product-list">
                            <table class="product-table">
                                <tbody>
                                    <tr class="product">
                                        <td class="product-image">
                                            <div class="product-thumbnail">
                                                <div class="product-thumbnail-wrapper">
                                                    <img src="img/z5318296110521_e0b7af2bd2dec430e27eaec3182c8556_a0494c20693944b78f601daecd358036_master.webp" alt="" class="product-thmbnial-image">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-description">
                                            <span class="product-description-name order-summary-emphasis">Kẹp Tóc Hoa Len</span>
                                            <span class="product-description-variant order-summary-small-text">Kem</span>
                                        </td>
                                        <td class="product-quantity">1</td>
                                        <td class="product-price">
                                            <span class="order-summary-emphasis">45,000đ</span>
                                        </td>
                                    </tr>
                                    <tr class="product">
                                        <td class="product-image">
                                            <div class="product-thumbnail">
                                                <div class="product-thumbnail-wrapper">
                                                    <img src="img/z5318296110521_e0b7af2bd2dec430e27eaec3182c8556_a0494c20693944b78f601daecd358036_master.webp" alt="" class="product-thmbnial-image">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-description">
                                            <span class="product-description-name order-summary-emphasis">Kẹp Tóc Hoa Len</span>
                                            <span class="product-description-varient">Kem</span>
                                        </td>
                                        <td class="product-quantity">1</td>
                                        <td class="product-price">
                                            <span class="order-summary-emphasis">45,000đ</span>
                                        </td>
                                    </tr>
                                    <tr class="product">
                                        <td class="product-image">
                                            <div class="product-thumbnail">
                                                <div class="product-thumbnail-wrapper">
                                                    <img src="img/z5318296110521_e0b7af2bd2dec430e27eaec3182c8556_a0494c20693944b78f601daecd358036_master.webp" alt="" class="product-thmbnial-image">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-description">
                                            <span class="product-description-name order-summary-emphasis">Kẹp Tóc Hoa Len</span>
                                            <span class="product-description-varient">Kem</span>
                                        </td>
                                        <td class="product-quantity">1</td>
                                        <td class="product-price">
                                            <span class="order-summary-emphasis">45,000đ</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--------------------------------------------TOTAL-LINES----------------------------------------------------->
                        <div class="order-summary-section order-summary-section-total-lines payment-line">
                            <table class="total-line-table">
                                <tbody>
                                    <tr class="total-line total-line-subtotal">
                                        <td class="total-line-name">Tạm tính</td>
                                        <td class="total-line-price">
                                            <span class="order-summary-emphasis">480,000đ</span>
                                        </td>
                                    </tr>
                                    <tr class="total-line total-line-shipping">
                                        <td class="total-line-name">Phí vận chuyển</td>
                                        <td class="total-line-price">
                                            <span class="order-summary-emphasis">Miễn phí</span>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="total-line-table-footer">
                                    <tr class="total-line">
                                        <td class="total-line-name payment-due-label">
                                            <span class="payment-due-label-total">Tổng cộng</span>
                                        </td>
                                        <td class="total-line-name payment-due">
                                            <span class="payment-due-currency">VND</span>
                                            <span class="payment-due-price">480,000đ</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</body>
</html>