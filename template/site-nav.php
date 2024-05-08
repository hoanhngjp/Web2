<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $total_price = 0;
?>
<div id="site-nav" class="site-nav">
        <div id="site-cart" class="site-nav-container">
            <div class="site-nav-container-last">
                <p class="title"Giỏ hàng>Giỏ hàng</p>
                <div class="cart-view">
                    <table id="cart-inside" class="">
                        <tbody>
                            <?php
                            if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0 ) {
                                echo '<tr>Hiện chưa có sản phẩm nào</tr>';
                            }
                            else {
                                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                    foreach ($_SESSION['cart'] as $product_id => $quantity) {

                                        $query = "SELECT p.*, pi.img_name 
                                                    FROM Product p 
                                                    LEFT JOIN `Product-Images` pi ON p.product_id = pi.id_product 
                                                    WHERE p.product_id = $product_id 
                                                    LIMIT 1";
                                        $result = mysqli_query($conn, $query);

                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $total_price += $row['product_price'] * $quantity;
                                                echo '<tr class="item-in-cart">';
                                                        echo '<td class="img">';
                                                            echo '<a href="">';
                                                                echo '<img src="img/prdImg/' . $row['img_name'] . '" alt="' . $row['product_name'] . '">';
                                                            echo '</a>';
                                                        echo '</td>';
                                                        echo '<td>';
                                                            echo '<a class="pro-title-cart" href="./product.php?product_id='. $row['product_id'] .'">' . $row['product_name'] . '</a>';
                                                            echo '<span class="variant"></span>';
                                                            echo '<span class="pro-quantity-cart">' . $quantity . '</span>';
                                                            echo '<span class="pro-price-cart">' . number_format($row['product_price'], 0, ',', '.') . '₫</span>';
                                                            echo '<span class="remove-in-cart">';
                                                                echo '<a href="#" class="remove-from-cart" data-product-id="'. $product_id .'">';
                                                                    echo '<ion-icon name="close-outline"></ion-icon>';
                                                                echo '</a>';
                                                            echo '</span>';
                                                        echo '</td>';
                                                echo '</tr>';                                          
                                            }
                                        }
                                    }
                                }
                                $_SESSION['total_price'] = $total_price;
                            }
                            ?>
                        </tbody>
                    </table>
                    <span class="line"></span>
                    <table class="table-total">
                        <tbody>
                            <tr>
                                <td class="text-left" style="font-size: 14px;">TỔNG TIỀN: </td>
                                <td class="text-right" id="total-in-cart" style="font-size: 14px;"><?php echo number_format($total_price, 0, ',', '.').'₫'; ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="./cart.php">
                                        <button>XEM GIỎ HÀNG</button>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                        if(isset($_SESSION['logged'])) {
                                            echo '<a href="./orderinfo.php">';
                                                echo '<button>THANH TOÁN</button>';
                                            echo '</a>';
                                        }
                                        else {
                                            echo '<a href="./login.php">';
                                                echo '<button>THANH TOÁN</button>';
                                            echo '</a>';
                                        }
                                    ?>
                                    
                                        
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                                $(document).ready(function(){
                                    // Xử lý sự kiện click cho nút "Xóa"
                                    $('.remove-from-cart').click(function(e){
                                        e.preventDefault(); // Ngăn chặn hành động mặc định của thẻ <a>

                                        var productId = $(this).data('product-id');

                                        // Gửi yêu cầu xóa sản phẩm thông qua Ajax
                                        $.ajax({
                                            url: 'function/remove_from_cart.php',
                                            type: 'post',
                                            data: {product_id: productId},
                                            success:function(response){
                                                // Cập nhật lại tổng tiền sau khi xóa sản phẩm
                                                $('#total-in-cart').html(response);
                                                // Cập nhật lại giỏ hàng sau khi xóa sản phẩm
                                                $('.cart-view').html(response);
                                                location.reload();
                                            }
                                        });
                                    });
                                });
                            </script>
                </div>
            </div>
        </div>
        <div id="site-search" class="site-nav-container">
            <div class="site-nav-container-last">
                <p class="title">Tìm kiếm</p>
                <div class="search-box-wrap">
                    <form class="searchForm" action="search.php?q='keyword'" method="GET">
                        <div class="search-inner">
                            <input type="text" class="searchInput" size="20" name="q" placeholder="Tìm kiếm sản phẩm">
                        </div>
                        <button class="btn-search">
                            <ion-icon name="search-outline"></ion-icon>
                        </button>
                    </form>
                    <div class="result-wrap">
                        <div class="result-content">
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script>
                                $(document).ready(function(){
                                    $('.searchInput').keyup(function(){
                                        var keyword = $(this).val();
                                        if(keyword != ''){
                                            $.ajax({
                                            url: 'function/search_result.php',
                                            type: 'post',
                                            data: {keyword:keyword},
                                            success:function(response){
                                                $('.result-content').html(response);
                                            }
                                            });
                                        } else {
                                            $('.result-content').html('');
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button id="site-close-handle" class="site-close-handle">
            <span class="close">
                <ion-icon name="close-outline"></ion-icon>
        </button>
    </div>
