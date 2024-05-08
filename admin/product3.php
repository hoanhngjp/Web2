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
  <link rel="stylesheet" href="./css/changeProductInfo.css?v=<?php echo time(); ?>">

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
              <h1 class="m-0">Xóa sản phẩm</h1>
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

      <div class="khachhang">
        <div class="table-footer">
          <select id="kieuTimSanPham" name="kieuTimSanPham">
            <option value="product_id">Tìm theo Mã</option>
            <option value="product_name">Tìm theo Tên</option>
          </select>
          <input id="tukhoa" type="text" placeholder="Tìm kiếm..." onkeyup="timKiemSanPham(this)">
          <button onclick="timKiemSanPham()"><i class="fa fa-search"></i> Tìm</button>
        </div>
      </div>

      <!-- Sản Phẩm -->
      <div class="wrap-table" id="resultProduct">
        <table id="userTable">
          <thead>
            <tr>
              <th>Product ID</th>
              <th>Tên sản phẩm</th>
              <th>Giá sản phẩm</th>
              <th>Mô tả sản phẩm</th>
              <th>Số lượng trong kho</th>
              <th>Trạng thái bán</th>
              <th>Hình ảnh sản phẩm</th>
              <th>Xóa sản phẩm</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query_product_records = "SELECT * FROM Product";

            $limit = 10;

            $total_records = mysqli_num_rows(mysqli_query($conn, $query_product_records));

            $total_pages = ceil($total_records / $limit);

            if (!isset($_GET['page'])) {
              $page = 1;
            } else {
              $page = $_GET['page'];
            }

            $start = ($page - 1) * $limit;

            $query_product = "SELECT * FROM Product Limit $start, $limit";
            $result_query_product = mysqli_query($conn, $query_product);

            if ($result_query_product) {
              while ($row = $result_query_product->fetch_assoc()) {
                echo '<form action="./function/delete-product.php" method="POST" onsubmit="return confirmDelete()">';
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
                  echo 'Đang bán';
                } else {
                  echo 'Đã ẩn';
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
                echo '<button class="sign-in-btn" type="submit" value="">Xóa sản phẩm</button>';
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
    <script src="js/admin.js"></script>
    <script>
      function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?");
      }
    </script>
    <script>
      function timKiemSanPham() {
        var tuKhoa = document.getElementById("tukhoa").value;
        var kieuTimSanPham = document.getElementById("kieuTimSanPham").value;

        // Gửi dữ liệu tìm kiếm lên máy chủ bằng Ajax
        $.ajax({
          type: "POST",
          url: "./function/timkiemxoasanpham.php", // Thay đổi đường dẫn đến tập tin PHP xử lý tìm kiếm
          data: {
            tuKhoa: tuKhoa,
            kieuTimSanPham: kieuTimSanPham
          },
          success: function(response) {
            // Hiển thị kết quả tìm kiếm trả về từ máy chủ
            $("#resultProduct").html(response);
          }
        });
      }
    </script>
</body>

</html>