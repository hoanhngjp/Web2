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
              <h1 class="m-0">Bảng chính</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="admin.php">Trang chủ</a></li>
                <li class="breadcrumb-item active">Bảng chính</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <?php
                  $query_total_bill = "SELECT COUNT(*) AS total_bills FROM Bill";
                  $result_total_bill = mysqli_query($conn, $query_total_bill);

                  $total_bill = $result_total_bill->fetch_assoc();
                  ?>
                  <h3><?php echo $total_bill['total_bills']; ?></h3>
                  <p>Đơn hàng</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bookmark"></i>
                </div>
                <a href="./donhang.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <?php
                  $query_total_users = "SELECT COUNT(*) AS total_users FROM User";
                  $result_total_users = mysqli_query($conn, $query_total_users);

                  $total_users = $result_total_users->fetch_assoc();
                  ?>
                  <h3><?php echo $total_users['total_users']; ?></h3>
                  <p>Người dùng</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="./change-user-info.php" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-gray">
                <div class="inner">
                  <?php
                  $query_total_products = "SELECT COUNT(*) AS total_products FROM Product";
                  $result_total_products = mysqli_query($conn, $query_total_products);

                  $total_products = $result_total_products->fetch_assoc();
                  ?>
                  <h3><?php echo $total_products['total_products']; ?></h3>
                  <p>Sản phẩm</p>
                </div>
                <div class="icon">
                  <i class="ion ion-android-car"></i>
                </div>
                <a href="./change-product-info.php" class="small-box-footer">Cập nhật <i class="fas fa-arrow-circle-right"></i></a>
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
</body>

</html>