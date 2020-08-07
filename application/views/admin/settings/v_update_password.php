<div class="row">
  <div class="col-lg-12">
    <div class="block">
      <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#"><?php echo $content['subTitle'] ?></a>
        </li>
      </ul>

      <div class="tab-pane" id="ubah-kata-sandi" role="tabpanel">
        <div class="row justify-content-center">
          <div class="col-7 col-sm-6 col-md-5 col-lg-6 my-5">
            <!-- start form -->
            <form method="post">
              <div class="form-group row">
                <label class="col-lg-4 col-form-label" >Old Password</label>
                <div class="col-lg-8">
                  <input type="password" id="inputCurrentPw" class="form-control <?php if(form_error('inputCurrentPw') !== ''){ echo 'is-invalid'; } ?>" name="inputCurrentPw" placeholder="Old Password" required>
                  <div class="form-text text-danger">
                    <?php echo form_error('inputCurrentPw') ?>
                    <?php echo $this->session->userdata('currentPwNotMatch') ?>
                  </div>
                </div>
              </div>
               <div class="form-group row">
                <label class="col-lg-4 col-form-label" >New Password</label>
                <div class="col-lg-8">
                  <input type="password" id="inputNewPw" class="form-control <?php if(form_error('inputNewPw') !== ''){ echo 'is-invalid'; } ?>" name="inputNewPw" placeholder="New Password" required>
                  <div class="form-text text-danger"><?php echo form_error('inputNewPw') ?></div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-4 col-form-label" >Repeat New Password</label>
                <div class="col-lg-8">
                  <input type="password" id="inputRepeatNewPw" class="form-control <?php if(form_error('inputRepeatNewPw') !== ''){ echo 'is-invalid'; } ?>" name="inputRepeatNewPw" placeholder="Repeat New Password" required>
                  <div class="form-text text-danger"><?php echo form_error('inputRepeatNewPw') ?></div>
                </div>
              </div>
              <div class="row justify-content-center">
                <a href=<?php echo base_url('admin/settings') ?> class="btn btn-secondary text-black mx-1 col-3">Back</a>
                <button type="submit" class="btn btn-success text-black mx-1 col-3">Update</button>
              </div>
            </form>
            <!-- end form -->
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end -->
<script type="text/javascript">
var url = document.location.toString();
if (url.match('#')) {
  $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
}

// Change hash for page-reload
$('.nav-tabs a').on('shown.bs.tab', function (e) {
  window.location.hash = e.target.hash;
})
</script>
