<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/navbar.css">
	<!-- Jquery Ui Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/jquery/jquery-ui.min.css">
	<!-- Bootstrap Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap/bootstrap.min.css">
	
	<!-- Sweet Alert -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<!-- Font Awesome CDN-->
	<script src="https://kit.fontawesome.com/ce2616ebdf.js" crossorigin="anonymous"></script>
	<!-- Jquery -->
	<script src="<?php echo base_url()?>public/jquery/jquery.js"></script>
	<!-- Jquery Ui Js -->
	<script src="<?php echo base_url()?>public/jquery/jquery-ui.min.js"></script>
	<!-- Custom Js -->
	<script src="<?php echo base_url()?>public/js/style.js"></script>
	<!-- Bootstrap Js -->
	<script src="<?php echo base_url(); ?>/public/bootstrap/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	
</div>
<div id="mySidenav" class="sidenav bg-dark">
	<div class="navbar-brand">
		<img src="<?php echo base_url()?>public/img/logo-zconnect.png">
	</div>
	<ul class="navbar-nav mr-auto mt-lg-0">
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url(); ?>">Dashboard</a>
    	</li>
    	<li class="nav-item dropdown">
			<a class="nav-link text-light" href="<?php echo base_url(); ?>index.php/viewcontroller/viewcustomer">Customer</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url(); ?>index.php/viewcontroller/viewquote">Quote</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url(); ?>index.php/viewcontroller/viewinvoice">Invoices</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url();?>index.php/viewcontroller/viewpayment">Payments</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url() ?>index.php/viewcontroller/viewproduct">Products</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="#">Inventory</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url() ?>index.php/viewcontroller/viewmonthfee">Monthly Fee</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url() ?>index.php/viewcontroller/viewmonthfee">OT</a>
    	</li>
    	<li class="nav-item">
			<a class="nav-link text-light" href="<?php echo base_url() ?>index.php/viewcontroller/testsidebar">Test Sidebar</a>
    	</li>
    </ul>
</div>

<div id="main" class="main">
	
	<nav class="navbar navbar-expand-lg navbar-expand-md navbar-light  bg-dark pt-0 pb-0">
		<a class="navbar-brand" href="#">
			<div class="brand-logo" id="brand_logo">
				<img src="<?php echo base_url()?>public/img/logo-zconnect.png">
			</div>
		</a>
		<button class="navbar-toggler text-dark" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon">
			</span>
		</button>
		<div class="btn text-light" id="open">
			<span class="fa fa-bars" role="button">
			</span>
		</div>
		<div class="btn text-light" id="close">
			<span class="fa fa-bars" role="button">
			</span>
		</div>
		<div class="collapse navbar-collapse" id="navbarText">
			<div class="navbar-nav mr-auto"></div>
			<span class="navbar-text">
				<div>
					<?php if($this->session->userdata("email")==""){ ?>
					<a href="<?php echo base_url(); ?>index.php/viewcontroller/viewlogin" class="btn text-light"><i class="fas fa-sign-in-alt" title="Login"></i></a>
					<?php } ?>
					<?php if($this->session->userdata('email')): ?>
					<a href="<?php echo base_url() ?>index.php/User/current_login" class="btn text-light"><i class="fas fa-user" title="User"></i></a>
						<?php endif ?>
						<?php if($this->session->userdata("rule")){ ?>
					<a href="<?php echo base_url(); ?>index.php/homecontroller/add_user" class="btn text-light"><i class="fas fa-users" title="All User"></i></a>
					<a href="" class="btn text-light"><i class="fas fa-cog" title="Setting"></i></a>
					<?php } ?>
					<?php if($this->session->userdata('email')): ?>
					<a href="<?php echo base_url() ?>index.php/deletecontroller/logout" class="btn text-light"><i class="fas fa-sign-out-alt" title="Logout"></i></a>
					<?php endif ?>
				</div>
			</span>
		</div>
	</nav>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$(function(){
			var activeurl = window.location;
			$('li a[href="'+activeurl+'"]').addClass('me-work');

		});
	});
</script>