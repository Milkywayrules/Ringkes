<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

    <title> <?php echo $header['tabTitle'] ?> </title>
    <link rel="icon" href=<?php echo $header['tabIcon'] ?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/bootstrap/dist/css/bootstrap.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/monotone/theme2.css")?>>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="<?php echo base_url('assets/template/sbadmin/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Include the above in your HEAD tag ---------->
    <style media="screen">
      #bg{
        background-color: #FAFAFA;
      }
    </style>
  </head>
  <body id="bg">

    <div class="container">
        <h2 class="text-center mt-5 mb-5">Get in touch with us, <br><b>Easy !</b></h2>
        <!-- <p class="text-center"><small>Not worked yet :(</small></p> -->
    	<div class="row justify-content-center">
    		<div class="col-12 col-md-8 col-lg-6 pb-5">

          <!--Form with header-->
          <form action="<?php echo base_url('mail') ?>" method="post">
              <div class="card border-secondary rounded-0 shadow">
                  <div class="card-header p-0">
                      <div class="bg-success text-white text-center py-2">
                          <div class="text-left">
                            <!-- X SIGN POJOK KANAN ATAS FORM -->
                            <a href="<?php echo base_url() ?>" class="close mr-3" data-dismiss="alert" aria-label="close">&times;</a><br>
                          </div>
                          <h3 class=""><i class="fa fa-envelope"></i> Send a lovely one !</h3>
                          <p class="m-0 mb-4">Your thought is like stars. Priceless.</p>
                      </div>
                  </div>
                  <div class="card-body p-3">

                      <!--Body-->
                      <div class="form-group">
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><label for="fullnameContact"><i class="fa fa-user text-success"></i></label></div>
                              </div>
                              <input type="text" class="form-control text-capitalize" id="fullnameContact" name="fullnameContact" placeholder="Your name here" required>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><label for="emailContact"><i class="fa fa-envelope text-success"></i></label></div>
                              </div>
                              <input type="email" class="form-control" id="emailContact" name="emailContact" placeholder="awesome@yours.com" required>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group mb-2">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><label for="commentContact"><i class="fa fa-comment text-success"></i></label></div>
                              </div>
                              <textarea class="form-control" id="commentContact" name="commentContact" placeholder="I love your website ! Keep it up and have a nice day !" required></textarea>
                          </div>
                      </div>

                      <div class="text-center">
                          <button class="btn btn-success btn-block rounded-1 py-2" type="submit" name="button" style="color:#fff"> <b>Send it !</b> </button>
                      </div>
                  </div>

              </div>
          </form>
          <!--Form with header-->

        </div>
    	</div>
    </div>
  </body>
</html>
