<?php 
    session_start();

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
            header("Location: ../register.php?fail=true");
        }

        if (empty($fullname) || empty($raw_gender) || empty($raw_birthday) || empty($email) || empty($raw_password) || empty($address)) {
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
                $_SESSION['user_id'] = $id_user;
                $_SESSION['logged'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['addresses'] = $addresses;

                $conn->close();
                header("Location: ../account.php");
            }
            else {
                echo "Lỗi !!!";
            }

            $conn->close();
        }
    }
?>