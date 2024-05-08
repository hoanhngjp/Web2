<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Lấy dữ liệu từ Form
        $fullname = $_POST['fullname'];
        $raw_gender = $_POST['gender'];
        $raw_birthday = $_POST['birthday']; //DD-MM-YYYY
        $email = $_POST['email'];
        $raw_password = $_POST['password'];
        $address = $_POST['address'];
        $user_isActive = 1;
        //Mã hóa mật khẩu
        $password = password_hash($raw_password,PASSWORD_DEFAULT);
        //Chuyển ngày sinh về dạng YYYY-MM-DD
        $birthday = date("Y-m-d", strtotime(str_replace('/', '-', $raw_birthday)));
        //Chuyển dữ liệu gender
        $gender = "";
        if ($raw_gender === "Nữ") {
            $gender = "Female";
        }
        if ($raw_gender === "Nam") {
            $gender = "Male";
        }

        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        $query_check_email = "SELECT user_email FROM User WHERE user_email = '$email'";
        $result_check_email = mysqli_query($conn, $query_check_email);

        if ($result_check_email->num_rows > 0) {
            header("Location: ../add-user.php?fail=true");
        }

        if (empty($fullname) || empty($raw_gender) || empty($raw_birthday) || empty($email) || empty($raw_password) || empty($address)) {
            header("Location: ../add-user.php");
            exit();
        }

        else {

            $query = "INSERT INTO User(user_email, user_password, user_fullname, user_sex, user_birthday, user_isActive)
            VALUES ('$email', '$password', '$fullname', '$gender', '$birthday', '$user_isActive') ";

            

            if (mysqli_query($conn, $query)) {
                $query_idUser = "SELECT user_id FROM User WHERE user_email = '$email'";
                $result_query_idUser = mysqli_query($conn, $query_idUser);
                $id_user;
                if ($result_query_idUser->num_rows == 1) {
                    $row = $result_query_idUser->fetch_assoc();
                    $id_user = $row['user_id'];
                }

                $adrs_isDefault = 1;

                $query_address = "INSERT INTO `Address-List`(id_user, adrs_fullname, adrs_address, adrs_phone, adrs_isDefault)
                VALUES ('$id_user', '$fullname', '$address', null, '$adrs_isDefault')";
                mysqli_query($conn, $query_address);

                header("Location: ../change-user-info.php");
            }
            else {
                echo "Lỗi !!!";
            }

            $conn->close();
        }
    }
?>