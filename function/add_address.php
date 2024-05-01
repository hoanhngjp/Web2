<?php
    session_start();

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
        exit();
    }

    // Xử lý form cập nhật địa chỉ khi người dùng nhấn nút "CẬP NHẬT"
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        $id_user = $_SESSION['user_id'];

        // Lấy dữ liệu từ form
        $adrs_fullname = $_POST['address_fullname'];
        $adrs_address = $_POST['address_address'];
        $adrs_phone = $_POST['address_phone'];

        // Kiểm tra checkbox được chọn hay không
        $adrs_isDefault = isset($_POST['address_default']) ? 1 : 0;

        // Nếu checkbox được chọn, thực hiện cập nhật `adrs_isDefault` cho các địa chỉ khác
        if ($adrs_isDefault == 1) {
            $query_update_default = "UPDATE `Address-List` SET adrs_isDefault = 0 WHERE id_user = '$id_user'";
            mysqli_query($conn, $query_update_default);
        }
        
        // Tiếp tục thêm địa chỉ mới vào cơ sở dữ liệu
        $query_insert_address = "INSERT INTO `Address-List`(id_user, adrs_fullname, adrs_address, adrs_phone, adrs_isDefault)
        VALUES ('$id_user', '$adrs_fullname', '$adrs_address', '$adrs_phone', '$adrs_isDefault')";

        if (mysqli_query($conn, $query_insert_address)) {
            $query_addressinfo = "SELECT * FROM `Address-List` WHERE id_user = '$id_user'";
            $result_query_addressinfo = mysqli_query($conn, $query_addressinfo);
            $addresses =array();

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
            $_SESSION['addresses'] = $addresses;
            
            $conn->close();
            header("Location: ../address.php");
        }
        else {
            echo 'Lỗi';
            $conn->close();
        }
        $conn->close();
    }
?>