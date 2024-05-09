<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once "../function/db_connect.php";
    $conn = connectDatabase();

    $id_user = $_SESSION['user_id'];
    $date_created = date("Y-m-d");
    $total_amount = $_SESSION['total_price'];
    $phone = $_SESSION['billing_address_phone'];
    $address = $_SESSION['billing_address_address'];
    $checkoutMethod = $_POST['checkoutMethod'];
    $payment_status = "pending";
    $shipping_status = "not_fulfilled";
    $is_confirmed = 0;
    $note = $_SESSION['bill_note'];

    $query_insert_bill = "INSERT INTO Bill (id_user, date_created, total_amount, phone,	shipping_address, checkout_method, payment_status, is_confirmed, shipping_status, note
    )
    VALUES ('$id_user', '$date_created', '$total_amount', '$phone', '$address', '$checkoutMethod', '$payment_status', '$is_confirmed', '$shipping_status', '$note')";

    if (mysqli_query($conn, $query_insert_bill)) {

        $id_bill = mysqli_insert_id($conn);

        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            $query = "SELECT * FROM Product WHERE product_id = $product_id LIMIT 1";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $unit_price = $row['product_price'];
                $total_price = $unit_price * $quantity;

                // Chèn dữ liệu vào bảng Bill-Detail
                $insert_query = "INSERT INTO `Bill-Detail` (id_bill, id_product, quantity, unit_price, total_price) 
                             VALUES ('$id_bill', '$product_id', '$quantity', '$unit_price', '$total_price')";
                mysqli_query($conn, $insert_query);

                $current_stock = $row['quantity_in_stock'];
                if ($current_stock >= $quantity) {
                    $new_stock = $current_stock - $quantity;

                    $update_query = "UPDATE Product SET quantity_in_stock = '$new_stock' WHERE product_id = $product_id";
                    mysqli_query($conn, $update_query);

                    unset($_SESSION['total_price']);
unset($_SESSION['cart']);
unset($_SESSION['checkoutMethod']);
unset($_SESSION['billing_address_address']);
unset($_SESSION['billing_address_phone']);
unset($_SESSION['billing_address_full_name']);
                }

            }
        }


    }
    
} else {
    echo "Error: POST method required!";
}
?>
