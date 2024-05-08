<?php
require_once "../function/db_connect.php";
$conn = connectDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý thông tin sản phẩm
    $product_name = $_POST['product_name'];
    $id_category = $_POST['id_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $quantity_in_stock = $_POST['quantity_in_stock'];
    $product_id = $_POST['product_id'];
    $is_onSale = $_POST['is_onSale'];

    // Cập nhật thông tin sản phẩm vào cơ sở dữ liệu
    $query_update_product = "UPDATE Product SET product_name = '$product_name', id_category = '$id_category', product_price = '$product_price', product_description = '$product_description', quantity_in_stock = '$quantity_in_stock', is_onSale = $is_onSale WHERE product_id = $product_id";
    mysqli_query($conn, $query_update_product);

    // Xử lý xóa hình ảnh sản phẩm
    if (isset($_POST['delete_images'])) {
        var_dump($_POST['delete_images']);
        $delete_images = $_POST['delete_images'];
        foreach ($delete_images as $image_id) {
            // Lấy tên hình ảnh từ cơ sở dữ liệu
            echo $image_id;
            $query_delete_image = "SELECT img_name FROM `Product-Images` WHERE img_id = $image_id";
            $result_delete_image = mysqli_query($conn, $query_delete_image);
            $row_delete_image = mysqli_fetch_assoc($result_delete_image);
            $image_name = $row_delete_image['img_name'];

            // Xóa hình ảnh khỏi thư mục lưu trữ
            $image_path = '../../img/prdImg/' . $image_name;
            unlink($image_path);

            // Xóa bản ghi từ bảng `Product-Images`
            $query_delete_image_record = "DELETE FROM `Product-Images` WHERE img_id = $image_id";
            mysqli_query($conn, $query_delete_image_record);
        }
    }

    // Xử lý thêm ảnh sản phẩm
    if ($_FILES['product_images']['size'][0] > 0) {
        $file_count = count($_FILES['product_images']['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $file_name = $_FILES['product_images']['name'][$i];
            $temp_name = $_FILES['product_images']['tmp_name'][$i];
            $file_size = $_FILES['product_images']['size'][$i];
            $file_type = $_FILES['product_images']['type'][$i];

            // Lưu hình ảnh vào thư mục lưu trữ
            move_uploaded_file($temp_name, '../../img/prdImg/' . $file_name);

            // Thêm bản ghi vào bảng `Product-Images`
            $query_insert_image = "INSERT INTO `Product-Images` (id_product, img_name) VALUES ($product_id, '$file_name')";
            mysqli_query($conn, $query_insert_image);
        }
    }

    // Chuyển hướng sau khi thực hiện thay đổi thông tin sản phẩm
    header("Location: ../change-product-info.php");
    exit();
}
