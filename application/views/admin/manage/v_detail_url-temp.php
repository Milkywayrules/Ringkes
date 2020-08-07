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
              <h6 class="m-0 font-weight-bold text-primary">All shortened URL(s) : <?php echo count($content['totUrl']).'URL(s)' ?></h6>
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($content['totUrl'] as $row): ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $row->ori_url ?></td>
                      <td><a style='text-decoration:none' target='_blank' href='<?php echo base_url($row->short_url) ?>'> <?php echo $row->short_url ?> </a></td>
                      <?php
                        if ( strpos($row->custom_url, 'pndkn_cstm_xx_') == 1 ) {
                          $custom_url = '';
                        }else {
                          $custom_url = $row->custom_url;
                        }
                       ?>
                      <td><a style='text-decoration:none' target='_blank' href='<?php echo base_url($custom_url) ?>'> <?php echo $custom_url ?> </a></td>
                      <td><?php echo $row->hit ?></td>
                      <td class="">
                        <a href=<?php echo current_url() . "/detail/{$row->id}" ?> class="btn-sm btn-primary my-1 text-decoration-none">Detail</a>
                        <a href=<?php echo current_url() . "/edit/{$row->id}" ?> class="btn-sm btn-info my-1 text-decoration-none">Ubah</a>
                      </td>
                    </tr>
                    <?php $no++; endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->


<!--  -->

<script type="text/javascript">
  function excel(){
    location.href='<?php echo base_url('report/excel'); ?>';
  }
  function pdf(){
    location.href='<?php echo base_url('report/pdf'); ?>';
  }
</script>
