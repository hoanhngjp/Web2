<?php
    session_start();
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
        // Kiểm tra xem product_id có tồn tại trong URL không
        if (isset($_GET['product_id'])) {
            // Lấy product_id từ URL
            $product_id = $_GET['product_id'];

            // Kiểm tra xem số lượng sản phẩm được chọn
            if (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
                // Lấy số lượng sản phẩm từ form
                $quantity = $_POST['quantity'];

                // Thêm sản phẩm vào giỏ hàng của người dùng
                if (!isset($_SESSION['cart'])) {
                    // Nếu giỏ hàng chưa tồn tại, khởi tạo giỏ hàng
                    $_SESSION['cart'] = array();
                }

                // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
                if (isset($_SESSION['cart'][$product_id])) {
                    // Nếu sản phẩm đã tồn tại trong giỏ hàng, cộng thêm số lượng mới vào số lượng đã có
                    $_SESSION['cart'][$product_id] += $quantity;
                } else {
                    // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
                    $_SESSION['cart'][$product_id] = $quantity;
                }

                // Chuyển hướng người dùng đến trang giỏ hàng sau khi thêm sản phẩm thành công
                header("Location: ../cart.php");
                exit();
            }
        }
    }
    else {
        header("Location: ../login.php");
        exit();
    }
?>