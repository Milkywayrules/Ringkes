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
              <h6 class="m-0 font-weight-bold text-primary">All registered user(s) : <?php echo count($content['totAccount']).' user(s)' ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Full Name</th>
                      <th>Username</th>
                      <th>E-Mail</th>
                      <th>Phone Number</th>
                      <th>Gender</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Full Name</th>
                      <th>Username</th>
                      <th>E-Mail</th>
                      <th>Phone Number</th>
                      <th>Gender</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($content['totAccount'] as $key): ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $key->fullname ?></td>
                      <td><?php echo $key->username ?></td>
                      <td><a style='text-decoration:none' href='<?php echo "mailto:{$key->email}" ?>'>  <?php echo $key->email ?>  </a></td>
                      <td><?php echo $key->phone_number ?></td>
                      <td><?php echo $key->gender ?></td>
                      <td><?php echo $key->is_active ?></td>
                      <td>- - -</td>
                      <!-- <td class="text-center">
                          <a class="btn btn-sm btn-info" data-toggle="tooltip" title="Detail Pelapor" ><i class="fas fa-fw fa-tachometer-alt"></i></a>
                          <a class="btn btn-sm btn-success" data-toggle="tooltip" title="Edit Pelapor" ><i class="fas fa-fw fa-tachometer-alt"></i></a>
                          <a class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus Pelapor" >
                              <i class="fa fa-trash"></i>
                          </a>
                      </td> -->
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


<!--  -->

<script type="text/javascript">
  function excel(){
    location.href='<?php echo base_url('report/excel'); ?>';
  }
  function pdf(){
    location.href='<?php echo base_url('report/pdf'); ?>';
  }
</script>
