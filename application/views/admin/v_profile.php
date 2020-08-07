<!--  -->
<?php

  $createdAt = $content['user']->created_at;
  $content['user']->created_at = explode(' ', $createdAt);

 ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Personal Profile</h1>
          </div>

          <div class="row justify-content-center">

            <div class="col-lg-10">

              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $content['subTitle'] ?></h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-7 col-sm-5 col-md-4 col-lg-4 col-xl-3 justify-content-center py-3 px-4 ">
                        <!-- <div class="row justify-content-center py-3 px-5"> -->
                          <img src=<?php echo base_url("assets/img/avatar/{$content['user']->avatar}") ?> alt="Avatar" width="100%">
                        <!-- </div> -->
                    </div>
                    <div class="col-10 col-sm-9 col-md-8 col-lg-7 col-xl-5 justify-content-center py-3 px-4 ">
                      <table>
                        <tbody>
                          <tr>
                            <td>Full Name</td>
                            <td width='10%' class="text-center">:</td>
                            <td> <?php echo $content['user']->fullname ?> </td>
                          </tr>
                          <tr>
                            <td>Username</td>
                            <td class="text-center">:</td>
                            <td> <?php echo "@{$content['user']->username}" ?> </td>
                          </tr>
                          <tr>
                            <td>E-mail</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['user']->email ?> </td>
                          </tr>
                          <tr>
                            <td>Phone Number</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['user']->phone_number ?> </td>
                          </tr>
                          <tr>
                            <td>Gender</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['user']->gender ?> </td>
                          </tr>
                          <tr>
                            <td>Tipe Akun</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['user']->privilege ?> </td>
                          </tr>
                          <tr>
                            <td>Active Status</td>
                            <td class="text-center">:</td>
                            <td> <i class="fa fa-<?php echo ($content['user']->is_active==1)?('check'):('times'); ?> mt-2"></i> </td>
                          </tr>
                          <tr>
                            <td>Joined Since</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['user']->created_at[0] ?> </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <hr>
                  <div class="row justify-content-center">
                    <a href=<?php echo base_url("admin/settings/update-profile") ?> class="btn btn-info col-6 mx-1">Edit profile</a>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->
<?php
// echo '<pre>';
// print_r($content['user']);
// die();
 ?>
<!--  -->

<script type="text/javascript">
  function excel(){
    location.href='<?php echo base_url('report/excel'); ?>';
  }
  function pdf(){
    location.href='<?php echo base_url('report/pdf'); ?>';
  }
</script>
