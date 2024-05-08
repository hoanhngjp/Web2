<?php
// Kết nối đến cơ sở dữ liệu

if (isset($_POST['fromDate']) && isset($_POST['toDate'])) {
    require_once "../function/db_connect.php";
    $conn = connectDatabase();
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    // Truy vấn để lấy danh sách top 5 khách hàng có mức mua hàng cao nhất trong khoảng thời gian đã chọn
    $query_top_customers = "SELECT User.user_fullname, User.user_id, COUNT(Bill.bill_id) AS total_orders, SUM(Bill.total_amount) AS total_spent
                            FROM User
                            INNER JOIN Bill ON User.user_id = Bill.id_user
                            WHERE Bill.date_created BETWEEN '$fromDate' AND '$toDate'
                            GROUP BY User.user_id
                            ORDER BY total_spent DESC
                            LIMIT 5";

    // Thực hiện truy vấn và lấy kết quả
    $result_top_customers = mysqli_query($conn, $query_top_customers);

    $top = 1;

    // Hiển thị thông tin top 5 khách hàng
    while ($row_top_customers = mysqli_fetch_assoc($result_top_customers)) {
        echo '<h2>TOP '. $top++ .': ' . $row_top_customers['user_fullname'] . '</h2>';
        echo '<table id="userTable" class="table-header">';
        echo '<thead>
        <tr>
          <th>STT</th>
          <th>Tên khách hàng</th>
          <th>Mã đơn hàng</th>
          <th>Ngày tạo đơn</th>
          <th>Tổng tiền đơn hàng</th>
          <th>Chi tiết đơn hàng</th>
        </tr>
      </thead>';

        // Truy vấn để lấy danh sách đơn hàng của khách hàng
        $query_orders = "SELECT Bill.bill_id, Bill.date_created, Bill.total_amount
                         FROM Bill
                         WHERE Bill.id_user = {$row_top_customers['user_id']} AND Bill.date_created BETWEEN '$fromDate' AND '$toDate'
                         ORDER BY Bill.total_amount DESC";
        $result_orders = mysqli_query($conn, $query_orders);

        $stt = 1;
        while ($row_order = mysqli_fetch_assoc($result_orders)) {
            echo '<form action="./function/updateBill.php" method="POST">  ';
            echo '<tr>';
            echo '<td>' . $stt++ . '</td>';
            echo '<td>' . $row_top_customers['user_fullname'] . '</td>';
            echo '<td>' . $row_order['bill_id'] . '</td>';
            echo '<input type="hidden" name="bill_id" value="' . $row_order['bill_id'] . '">';
            echo '<td>' . date("d/m/Y", strtotime($row_order["date_created"])) . '</td>';
            echo '<td>' . number_format($row_order['total_amount']) . '₫</td>';
            echo '<td>';
                echo '<a href="chitiet.php?bill_id=' . $row_order['bill_id'] . '" style="color: black;" i class="fa fa-eye"></i> Chi tiết</a>';
            echo '</td>';
            echo '</tr>';
            echo '</form>  ';
        }
        echo '</table>';
    }
}
