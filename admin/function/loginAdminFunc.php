<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Kết nối database
        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        //Lấy dữ liệu người dùng đăng nhập
        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];

        //Truy vấn cơ sở dữ liệu để lấy mật khẩu được mã hóa
        $query = "SELECT admin_password FROM `Admin` WHERE admin_username = '{$admin_username}'";
        $result= mysqli_query($conn, $query);

        if ($result->num_rows == 1) {
            // Lấy mật khẩu đã được mã hóa từ cơ sở dữ liệu
            $row = $result->fetch_assoc();


            //So sánh mật khẩu 
            if ($admin_password === $row['admin_password']) {
                $query = "SELECT * FROM `Admin` WHERE admin_username = '{$admin_password}'";
                $result = mysqli_query($conn, $query);

                $row1 = $result->fetch_assoc();

                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_username'] = $row1['admin_username'];
 
                header("Location: ../admin.php");
            }
            else {
                header("Location: ../loginAdmin.php?fail=true");
            }
        }
    }
?>