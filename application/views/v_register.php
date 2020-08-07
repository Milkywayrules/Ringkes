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

      <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10 col-8">
        <div class="my-4 col-sm-5 col-5 mx-auto">
          <a href="<?php echo base_url() ?>"><img src=<?php echo base_url("assets/img/logo/mainicon-tr-white.png") ?> alt="" width="100%" align='center'></a>
        </div>
        <div class="card o-hidden border-0 shadow-lg my-3">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-12">
                <div class="pb-4 pt-4 px-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an account!</h1>
                  </div>

                  <!-- buka form -->
                  <form class="user" method="post">
                    <!-- 1 -->
                    <div class="form-row mb-3">
                      <div class="col">
                        <input type="text" class="form-control form-control-user <?php if(form_error('username') !== ''){ echo 'is-invalid'; } ?>" id="inputUsername" placeholder="Username" name="username" autofocus>
                        <?php echo form_error('username') ?>
                      </div>
                      <div class="col">
                        <input type="text" class="form-control form-control-user <?php if(form_error('email') !== ''){ echo 'is-invalid'; } ?>" id="inputEmail" placeholder="E-mail" name="email">
                        <?php echo form_error('email') ?>
                      </div>
                    </div>
                    <!-- 2 -->
                    <div class="form-row mb-3">
                      <div class="col">
                        <input type="text" class="form-control form-control-user <?php if(form_error('fullname') !== ''){ echo 'is-invalid'; } ?>" id="inputFullname" placeholder="Full Name" name="fullname">
                        <?php echo form_error('fullname') ?>
                      </div>
                      <div class="col">
                        <input type="number" class="form-control form-control-user <?php if(form_error('phone_number') !== ''){ echo 'is-invalid'; } ?>" id="inputPhoneNumber" placeholder="Phone Number" name="phone_number">
                        <?php echo form_error('phone_number') ?>
                      </div>
                    </div>
                    <!-- 3 -->
                    <div class="form-row mb-3">
                      <div class="col">
                        <input type="password" class="form-control form-control-user <?php if(form_error('password') !== ''){ echo 'is-invalid'; } ?>" id="inputPassword" placeholder="Password" name="password">
                        <?php echo form_error('password') ?>
                      </div>
                      <div class="col">
                        <input type="password" class="form-control form-control-user <?php if(form_error('verPassword') !== ''){ echo 'is-invalid'; } ?>" id="inputVerPassword" placeholder="Repeat Password" name="verPassword">
                        <?php echo form_error('verPassword') ?>
                      </div>
                    </div>
                    <!-- 4 -->
                    <div class="form-group">
                      <div class="form-row mb-3 justify-content-center">
                        <div class="custom-control custom-checkbox form-check form-check-inline">
                          <input type="radio" class="custom-control-input" id="inputGenderM" name="gender" value="M">
                          <label class="custom-control-label" for="inputGenderM">Male</label>
                        </div>
                        <div class="custom-control custom-checkbox form-check form-check-inline">
                          <input type="radio" class="custom-control-input" id="inputGenderF" name="gender" value="F">
                          <label class="custom-control-label" for="inputGenderF">Female</label>
                        </div>
                      </div>
                      <center> <?php echo form_error('gender') ?> </center>
                    </div>
                    <!-- 5 -->
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="submitRegister" value=1>
                      Register Account
                    </button>
                  </form>
                  <!-- tutup form -->

                  <hr>
                  <div class="text-center">
                    <a class="small" href=<?php echo base_url("resetpassword") ?>>Forgot password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href=<?php echo base_url("login") ?>>Already have an account? Login!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div> <!-- end of container (v_header) -->

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
