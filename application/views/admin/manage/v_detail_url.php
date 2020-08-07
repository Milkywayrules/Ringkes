<!--  -->
<?php

  $createdAt = $content['rowData']->created_at;
  $content['rowData']->created_at = explode(' ', $createdAt);

  // ngilangin http sama https dari base_url()
  $base_url = base_url();
  $http  = strpos($base_url, 'http://');
  $https = strpos($base_url, 'https://');
  if ( $http !== FALSE ) {
    $protocol = explode('http://', $base_url);
  }elseif ($https !== TRUE) {
    $protocol = explode('https://', $base_url);
  }

 ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"> <?php echo $content['subTitle'] ?></h1>
          </div>

          <div class="row justify-content-center">

            <div class="col-lg-10">

              <!-- Dropdown Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $content['cardTitle'] ?></h6>
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
                      <img src=<?php echo base_url("tralala/{$content['rowData']->qrcode}") ?> alt="QR Code" width="100%">
                    </div>
                    <div class="col-12 col-sm-12 col-md-11 col-lg-12 col-xl-10 justify-content-center py-3 px-4 ">
                      <table>
                        <tbody>
                          <tr>
                            <td width='110px'>Created By</td>
                            <td width='5%' class="text-center">:</td>
                            <td> <?php echo "@{$content['rowData']->created_by}" ?> </td>
                          </tr>
                          <tr>
                            <td>Original link</td>
                            <td class="text-center">:</td>
                            <td>
                              <a href=<?php echo $content['rowData']->ori_url ?>>
                                <?php echo $content['rowData']->ori_url ?>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Short link</td>
                            <td class="text-center">:</td>
                            <td>
                              <a href=<?php echo base_url($content['rowData']->short_url) ?>>
                                <?php echo $protocol[1].$content['rowData']->short_url  ?>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Custom link</td>
                            <td class="text-center">:</td>
                            <td> <?php
                              $custom_url = $protocol[1].$content['rowData']->custom_url;
                              ?>
                              <a href=<?php echo base_url().($content['rowData']->custom_url != 'ringkesin_custom_blank') ?: ($custom_url); ?>>
                                <?php echo base_url().($content['rowData']->custom_url != 'ringkesin_custom_blank') ?: ($custom_url); ?>
                              </a>
                            </td>
                          </tr>
                          <tr>
                            <td>Total visited</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['rowData']->hit ?> </td>
                          </tr>
                          <tr>
                            <td>Created at</td>
                            <td class="text-center">:</td>
                            <td> <?php echo $content['rowData']->created_at[1].' '.$content['rowData']->created_at[0] ?> </td>
                          </tr>
                          <tr>
                            <td>Active Status</td>
                            <td class="text-center">:</td>
                            <td> <i class="fa fa-<?php echo ($content['rowData']->is_active==1)?('check'):('times'); ?> mt-2"></i> </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <hr>
                  <div class="row justify-content-center">
                    <a href=<?php echo base_url("admin/manage/url") ?> class="btn btn-info col-4 mx-1">Back</a>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->
<?php
// echo '<pre>';
// print_r($content['rowData']);
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
