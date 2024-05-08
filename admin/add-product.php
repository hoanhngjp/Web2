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
              <h1 class="m-0">Thêm sản phẩm</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="admin.html">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thêm sản phẩm</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Thông tin sản phẩm</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <form action="./function/process_add_product.php" method="post" enctype="multipart/form-data" onsubmit="convertNewlines()">
                    <div class="form-group">
                      <label for="product_name">Tên sản phẩm</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="form-group">
                      <label for="id_category">Danh mục</label>
                      <select class="form-control" id="id_category" name="id_category">
                        <?php
                        $query_category = "SELECT * FROM Category WHERE category_parent_id != 0";
                        $result_category = mysqli_query($conn, $query_category);

                        if ($result_category && mysqli_num_rows($result_category) > 0) {
                          while ($row = mysqli_fetch_assoc($result_category)) {
                            echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                          }
                        } else {
                          echo '<option value="">Không có danh mục</option>';
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="product_price">Giá tiền</label>
                      <input type="text" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    <div class="form-group">
                      <label for="product_description">Mô tả sản phẩm</label>
                      <textarea class="form-control" id="product_description" name="product_description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="quantity_in_stock">Số lượng trong kho</label>
                      <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock" min="0" required>
                    </div>
                    <div class="form-group">
                      <label for="product_images">Hình ảnh sản phẩm</label>
                      <div id="image_inputs">
                        <div class="image-input">
                        </div>
                      </div>
                      <button type="button" id="add_image_input" class="btn btn-primary mt-2">Thêm ảnh</button>
                    </div>

                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                  </form>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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
    document.addEventListener('DOMContentLoaded', function() {
      var imageInputsContainer = document.getElementById('image_inputs');
      var addImageButton = document.getElementById('add_image_input');

      // Tạo trường input đầu tiên
      createImageInput();

      addImageButton.addEventListener('click', function() {
        // Thêm trường input mới khi nhấn nút "Thêm ảnh"
        createImageInput();
      });

      function createImageInput() {
        var imageInputWrapper = document.createElement('div');
        imageInputWrapper.classList.add('image-input');

        var imageInput = document.createElement('input');
        imageInput.type = 'file';
        imageInput.classList.add('form-control-file');
        imageInput.name = 'product_images[]';
        imageInput.accept = 'image/*';
        imageInput.required = true;

        var previewImageContainer = document.createElement('div');
        previewImageContainer.classList.add('preview-image', 'mt-2');

        imageInputWrapper.appendChild(imageInput);
        imageInputWrapper.appendChild(previewImageContainer);
        imageInputsContainer.appendChild(imageInputWrapper);

        // Xử lý sự kiện change cho trường input mới
        imageInput.addEventListener('change', function(event) {
          var file = event.target.files[0];
          var reader = new FileReader();

          reader.onload = function(event) {
            var previewImage = document.createElement('img');
            previewImage.src = event.target.result;
            previewImage.classList.add('img-thumbnail', 'mr-2', 'mb-2');
            previewImageContainer.innerHTML = '';
            previewImageContainer.appendChild(previewImage);
          };

          reader.readAsDataURL(file);
        });

        // Gọi sự kiện change cho trường input đầu tiên
        imageInput.dispatchEvent(new Event('change'));
      }
    });
  </script>

  <script>
    // Hàm này sẽ thực hiện chuyển đổi ký tự xuống dòng thành ký tự xuống dòng \n
    function convertNewlines() {
      var descriptionTextarea = document.getElementById('product_description');
      var description = descriptionTextarea.value;
      var descriptionWithNewlines = description.replace(/<br>/g, '\n');
      descriptionTextarea.value = descriptionWithNewlines;
    }
  </script>

</body>

</html>