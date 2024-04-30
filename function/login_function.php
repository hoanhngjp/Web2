<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Kết nối database
        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        //Lấy dữ liệu người dùng đăng nhập
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Truy vấn cơ sở dữ liệu để lấy mật khẩu được mã hóa
        $query = "SELECT user_password FROM User WHERE user_email = '{$email}'";
        $result= mysqli_query($conn, $query);

        if ($result->num_rows == 1) {
            // Lấy mật khẩu đã được mã hóa từ cơ sở dữ liệu
            $row = $result->fetch_assoc();
            $hashed_password = $row['user_password'];

            //So sánh mật khẩu 
            if (password_verify($password, $hashed_password)) {
                $query_user = "SELECT user_id ,user_email, user_fullname FROM User WHERE user_email = '{$email}'";
                $result_query_user = mysqli_query($conn, $query_user);
                $user_id;
                $user_email;
                $user_fullname;
                if (mysqli_num_rows($result_query_user) > 0) {
                    while ($row = mysqli_fetch_assoc($result_query_user)) {
                        $user_id = $row['user_id'];
                        $user_email = $row['user_email'];
                        $user_fullname = $row['user_fullname'];
                    }
                }

                $addresses = array();
                $query_addressinfo = "SELECT * FROM `Address-List` WHERE id_user = '$user_id'";
                $result_query_addressinfo = mysqli_query($conn, $query_addressinfo);

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

                $_SESSION['logged'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['email'] = $user_email;
                $_SESSION['fullname'] = $user_fullname;
                $_SESSION['addresses'] = $addresses;

                header("Location: ../account.php");
            }
            else {
                header("Location: ../login.php?fail=true");
            }
        }
    }
?>