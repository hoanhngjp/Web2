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
        $address_list_id = $_POST['address_list_id'];
        $adrs_fullname = $_POST['adrs_fullname'];
        $adrs_address = $_POST['adrs_address'];
        $adrs_phone = $_POST['adrs_phone'];

        $query_update = "UPDATE `Address-List`
        SET adrs_fullname = '$adrs_fullname', adrs_address = '$adrs_address', adrs_phone = '$adrs_phone'
        WHERE adrs_id = '$address_list_id'";

        if (mysqli_query($conn, $query_update)) {
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
        // Thực hiện các thao tác kiểm tra và cập nhật dữ liệu vào cơ sở dữ liệu
        // (Viết code xử lý cập nhật dữ liệu vào cơ sở dữ liệu ở đây)

        // Sau khi cập nhật thành công, bạn có thể chuyển hướng người dùng đến trang khác hoặc hiển thị thông báo cập nhật thành công
        // Ví dụ:
        // header("Location: success.php");
        // exit();
    }
?>