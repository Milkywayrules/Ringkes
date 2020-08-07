<!--  -->


        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $content['subTitle'] ?> </h1>
            <button onclick="excel()" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Excel Report</button>
          </div>

          <!-- Content Row -->
          <!-- <div class="row"> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">URL(s) you have been shortened : <?php echo count($content['totUrl']) ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Original Link</th>
                      <th>Shortened</th>
                      <th>Custom</th>
                      <th>Visited</th>
                      <th>QRcode</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($content['totUrl'] as $key): ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $key->ori_url ?></td>
                      <td><a style='text-decoration:none' target='_blank' href='<?php echo base_url($key->short_url) ?>'>   <?php echo $key->short_url ?>   </a></td>
                      <?php
                        if ( strpos($key->custom_url, 'pndkn_cstm_xx_') == 1 ) {
                          $custom_url = '';
                        }else {
                          $custom_url = $key->custom_url;
                        }
                       ?>
                      <td><a style='text-decoration:none' target='_blank' href='<?php echo base_url($custom_url) ?>'>  <?php echo $custom_url ?>  </a></td>
                      <td><?php echo $key->hit ?></td>
                      <!-- <td class="text-center">
                          <a class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail Pelapor" ><i class="fas fa-fw fa-tachometer-alt"></i></a>
                          <a class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit Pelapor" ><i class="fas fa-fw fa-tachometer-alt"></i></a>
                          <a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Pelapor" >
                              <i class="fa fa-trash"></i>
                          </a>
                      </td> -->
                      <td><a href=<?php echo base_url("tralala/{$key->qrcode}") ?>><img width="120" src=<?php echo base_url("tralala/{$key->qrcode}") ?> alt=<?php echo "qrcode-{$key->short_url}" ?>></a></td>
                      <td>
                        <!-- - - - -->
                        <!-- <div class="input-group-append"> -->
                          <!-- FORM UNTUK EDIT URL (BELOM SELESE)
                          <form class="" method="post">
                            <input type="text" name="edit-url" value=<?php echo $key->short_url ?> hidden>
                            <span><button type="submit" class="btn btn-warning mx-1" name="edit-url-button"><i class="far fa-edit"></i></button></span>
                          </form> -->
                          <!-- FORM UNTUK DELETE URL (BELOM SELESE) -->
                          <form class="" action=<?php echo base_url('u/manage/delete_url') ?> method="post">
                            <input type="text" name="delete_url" value=<?php echo $key->id ?> hidden>
                            <span><input type="submit" class="btn btn-danger mx-3 my-3" onclick="return confirm_delete()" value="&times;"></span>
                          </form>
                        <!-- </div> -->
                      </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- </div> -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<!--  -->

<script type="text/javascript">
  function excel(){
    location.href='<?php echo base_url('report/excel'); ?>';
  }
  function pdf(){
    location.href='<?php echo base_url('report/pdf'); ?>';
  }
  function confirm_delete(){
    var yakin = confirm("You are going to DELETE this data PERMANENTLY, are you sure ?");
    // if (yakin == true) {
    //   window.location.href = 'delete_url';
    // }
    return yakin;
  }
</script>
