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
    <link rel="stylesheet" href="css/header.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/footer.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/product.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Sản phẩm</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
    <script src="js/product_function.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
        require_once "./template/header.php";
        require_once "./function/db_connect.php";
        $conn = connectDatabase();

        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];

            $query_product = "SELECT * FROM Product WHERE product_id = $product_id ";
            $result_query_product = mysqli_query($conn, $query_product);
            $result_product = $result_query_product->fetch_assoc();

            $query_category = "SELECT * FROM Category WHERE category_id = {$result_product['id_category']}";
            $result_qeury_category = mysqli_query($conn, $query_category);
            $result_category = $result_qeury_category->fetch_assoc();
        }
        else {
            echo "KHÔNG TÌM THẤY SẢN PHẨM !!!";
        }
        ?>
        <!--------------------------------------------PRODUCT----------------------------------------------------->
        <div class="productDetail-page">
        <div class="main-wrap">
            <div class="nav-header-wrap">
                <div class="nav-header">
                    <ol>
                        <li>
                            <a href="./home.php">
                                <span>Trang chủ</span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li>
                        <?php 
                            echo '<a href="./collections.php?category_id=' . $result_category['category_id'] . '">';
                                echo '<span>' . $result_category['category_name'] . '</span>';
                            echo '</a>';        
                        ?>
                            <meta itemprop="position" content="2">
                        </li>
                        <li class="active">
                            <span>
                                <?php echo '<span>' . $result_product['product_name'] . '</span>'; ?>
                            </span>
                            <meta itemprop="position" content="3">
                        </li>
                    </ol>
                </div>
            </div>
            <div class="product-detail-wrap">
                <div class="product-detail-2-wrap">
                    <div class="product-detail-main">
                        <div class="product-content-img">
                            <div class="product-gallery">
                                <div class="product-gallery-container">
                                    <div class="product-gallery-thumbs">
                                    <?php 
                                        $query_images = "SELECT * FROM `Product-Images` WHERE id_product = {$result_product['product_id']}";
                                        $result_query_images = mysqli_query($conn, $query_images);
                                        while ($row = $result_query_images->fetch_assoc()) {
                                            echo '<div class="product-gallery-thumb">';
                                                echo '<a href="#" class="thumb-placeholder">';
                                                    echo '<img src="img/prdImg/' . $row['img_name'] . '" alt=" ' . $result_product['product_name'] . '">';
                                                echo '</a>';
                                            echo '</div>';
                                        }
                                    ?>
                                    </div>
                                </div>
                                <div class="product-image-detail">
                                    <div class="product-image-wrap">
                                        <?php 
                                            $query_img =  "SELECT * FROM `Product-Images` WHERE id_product = {$result_product['product_id']} GROUP BY id_product";
                                            $result_query_img = mysqli_query($conn, $query_img);
                                            $result_img = $result_query_img->fetch_assoc();

                                            echo '<img class="product-img-feature" src="img/prdImg/' . $result_img['img_name'] . '" alt="' . $result_product['product_name'] . '">';
                                        ?>
                                    </div>
                                </div>
                                <script src="js/changeProductPicture.js" defer></script>
                            </div>
                        </div>
                        <div class="product-content-desc">
                            <div class="product-title">
                                <?php echo '<h1>' . $result_product['product_name'] . '</h1>'; ?>
                                <span id="pro-sku">SKU: BPHTBGUHH-1</span>
                            </div>
                             <div class="product-price">
                                <span class="pro-price"><?php echo number_format($result_product['product_price'], 0, ',', '.') . '₫' ?></span>
                             </div>
                             <form class="form-add-item" action="./function/add_to_cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $result_product['product_id']; ?>">
                                <div class="selector-actions">
                                    <div class="quantity-area">
                                        <input id="minusBtn" class="qty-btn" type="button" value="-">
                                        <input type="text" id="quantity" class="quantity-selector" name="quantity" value="1" min="1">
                                        <input id="plusBtn" class="qty-btn" type="button" value="+">
                                    </div>
                                    <div class="wrap-addcart">
                                        <button type="submit" id="add-to-cart" class="addToCartProduct">Thêm vào giỏ</button>
                                    </div>
                                </div>
                             </form>
                             <div class="product-description">
                                <div class="title">
                                    <h2>Mô tả</h2>
                                </div>
                                <div class="description-content">
                                    <div class="description-productdetail">
                                        <?php echo nl2br($result_product['product_description']); ?>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div>
                    <div class="listProduct-related">
                        <div class="heading-title">
                            <h2>Sản phẩm liên quan</h2>
                        </div>
                        <div class="content-product-list">
                        <?php
                            //Lấy 10 sản phẩm có liên quan
                            $nums_relate_products = 10;
                            $query_relate_products = "SELECT * FROM Product WHERE id_category = {$result_product['id_category']} ORDER BY RAND() LIMIT {$nums_relate_products}";
                            $result_query_relate_products = mysqli_query($conn, $query_relate_products);

                            while ($row = $result_query_relate_products->fetch_assoc()) {
                                echo '<div class="pro-loop">';
                                    echo '<div class="product-block">';
                                        echo '<div class="product-img">';
                                            echo '<div class="sold-out">';
                                                if ($row['quantity_in_stock'] == 0) {
                                                    echo '<span>Hết hàng</span>';
                                                }
                                            echo '</div>';  
                                            echo '<a href="./product.php?product_id=' . $row['product_id'] . '">';
                                                echo '<picture>';
                                                    $query_relate_img = "SELECT * FROM `Product-Images` WHERE id_product = {$row['product_id']} GROUP BY id_product";
                                                    $result_query_relate_img = mysqli_query($conn, $query_relate_img);
                                                    $result_relate_img = $result_query_relate_img->fetch_assoc();
                                                    echo '<img src="img/prdImg/' . $result_relate_img['img_name'] . '" alt="">';
                                                echo '</picture>';
                                            echo '</a>';
                                        echo '</div>';  
                                        echo '<div class="product-detail">';
                                            echo '<div class="box-proDetail">';
                                                echo '<h3 class="pro-name">';
                                                    echo '<a href="./product.php?product_id=' . $row['product_id'] . '">' . $row['product_name'] . '</a>';
                                                echo '</h3>';
                                            echo '</div>'; 
                                            echo '<div class="box-proPrice">';
                                                echo '<p class="pro-pice">';
                                                    echo '<span>' . number_format($row['product_price'], 0, ',', '.') . '₫</span>';
                                                echo '</p>';
                                            echo '</div>'; 
                                        echo '</div>'; 
                                    echo '</div>';    
                                echo '</div>';
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