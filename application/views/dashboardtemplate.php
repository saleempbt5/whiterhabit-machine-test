<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;   ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo  base_url('Appresources/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  
  <link rel="stylesheet" href="<?php echo  base_url('Appresources/dist/css/adminlte.min.css?ver=1.1'); ?>">
  <?php echo  $_styles ?> 
   <script type="text/javascript">
    var csrf_token_name = '<?php echo $this->security->get_csrf_token_name(); ?>';
     var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
</script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


<?php  echo $topbar;  ?>


  <!-- Main Sidebar Container -->
  <?php  echo $leftsection;  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php echo $contentheader;  ?>
  <?php  echo $content;  ?>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 <a href="">White Rabbit</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo  base_url('Appresources/plugins/jquery/jquery.min.js'); ?>"></script>


<!-- Bootstrap 4 -->
<script src="<?php echo  base_url('Appresources/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo  base_url('Appresources/dist/js/adminlte.js'); ?>"></script>

 <?php echo  $_scripts ?>
</body>
</html>

