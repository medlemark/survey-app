<?php
if (!$this->session->userdata('logged_in')) {
 redirect('/admin/login');
}
?>
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
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Users <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('user/create'); ?>">Create</a></li>
            <li><a href="<?php echo site_url('user'); ?>">List</a></li>
          </ul>
        </li>  
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Survey <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('survey/create'); ?>">Create</a></li>
            <li><a href="<?php echo site_url('survey'); ?>">List</a></li>
           
             
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Rewards <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo site_url('reward/create'); ?>">Create</a></li>
            <li><a href="<?php echo site_url('reward'); ?>">List</a></li>
          </ul>
        </li>        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Response <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
             <li><a href="<?php echo site_url('response'); ?>">List</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo site_url('admin/logout'); ?>">logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<br>
<div class="container">