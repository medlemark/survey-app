<!DOCTYPE html>
<html>
<head>
	<title>Survey App</title>
	<meta charset=utf-8>
	<meta name=description content="">
	<meta name=viewport content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/bootstrap.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/custom.css'); ?>">
  <script src="<?php echo site_url('assets/js/jquery.min.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtuRsGv9g6__ksTk-EVG4_z7G53wBLYT8&libraries=places"></script>

	<script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo site_url('assets/js/script.js'); ?>" type="text/javascript" charset="utf-8"></script>
</head>
<body>
 <nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url('/'); ?>">Rewarding Surveys</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       
      
      
    </div>
  </div>
</nav>
<br>
<br>
<br>
<div class="container">
  <div class="col-sm-offset-3 col-sm-6">
  <form action="" method="POST" role="form">
    <?php if(validation_errors()){ ?>
    <div class="alert alert-warning alert-dismissable">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo validation_errors(); ?>
    </div>
    <?php } ?>
    
    <legend>Welcome To RewardingSurveys</legend>
  
    <div class="form-group">
      <label for="">USERNAME</label>
      <input type="text" class="form-control" name="username" placeholder="TYPE USERNAME">
    </div> 
    <div class="form-group">
      <label for="">PASSWORD</label>
      <input type="password" class="form-control" name="password" placeholder="TYPE PASSWORD">
    </div>
  
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
</div>