<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    // Kiểm tra xem product_id có tồn tại trong URL không
    if (isset($_POST['product_id'])) {
        // Lấy product_id từ URL
        $product_id = $_POST['product_id'];

        // Kiểm tra xem số lượng sản phẩm được chọn
        if (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
            // Lấy số lượng sản phẩm từ form
            $quantity = intval($_POST['quantity']); // Chuyển đổi thành số nguyên

            // Thêm sản phẩm vào giỏ hàng của người dùng
            if (!isset($_SESSION['cart'])) {
                // Nếu giỏ hàng chưa tồn tại, khởi tạo giỏ hàng
                $_SESSION['cart'] = array();
            }

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng, cộng thêm số lượng mới vào số lượng đã có
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
                $_SESSION['cart'][$product_id] = $quantity;
            }

            // Chuyển hướng người dùng trở lại trang sản phẩm sau khi thêm vào giỏ hàng
            header("Location: ../product.php?product_id={$product_id}");
            exit();
        }
    }
} else {
    // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: ../login.php");
    exit();
}
?>
