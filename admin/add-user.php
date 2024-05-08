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
  <link rel="stylesheet" href="./css/add_user.css?v=<?php echo time(); ?>">
  <script src="./js/checkAddUser.js?v=<?php echo time(); ?>" defer></script>
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
            <h1 class="m-0">Thêm thông tin người dùng</h1>
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
  <div class="form-wrap"> 
            <div class="form">
                <form action="./function/addUserFunc.php" method="post" onsubmit="return checkRegistry()">
                <?php 
                    if(isset($_GET['fail'])) {
                        $fail = $_GET['fail'];
                        if ($fail) {
                            echo '<div class="errors-wrap">
                            <span class="show-error" id="isExist-error" style="display: block;">Email đã tồn tại.</span>
                        </div>' ;
                        }
                    }
                ?>
                    
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="fullname">Họ và tên*</label>
                        </div>
                        <input  type="text" name="fullname" id="fullname" placeholder="Họ và tên">
                        <div class="errors-wrap">
                            <span class="show-error" id="fullname-error">*Vui lòng nhập Họ tên của bạn</span>
                        </div>
                    </div>
                    <div class="gender-wrap">
                        <div class="label-wrap">
                            <label for="gender">Giới tính*</label>
                        </div>
                        <div class="radio-wrap">
                            <input type="radio" id="radio1" name="gender" value="Nữ" checked>
                            <label for="radio1">Nữ</label>
                            <input type="radio" id="radio2" name="gender" value="Nam">
                            <label for="radio2">Nam</label>
                        </div>
                        <div class="errors-wrap">
                            <span class="show-error" id="gender-error">*Vui lòng chọn Giới tính của bạn</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="birthday">Ngày sinh*</label>
                        </div>
                        <input  type="text" name="birthday" id="birthday" placeholder="dd/mm/yyyy">
                        <div class="errors-wrap">
                            <span class="show-error" id="birthday-error"></span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="email">Email*</label>
                        </div>
                        <input  type="text" name="email" id="email" placeholder="Email">
                        <div class="errors-wrap">
                            <span class="show-error" id="email-error"></span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="password">Mật khẩu*</label>
                        </div>
                        <input  type="password" name="password" id="password" placeholder="Mật khẩu">
                        <div class="errors-wrap">
                            <span class="show-error" id="password-error">*Vui lòng nhập Mật khẩu của bạn</span>
                        </div>
                    </div>
                    <div class="input-wrap">
                        <div class="label-wrap">
                            <label for="address">Địa chỉ*</label>
                        </div>
                        <input  type="text" name="address" id="address" placeholder="Địa chỉ">
                        <div class="errors-wrap">
                            <span class="show-error" id="address-error">*Vui lòng nhập Địa chỉ của bạn</span>
                        </div>
                    </div>
                    <div class="others-wrap">
                        <div class="button-wrap">
                            <button class="sign-in-btn" type="submit" value="login">Tạo tài khoản</button>
                        </div>
                    </div>
                </form>
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
<script src="js/admin.js"></script>
</body>
</html>
