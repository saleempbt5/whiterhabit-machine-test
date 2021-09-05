
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
    <meta name="description" content="IDE Pvt Ltd : Data Entry Opearation">
    <meta name="keywords" content="IDE Pvt Ltd ">
    <meta name="author" content="ioss">
    <title><?php  echo $title;  ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="<?php echo  base_url('Appresources/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo  base_url('Appresources/dist/css/adminlte.min.css'); ?>">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
  <?php  echo $content;  ?>
 
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo  base_url('Appresources/plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo  base_url('Appresources/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo  base_url('Appresources/dist/js/adminlte.min.js'); ?>"></script>

</body>
</html>

