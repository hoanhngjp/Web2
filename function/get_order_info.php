<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Kiểm tra nếu form đã được submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ các trường input
        $fullName = $_POST['billing_address_full_name'];
        $phone = $_POST['billing_address_phone'];
        $address = $_POST['billing_address_address'];

        // In ra các giá trị dữ liệu nhận được từ form
        echo "Full Name: " . $fullName . "<br>";
        echo "Phone: " . $phone . "<br>";
        echo "Address: " . $address . "<br>";

        // Lưu thông tin vào session
        $_SESSION['billing_address_full_name'] = $fullName;
        $_SESSION['billing_address_phone'] = $phone;
        $_SESSION['billing_address_address'] = $address;

        // Chuyển hướng hoặc thực hiện các hành động khác sau khi lưu thông tin vào session
        // Ví dụ:
        header("Location: ../checkout.php");
    }
?>
