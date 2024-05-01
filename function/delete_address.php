<?php
session_start();
require_once "../function/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['address_id'])) {
    $addressId = $_POST['address_id'];
    $id_user = $_SESSION['user_id']; // Đảm bảo bạn đã đặt session user_id khi người dùng đăng nhập

    $conn = connectDatabase();

    $query_delete_address = "DELETE FROM `Address-List` WHERE adrs_id = '$addressId'";

    if (mysqli_query($conn, $query_delete_address)) {
        // Cập nhật lại session với danh sách địa chỉ mới
        $query_addressinfo = "SELECT * FROM `Address-List` WHERE id_user = '$id_user'";
        $result_query_addressinfo = mysqli_query($conn, $query_addressinfo);
        $addresses = array();

        if (mysqli_num_rows($result_query_addressinfo) > 0) {
            while ($row = mysqli_fetch_assoc($result_query_addressinfo)) {
                $address_info = array(
                    "adrs_id" => $row['adrs_id'],
                    "adrs_fullname" => $row['adrs_fullname'],
                    "adrs_address" => $row['adrs_address'],
                    "adrs_phone" => $row['adrs_phone'],
                    "adrs_isDefault" => $row['adrs_isDefault']
                );
                $addresses[] = $address_info;
            }
        }

        // Cập nhật session với danh sách địa chỉ mới
        $_SESSION['addresses'] = $addresses;

        echo "Xóa địa chỉ thành công";
    } else {
        // Trả về thông báo lỗi nếu có lỗi xảy ra trong quá trình xóa địa chỉ
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
