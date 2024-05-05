<?php
session_start();
require_once "../function/db_connect.php";
$conn = connectDatabase();

// Kiểm tra nếu là yêu cầu POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận dữ liệu từ yêu cầu POST
    $data = json_decode(file_get_contents("php://input"), true);
    $fullName = $data['fullName'];
    $phone = $data['phone'];
    $address = $data['address'];

    $id_user = $_SESSION['user_id'];

    $query = "INSERT INTO `Address-List` (id_user, adrs_fullname, adrs_address, adrs_phone, adrs_isDefault)
    VALUES ('$id_user', '$fullName', '$address', '$phone', 0)";

    if (mysqli_query($conn, $query)) {
        echo 'Sucess';
    }
    // Lưu thông tin vào cơ sở dữ liệu
    // Viết mã SQL thêm thông tin vào bảng Address-List

    // Gửi phản hồi về cho JavaScript
    echo "New address saved successfully!";
}
?>
