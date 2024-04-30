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
    <link rel="stylesheet" href="css/collections.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>Tất cả sản phẩm</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js" defer></script>
    <script src="js/showSubMenu.js?v=<?php echo time();?>" defer></script>
</head>
<body>
    <?php
        session_start();
    ?>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php";
            require_once "./function/db_connect.php";
            $conn = connectDatabase();
            $query = "SELECT * FROM Category WHERE category_parent_id = 0";
            $result = $conn->query($query);
        ?>
        <!--------------------------------------------Collections----------------------------------------------------->
        <div class="collections-wrap">
        <!--------------------------------------------DIRECT----------------------------------------------------->
        <div class="direct">
            <div class="direct-items">
                <?php
                    require_once './function/database_function.php';
                    
                    //Số lượng sản phẩm mỗi trang
                    $products_per_page = 16;
                    
                    if (isset($_GET['category_id'])) {
                        //Xác định trang hiện tại 
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        //Tính offset
                        $offset = ($current_page - 1) * $products_per_page;
                        
                        $raw_category_id = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
                        $category_id = explode('?', $raw_category_id)[0]; // Lấy phần tử đầu tiên sau khi tách chuỗi bởi dấu "?"
                        // Lấy tất cả các category con của category cha
                        $child_categories = getChildCategories($conn,$category_id);
                        //Bao gồm cả category cha trong danh sách sản phẩm
                        $child_categories[] = $category_id;
                        // Sử dụng implode để chuyển mảng thành chuỗi để sử dụng trong câu truy vấn
                        $category_ids_string = implode(',', $child_categories);
                        //Truy vấn tất cả sản phẩm trong các category đã lấy được
                        $query = "SELECT * FROM Product WHERE id_category IN ($category_ids_string) LIMIT $offset, $products_per_page";
                        $category_name = getCategoryName($conn, $category_id);
                        $products = mysqli_query($conn, $query);
                        
                        // Tính tổng số trang
                        $total_products_query = "SELECT COUNT(*) AS total FROM Product WHERE id_category IN ($category_ids_string)";
                        $total_products_result = mysqli_query($conn, $total_products_query);
                        $total_products_row = mysqli_fetch_assoc($total_products_result);
                        $total_products = $total_products_row['total'];
                        $total_pages = ceil($total_products / $products_per_page);
                    }
                    else {
                        //Xác định trang hiện tại 
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                        //Tính offset
                        $offset = ($current_page - 1) * $products_per_page;

                        $category_id = 0;
                        $query = "SELECT * FROM Product LIMIT $offset, $products_per_page";
                        $category_name = 'Tất cả sản phẩm';
                        $products = mysqli_query($conn, $query);

                        // Tính tổng số trang
                        $total_products_query = "SELECT COUNT(*) AS total FROM Product";
                        $total_products_result = mysqli_query($conn, $total_products_query);
                        $total_products_row = mysqli_fetch_assoc($total_products_result);
                        $total_products = $total_products_row['total'];
                        $total_pages = ceil($total_products / $products_per_page);
                    }
                    ?>
                <a href="./home.php">Trang chủ</a> <p> / </p> <a href="">Danh mục</a> <p> / </p><?php echo '<p>' . $category_name . '</p>'?>
            </div>
        </div>
        <!--------------------------------------------COLLECTIONS----------------------------------------------------->
        <div class="collections-content">
            <!--------------------------------------------Collections-MENU----------------------------------------------------->
            <div class="menu-wrap">
            <?php
                if ($result->num_rows > 0) {
                    echo '<ul class="menu-tree">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="menu-item">';
                            if (hasSubCategories($row['category_id'])){
                                echo '<a href="./collections.php?category_id=' . $row['category_id'] . '">'. $row['category_name'] . '<ion-icon name="remove-outline"></ion-icon></a>';
                            }
                            else {
                                echo '<a href="./collections.php?category_id=' . $row['category_id'] . '">'. $row['category_name'] . '</a>';
                            }
                            //Kiểm tra nếu có mục con
                            $subQuery = "SELECT * FROM Category WHERE category_parent_id = " . $row['category_id'];
                            $subResult = $conn->query($subQuery);

                            if ($subResult->num_rows > 0) {
                                echo '<ul class="sub-menu">';
                                //Xuất các mục con
                                while ($subRow = $subResult->fetch_assoc()) {
                                    echo '<li class="sub-menu-item">';
                                        echo '<a href="./collections.php?category_id=' . $subRow['category_id'] . '">' . $subRow['category_name'] . '</a>';
                                    echo '</li>';
                                }
                                echo '</ul>';
                            }
                        echo '</li>';
                    }
                    echo '</ul>';
                }

                else {
                    echo "KHÔNG CÓ DỮ LIỆU !!!";
                }
            ?>
            </div>
            <!--------------------------------------------COLLECTIONS-ITEMS-----------------------------------------------------> 
            <div class="collections-item-wrap">
                <div class="collections-heading-wrap">

                    <div class="collections-title">
                    <?php
                        if ($category_id != 0){
                            $category_name = getCategoryName($conn, $category_id);
                            echo '<h1>' . $category_name . '</h1>';
                        }
                        else {
                            $category_name = 'Tất cả sản phẩm';
                            echo '<h1>' . $category_name . '</h1>';
                        }
                    ?>
                    </div>
                    <div class="selection-wrap">
                        <select name="order" id="">
                            <option value="priceIncrease">Giá: Tăng dần</option>
                            <option value="priceDecrease">Giá: Giảm dần</option>
                            <option value="nameIncrease">Tên: A - Z</option>
                            <option value="nameDecrease">Tên: Z - A</option>
                        </select>
                    </div>
                </div>
                <?php
                if ($products->num_rows > 0) {
                    echo '<div class="collections-item">';
                    while ($row = $products->fetch_assoc()) {
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
                    echo '</div>';
                }
                else {
                    echo 'CHƯA CÓ SẢN PHẨM !!!';
                }
                ?>
                <div class="collections-footer-wrap">
                    <?php
                    //Hiển thị các liên kết phân trang
                    if ($category_id != 0) {
                        if ($current_page > 1) {
                            echo '<a href="./collections.php?category_id=' . $category_id . '&page=' . ($current_page - 1) . '" class="prevPage"><i class="fa-solid fa-arrow-left-long"></i></a>';
                        }
                            echo '<ul class="page-list">';
                            for ($i  = 1; $i <= $total_pages; $i++) {
                                if ($i == $current_page) {
                                    echo '<li><a href="./collections.php?category_id=' . $category_id . '&page=' . $i . '"style="font-weight: bold;">' . $i . '</a></li>';
                                } else {
                                    echo '<li><a href="./collections.php?category_id=' . $category_id . '&page=' . $i . '">' . $i . '</a></li>';
                                }                            
                            }
                            echo '</ul>';
                        if ($current_page < $total_pages) {
                            echo '<a href="./collections.php?category_id=' . $category_id . '&page=' . ($current_page + 1) . '" class="nextPage"><i class="fa-solid fa-arrow-right-long"></i></a>';
                        }     
                    }
                    else {
                        if ($current_page > 1) {
                            echo '<a href="./collections.php?page=' . ($current_page - 1) . '" class="prevPage"><i class="fa-solid fa-arrow-left-long"></i></a>';
                        }
                            echo '<ul class="page-list">';
                            for ($i  = 1; $i <= $total_pages; $i++) {
                                if ($i == $current_page) {
                                    echo '<li><a href="./collections.php?page=' . $i . '"style="font-weight: bold;">' . $i . '</a></li>';
                                } else {
                                    echo '<li><a href="./collections.php?page=' . $i . '">' . $i . '</a></li>';
                                }                            
                            }
                            echo '</ul>';
                        if ($current_page < $total_pages) {
                            echo '<a href="./collections.php?page=' . ($current_page + 1) . '" class="nextPage"><i class="fa-solid fa-arrow-right-long"></i></a>';
                        }
                    }
                    ?>
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