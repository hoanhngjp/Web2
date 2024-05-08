<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        $user_id = $_POST['user_id'];
        $user_email = $_POST['user_email'];
        $user_fullname = $_POST['user_fullname'];
        $user_sex = $_POST['user_sex'];
        $raw_birthday = $_POST['user_birthday'];
        $user_isActive = $_POST['user_isActive'];

        $user_birthday = date("Y-m-d", strtotime(str_replace('/', '-', $raw_birthday)));


        $query = "UPDATE User
        SET user_email = '$user_email', user_fullname = '$user_fullname', user_sex = '$user_sex', user_birthday = '$user_birthday', user_isActive = '$user_isActive'
        WHERE user_id = '$user_id'";

        if (mysqli_query($conn, $query)) {
            header("Location: ../change-user-info.php");
        }
    }
?>
