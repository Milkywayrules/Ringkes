<div class="row">
  <div class="col-lg-12">
    <div class="block">
      <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" href="#">Edit URL</a>
        </li>
      </ul>

      <div class="tab-pane" id="ubah-kata-sandi" role="tabpanel">
        <div class="row justify-content-center">
          <div class="col-7 col-sm-6 col-md-5 col-lg-6 my-5">
            <form class="validasi-ubah-sandi" method="post">
              <input hidden type="email" name="email" value="<?= '$email';?>">
              <div class="form-group row">
                <label class="col-lg-4 col-form-label" >Original Link</label>
                <div class="col-lg-8">
                  <input type="text" id="ubah-ori_url" class="form-control <?php if(form_error('ubah-ori_url') !== ''){ echo 'is-invalid'; } ?>" name="ubah-ori_url"  value=<?= $ori_url ?> disabled>
                  <div class="form-text text-danger"><?php echo form_error('ubah-ori_url') ?></div>
                </div>
              </div>
               <div class="form-group row">
                <label class="col-lg-4 col-form-label" >Short Code</label>
                <div class="col-lg-8">
                  <input type="text" id="ubah-short_url" class="form-control <?php if(form_error('ubah-short_url') !== ''){ echo 'is-invalid'; } ?>" name="ubah-short_url" value=<?= $short_url ?> disabled>
                  <div class="form-text text-danger"><?php echo form_error('ubah-short_url') ?></div>
                </div>
              </div>
              <?php
                if ( strpos($custom_url, 'pndkn_cstm_xx_') == 1 ) {
                  $custom_url = '';
                }else {
                  $custom_url = $custom_url;
                }
               ?>
              <div class="form-group row">
                <label class="col-lg-4 col-form-label" >Custom Code</label>
                <div class="col-lg-8">
                  <input type="text" id="ubah-custom_url" class="form-control <?php if(form_error('ubah-custom_url') !== ''){ echo 'is-invalid'; } ?>" name="ubah-custom_url" value=<?= $custom_url ?>>
                  <div class="form-text text-danger"><?php echo form_error('ubah-custom_url') ?></div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-4 col-form-label" >Visited</label>
                <div class="col-lg-8">
                  <input type="text" id="ubah-visited" class="form-control" name="ubah-knf" value=<?= $hit ?> disabled>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <center>
                    <label class="col-lg-4 col-form-label" >QRcode</label>
                  </center>
                  <center>
                    <img src=<?php echo base_url('tralala/'.$qrcode) ?> alt=<?= $qrcode ?> width='60%'>
                    <p><?= $qrcode ?></p>
                  </center>
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
