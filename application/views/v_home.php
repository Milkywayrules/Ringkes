<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	$success    = $this->session->flashdata('success');
	$ori_url    = $this->session->flashdata('ori_url');
	$short_url  = $this->session->flashdata('short_url');
	$custom_url = $this->session->flashdata('custom_url');
	// $found = $this->session->flashdata('found');

  // ngilangin http sama https dari base_url() buat disabled input custom url
	$base_url = base_url();
	$http  = strpos($base_url, 'http://');
	$https = strpos($base_url, 'https://');
	if ( $http !== FALSE ) {
		$base_url = explode('http://', $base_url);
	}elseif ($https !== TRUE) {
		$base_url = explode('https://', $base_url);
	}

?>


<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<title>RINGKESIN - Lebih singkat lebih hebat!</title>
		<link rel="icon" href=<?php echo base_url().'assets/img/register.png' ?>>
		<link rel="stylesheet" href=<?php echo base_url()."assets/css/bootstrap/dist/css/bootstrap.css"?>>
		<link rel="stylesheet" href=<?php echo base_url()."assets/css/monotone/theme2.css"?>>
		<link rel="stylesheet" href="<?php echo base_url('assets/template/sbadmin/vendor/fontawesome-free/css/all.min.css')?>">
		<link rel="stylesheet" href=<?php echo base_url()."assets/template/eventually/css/main.css"?> />
		<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> -->
		<!-- sweetalert -->
		<script src=<?php echo base_url('assets/js/plugins/sweetalert2/sweetalert.min.js') ?>></script>

		<!-- click.ly analytics -->
		<script>var clicky_site_ids = clicky_site_ids || []; clicky_site_ids.push(101168316);</script>
		<script async src="//static.getclicky.com/js"></script>
		<!-- <link rel="stylesheet" href="assets/css/monotone/theme.min.css"> -->
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
	<body class="is-preload">
		<!-- Header -->
		<!-- Login Logout Button -->
		<!-- SUDAH LOGIN -->
		<?php
		if ($this->session->userdata('login') == 1) {
			?>
			<div style="text-align:right;">
				<a style="color:white;" href="<?php echo base_url('u/dashboard') ?>">
					<button class="btn-sm" style="background-color:#858796;"><i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i> Dashboard </button>
				</a>
				<a style="color:white;" href="<?php echo base_url('logout') ?>" data-toggle="modal" data-target="#logoutModal">
					<button class="btn-sm btn-danger"> Logout <i class="fas fa-sign-out-alt fa-sm fa-fw ml-2 text-gray-400"></i></button>
				</a>
			</div>
		<!-- BELUM LOGIN -->
			<?php
		}else {
			?>
			<div style="text-align:right;">
				<a style="background-color:black;color:white;" href="<?php echo base_url('login') ?>" data-toggle="modal" data-target="#loginModal">
					<button class="btn-sm" style="background-color:black;"> Login <i class="fas fa-sign-out-alt fa-sm fa-fw ml-2 text-gray-400"></i></button>
				</a>
			</div>
			<?php
		}
		?>

<!-- ========================================================= START HOME ========================================================= -->
		<header id="header">
			<h1>R I N G K E S I N</h1>
			<p>Lebih singkat lebih hebat!
				<br/>
				Copy dan paste link kamu dibawah :) Brought to you by <a href="https://instagram.com/dioilham">Me Myself and I</a>.</p>
			</header>

			<!-- URL Form -->
			<form id="signup-form" action="<?php echo base_url('') ?>" method="post">
				<input class="form-control form-control-md" type="text" name="url" placeholder="Try it here!" autofocus id="url" value=<?php echo set_value('url') ?>>
				<button type="reset" 	name="reset" style="margin:auto 0.2em; margin-left:1em;" class="btn-danger"> <span>Reset</span> </button>
				<button type="submit" name="submit" style="margin:auto 0.2em;" class=""> <span>Ringkesin !</span> </button>
				<div class="my-1"><small><?php echo form_error('url') ?></small></div>
			</form>
			<br>

			<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<!-- <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li> -->
					<li><a href="https://instagram.com/dioilham" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="http://sabar.lom.dimasukin.nanti.dulu.ya" class="icon fa-github"><span class="label">GitHub</span></a></li>
					<li><a href="http://linkedin.com/in/dioilham" class="icon fa-linkedin"><span class="label">Linkedin</span></a></li>
					<li><a href="mailto:dioilham123456@gmail.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; RINGKES.IN 2020.</li><li>Credits: <a href="https://instagram.com/dioilham">Me Myself and I</a></li>
				</ul>
			</footer>
<!-- ========================================================= END HOME ========================================================= -->
<!-- ========================================================= START MODAL ========================================================= -->
			<!-- Logout Modal-->
			<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLabel" style="color:#858796;">Ready to Leave?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body" style="color:#858796;">Select "Logout" below if you are ready to end your current session.</div>
						<div class="modal-footer">
							<button class="btn-secondary" type="button" data-dismiss="modal">Cancel</button>
							<button class="btn-danger" type="button" onclick="location.href='<?php echo base_url('logout') ?>';">Logout</button>
						</div>
					</div>
				</div>
			</div>
			<!-- End logout modal -->
			<!-- Login Modal-->
			<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLabel" style="color:#858796;">Login</h5>
							<button class="btn-sm close" type="button" data-dismiss="modal" aria-label="Close" style="background-color:black">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body" style="color:#858796;">
							<!-- BUKA FORM -->
							<?php echo form_open('login', 'class="user"'); ?>
							<div class="form-group">
								<label for="InputEmailUsername"><span style="color:#858796">Username / e-mail</span></label>
								<input name="emailUsername" type="text" class="form-control form-control-user" id="InputEmailUsername" placeholder="E-Mail / Username" required autofocus style="border-color:#858796;">
								<sup><?php echo form_error('emailUsername') ?></sup>
							</div>
							<div class="form-group">
								<label for="InputPassword"><span style="color:#858796">Password</span></label>
								<input name="password" type="password" class="form-control form-control-user" id="InputPassword" placeholder="Password" required style="border-color:#858796;">
								<sup><?php echo form_error('password') ?></sup>
							</div>
							<input type="text" name="loginDariHome" value="1" hidden>
							<input type="submit" value="Login" class="btn btn-primary btn-user btn-block">
							<!-- <hr>
							<div class="g-signin2 d-flex justify-content-center" data-onsuccess="onSignIn" data-theme="dark"></div>
							<a href="index.html" class="btn btn-facebook btn-user btn-block">
							<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
							</a> -->
							</form>
							<!-- TUTUP FORM -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Login modal -->
<!-- ========================================================= END MODAL ========================================================= -->

		  <!-- sweetalert modal notification -->
		  <?php if ($this->session->userdata('success_message')): ?>
		    <script>
		    swal({
		      title: "<?php echo $this->session->title; ?>",
		      text: "<?php echo $this->session->text; ?>",
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
		  <!-- sweetalert end -->

			<!-- Scripts -->
			<script src=<?php echo base_url()."assets/template/eventually/js/main.js"?>></script>
			<!-- Bootstrap core JavaScript-->
			<script src="<?php echo base_url('assets/template/sbadmin/vendor/jquery/jquery.min.js')?>"></script>
			<script src="<?php echo base_url('assets/template/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNu/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	</body>
</html>
