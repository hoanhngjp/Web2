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
    <link rel="stylesheet" href="css/home.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="css/cart-search.css?v=<?php echo time();?>">
    <title>A Little Leaf</title>
    <link rel="icon" type="image/x-icon" href="img/footerLogo.webp">
    <script src="js/showCartSearch.js" defer></script>
</head>
<body>
    <div id="main-body">
        <!--------------------------------------------HEADER----------------------------------------------------->
        <?php
        require_once "./template/header.php";
        ?>
        <!--------------------------------------------SLIDER----------------------------------------------------->
        <div class="slider">
            <div class="list">
                <div class="item">
                    <img src="img/slider/slider1.webp" alt="">
                </div>
                <div class="item">
                    <img src="img/slider/slider2.webp" alt="">
                </div>
                <div class="item">
                    <img src="img/slider/slider3.webp" alt="">
                </div>
                <div class="item">
                    <img src="img/slider/slider4.webp" alt="">
                </div>
            </div>
            <!--button prev & next-->
            <div class="buttons">
                <button id="prev"><ion-icon name="arrow-back-outline"></ion-icon></button>
                <button id="next"><ion-icon name="arrow-forward-outline"></ion-icon></button>
            </div>
            <!--dots-->
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <script src="js/slider.js"></script>
        </div>
        <!--------------------------------------------CATEGORY----------------------------------------------------->
        <div class="category-title">
        <h2>DANH MỤC SẢN PHẨM</h2>
        </div>
        <div class="category-wrap">
            <?php
                require_once "./function/db_connect.php";
                $conn = connectDatabase();
                $query = "SELECT * FROM Category WHERE category_parent_id = 0";
                $result = $conn->query($query);

                if ($result->num_rows > 0){
                    echo '<div class="category">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="category-item">';
                            echo '<a href="./collections.php?category_id=' . $row['category_id'] . '">';
                                echo '<div class="category-item-img">';
                                    echo '<img src="img/homeCategory/' . $row['category_img'] . '" alt="">';
                                echo '</div>';
                                echo '<span>' . $row['category_name'] . '</span>';
                            echo '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
                else {
                    echo 'KHÔNG CÓ DỮ LIỆU !!!';
                }
                
            ?>
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