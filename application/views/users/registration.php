        <div class="col-md-4 " style="background-image: url(<?php echo base_url('assets/img/bbc.png'); ?>); height:6000px; margin-top: -20px">
            <div>
            <img src="<?php echo base_url('assets/img/image2.png'); ?>" alt="" style=" width: 90%; margin-left: 5%; margin-top: 40%"> 
                
            </div>
        </div> 
        <div class="col-md-8 " style="border-radius: 0px; margin-top: 5%">
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
    
            <h2>Add User</h2> <br/><br/> <br/><br/>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name" required value="<?php echo !empty($user['name'])?$user['name']:''; ?>">
                  <?php echo form_error('name','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username" required value="<?php echo !empty($user['username'])?$user['username']:''; ?>">
                  <?php echo form_error('username','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="contact_no" placeholder="Contact Number" value="<?php echo !empty($user['contact_no'])?$user['contact_no']:''; ?>">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                  <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="conf_password" placeholder="Confirm password" required>
                  <?php echo form_error('conf_password','<span class="help-block">','</span>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="regisSubmit" class="btn-primary btn pull-right" value="Submit"/>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>