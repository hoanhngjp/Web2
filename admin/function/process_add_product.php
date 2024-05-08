<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../function/db_connect.php";
    $conn = connectDatabase();

    $product_name = $_POST['product_name'];
    $id_category = $_POST['id_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $is_onSale = 1;

    $query_insert_product = "INSERT INTO Product (id_category, product_name, product_price, product_description, quantity_in_stock, is_onSale)
                            VALUES ('$id_category', '$product_name', '$product_price', '$product_description', '$quantity_in_stock', '$is_onSale')";
    $result_insert_product = mysqli_query($conn, $query_insert_product);

    if ($result_insert_product) {
        $last_product_id = mysqli_insert_id($conn);

        foreach ($_FILES['product_images']['tmp_name'] as $key => $tmp_name) {
            $image_name = $_FILES['product_images']['name'][$key];
            $image_temp = $_FILES['product_images']['tmp_name'][$key];
            $target_directory = "../../img/prdImg/";
            $target_file = $target_directory . basename($image_name);
            move_uploaded_file($image_temp, $target_file);
            $query_insert_image = "INSERT INTO `Product-Images` (id_product, img_name) VALUES ('$last_product_id', '$image_name')";
            $result_insert_image = mysqli_query($conn, $query_insert_image);

            if (!$result_insert_image) {
                echo "Lỗi khi lưu hình ảnh vào cơ sở dữ liệu.";
                exit();
            }

            header("Location: ../add-product.php");
        }
    } else {
        // Xử lý lỗi khi thêm sản phẩm vào cơ sở dữ liệu
        echo "Có lỗi xảy ra khi thêm sản phẩm vào cơ sở dữ liệu.";
    }
}
