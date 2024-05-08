<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        $bill_id = $_POST['bill_id'];
        $payment_status = $_POST['payment_status'];
        $is_confirmed = $_POST['is_confirmed'];
        $shipping_status = $_POST['shipping_status'];

        $query = "UPDATE Bill
        SET payment_status = '$payment_status', is_confirmed = '$is_confirmed', shipping_status = '$shipping_status'
        WHERE bill_id = '$bill_id'";

        if (mysqli_query($conn, $query)) {
            header("Location: ../donhang.php");
        }
    }
?>
