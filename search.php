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
    <link rel="stylesheet" href="css/search.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Kết quả tìm kiếm</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js?v=<?php echo time();?>" defer></script>
    <script src="js/showSubMenu.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php";
            require_once "./function/db_connect.php";
            $conn = connectDatabase();
        ?>
        <!--------------------------------------------SEARCH-PAGE----------------------------------------------------->
        <div class="searchPage" id="layout-search">
            <?php
                // Số sản phẩm hiển thị trên mỗi trang
                $productsPerPage = 10;
                // Trang hiện tại
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                if(isset($_GET['q'])) {
                    $keyword = $_GET['q'];// Tính tổng số sản phẩm tìm được
                    $totalProductsQuery = "SELECT COUNT(*) AS total FROM Product WHERE product_name LIKE '%$keyword%'";
                    $totalProductsResult = $conn->query($totalProductsQuery);
                    $totalProducts = $totalProductsResult->fetch_assoc()['total'];
                    // Tính toán số lượng trang
                    $totalPages = ceil($totalProducts / $productsPerPage);

                    // Tính OFFSET để truy vấn dữ liệu
                    $offset = ($page - 1) * $productsPerPage;
                    
                    // Truy vấn cơ sở dữ liệu để lấy dữ liệu cho trang hiện tại
                    $sql = "SELECT * FROM Product WHERE product_name LIKE '%$keyword%' LIMIT $productsPerPage OFFSET $offset";

                    // Thực hiện truy vấn SQL
                    $result = $conn->query($sql);

                    
                }
            ?>
            <div class="container-fluid">
                <div class="row pd-page">
                    <div class="col-md-12 col-xs-12">
                        <div class="heading-page">
                            <h1>Tìm kiếm</h1>
                            <?php
                                if(isset($_GET['q'])) {
                                    if ($totalProducts != 0) {
                                        echo '<p class="subtxt">';
                                            echo 'Có <span>' . $totalProducts . ' sản phẩm</span> cho tìm kiếm';
                                        echo '</p>';
                                    }
                                }
                            ?>
                        </div>
                        <div class="wrapbox-content-page">
                            <div class="content-page clearfix" id="search">
                                <div class="expanded-message">
                                    <div class="search-field">
                                        <form action="" method="GET" class="search-page">
                                            <input type="text" class="search_box" name="q" placeholder="Tìm kiếm">
                                            <input type="submit" id="go">
                                        </form>
                                    </div>
                                    <?php
                                        if(isset($_GET['q'])) {
                                            if ($totalProducts == 0) {
                                                echo '<div class="message-txt clearfix">';
                                                    echo '<p>Rất tiếc, chúng tôi không tìm thấy kết quả cho từ khóa của bạn</p>';
                                                    echo '<p>Vui lòng kiểm tra chính tả, sử dụng các từ tổng quát hơn và thử lại!</p>';
                                                echo '</div>';
                                            }
                                        }
                                    ?>
                                </div>
                                <?php 
                                    if(isset($_GET['q'])) {
                                        if ($totalProducts != 0) {
                                            echo '<p class="subtext-result">';
                                                echo 'Kết quả tìm kiếm cho <strong>' . htmlspecialchars($keyword) . '</strong>';
                                            echo '</p>';
                                        }
                                    }
                                ?>
                                <div class="results content-product-list ">
                                    <div class="search-list-results">
                                        <?php 
                                        // Hiển thị kết quả
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $query_img = "SELECT img_name FROM `Product-Images` WHERE id_product = '{$row['product_id']}' GROUP BY id_product";
                                                $result_img = mysqli_query($conn, $query_img);
                                                $row_img = $result_img->fetch_assoc();
                                                echo '<div class="item-wrap">';
                                                    echo '<div class="item-picture">';
                                                        echo '<a href="./product.php?product_id=' . $row['product_id']. ' ">';
                                                            echo '<img src="./img/prdImg/'.$row_img['img_name'].'" alt="' . $row['product_name'] . '">';
                                                        echo '</a>';
                                                    echo '</div>';
                                                    echo '<div class="item-detail">';
                                                        echo '<h3>';
                                                            echo '<a href="./product.php?product_id=' . $row['product_id']. ' ">' . $row['product_name'] . '</a>';
                                                        echo '</h3>';
                                                        echo '<p class="item-price">'. number_format($row['product_price'], 0, ',', '.') . '₫</p>';
                                                    echo '</div>';
                                                echo '</div>';
                                            }
                                        } else {
                                            
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="search-footer-wrap">
                                    <?php
                                        if(isset($_GET['q'])) {
                                            if ($page > 1) {
                                                echo '<a href="?q='.urlencode($keyword).'&page='.($page - 1).'" class="prevPage"><i class="fa-solid fa-arrow-left-long"></i></a>';
                                            }
                                            echo '<ul class="page-list">';
                                                for ($i = 1; $i <= $totalPages; $i++) {
                                                    echo '<li>';
                                                        if ($i == $page) {
                                                            echo '<a href="?q='.urlencode($keyword).'&page='.$i.'"style="font-weight: bold;">'.$i.'</a>';
                                                        }
                                                        else {
                                                            echo '<a href="?q='.urlencode($keyword).'&page='.$i.'">'.$i.'</a>';
                                                        }
                                                    echo '</li>';
                                                }
                                            echo '</ul>';
                                            if ($page < $totalPages) {
                                                echo '<a href="?q='.urlencode($keyword).'&page='.($page + 1).'" class="nextPage"><i class="fa-solid fa-arrow-right-long"></i></a>';
                                            }
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
    <?php
        require_once "./template/site-nav.php";
    ?>
</body>
</html>