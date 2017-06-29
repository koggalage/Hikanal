
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h2>User Login</h2>
            <?php
            if(!empty($success_msg)){
                echo '<p class="text-success">'.$success_msg.'</p>';
            }elseif(!empty($error_msg)){
                echo '<p class="text-danger">'.$error_msg.'</p>';
            }
            ?>
            <form action="" method="post">
                <div class="form-group has-feedback">
                    <input type="username" class="form-control" name="username" placeholder="Username" required="" value="">
                    <?php echo form_error('username','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required="">
                  <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="loginSubmit" class="btn-primary btn pull-right" value="Login"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>