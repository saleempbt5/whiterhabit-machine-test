<div class="card-body login-card-body">
      

      <p class="login-box-msg">Sign in to start your session</p>
      <?php if($status_msg != ""){ ?> 

        <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <strong><?php echo $status_msg ?></strong> 
                
                </div>


<?php } ?>

<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'signinform', 'novalidate' => 'novalidate');
  echo form_open('',$attributes) ?>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="userid" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="userpassword" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <?php echo form_close() ?>
    </div>