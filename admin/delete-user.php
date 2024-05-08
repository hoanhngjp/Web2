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
            <h1 class="m-0">Khóa người dùng</h1>
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

    <!-- Khách hàng -->
    <div class="khachhang">
        <div class="table-footer">
          <select name="kieuTimKhachHang">
              <option value="ten">Tìm theo ID</option>
              <option value="email">Tìm theo Email</option>
              <option value="taikhoan">Tìm theo Tài khoản</option>
          </select>
          <input type="text" placeholder="Tìm kiếm..." onkeyup="timKiemNguoiDung(this)">
          <button onclick="locDonHangTheoKhoangNgay()"><i class="fa fa-search"></i> Tìm</button>
      </div>
  </div> <!-- // khach hang -->

  <div class="wrap-table">
        <table id="userTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>User ID</th>
            <th>Email</th>
            <th>Họ và Tên</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Trạng thái tài khoản</th>
          </tr>
        </thead>
        <tbody>
            <?php 
              $query_user_records = "SELECT * FROM USER";

              $limit = 10;
              
              $total_records = mysqli_num_rows(mysqli_query($conn,$query_user_records));

              $total_pages = ceil($total_records/ $limit);

              if (!isset($_GET['page'])) {
                $page = 1;
              }
              else {
                $page = $_GET['page'];
              }

              $start = ($page - 1) *$limit;

              $query_user = "SELECT * FROM User Limit $start, $limit";
              $result_query_user = mysqli_query($conn, $query_user);

              $stt = 0;
              if ($result_query_user) {
                while ($row = $result_query_user->fetch_assoc()) {
                  $stt++;
                  echo '<form>  ';
                    echo '<tr>';
                      echo '<td>'. $stt .'</td>';
                      echo '<td>'. $row['user_id'] .'</td>';
                      echo '<input type="hidden" name="user_id" value="'. $row['user_id'] .'">';
                      echo '<td class="editable">';
                        echo '<input type="text" name="user_email"  value="'. $row['user_email'] .'">';
                      echo '</td>';
                      echo '<td class="editable">';
                        echo '<input type="text" name="user_fullname"  value="'. $row['user_fullname'] .'">';
                      echo '</td>';
                      echo '<td>';
                        echo '<select name="user_sex">';
                          if ($row['user_sex'] == "Male") {
                            echo '<option value="Male" selected>Nam</option>';
                            echo '<option value="Female">Nữ</option>';
                          }
                          else {
                            echo '<option value="Male">Nam</option>';
                            echo '<option value="Female" selected>Nữ</option>';
                          }
                        echo '</select>';
                      echo '</td>';
                      echo '<td>';
                        echo '<input type="text" name="user_birthday"  value="'. date("d/m/Y", strtotime($row["user_birthday"])) .'">';
                      echo '</td>';
                      echo '<td>';
                        echo '<select name="user_isActive" >';
                          if ($row['user_isActive'] == 1) {
                            echo '<option value="1" selected>Hoạt động</option>';
                            echo '<option value="0">Khóa</option>';
                          }
                          else {
                            echo '<option value="1">Hoạt động</option>';
                            echo '<option value="0" selected>Khóa</option>';
                          }
                        echo '</select>';
                      echo '</td>';
                    echo '</tr>';
                  echo '</form>';
                }
              }
            ?>
          
        <!-- Add more rows as needed -->
        </tbody>
        </table>
        <div class="pagination">
          <?php if ($page > 1): ?>
              <a href="?page=<?php echo ($page - 1); ?>" class="prev">&laquo; Trang trước</a>
          <?php endif; ?>

          <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" class="<?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
          <?php endfor; ?>

          <?php if ($page < $total_pages): ?>
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
<script src="js/admin.js"></script>
</body>
</html>
