<?php
    require_once "./function/db_connect.php";
    $conn = connectDatabase();
    $query = "SELECT * FROM Category WHERE category_parent_id = 0";
    $result = $conn->query($query);

    function hasSubCategories($category_id) {
        global $conn;
        $subQuery = "SELECT * FROM Category WHERE category_parent_id = $category_id";
        $subResult = $conn->query($subQuery);
        return $subResult->num_rows > 0;
    }

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

<header>
            <div class="homeLogo">
                <a href="./home.php"><img src="img/logo.webp" alt=""></a>
            </div>
            <div class="menu">
            <ul>
                <li><a href="./home.php">Trang chủ</a></li>
                <li>
                    <a href="./collections.php">Sản phẩm <ion-icon name="chevron-down-outline"></ion-icon></a>
                    <?php
                    if ($result->num_rows > 0) {
                        echo '<ul class="dropDown">';
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>';
                                if (hasSubCategories($row['category_id'])) {
                                    echo '<a href="./collections.php?category_id=' . $row['category_id'] . '">' . $row['category_name'] . ' <ion-icon name="chevron-forward-outline"></ion-icon></a>';
                                }
                                else {
                                    echo '<a href="./collections.php?category_id=' . $row['category_id'] . '">' . $row['category_name'] . '</a>';
                                }
                                //Kiểm tra nếu có mục con
                                $subQuery = "SELECT * FROM Category WHERE category_parent_id = " . $row['category_id'];
                                $subResult = $conn->query($subQuery);
                                if ($subResult->num_rows > 0){
                                    echo '<ul class = "subMenu">';
                                    //Xuất các mục con
                                    while ($subRow = $subResult->fetch_assoc()) {
                                        echo '<li><a href="./collections.php?category_id=' . $subRow['category_id'] . '">' . $subRow['category_name'] . '</a></li>';
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
                </li>
                <li><a href="">Về A Little Leaf</a></li>
            </ul>
            </div>
            <div class="headerOthers">
                <ul class="others">
                    <?php
                        if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
                            echo '<li><a href="account.php"><ion-icon name="person-circle-outline"></ion-icon></a></li>';
                        }
                        else {
                            echo '<li><a href="login.php"><ion-icon name="person-circle-outline"></ion-icon></a></li>';
                        }
                    ?>
                    <li><a href="" id="open-site-search"><ion-icon name="search-outline"></ion-icon></a></li>
                    <li>
                        <a href="" id="open-site-cart">
                            <ion-icon name="bag-outline"></ion-icon>
                            <span class="count-holder">
                                <?php
                                echo '<span class="count">'. $count .'</span>';                               
                                ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </header>