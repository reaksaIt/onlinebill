<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Billing</title>
	<!-- Style Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">
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
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarTogglerDemo03">
			    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
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
						<a class="nav-link text-light" href="#">Payments</a>
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
			    <div class="my-2 my-lg-0">
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
			</div>
		</div>
	</nav>
	<script type="text/javascript">
		$(document).ready(function(){
			$(function(){
				var activeurl = window.location;
				$('a[href="'+activeurl+'"]').addClass('me-work');

			});
		});
	</script>