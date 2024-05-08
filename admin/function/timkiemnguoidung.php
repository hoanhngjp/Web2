<?php
require_once "../function/db_connect.php";
$conn = connectDatabase();

$tuKhoa = $_POST['tuKhoa'];
$kieuTimKhachHang = $_POST['kieuTimKhachHang'];

$query_user_records = "SELECT * FROM User WHERE ";

switch ($kieuTimKhachHang) {
    case "ten":
        $query_user_records .= "user_fullname LIKE '%$tuKhoa%'";
        break;
    case "email":
        $query_user_records .= "user_email LIKE '%$tuKhoa%'";
        break;
    case "id":
        $query_user_records .= "user_id = '$tuKhoa'";
        break;
}

$limit = 10;

$total_records = mysqli_num_rows(mysqli_query($conn, $query_user_records));

$total_pages = ceil($total_records / $limit);

if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$start = ($page - 1) * $limit;

$query_user_records .= " Limit $start, $limit";
$result_query_user = mysqli_query($conn, $query_user_records);

if ($result_query_user) {
    echo '<table id="userTable">';
    echo '<thead>
    <tr>
      <th>User ID</th>
      <th>Email</th>
      <th>Họ và Tên</th>
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <th>Trạng thái tài khoản</th>
      <th>Cập nhật thông tin</th>
    </tr>
  </thead>';
  echo '<tbody>';
    while ($row = $result_query_user->fetch_assoc()) {
        echo '<form action="./function/change_user_info.php" method="POST">  ';
        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<input type="hidden" name="user_id" value="' . $row['user_id'] . '">';
        echo '<td class="editable">';
        echo '<input type="text" name="user_email"  value="' . $row['user_email'] . '">';
        echo '</td>';
        echo '<td class="editable">';
        echo '<input type="text" name="user_fullname"  value="' . $row['user_fullname'] . '">';
        echo '</td>';
        echo '<td>';
        echo '<select name="user_sex">';
        if ($row['user_sex'] == "Male") {
            echo '<option value="Male" selected>Nam</option>';
            echo '<option value="Female">Nữ</option>';
        } else {
            echo '<option value="Male">Nam</option>';
            echo '<option value="Female" selected>Nữ</option>';
        }
        echo '</select>';
        echo '</td>';
        echo '<td>';
        echo '<input type="text" name="user_birthday"  value="' . date("d/m/Y", strtotime($row["user_birthday"])) . '">';
        echo '</td>';
        echo '<td>';
        echo '<select name="user_isActive" >';
        if ($row['user_isActive'] == 1) {
            echo '<option value="1" selected>Hoạt động</option>';
            echo '<option value="0">Khóa</option>';
        } else {
            echo '<option value="1">Hoạt động</option>';
            echo '<option value="0" selected>Khóa</option>';
        }
        echo '</select>';
        echo '</td>';
        echo '<td>';
        echo '<button class="sign-in-btn" type="submit" value="login">Cập nhật</button>';
        echo '</td>';
        echo '</tr>';
        echo '</form>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<div class="pagination">';
    if ($page > 1) {
        echo '<a href="?page='.($page - 1).'" class="prev">&laquo; Trang trước</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == 1 || $i == $total_pages || ($i >= $page - 2 && $i <= $page + 2)) {
            if ($page == $i) {
                echo '<a href="?page='.$i.'" class="active">'.$i.'</a>';
            }else {
                echo ' <a href="?page='.$i.'">'.$i.'</a>';
            }
        }
        else if ($i == $page - 3 || $i == $page + 3) {
            echo '<span>...</span>';
        }
    }
    if ($page < $total_pages) {
        echo '<a href="'.($page + 1).'" class="next">Trang tiếp theo &raquo;</a>';
    }
    echo '</div>';
}
