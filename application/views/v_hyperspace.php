<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>pendekin ? disini aja !</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href=<?php echo base_url()."assets/css/bootstrap/dist/css/bootstrap.css"?>>
		<link rel="stylesheet" href="<?php echo base_url('assets/template/sbadmin/vendor/fontawesome-free/css/all.min.css')?>" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url('assets/template/hyperspace/assets/css/main.css')?>" />
		<noscript><link rel="stylesheet" href="<?php echo base_url('assets/template/hyperspace/assets/css/noscript.css')?>" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
					<nav>
						<ul>
							<li><a href="#intro">Welcome</a></li>
							<!-- <li><a href="#one">Who we are</a></li>
							<li><a href="#two">What we do</a></li>
							<li><a href="#three">Get in touch</a></li> -->
						</ul>
					</nav>
				</div>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>pendekin</h1>
							<p>Just another fine URL shortener site crafted by <a href="http://qopas.in">me, myself, and i.</a><br />
							an open source project, fork at <a href="http://bitbucket">Bitbucket</a>, <a href="http://github">Github</a>, or <a href="http://gitlab">Gitlab</a>.</p>
							<span>Input your original link below:</span>
							<input placeholder="Paste here and magic begins!" class="form-control form-control-md" type="text" name="url" id="url" autofocus value=<?php echo set_value('url') ?> >
							<?php if ( ! $this->session->userdata('success') ) {
								echo '<center><sub><b>This is a URL shortener</b>, copy and paste your original link above, <br>wait, and see the magic begins !</sub></center>';
							} ?>


							<?php
			        // 0 == false
							$success = 'a';
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
					</section>

				<!-- One -->
					<!-- <section id="one" class="wrapper style2 spotlights">
						<section>
							<a href="#" class="image"><img src="<?php echo base_url('assets/template/hyperspace/images/pic01.jpg')?>" alt="" data-position="center center" /></a>
							<div class="content">
								<div class="inner">
									<h2>Sed ipsum dolor</h2>
									<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus.</p>
									<ul class="actions">
										<li><a href="generic.html" class="button">Learn more</a></li>
									</ul>
								</div>
							</div>
						</section>
						<section>
							<a href="#" class="image"><img src="<?php echo base_url('assets/template/hyperspace/images/pic02.jpg')?>" alt="" data-position="top center" /></a>
							<div class="content">
								<div class="inner">
									<h2>Feugiat consequat</h2>
									<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus.</p>
									<ul class="actions">
										<li><a href="generic.html" class="button">Learn more</a></li>
									</ul>
								</div>
							</div>
						</section>
						<section>
							<a href="#" class="image"><img src="<?php echo base_url('assets/template/hyperspace/images/pic03.jpg')?>" alt="" data-position="25% 25%" /></a>
							<div class="content">
								<div class="inner">
									<h2>Ultricies aliquam</h2>
									<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus.</p>
									<ul class="actions">
										<li><a href="generic.html" class="button">Learn more</a></li>
									</ul>
								</div>
							</div>
						</section>
					</section> -->

				<!-- Two -->
					<!-- <section id="two" class="wrapper style3 fade-up">
						<div class="inner">
							<h2>What we do</h2>
							<p>We do nothing till we become something.</p>
							<div class="features">
								<section>
									<span class="icon major fa-code"></span>
									<h3>Lorem ipsum amet</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-lock"></span>
									<h3>Aliquam sed nullam</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-cog"></span>
									<h3>Sed erat ullam corper</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-desktop"></span>
									<h3>Veroeros quis lorem</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-chain"></span>
									<h3>Urna quis bibendum</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
								<section>
									<span class="icon major fa-diamond"></span>
									<h3>Aliquam urna dapibus</h3>
									<p>Phasellus convallis elit id ullam corper amet et pulvinar. Duis aliquam turpis mauris, sed ultricies erat dapibus.</p>
								</section>
							</div>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn more</a></li>
							</ul>
						</div>
					</section> -->

				<!-- Three -->
					<!-- <section id="three" class="wrapper style1 fade-up">
						<div class="inner">
							<h2>Get in touch</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
							<div class="split style1">
								<section>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="name">Name</label>
												<input type="text" name="name" id="name" />
											</div>
											<div class="field half">
												<label for="email">Email</label>
												<input type="text" name="email" id="email" />
											</div>
											<div class="field">
												<label for="message">Message</label>
												<textarea name="message" id="message" rows="5"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><a href="" class="button submit">Send Message</a></li>
										</ul>
									</form>
								</section>
								<section>
									<ul class="contact">
										<li>
											<h3>Address</h3>
											<span>12345 Somewhere Road #654<br />
											Nashville, TN 00000-0000<br />
											USA</span>
										</li>
										<li>
											<h3>Email</h3>
											<a href="#">user@untitled.tld</a>
										</li>
										<li>
											<h3>Phone</h3>
											<span>(000) 000-0000</span>
										</li>
										<li>
											<h3>Social</h3>
											<ul class="icons">
												<li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
												<li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
												<li><a href="#" class="fa-github"><span class="label">GitHub</span></a></li>
												<li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
												<li><a href="#" class="fa-linkedin"><span class="label">LinkedIn</span></a></li>
											</ul>
										</li>
									</ul>
								</section>
							</div>
						</div>
					</section> -->

			</div>

		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						Made with <small><i class="fa fa-heart"></i></small> and hundred of <small><i class="fa fa-coffee"></i></small> by Dio Ilham.
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/jquery.min.js ')?>"></script>
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/jquery.scrollex.min.js ')?>"></script>
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/jquery.scrolly.min.js ')?>"></script>
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/browser.min.js ')?>"></script>
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/breakpoints.min.js ')?>"></script>
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/util.js ')?>"></script>
			<script src="<?php echo base_url('assets/template/hyperspace/assets/js/main.js ')?>"></script>

	</body>
</html>
