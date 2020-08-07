<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <link rel="icon" href=<?php echo $tabIcon ?>>
  <title> <?php echo $tabTitle ?> </title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/template/sbadmin/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/template/sbadmin/css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <!-- Codebase Core JS -->
  <script src=<?php echo base_url('assets/js/plugins/sweetalert2/sweetalert.min.js') ?>></script>
  <!-- click.ly analytics -->
  <script>var clicky_site_ids = clicky_site_ids || []; clicky_site_ids.push(101168316);</script>
  <script async src="//static.getclicky.com/js"></script>

</head>

<body style="min-height:100vh; min-width:100vh;" class="bg-gradient-primary">

  <div class="container py-3">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-4 col-lg-5 col-md-7 col-9">
        <div class="my-4 col-7 mx-auto">
          <a href="<?php echo base_url() ?>"><img src=<?php echo base_url("assets/img/logo/mainicon-tr-white.png") ?> alt="" width="100%" align='center'></a>
        </div>
        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot your password?</h1>
                    <p class="mb-4" style="font-size:0.9em">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                  </div>
                  <form class="user" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="reset-email" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email address" autofocus>
                      <sup><?php echo form_error('reset-email') ?></sup>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Reset Password
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo base_url('login') ?>">Already have an account? Login!</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?php echo base_url('register') ?>">Create an account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

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

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/template/sbadmin/vendor/jquery/jquery.min.js')?>"></script>
  <script src="<?php echo base_url('assets/template/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/template/sbadmin/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/template/sbadmin/js/sb-admin-2.min.js')?>"></script>

</body>

</html>
