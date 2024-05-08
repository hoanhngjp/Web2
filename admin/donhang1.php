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
            <h1 class="m-0">Xử lý đơn hàng</h1>
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
  
   <!-- Đơn Hàng -->
   <div class="donhang">
    <table class="table-header">
        <tr>
            <!-- Theo độ rộng của table content -->
            <th title="Sắp xếp" style="width: 7%" onclick="sortDonHangTable('stt')">STT<i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 13%" onclick="sortDonHangTable('madon')">Mã đơn <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 25%" onclick="sortDonHangTable('khach')">Khách hàng <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 20%" onclick="sortDonHangTable('sanpham')">Sản phẩm <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 15%" onclick="sortDonHangTable('tongtien')">Tổng tiền <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 10%" onclick="sortDonHangTable('ngaygio')">Ngày giờ <i class="fa fa-sort"></i></th>
            <th title="Sắp xếp" style="width: 10%" onclick="sortDonHangTable('trangthai')">Trạng thái<i class="fa fa-sort"></i></th>
        </tr>
        <tr>
            <th title="Sắp xếp" style="width: 7" >1 </th>
            <th title="Sắp xếp" style="width: 13%" >SKJ023</th>
            <th title="Sắp xếp" style="width: 25%" >Huỳnh Văn Kiên </th>
            <th title="Sắp xếp" style="width: 20%" >Ford Focus</th>
            <th title="Sắp xếp" style="width: 15%" >800.000.000 </th>
            <th title="Sắp xếp" style="width: 10%" >01/12/2023</th>
            <th>
              <select name="" id="company">
                      <option value="on">Chưa xử lý</option>
                      <option value="off">Đã xử lý</option>
              </select> 
            </th>
          </tr>
        <tr>
          <th title="Sắp xếp" style="width: 7%" >2 </th>
          <th title="Sắp xếp" style="width: 13%" >GHU010 </th>
          <th title="Sắp xếp" style="width: 25%" >Trần Thị Hà</th>
          <th title="Sắp xếp" style="width: 20%" >Audi R8</th>
          <th title="Sắp xếp" style="width: 15%" >1.000.000.000</th>
          <th title="Sắp xếp" style="width: 10%" >01/12/2023</th>
          <th>
            <select name="" id="company">
                    <option value="on">Chưa xử lý</option>
                    <option value="off">Đã xử lý</option>
                </select>
          </th>
      </tr>
      <tr>
        <th title="Sắp xếp" style="width: 7%" >3 </th>
        <th title="Sắp xếp" style="width: 13%" >RDF503</th>
        <th title="Sắp xếp" style="width: 25%" >Hồ Thanh Ngọc</th>
        <th title="Sắp xếp" style="width: 20%" >BMW Z4 Roadster</th>
        <th title="Sắp xếp" style="width: 15%" >3.500.000.000 </th>
        <th title="Sắp xếp" style="width: 10%" >03/12/2023</th>
        <th>
          <select name="" id="company">
                  <option value="on">Chưa xử lý</option>
                  <option value="off">Đã xử lý</option>
              </select>
        </th>

    </tr>
    <tr>
      <th title="Sắp xếp" style="width: 7%" >4 </th>
      <th title="Sắp xếp" style="width: 13%" >UII101 </th>
      <th title="Sắp xếp" style="width: 25%" >Nguyễn Bá Hùng </th>
      <th title="Sắp xếp" style="width: 20%" >Bentley Continental GTC </th>
      <th title="Sắp xếp" style="width: 15%" >11.000.000.000 </th>
      <th title="Sắp xếp" style="width: 10%" >04/12/2023</th>
      <th>
        <select name="" id="company">
                <option value="on">Chưa xử lý</option>
                <option value="off">Đã xử lý</option>
            </select>
      </th>
    </tr>
    <tr>
      <th title="Sắp xếp" style="width: 7%" >5 </th>
      <th title="Sắp xếp" style="width: 13%" >IND023</th>
      <th title="Sắp xếp" style="width: 25%" >Hồ Văn Bình </th>
      <th title="Sắp xếp" style="width: 20%" >Ford Focus </th>
      <th title="Sắp xếp" style="width: 15%" >800.000.000 </th>
      <th title="Sắp xếp" style="width: 10%" >04/12/2023</th>
      <th>
        <select name="" id="company">
                <option value="on">Chưa xử lý</option>
                <option value="off">Đã xử lý</option>
        </select> 
      </th>
    </tr>
    <tr>
      <th title="Sắp xếp" style="width: 7%" >6 </th>
      <th title="Sắp xếp" style="width: 13%" >LDA233</th>
      <th title="Sắp xếp" style="width: 25%" >Huỳnh Văn Kiên </th>
      <th title="Sắp xếp" style="width: 20%" >Ford Focus </th>
      <th title="Sắp xếp" style="width: 15%" >800.000.000 </th>
      <th title="Sắp xếp" style="width: 10%" >04/12/2023</th>
      <th>
        <select name="" id="company">
                <option value="on">Chưa xử lý</option>
                <option value="off">Đã xử lý</option>
        </select> 
      </th>
    </tr>
    <tr>
      <th title="Sắp xếp" style="width: 7%" >7 </th>
      <th title="Sắp xếp" style="width: 13%" >PDJ001</th>
      <th title="Sắp xếp" style="width: 25%" >Trương Lâm </th>
      <th title="Sắp xếp" style="width: 20%" >Ford Focus </th>
      <th title="Sắp xếp" style="width: 15%" >800.000.000 </th>
      <th title="Sắp xếp" style="width: 10%" >05/12/2023</th>
      <th>
        <select name="" id="company">
                <option value="on">Chưa xử lý</option>
                <option value="off">Đã xử lý</option>
        </select> 
      </th>
    </tr>
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
