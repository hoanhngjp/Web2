<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require_once "../function/db_connect.php";
        $conn = connectDatabase();

        $product_id = $_POST['product_id'];

        $query = "DELETE FROM Product WHERE product_id = $product_id";

        if (mysqli_query($conn, $query)) {
            header("Location: ../product3.php");
        }
    }
?>
