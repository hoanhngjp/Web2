<?php
session_start();
require_once "../function/db_connect.php";
$conn = connectDatabase();

// Kiểm tra nếu sản phẩm_id được gửi từ Ajax request
if(isset($_POST['product_id'])){
    $product_id = $_POST['product_id'];
    
    // Xóa sản phẩm khỏi giỏ hàng
    unset($_SESSION['cart'][$product_id]);

    // Tính toán lại tổng tiền
    $total_price = 0;
    foreach($_SESSION['cart'] as $product_id => $quantity) {
        // Thực hiện truy vấn để lấy giá của sản phẩm từ cơ sở dữ liệu
        // Sau đó tính toán tổng tiền mới
        // $total_price += ...
        $query = "SELECT * FROM Product WHERE product_id = $product_id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $total_price += $row['product_price'];
            }
        }
    }

    // Gửi tổng tiền mới về cho trang web
    echo number_format($total_price, 0, ',', '.') . '₫';
    exit();
}
?>
