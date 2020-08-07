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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>pendekin? disini aja!</title>
	<link rel="icon" href=<?php echo base_url().'assets/img/register.png' ?>>
	<link rel="stylesheet" href=<?php echo base_url()."assets/css/bootstrap/dist/css/bootstrap.css"?>>
	<link rel="stylesheet" href=<?php echo base_url()."assets/css/monotone/theme2.css"?>>
	<link href="<?php echo base_url('assets/template/sbadmin/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> -->

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
	<style type="text/css">

		::selection { background-color: #E13300; color: white; }
		::-moz-selection { background-color: #E13300; color: white; }

		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		a {
			/* color: #003399; */
			color: #4e4e4e;
			background-color: transparent;
			font-weight: normal;
		}
		a:hover{
			color: #4e4e4e;
			text-decoration: none;
		}

		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f9f9f9;
			border: 1px solid #D0D0D0;
			color: #002166;
			display: block;
			margin: 14px 0 14px 0;
			padding: 12px 10px 12px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			margin: 10px;
			border: 1px solid #D0D0D0;
			box-shadow: 0 0 8px #D0D0D0;
		}

		#uppertitle{
			font-size: 60%;
		}
		#uppertitle2{
			font-size: 80%;
		}

		.center{
			text-align: center;
		}

		#pendekin{
			border:none;
			font-size:70px;
		}
		@media (max-width: 767px) {
			#qopasin{
				font-size: 40px;
			}
		}

		.tooltip {
	    position: relative;
	    display: inline-block;
		}

		.tooltip .tooltiptext {
		    visibility: hidden;
		    width: 140px;
		    background-color: #555;
		    color: #fff;
		    text-align: center;
		    border-radius: 6px;
		    padding: 5px;
		    position: absolute;
		    z-index: 1;
		    bottom: 150%;
		    left: 50%;
		    margin-left: -75px;
		    opacity: 0;
		    transition: opacity 0.3s;
		}

		.tooltip .tooltiptext::after {
		    content: "";
		    position: absolute;
		    top: 100%;
		    left: 50%;
		    margin-left: -5px;
		    border-width: 5px;
		    border-style: solid;
		    border-color: #555 transparent transparent transparent;
		}

		.tooltip:hover .tooltiptext {
		    visibility: visible;
		    opacity: 1;
		}

	</style>
</head>
<body>

	<div id="container">
		<!-- judul pada halaman -->
		<center>
			<h1>
				<div class="row">
					<div class="col-12 text-right">
						<span id="uppertitle">Welcome to <b>pendekin ?</b></span>
						<span id="uppertitle2">V0.0</span>
						<span id="uppertitle">{beta}</span>
					</div>
				</div>
				<div class="input-group-append col-sm-6 mx-auto">
					<!-- <button onclick="return redirect(this.x)" value="next" class="btn btn-outline-success rounded-right btn-md form-control " name="">c</button>
					<button onclick="return redirect(this.x)" value="next" class="btn btn-outline-success btn-sm form-control " name="">c</button>
					<button onclick="return redirect(this.x)" value="next" class="btn btn-outline-success rounded-left btn-md form-control " name="">c</button> -->

					<?php if( ($this->session->privilege <= 4) and ($this->session->login == 1) ){ ?>
					<button onclick="location.href='<?php echo base_url('admin'); ?>';" style="border-color:transparent;"
							class="btn btn-outline-light rounded-right btn-md form-control text-dark" name="profile" value='profile'>Dashboard</button>
					<?php }elseif( ($this->session->privilege >= 5) and ($this->session->login == 1) ) { ?>
					<button onclick="location.href='<?php echo base_url('u/dashboard'); ?>';" style="border-color:transparent;"
							class="btn btn-outline-light rounded-right btn-md form-control text-dark" name="profile" value='profile'>Dashboard</button>
					<?php } ?>

					<button onclick="location.href='<?php echo base_url('pages/about'); ?>';" style="border-color:transparent;"
							class="btn btn-outline-light rounded btn-md form-control text-dark" name="about" value="about">About</button>
					<button onclick="location.href='<?php echo base_url('pages/contact_us'); ?>';" style="border-color:transparent;"
							class="btn btn-outline-light rounded btn-md form-control text-dark" name="contact" value="contact">Contact Us</button>
					<button onclick="location.href='<?php echo base_url('pages/comingsoon') ?>';" style="border-color:transparent;"
							class="btn btn-outline-light rounded-left btn-md form-control text-dark" name="comingsoon" value="comingsoon">Coming soon</button>
				</div>
			</h1>
			<!-- <h1 id="qopasin"><a href="<?php echo base_url() ?>">QOPAS.IN</a></h1> -->
			<h1 id="pendekin">pendekin ?</h1>
			<h5 id="pendekinaja">disini aja !</h5>
			<hr style="width:10%;">
		</center>
		<div id="body">
			<div class="center my-3">
				<!-- form untuk generate link -->
				<div class="row">
					<div class="col-xl-6 col-lg-7 col-sm-9 col-11 mx-auto my-5">
					<form class="" action="<?php echo base_url('') ?>" method="post">
						<div class="input-group mt-3 mb-1">
								<!-- input box -->
								<input class="form-control form-control-md" type="text" name="url" placeholder="Paste here and magic begins!"  autofocus id="url" value=<?php echo set_value('url') ?>>
								<div class="input-group-append">
									<!-- tombol untuk generate link -->
									<button class="btn btn-outline-dark btn-lg " type="submit" name="submit"> <span>Generate !</span> </button>
									<button class="btn btn-outline-danger btn-sm rounded-right" type="reset" name="reset" ><small>Reset?</small></button>
								</div>
						</div>
						<div class="my-1"><small><?php echo form_error('url') ?></small></div>
						<div class="input-group col-10 mt-3">
	            <h5 class="mr-2">Custom url : </h5>
	            <input class="form-control form-control-sm col-2 col-lg-3" type="text" placeholder="<?php echo $base_url[1] ?>" disabled>
	            <input class="form-control form-control-sm col-4 col-lg-6" type="text" name="custom" placeholder="" id="custom" value=<?php echo set_value('custom') ?>>
	          </div>
						<div class="mb-3"><small><?php echo form_error('custom') ?></small></div>
						<?php if ( ! $this->session->userdata('success') ) {
							echo '<small><b>This is a URL shortener</b>, copy and paste your long URL above, <br>wait, and see the magic begins !</small>';
						} ?>
					</form>
					</div>
				</div>
				<!-- jika inputan kosong -->
				<p>	<?php $error = $this->session->flashdata('error');
									if (isset($error)){
									echo $error;
									}
						?>
				</p>
				<?php
        // 0 == false
					if ( isset($success) ) {
						$resTitle = 'Your link is ready !';
						$resOldLink = 'Your old link : ';
						// $a = strpos($custom_url, 'pndkn_cstm_xx_');
						if ( strpos($custom_url, 'pndkn_cstm_xx_') == 1 ) {
							$this->session->set_flashdata('short_url', base_url($short_url));
						}else {
							$this->session->set_flashdata('short_url', base_url($custom_url));
						}
				?>
						<div class="row">
							<div class="col-xl-4 col-lg-5 col-sm-7 col-9 mx-auto">
								<div class="card border-secondary shadow">
									<div class="card-header">
										<div class="mb-2">
											<span><b><?php echo $resTitle ?></b></span>
										</div>
										<div class="input-group-append">
											<input id="myInput" class="form-control" type="text" disabled name="shortUrl" value="<?php echo $this->session->short_url ?>">
										</div>
										<div class="mt-2">
											<span>
												<?php $longUrl = $this->session->flashdata('ori_url');
												echo $resOldLink . $longUrl; ?>
											</span>
										</div>
									</div>
									<div class="card-body">
	                  <a href="<?php echo base_url("tralala/{$this->session->qrcode_img}") ?>"><img class="card-img-top col-sm-12 my-2" src="<?php echo base_url("tralala/{$this->session->qrcode_img}") ?>" alt="Card image cap"></a>
	                  <a download class="btn btn-success btn-sm btn-block mt-3" href="<?php echo base_url("tralala/{$this->session->qrcode_img}") ?>" style="color:#fff"> Save QR-Code ! </a>
	                </div>
								</div>
							</div>
						</div>
						<?php
					}
					$this->session->keep_flashdata('success');
					$this->session->keep_flashdata('ori_url');
					$this->session->keep_flashdata('short_url');
					$this->session->keep_flashdata('custom_url');
					$this->session->keep_flashdata( 'qrcode');
					// $this->session->keep_flashdata('found');

				?>

			</div>
		</div>
		<!-- jika belum login maka tampilkan waktu render dan tombol login -->
		<?php if (!$this->session->userdata('email')): ?>
			<p class="footer" style="border-style:none;">
				<!-- <?php echo "Total URL registered  : {$total_url} - " ?>Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'xdevelopment') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?> -->
			</p>
			<form action="<?php echo base_url('login') ?>" method="post">
					<div class="input-group-addon">
						<p class="footer ">

					<a style="color:white;" class="btn btn-success btn-sm mt-2 mb-2" href="<?php echo base_url('register') ?>">Register</a>
					<a style="color:white;" class="btn btn-warning btn-sm mt-2 mb-2" href="<?php echo base_url('login') ?>" >Login</a>
				</p>
			</div>
			</form>
		<?php endif; ?>
		<!-- jika sudah login maka timbul username dan tombol logout -->
		<?php if ($username = $this->session->userdata('email')): ?>
			<p class="footer" style="border-style:none;">Hi, <strong><?php echo $this->session->userdata('name') ?></strong>, you are logged in as <strong><?php echo $username ?></strong></p>
			<form action="<?php echo base_url('auth/logout') ?>" method="post">
				<p class="footer"><a onclick="return confirm_logout()" class="btn btn-sm btn-outline-warning mt-2 mb-2" href="<?php echo base_url('logout') ?>" >Logout</a></p>
			</form>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col mx-3">
			<small>
				<sup>*</sup> Considering to be an open-source project
			</small>
		</div>
		<div class="col text-right mx-2">
			Made with <small><i class="fa fa-heart"></i></small> and hundred of <small><i class="fa fa-coffee"></i></small> by Dio Ilham.
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNu/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>


</body>
</html>
