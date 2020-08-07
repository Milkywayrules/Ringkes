<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$success    = $this->session->flashdata('success');
	$ori_url    = $this->session->flashdata('ori_url');
	$short_url  = $this->session->flashdata('short_url');
	$custom_url = $this->session->flashdata('custom_url');
	// $found = $this->session->flashdata('found');

  // ngilangin http sama https dari base_url() buat disabled input custom url
	$base_url = base_url();
	$http  		= strpos($base_url, 'http://');
	$https 		= strpos($base_url, 'https://');
	if ( $http !== FALSE ) {
		$base_url = explode('http://', $base_url);
	}elseif ($https !== TRUE) {
		$base_url = explode('https://', $base_url);
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title> <?php echo $header['tabTitle'] ?> </title>
	<link href="<?php echo $header['tabIcon'] ?>" rel="icon">

	<link href="<?php echo base_url('assets/template/bulma/css/bulma.min.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/template/sbadmin/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
  <!-- Codebase Core JS -->
  <script src=<?php echo base_url('assets/js/plugins/sweetalert2/sweetalert.min.js') ?>></script>

	<!-- click.ly analytics -->
	<script>var clicky_site_ids = clicky_site_ids || []; clicky_site_ids.push(101168316);</script>
	<script async src="//static.getclicky.com/js"></script>

	<script type="text/javascript">
		function confirm_logout(){
			var yakin = confirm("You are going to logout, are you sure ?");
			return yakin;
		}
		function redirect(x) {
			var yakin = confirm(x);
			return yakin;
		}
		function copy_to_cb() {
		  var copyText = document.getElementById("myInput");
		  copyText.select();
		  document.execCommand("copy");

		  var tooltip = document.getElementById("myTooltip");
		  tooltip.innerHTML = "Copied: " + copyText.value;
		}

		function outFunc() {
		  var tooltip = document.getElementById("myTooltip");
		  tooltip.innerHTML = "<i class='fa fa-copy'></i> Copy Link !";
		}
	</script>
</head>

<body>
	<section class="hero is-dark is-fullheight">
		<!-- Hero header: will stick at the top -->
		<!-- hero header : start -->
		<div class="hero-head">
			<header class="navbar">
				<div class="container">
					<!-- navbar brand : start -->
					<div class="navbar-brand column is-2">
						<a class="navbar-item" href="#">
							<img src="<?php echo base_url('assets/img/logo/mainicon-tr-white.png')?>" alt="Main Logo">
						</a>
					</div>
					<!-- navbar brand : end -->
					<!-- navbar menu : start -->
					<div id="navbarMenuHeroC" class="navbar-menu is-active">
						<!-- navbar button left : start -->
						<div class="navbar-start">
							<a class="navbar-item is-active" href="#">
								Home
							</a>
							<a class="navbar-item" href="pages/about">
								About
							</a>
							<a class="navbar-item" href="pages/contact-us">
								Contact us
							</a>
							<a class="navbar-item" href="pages/comingsoon">
								Coming soon
							</a>
						</div>
						<!-- navbar button left : end -->
						<!-- navbar button right : start -->
						<div class="navbar-end">
							<!-- site versioning -->
							<a class="navbar-item" style="font-size:10px;"><?php echo 'dev version: '.SITE_VERSION ?></a>
							<?php
							if ($this->session->isLogin == 1) { ?>
							<a class="navbar-item is-light" href=<?php echo ($this->session->privilege == 'adminUser')?("admin/dashboard"):("u/dashboard"); ?>> <!-- basiuser / adminuser ? -->
								<strong><i class="fa fa-user"></i> <?php echo $this->session->username ?></strong>
							</a>
							<div class="navbar-item">
								<div class="buttons">
									<a class="button is-danger" href="logout" onclick="confirm_logout()">
										Logout
									</a>
								</div>
							</div>
							<?php }else{ ?>
							<div class="navbar-item">
								<div class="buttons">
									<a class="button is-light" href="register">
										<strong>Register</strong>
									</a>
									<a class="button is-dark" href="login">
										<strong>Login</strong>
									</a>
								</div>
							</div>
							<?php } ?>
						</div>
						<!-- navbar button right : end -->
					</div>
					<!-- navbar menu : end -->
				</div>
			</header>
		</div>
		<!-- hero header : end -->

		<!-- Hero content: will be in the middle -->
		<!-- hero content : start -->
		<div class="hero-body">
			<div class="container has-text-centered">
				<h1 class="title">
					Title
				</h1>
				<h2 class="subtitle">
					Subtitle
				</h2>
			</div>
		</div>
		<!-- hero content : end -->

		<!-- Hero footer: will stick at the bottom -->
		<!-- hero footer : start -->
		<div class="hero-foot">
			<nav class="">
				<div class="container has-text-centered">
					<small>Made with <small><i class="fa fa-heart"></small></i> and hundred of <small><i class="fa fa-coffee"></small></i>
					by <a href=<?php echo OWNER_IG_URL ?> target='_blank'><?php echo OWNER_IG ?></a></small>
				</div>
			</nav>
		</div>
		<!-- hero footer : end -->
	</section>

  <?php if ($this->session->userdata('success_message')): ?>
    <script>
    swal({
      title: "<?php echo $this->session->userdata('title'); ?>",
      text: "<?php echo $this->session->userdata('text'); ?>",
      timer: 3000,
      button: false,
      icon: 'success'
    });
    </script>
  <?php endif; ?>
  <?php if ($this->session->userdata('failed_message')): ?>
    <script>
      swal({
         title: "<?php echo $this->session->title; ?>",
         text: "<?php echo $this->session->text; ?>",
         timer: 3000,
         button: false,
         icon: 'error'
      });
    </script>
  <?php endif; ?>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNu/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</body>
</html>
