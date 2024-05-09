<?php
require_once "./function/db_connect.php";
$conn = connectDatabase();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="admin/process.css">
  <link rel="stylesheet" href="admin/style.css">
  <link rel="stylesheet" href="./css/changeUserInfo.css?v=<?php echo time(); ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php
    require_once "./template/main-header.php";
    ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php
    require_once "./template/main-sidebar.php";
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Đơn hàng</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="admin.html">Trang chủ</a></li>
                <li class="breadcrumb-item active">...</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


      <!-- Main content -->

      <div class="table-content">
      </div>


      <div class="table-footer">
        <form action="">
          Từ ngày: <input type="date" id="fromDate">
          Đến ngày: <input type="date" id="toDate">
          <button onclick="timTheoNgay()"><i class="fa fa-search"></i>Tìm theo ngày</button>
          <div>
          <select name="payment_status" id="payment_status" onchange="timKiemDonHangTheoTrangThaiThanhToan()">
            <option disabled selected>Trạng thái thanh toán</option>
            <option value="pending">Đang chờ</option>
            <option value="paid">Đã thanh toán</option>
          </select>

          <select name="is_confirmed" id="is_confirmed" onchange="timKiemDonHangTheoTinhTrangDon()">
            <option disabled selected>Tình trạng đơn hàng</option>
            <option value="1">Đã xác nhận</option>
            <option value="0">Chưa xác nhận</option>
          </select>

          <select name="shipping_status" id="shipping_status" onchange="timKiemDonHangTheoTrangThaiGiaoHang()">
            <option disabled selected>Trạng thái giao hàng</option>
            <option value="fulfilled">Đã giao hàng</option>
            <option value="not_fulfilled">Chưa giao hàng</option>
          </select>

        </div>
        </form>
        <div>
          <select id="kieuTimDonHang" name="kieuTimDonHang">
            <option value="bill_id">Tìm theo Mã đơn</option>
            <option value="bill_fullname">Tìm theo Tên khách hàng</option>
          </select>
          <input id="tuKhoa" type="text" placeholder="Tìm kiếm..." onkeyup="timKiemDonHang(this)">
        </div>

        


      </div>

      <!-- Đơn Hàng -->
        <div class="wrap-table" id="resultBill">
        <table id="userTable" class="table-header">
          <thead>
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
          </thead>
          <tbody>
            <?php
            $limit = 10;

            $start;

            // Kiểm tra xem người dùng đã chọn trạng thái nào từ dropdown hay chưa
            if (isset($_GET['payment_status']) || isset($_GET['is_confirmed']) || isset($_GET['shipping_status'])) {

              $default_payment_status = ''; // Hoặc bất kỳ giá trị mặc định nào phù hợp với dữ liệu của bạn
              $default_is_confirmed = '';
              $default_shipping_status = '';

              // Lấy giá trị trạng thái từ các tham số truy vấn
              $payment_status = isset($_GET['payment_status']) ? $_GET['payment_status'] : $default_payment_status;
              $is_confirmed = isset($_GET['is_confirmed']) ? $_GET['is_confirmed'] : $default_is_confirmed;
              $shipping_status = isset($_GET['shipping_status']) ? $_GET['shipping_status'] : $default_shipping_status;

              // Tạo điều kiện WHERE dựa trên các trạng thái được chọn
              $where_conditions = [];
              if (!empty($payment_status)) {
                $where_conditions[] = "payment_status = '$payment_status'";
              }
              if (!empty($is_confirmed)) {
                $where_conditions[] = "is_confirmed = '$is_confirmed'";
              }
              if (!empty($shipping_status)) {
                $where_conditions[] = "shipping_status = '$shipping_status'";
              }

              // Ghép các điều kiện WHERE lại với nhau bằng AND
              $where_clause = implode(" AND ", $where_conditions);

              $query_bill_records = "SELECT COUNT(*) AS total_records FROM Bill";
              if (!empty($where_clause)) {
                $query_bill_records .= " WHERE $where_clause";
              }

              $total_records = mysqli_fetch_assoc(mysqli_query($conn, $query_bill_records))['total_records'];

              $total_pages = ceil($total_records / $limit);
              // Tạo truy vấn SQL với điều kiện WHERE theo các trạng thái đã chọn

              if (!isset($_GET['page'])) {
                $page = 1;
              } else {
                $page = $_GET['page'];
              }

              $start = ($page - 1) * $limit;

              $query_bill = "SELECT Bill.*, User.user_fullname 
                  FROM Bill 
                  INNER JOIN User ON Bill.id_user = User.user_id 
                  WHERE $where_clause
                  LIMIT $start, $limit";
            } else {
              $query_bill_records = "SELECT * FROM Bill";


              $total_records = mysqli_num_rows(mysqli_query($conn, $query_bill_records));

              $total_pages = ceil($total_records / $limit);

              if (!isset($_GET['page'])) {
                $page = 1;
              } else {
                $page = $_GET['page'];
              }

              $start = ($page - 1) * $limit;

              $query_bill = "SELECT Bill.*, User.user_fullname 
                          FROM Bill 
                          INNER JOIN User ON Bill.id_user = User.user_id 
                          LIMIT $start, $limit";
            }


            $result_query_bill = mysqli_query($conn, $query_bill);

            if ($result_query_bill) {
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
            }
            ?>

          </tbody>
        </table>
        <div class="pagination">
          <?php if ($page > 1) : ?>
            <a href="?page=<?php echo ($page - 1); ?>" class="prev">&laquo; Trang trước</a>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
            <?php if ($i == 1 || $i == $total_pages || ($i >= $page - 2 && $i <= $page + 2)) : ?>
              <a href="?page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php elseif ($i == $page - 3 || $i == $page + 3) : ?>
              <span>...</span>
            <?php endif; ?>
          <?php endfor; ?>

          <?php if ($page < $total_pages) : ?>
            <a href="?page=<?php echo ($page + 1); ?>" class="next">Trang tiếp theo &raquo;</a>
          <?php endif; ?>
        </div>
      </div>








      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <script>
      function timKiemDonHang() {
        var tuKhoa = document.getElementById("tuKhoa").value;
        var kieuTimDonHang = document.getElementById("kieuTimDonHang").value;

        // Gửi dữ liệu tìm kiếm lên máy chủ bằng Ajax
        $.ajax({
          type: "POST",
          url: "./function/timkiemdonhang.php", // Thay đổi đường dẫn đến tập tin PHP xử lý tìm kiếm
          data: {
            tuKhoa: tuKhoa,
            kieuTimDonHang: kieuTimDonHang
          },
          success: function(response) {
            // Hiển thị kết quả tìm kiếm trả về từ máy chủ
            $("#resultBill").html(response);
          }
        });
      }

      function timKiemDonHangTheoTrangThaiThanhToan() {
        var trangThaiDonHang = document.getElementById("payment_status").value;
      
        $.ajax({
          type: "POST",
          url: "./function/timkiemdonhangtheotrangthaidon.php", // Thay đổi đường dẫn đến tập tin PHP xử lý tìm kiếm
          data: {
            trangThaiDonHang: trangThaiDonHang
          },
          success: function(response) {
            // Hiển thị kết quả tìm kiếm trả về từ máy chủ
            $("#resultBill").html(response);
          }
        });
      }

      function timKiemDonHangTheoTinhTrangDon() {
        var tinhTrangDon = document.getElementById("is_confirmed").value;
      
        $.ajax({
          type: "POST",
          url: "./function/timkiemdonhangtheotinhtrangdon.php", // Thay đổi đường dẫn đến tập tin PHP xử lý tìm kiếm
          data: {
            tinhTrangDon: tinhTrangDon
          },
          success: function(response) {
            // Hiển thị kết quả tìm kiếm trả về từ máy chủ
            $("#resultBill").html(response);
          }
        });
      }

      function timKiemDonHangTheoTrangThaiGiaoHang() {
        var trangThaiGiaoHang = document.getElementById("shipping_status").value;
      
        $.ajax({
          type: "POST",
          url: "./function/timkiemdonhangtheotrangthaigiaohang.php", // Thay đổi đường dẫn đến tập tin PHP xử lý tìm kiếm
          data: {
            trangThaiGiaoHang: trangThaiGiaoHang
          },
          success: function(response) {
            // Hiển thị kết quả tìm kiếm trả về từ máy chủ
            $("#resultBill").html(response);
          }
        });
      }

      function timTheoNgay() {
        var fromDate = document.getElementById("fromDate").value;
        var toDate = document.getElementById("toDate").value;

        // Gửi dữ liệu ngày tháng lên máy chủ bằng Ajax
        $.ajax({
          type: "POST",
          url: "./function/timtheongay.php",
          data: {
            fromDate: fromDate,
            toDate: toDate
          },
          success: function(response) {
            // Hiển thị kết quả trả về từ máy chủ
            $("#resultBill").html(response);
          }
        });
      }

    </script>

</body>

</html>