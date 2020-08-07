<!--Template Name: simple-looking-404-page
File Name: index.html
Author Name: ThemeVault
Author URI: http://www.themevault.net/
License URI: http://www.themevault.net/license/

Big thanks for them!-->
<?php
	$CI =& get_instance();
	if( ! isset($CI))
	{
	    $CI = new CI_Controller();
	}
	$CI->load->helper('url');

// below here base_url(), site_url() will work
 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Whoopss... | Page Not Found | Ringkes.in</title>
        <link href="<?php echo base_url('assets/img/logo/mainicon.png')?>" rel="icon">

        <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
        <!-- Custom styles for this template -->
        <!-- <link href="css/style.css" rel="stylesheet"> -->
				<style media="screen">
					/*
					Template Name: simple-looking-404-page
					File Name: style.css
					Author Name: ThemeVault
					Author URI: http://www.themevault.net/
					License URI: http://www.themevault.net/license/
					*/

					html {
						margin: 0;
						padding: 0;
					}
					body {
						font-family: 'Lato', sans-serif;
						margin: 0;
						color: #000;
						font-size:100%;
						letter-spacing: 1px;
						background-color: #445252;
					}
					.top{
						background-color: #f7e4c5;
						padding: 10% 0 0;
					}
					.top h1 {
						font-size: 220px;
						font-weight: 900;
						margin: 0;
						text-align: center;
						color:#fd4d42;
						line-height: 175px;
					}
					.bottom{
						background-color: #445252;
						color: #fff;
						margin-top: -5px;
						padding: 5% 0;
						position: relative;
						text-align: center;
					}
					.bottom h2 {
						font-size: 40px;
						font-style: italic;
						letter-spacing: 2px;
						margin: 0;
					}
					.bottom p {
						font-weight: 300;
					}
					.action-btn {
						display: inline-block;
						margin-top: 35px;
					}
					.action-btn a {
						background-color: #fff;
						color: #000;
						padding: 10px 20px;
						text-decoration: none;
						margin-right: 10px;
						box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75);
					}
					.action-btn a:last-child{
						margin-right: 0px;
					}
					.action-btn a:hover {
						background-color: #fd4d42;
						color: #fff;
					}
					.copyright {
						margin-top: 50px;
						font-size: 15px;
					}
					.copyright a{
						color: #fd4d42;
						text-decoration: none;
					}
					.copyright a:hover{
						color: #fff;
					}
					@media (max-width: 991px){
						.top h1 {
								color: #fd4d42;
								font-size: 180px;
								line-height: 148px;
						}
						.bottom h2 {
								font-size: 32px;
						}
						.bottom p, .action-btn a {
								font-size: 14px;
						}
					}
					@media (max-width: 767px){
						.top h1 {
								font-size: 120px;
								line-height: 100px;
						}
						.top {
								padding: 50px 0 0;
						}
						.bottom h2 {
								font-size: 26px;
						}
						.bottom {
								padding: 50px 0;
						}
					}
					@media (max-width: 500px){
						.copyright {
								font-size: 13px;
						}
					}
					@media (max-width: 340px){
						.top{
							padding: 20% 0 0;
						}
						.top h1 {
								font-size: 100px;
								line-height: 80px;
						}
						.bottom h2 {
								font-size: 22px;
						}
						.bottom p{
								font-size: 12px;
						}
					}
				</style>
    </head>
    <body class="content">
        <div class="container">
            <div class="row">
                <div class="top">
                    <h1>404</h1>
                </div>
                <div class="bottom">
                    <h2>Page Not Found:(</h2>
                    <p>Why don't you try one of these pages instead?</p>
                    <div class="action-btn">
                        <a href="<?php echo base_url() ?>">&larr; Back Home</a>
                        <a href="<?php echo base_url('pages/contact-us') ?>">Contact Us</a>
												<a href="<?php echo base_url('pages/comingsoon') ?>">Coming Soon</a>
												<a href="<?php echo base_url('register') ?>">Register</a>
                    </div>
										<div class="copyright text-center my-auto">
					            <span>Copyright &copy; ringkesin 2019-2020</span>
					          </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php echo die(); ?>
