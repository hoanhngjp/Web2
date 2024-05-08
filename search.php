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
            require_once "./function/database_function.php";
            $conn = connectDatabase();
        ?>
        <!--------------------------------------------SEARCH-PAGE----------------------------------------------------->
        <div class="searchPage" id="layout-search">
            <?php
                // Số sản phẩm hiển thị trên mỗi trang
                $productsPerPage = 10;
                // Trang hiện tại
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                $where_conditions = "";

                if(isset($_GET['categories']) && !empty($_GET['categories'])) {
                    $category_ids = $_GET['categories'];
                    
                    // Lấy tất cả các danh mục con của các danh mục cha được chọn
                    $all_category_ids = array();
                    foreach ($category_ids as $category_id) {
                        $all_category_ids[] = $category_id;
                        $all_category_ids = array_merge($all_category_ids, getChildCategories($conn, $category_id));
                    }
            
                    // Chuyển đổi danh sách danh mục thành chuỗi để sử dụng trong câu truy vấn SQL
                    $category_ids_string = implode(",", $all_category_ids);
                    $where_conditions .= " AND id_category IN ($category_ids_string)";
                }

                // Thêm điều kiện tìm kiếm về khoảng giá nếu được chọn
                if(isset($_GET['price_range']) && !empty($_GET['price_range'])) {
                    $price_ranges = $_GET['price_range'];
                    $price_conditions = array();
                    foreach ($price_ranges as $price_range) {
                        if ($price_range === "under500k") {
                            $price_conditions[] = "product_price < 500000";
                        } elseif ($price_range === "500k_to_1m") {
                            $price_conditions[] = "product_price BETWEEN 500000 AND 1000000";
                        } elseif ($price_range === "over1m") {
                            $price_conditions[] = "product_price > 1000000";
                        }
                    }
                    // Kết hợp các điều kiện về khoảng giá bằng toán tử OR
                    if (!empty($price_conditions)) {
                        $where_conditions .= " AND (" . implode(" OR ", $price_conditions) . ")";
                    }
                }

                if(isset($_GET['q'])) {
                    $keyword = $_GET['q'];// Tính tổng số sản phẩm tìm được

                    $where_conditions .= " AND (product_name LIKE '%$keyword%')";
                }

                // Thực hiện truy vấn SQL với các điều kiện tìm kiếm
                $query = "SELECT COUNT(*) AS total FROM Product WHERE 1=1 $where_conditions AND is_onSale = 1";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $totalProducts = $row['total'];

                // Phân trang kết quả
                $perPage = 10;
                $totalPages = ceil($totalProducts / $perPage);
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $offset = ($page - 1) * $perPage;

                $query_result = "SELECT * FROM Product WHERE 1=1 $where_conditions AND is_onSale = 1 LIMIT $offset, $perPage";
                $result = mysqli_query($conn, $query_result);


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
                                            <div id="filter-options">
                                                <div class="category-type-wrap">
                                                    <span class="fc-title">Danh mục</span>
                                                    <ul class="fc-category-list">
                                                    <?php
                                                        $query_get_category_type = "SELECT * FROM Category";
                                                        $result_get_category_type = mysqli_query($conn, $query_get_category_type);

                                                        if ($result_get_category_type) {
                                                            while ($row = $result_get_category_type->fetch_assoc()) {
                                                                echo '<li>';
                                                                    echo '<label>';
                                                                        echo '<input class="category-ids" type="checkbox" value="'. $row['category_id'] .'" name="categories[]">';
                                                                        echo $row['category_name'];
                                                                    echo '</label>';
                                                                echo '</li>';
                                                            }
                                                        }
                                                    ?>
                                                    </ul>
                                                </div>
                                                <div class="price-type-wrap">
                                                    <span class="fc-title">Khoảng giá</span>
                                                    <ul class="fc-price-list">
                                                        <li>
                                                            <label for="">
                                                                <input class="price-id" name="price_range[]" value="under500k" type="checkbox">
                                                                < 500.000₫
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label for="">
                                                                <input class="price-id" name="price_range[]" type="checkbox" value="500k_to_1m">
                                                                500.000₫ - 1.000.000₫
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <label for="">
                                                                <input class="price-id" name="price_range[]" type="checkbox" value="over1m">
                                                                > 1.000.000₫
                                                            </label>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="open-filter-wrap">
                                                <div class="open-filter-block">
                                                    <span id="close-filter-option"><ion-icon name="caret-up-outline"></ion-icon></span>
                                                    <span class="open-filter-title">Nâng cao</span>
                                                    <span id="show-filter-option"><ion-icon name="caret-down-outline"></ion-icon></span>
                                                </div>
                                            </div>
                                        </form>
                                        <script src="./js/showFilterOptions.js?v=<?php echo time(); ?>"></script>
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
                                        if ($result->num_rows > 0 ) {
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
                                            // Xây dựng các tham số tìm kiếm
                                            $search_params = http_build_query($_GET);
                                    
                                            if ($page > 1) {
                                                echo '<a href="?'.$search_params.'&page='.($page - 1).'" class="prevPage"><i class="fa-solid fa-arrow-left-long"></i></a>';
                                            }
                                    
                                            echo '<ul class="page-list">';
                                            for ($i = 1; $i <= $totalPages; $i++) {
                                                echo '<li>';
                                                if ($i == $page) {
                                                    echo '<span style="font-weight: bold;">'.$i.'</span>';
                                                }
                                                else {
                                                    echo '<a href="?'.$search_params.'&page='.$i.'">'.$i.'</a>';
                                                }
                                                echo '</li>';
                                            }
                                            echo '</ul>';
                                    
                                            if ($page < $totalPages) {
                                                echo '<a href="?'.$search_params.'&page='.($page + 1).'" class="nextPage"><i class="fa-solid fa-arrow-right-long"></i></a>';
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