<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://kit.fontawesome.com/39b6b90061.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/collections.css">
    <link rel="stylesheet" href="css/cart-search.css">
    <title>Tất cả sản phẩm</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js" defer></script>
    <script src="js/sub-menu.js" defer></script>
</head>
<body>
    <div class="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
            require_once "./template/header.php";
        ?>
        <!--------------------------------------------Collections----------------------------------------------------->
        <div class="collections-wrap">
        <!--------------------------------------------DIRECT----------------------------------------------------->
        <div class="direct">
            <div class="direct-items">
                <a href="./home.php">Trang chủ</a> <p> / </p> <a href="">Danh mục</a> <p> / </p> <p>Tất cả sản phẩm</p>
            </div>
        </div>
        <!--------------------------------------------COLLECTIONS----------------------------------------------------->
        <div class="collections-content">
            <!--------------------------------------------Collections-MENU----------------------------------------------------->
            <div class="menu-wrap">
            <?php
                require_once "./function/db_connect.php";
                $conn = connectDatabase();
                $query = "SELECT * FROM Category WHERE category_parent_id = 0";
                $result = $conn->query($query);
            
                function hasSubCategoriesCollections($category_id) {
                    global $conn;
                    $subQuery = "SELECT * FROM Category WHERE category_parent_id = $category_id";
                    $subResult = $conn->query($subQuery);
                    return $subResult->num_rows > 0;
                }

                if ($result->num_rows > 0) {
                    echo '<ul class="menu-tree">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="menu-item">';
                            if (hasSubCategoriesCollections($row['category_id'])){
                                echo '<a href="">'. $row['category_name'] . '<ion-icon name="remove-outline"></ion-icon></a>';
                            }
                            else {
                                echo '<a href="">'. $row['category_name'] . '</a>';
                            }
                            //Kiểm tra nếu có mục con
                            $subQuery = "SELECT * FROM Category WHERE category_parent_id = " . $row['category_id'];
                            $subResult = $conn->query($subQuery);

                            if ($subResult->num_rows > 0) {
                                echo '<ul class="sub-menu">';
                                //Xuất các mục con
                                while ($subRow = $subResult->fetch_assoc()) {
                                    echo '<li class="sub-menu-item">';
                                        echo '<a href="">' . $subRow['category_name'] . '</a>';
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
                $conn->close();
            ?>
            </div>
            <!--------------------------------------------COLLECTIONS-ITEMS----------------------------------------------------->
            <div class="collections-item-wrap">
                <div class="collections-heading-wrap">
                    <div class="collections-title">
                        <h1>Tất cả sản phẩm</h1>
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
                <div class="collections-item">
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                    <div class="item-wrap">
                        <div class="item-picture">
                            <a href="">
                                <img src="img/item-demo-picture.webp" alt="">
                            </a>
                        </div>
                        <div class="item-detail">
                            <h3>
                                <a href="">Cốc Thủy Tinh Gia Đình Cún, Mèo</a>
                            </h3>
                            <p class="item-price">185,000đ</p>
                        </div>
                    </div>
                </div>
                <div class="collections-footer-wrap">
                    <a href="" class="prevPage"><i class="fa-solid fa-arrow-left-long"></i></a>
                    <ul class="page-list">
                        <li>
                            <a href="">1</a>
                        </li>
                        <li>
                            <a href="">2</a>
                        </li>
                        <li>
                            <a href="">3</a>
                        </li>
                    </ul>
                    <a href="" class="nextPage"><i class="fa-solid fa-arrow-right-long"></i></a>
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