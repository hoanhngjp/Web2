<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $_SESSION['cart'][$product_id] = $quantity;

    if ($quantity == 0) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION['cart'][$product_id]);
        exit(); // Dừng script để chuyển hướng ngay sau khi gửi header

    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }


    $total_price = calculateTotalPrice($_SESSION['cart']);

    echo json_encode(['total_price' => $total_price]);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo "Method Not Allowed";
}

function calculateTotalPrice($cart) {
    $total_price = 0;
    foreach ($cart as $product_id => $quantity) {
        $total_price += $quantity * getProductPrice($product_id);
    }
    return $total_price;
}

function getProductPrice($product_id) {
    require_once "./db_connect.php";
    $conn = connectDatabase();
    $query = "SELECT product_price FROM Product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['product_price'];
    } else {
        // Trường hợp không tìm thấy giá của sản phẩm
        return 0;
    }
}
?>
