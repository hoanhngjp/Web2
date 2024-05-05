<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    echo json_encode(array('error' => 'User not logged in'));
    exit;
}

// Kết nối cơ sở dữ liệu
require_once '../function/db_connect.php';
$conn = connectDatabase();

// Lấy user_id từ session
$user_id = $_SESSION['user_id'];

// Lấy address_id từ dữ liệu gửi đi
$address_id = $_POST['address_id'];

// Truy vấn để lấy thông tin địa chỉ từ bảng Address-List dựa trên user_id và address_id
$query = "SELECT * FROM `Address-List` WHERE id_user = $user_id AND adrs_id = $address_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(array('error' => 'Error fetching address information'));
    exit;
}

// Lấy thông tin địa chỉ
$row = mysqli_fetch_assoc($result);
$address = array(
    'adrs_fullname' => $row['adrs_fullname'],
    'adrs_address' => $row['adrs_address'],
    'adrs_phone' => $row['adrs_phone']
);

// Trả về dữ liệu dưới dạng JSON
echo json_encode($address);

?>
