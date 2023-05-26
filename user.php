<?php include("koneksi.php");
session_start();
if(!isset($_SESSION['user'])){
  header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Sia-BAZNAS | Kab Rembang</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- SweetAlert2 -->
<link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Toastr -->
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Animate style -->
  <link rel="stylesheet" href="plugins/animate/animate.min.css">
  <link rel='shortcut icon' href='baznas.ico'/>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-success navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-teal elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link navbar-success">
      <img src="dist/img/baznas.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3 animated bounce"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SiaBAZNAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
              <?php 
            $username=$_SESSION['user'];
            $q=mysql_query("select * from user where username='$username'");
            while($b=mysql_fetch_array($q)){
            echo "Hallo ".$b['nama']."";
            $k=$q['id_user'];
            }  
            ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">Menu Utama</li>
          <li class="nav-item">
            <a href="?user=beranda" class="nav-link active">
              <img src='dist/img/svg/home.svg' width='25'>
              <p>
                Beranda
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="?user=transaksi" class="nav-link">
              <img src='dist/img/svg/survey.svg' width='25'>
              <p>
                Transaksi
              </p>
            </a>

          </li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <img src='dist/img/svg/print.svg' width='25'>
              <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="?user=gantipassword" class="nav-link">
                  <i class="far fa-circle nav-icon text-teal"></i>
                  <p>Ganti Password</p>
                </a>
              </li>
            </ul>

        <li><a class='btn btn-block' style='background-color:#02948d' href='logout.php'><b><img src="dist/img/svg/cancel.svg" width='30'> Keluar</b></a></li>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sistem Informasi Akuntansi Baznas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button class='btn  btn-flat  bg-purple' ><i class='fa fa-calendar'></i> <?php echo date('D, d M Y')?></button>
              <button class='btn  btn-flat  bg-maroon' ><script type="text/javascript">
    function tampilkanwaktu(){         //fungsi ini akan dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    var waktu = new Date();            //membuat object date berdasarkan waktu saat
    var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
    var sm = waktu.getMinutes() + "";  //memunculkan nilai detik
    var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }
</script>
<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
<span id="clock"></span></button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <?php
        switch($_GET['user']){
      default : include('userberanda.php');break;
      case 'gantipassword' : include('pengguna.php');break;
      case 'transaksi' : include('transaksiuser.php');break;
      case 'lihatd' : include('lihat.php');break;
      case 'transaksisimpan' : include('transaksisimpan.php');break;
      case 'transaksiubah' : include('transaksiubah.php');break;
      case 'transaksihapus' : include('transaksihapus.php');break;
      case 'transaksicetak' : include('cetaktransaksi.php');break;
      
    }
  ?>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.1
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- PAGE SCRIPTS -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
    $('#datepicker').datepicker({
      format: "yyyy-mm-dd",
  autoclose: true
})
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    $('.swalDefaultQuestion').click(function() {
    Toast.fire({
      type: 'question',
      title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
    })
  });
    $('.swalDefaultSuccess').click(function() {
      Toast.fire({
        type: 'success',
        title: 'berhasil Menyimpan.'
      })
      $('.toastrDefaultSuccess').click(function() {
    toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
    });
    });
  });
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
