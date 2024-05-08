<?php
require_once "../function/db_connect.php";
$conn = connectDatabase();

$tuKhoa = $_POST['tuKhoa'];
$kieuTimSanPham = $_POST['kieuTimSanPham'];

$query_product_records = "SELECT * FROM Product WHERE ";

switch ($kieuTimSanPham) {
    case "product_name":
        $query_product_records .= "product_name LIKE '%$tuKhoa%'";
        break;
    case "product_id":
        $query_product_records .= "product_id LIKE '%$tuKhoa%'";
        break;
}

$limit = 10;

$total_records = mysqli_num_rows(mysqli_query($conn, $query_product_records));

$total_pages = ceil($total_records / $limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start = ($page - 1) * $limit;

$query_product_records .= " Limit $start, $limit";
$result_query_product = mysqli_query($conn, $query_product_records);

if ($result_query_product) {
    echo '<table id="userTable">';
    echo '<thead>
    <tr>
      <th>Product ID</th>
      <th>Tên sản phẩm</th>
      <th>Giá sản phẩm</th>
      <th>Mô tả sản phẩm</th>
      <th>Số lượng trong kho</th>
      <th>Trạng thái bán</th>
      <th>Hình ảnh sản phẩm</th>
      <th>Sửa thông tin</th>
    </tr>
  </thead>';
    echo '<tbody>';
    while ($row = $result_query_product->fetch_assoc()) {
        echo '<form action="./product-info.php" method="GET">';
        echo '<tr>';
        echo '<td>' . $row['product_id'] . '</td>';
        echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
        echo '<td>' . $row['product_name'] . '</td>';
        echo '<td>' . $row['product_price'] . '</td>';
        echo '<td class="editable"';
        echo '<textarea name="product_description">' . $row['product_description'] . '</textarea>';
        echo '</td>';
        echo '<td>' . $row['quantity_in_stock'] . '</td>';
        echo '<td>';
        if ($row['is_onSale'] == 1) {
            echo 'Đang mở bán';
        } else {
            echo 'Đã ẩn sản phẩm';
        }
        echo '</td>';
        echo '<td class="image-container">';

        $product_id = $row['product_id'];
        $query_images = "SELECT * FROM `Product-Images` WHERE id_product = $product_id LIMIT 1";
        $result_images = mysqli_query($conn, $query_images);

        while ($image_row = mysqli_fetch_assoc($result_images)) {
            echo '<img src="../img/prdImg/' . $image_row['img_name'] . '" alt="Product Image">';
        }
        echo '</td>';
        echo '<td>';
        echo '<button class="sign-in-btn" type="submit" value="login">Sửa thông tin sản phẩm</button>';
        echo '</td>';
        echo '</tr>';
        echo '</form>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<div class="pagination">';
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '" class="prev">&laquo; Trang trước</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == 1 || $i == $total_pages || ($i >= $page - 2 && $i <= $page + 2)) {
            if ($page == $i) {
                echo '<a href="?page=' . $i . '" class="active">' . $i . '</a>';
            } else {
                echo ' <a href="?page=' . $i . '">' . $i . '</a>';
            }
        } else if ($i == $page - 3 || $i == $page + 3) {
            echo '<span>...</span>';
        }
    }
    if ($page < $total_pages) {
        echo '<a href="' . ($page + 1) . '" class="next">Trang tiếp theo &raquo;</a>';
    }
    echo '</div>';
}
