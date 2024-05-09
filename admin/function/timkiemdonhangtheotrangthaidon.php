<?php
require_once "../function/db_connect.php";
$conn = connectDatabase();

$trangThaiDonHang = $_POST['trangThaiDonHang'];

$query_bill_records = "SELECT Bill.*, User.user_fullname 
FROM Bill 
INNER JOIN User ON Bill.id_user = User.user_id 
WHERE ";

switch ($trangThaiDonHang) {
    case "pending":
        $query_bill_records .= "payment_status = '$trangThaiDonHang'";
        break;
    case "paid":
        $query_bill_records .= "payment_status = '$trangThaiDonHang'";
        break;
}

$limit = 10;

$total_records = mysqli_num_rows(mysqli_query($conn, $query_bill_records));

$total_pages = ceil($total_records / $limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start = ($page - 1) * $limit;

$query_bill_records .= " Limit $start, $limit";
$result_query_bill = mysqli_query($conn, $query_bill_records);

if ($result_query_bill) {
    echo '<table id="userTable" class="table-header">';
    echo '<thead>
    <tr>
    <th>Bill ID</th>
    <th>Tên khách hàng</th>
    <th>Ngày tạo đơn</th>
    <th>Tổng giá trị đơn hàng</th>
    <th>Số điện thoại khách hàng</th>
    <th>Địa chỉ giao hàng</th>
    <th>Phương thức thanh toán</th>
    <th>Trạng thái thanh toán</th>
    <th>Tình trạng đơn hàng</th>
    <th>Trạng thái giao hàng</th>
    <th>Ghi chú đơn hàng</th>
    <th>Cập nhật đơn hàng</th>
    <th>Thông tin đơn hàng</th>
  </tr>
</thead>';
    echo '<tbody>';
    while ($row = $result_query_bill->fetch_assoc()) {
        echo '<form action="./function/updateBill.php" method="POST">  ';
                echo '<tr>';
                echo '<td>' . $row['bill_id'] . '</td>';
                echo '<input type="hidden" name="bill_id" value="' . $row['bill_id'] . '">';
                echo '<td>' . $row['user_fullname'] . '</td>';
                echo '<td>' . date("d/m/Y", strtotime($row["date_created"])) . '</td>';
                echo '<td>' . number_format($row['total_amount'], 0, ',', '.') . '₫</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['shipping_address'] . '</td>';
                echo '<td>' . $row['checkout_method'] . '</td>';
                echo '<td>';
                echo '<select name="payment_status" >';
                if ($row['payment_status'] === "pending") {
                  echo '<option value="pending" selected>Đang chờ</option>';
                  echo '<option value="paid">Đã thanh toán</option>';
                } else {
                  echo '<option value="pending">Đang chờ</option>';
                  echo '<option value="paid" selected>Đã thanh toán</option>';
                }
                echo '</select>';
                echo '</td>';
                echo '<td>';
                echo '<select name="is_confirmed" >';
                if ($row['is_confirmed'] == 1) {
                  echo '<option value="1" selected>Đã xác nhận</option>';
                  echo '<option value="0">Chưa xác nhận</option>';
                } else {
                  echo '<option value="1">Đã xác nhận</option>';
                  echo '<option value="0" selected>Chưa xác nhận</option>';
                }
                echo '</select>';
                echo '</td>';
                echo '<td>';
                echo '<select name="shipping_status" >';
                if ($row['shipping_status'] == "fulfilled") {
                  echo '<option value="fulfilled" selected>Đã giao hàng</option>';
                  echo '<option value="not_fulfilled">Chưa giao hàng</option>';
                } else {
                  echo '<option value="fulfilled">Đã giao hàng</option>';
                  echo '<option value="not_fulfilled" selected>Chưa giao hàng</option>';
                }
                echo '</select>';
                echo '</td>';
                echo '<td class="editable"';
                echo '<textarea name="note">' . $row['note'] . '</textarea>';
                echo '</td>';
                echo '<td>';
                echo '<button class="sign-in-btn" type="submit" value="">Cập nhật</button>';
                echo '</td>';
                echo '<td>';
                echo '<a href="chitiet.php?bill_id=' . $row['bill_id'] . '" style="color: black;" i class="fa fa-eye"></i> Chi tiết</a>';
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
