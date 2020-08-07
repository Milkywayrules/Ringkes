  <div class="row">
    <div class="col-lg-12">
      <div class="block">
        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" href="#">Change Password</a>
          </li>
        </ul>

        <div class="tab-pane" id="ubah-kata-sandi" role="tabpanel">
          <div class="row justify-content-center">
            <div class="col-7 col-sm-6 col-md-5 col-lg-6 my-5">
              <form class="validasi-ubah-sandi" method="post">
                <input hidden type="email" name="email" value="<?= '$email';?>">
                <div class="form-group row">
                  <label class="col-lg-4 col-form-label" >Old Password</label>
                  <div class="col-lg-8">
                    <input type="password" id="ubah-lama" class="form-control <?php if(form_error('ubah-lama') !== ''){ echo 'is-invalid'; } ?>" name="ubah-lama"  placeholder="Old Password" disabled>
                    <div class="form-text text-danger"><?php echo form_error('ubah-lama') ?></div>
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="col-lg-4 col-form-label" >New Password</label>
                  <div class="col-lg-8">
                    <input type="password" id="ubah-baru" class="form-control <?php if(form_error('ubah-baru') !== ''){ echo 'is-invalid'; } ?>" name="ubah-baru" placeholder="New Password" disabled>
                    <div class="form-text text-danger"><?php echo form_error('ubah-baru') ?></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-lg-4 col-form-label" >Repeat New Password</label>
                  <div class="col-lg-8">
                    <input type="password" id="ubah-knf" class="form-control <?php if(form_error('ubah-knf') !== ''){ echo 'is-invalid'; } ?>" name="ubah-knf" placeholder="Repeat New Password" disabled>
                    <div class="form-text text-danger"><?php echo form_error('ubah-knf') ?></div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-lg-12">
                    <button type="submit" class="btn btn-success text-black btn-lg btn-block" disabled>Save Changes</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
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
