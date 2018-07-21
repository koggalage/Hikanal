        <div class="col-md-4 " style="background-image: url(<?php echo base_url('assets/img/bbc.png'); ?>); height:6000px; margin-top: -20px">
            <div>
            <img src="<?php echo base_url('assets/img/image2.png'); ?>" alt="" style=" width: 90%; margin-left: 5%; margin-top: 40%"> 
                
            </div>
        </div> 
        <div class="col-md-8 " style="border-radius: 0px; margin-top: 5%">
            <div class="container">
                <?php if (isset($suc_msg)) { ?>
                    <div class="row">
                            <div class="form-group col-md-6 col-md-offset-1">
                                <div class="col-xs-12 alert alert-success fade in">
                                    <!--<div class="form-group"></div>-->
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="ti-close"></i>
                                    </button>
                                    User added Successfully
                                </div>
                            </div>
                    </div>

                <?php } ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-1">
                
                        <h2 align="center">Add User</h2> <br/><br/> <br/><br/>
                        <!-- <form action="" method="post"> -->
                        <?php echo form_open(base_url('index.php/users/registration'), array('class' => 'col-md-12')); ?>

                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required value="">
                              <?php echo form_error('username','<span class="help-block">','</span>'); ?>
                            </div>
                            <div class="form-group">
                              <input type="password" class="form-control" name="passwd" placeholder="Password" required>
                              <?php echo form_error('password','<span class="help-block">','</span>'); ?>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="email" placeholder="Email Address" value="">
                                <?php echo form_error('email','<span class="help-block">','</span>'); ?>
                            </div>
                            <input type="hidden" name="auth_level" value="1">
                            <div class="form-group">
                                <input type="submit" name="regisSubmit" class="btn-primary btn pull-right" value="Submit"/>
                            </div>
                        <!-- </form> -->
                    </div>
                </div>
            </div>
</div>
</body>
</html>