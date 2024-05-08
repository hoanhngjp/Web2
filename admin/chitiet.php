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
              <h1 class="m-0">Chi tiết đơn hàng - <?php echo $_GET['bill_id']; ?></h1>
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



      <!-- Đơn Hàng -->
      <div class="donhang">
        <table id="userTable" class="table-header">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Số lượng sản phẩm</th>
              <th>Đơn giá</th>
              <th>Thành tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $bill_id;
            if (isset($_GET['bill_id'])) {
              $bill_id = $_GET['bill_id'];
            }

            $stt = 0;
            $sum = 0;
            $query_bill_detail = "SELECT * FROM `Bill-Detail` WHERE id_bill = $bill_id";
            $result_bill_detail = mysqli_query($conn, $query_bill_detail);

            if ($result_bill_detail) {
              while ($row = $result_bill_detail->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . ++$stt . '</td>';

                $query_product_name = "SELECT product_name FROM Product WHERE product_id = {$row['id_product']}";
                $result_product_name = mysqli_query($conn, $query_product_name);
                $row_name = $result_product_name->fetch_assoc();

                echo '<td>' . $row_name['product_name'] . '</td>';

                $query_img = "SELECT img_name FROM `Product-Images` WHERE id_product = {$row['id_product']} LIMIT 1";
                $result_img = mysqli_query($conn, $query_img);
                $row_img = $result_img->fetch_assoc();

                echo '<td class="img-container"><img src="../img/prdImg/' . $row_img['img_name'] . '" alt="Product Image"></td>';
                echo '<td>' . $row['quantity'] . '</td>';
                echo '<td>' . number_format($row['unit_price'], 0, ',', '.') . '₫</td>';
                echo '<td>' . number_format($row['total_price'], 0, ',', '.') . '₫</td>';
                echo '</tr>';

                $sum += $row['total_price'];
              }
            }
            ?>

          </tbody>
          <tfoot>
            <td colspan="4">Tổng tiền: </td>
            <td colspan="2"><?php echo number_format($sum, 0, ',', '.') . 'đ'; ?></td>
          </tfoot>
        </table>
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
</body>

</html>