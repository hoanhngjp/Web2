<?php
require_once "../function/db_connect.php";
$conn = connectDatabase();

if(isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    
    // Truy vấn cơ sở dữ liệu để tìm kiếm sản phẩm
    $sql = "SELECT * FROM Product WHERE product_name LIKE '%$keyword%'";
    
    // Thực hiện truy vấn SQL
    $result = $conn->query($sql);
    $total_results = $result->num_rows;
    // Hiển thị kết quả
    $count = 0; // Khởi tạo biến đếm
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Kiểm tra nếu đã hiển thị đủ 5 sản phẩm thì dừng vòng lặp
            if ($count >= 5) {
                break;
            }
            echo '<div class="item-ult">';
                echo '<div class="thumbs">';
                        $query_img = "SELECT img_name FROM `Product-Images` WHERE id_product = '{$row['product_id']}' GROUP BY id_product";
                        $result_img = mysqli_query($conn, $query_img);
                        $row_img = $result_img->fetch_assoc();
                    echo '<a href="./product.php?product_id=' . $row['product_id'] . '"><img src="./img/prdImg/'. $row_img['img_name'] . '" alt=""></a>';
                echo '</div>';
                echo '<div class="title">';
                    echo '<a href="./product.php?product_id=' . $row['product_id'] . '">' . $row['product_name'] . '</a>';
                    echo '<p class="f-initial">' . $row['product_price'] . '</p>';
                echo '</div>';
            echo '</div>';
            $count++; // Tăng biến đếm sau mỗi lần hiển thị sản phẩm
        }
    } else {
        echo "Không tìm thấy sản phẩm nào.";
    }
        // Đếm số sản phẩm còn lại
        $remaining_results = max(0, $total_results - $count);
        echo '<div class="result-wrap">';
        echo '<div class="result-content">';
            // Hiển thị phần resultMore với số lượng sản phẩm còn lại
        echo '<div class="resultMore">';
        if ($remaining_results > 0) {
            echo '<a href="./search.php?q='.$keyword.'">Xem thêm <strong> ' . $remaining_results . '</strong> sản phẩm</a>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
}
?>
