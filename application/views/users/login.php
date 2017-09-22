        <div class="row cont" >
        <div class="col-md-4 " style="background-image: url(<?php echo base_url('assets/img/bbc.png'); ?>); height:6000px; margin-top: -20px">
            <div>
            <img src="<?php echo base_url('assets/img/image2.png'); ?>" alt="" style=" width: 90%; margin-left: 5%; margin-top: 40%"> 
                
            </div>
        </div>        
        <div class="col-md-8 " style="">
            <div class="row">
                
                <div  class="col-md-8 col-md-offset-2" style="border-radius: 10px;  margin-top: 5%" >
                        <h2 align="center">CUSTOMIZED MILITARY MAP PROJECTION FOR SRI LANKA ARMY</h2> <br/><br/>
                        <h3>(BASED ON STANDARD 1:50000 MAPS AND REAL-TIME AERIAL IMAGES)</h3>
                </div>        
            </div>
            <div class="row">
                <div  class="col-md-4 col-md-offset-6" style="border-radius: 0px; margin-top: 15%" >
                    <?php if (!isset($on_hold_message)) { ?>
                        <?php if (isset($login_error_mesg)) { ?>
                            <div class="form-group col-md-10 pull-right" style="border-radius: 0px;">
                                <div class="col-xs-12 alert alert-block alert-danger fade in">
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="ti-close"></i>
                                    </button>
                                    <strong>Login Error!</strong> Invalid Username or Password.
                                </div>
                            </div>

                        <?php } ?>
                        <?php if ($this->input->get('logout')) { ?>
                            <div class="form-group col-md-12">
                                <div class="col-xs-12 alert alert-success fade in">
                                    <!--<div class="form-group"></div>-->
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="ti-close"></i>
                                    </button>
                                    Successfully logged out.
                                </div>
                            </div>

                        <?php } ?>
                        <?php echo form_open($login_url, array('class' => 'col-md-12')); ?>
                        <div class="form-group" style="border-radius: 0px;" >
                            <div class="input-group" style="margin-bottom:1%;">
                                <label for="login_string"> Username&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <span class="input-group-addon for" id="sizing-addon2"><i class="glyphicon glyphicon-user"></i></span>
                                <!-- <span class="input-group-addon for" id="sizing-addon2"><i class="glyphicon glyphicon-user"></i></span> -->
                                <input type="text" name="login_string" class="form-control" placeholder="Username" >
                            </div>
                            <div class="input-group" style="margin-bottom:1%;">
                                <label for="login_pass">Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" name="login_pass" class="form-control" placeholder="Password" >
                            </div>
                            <?php if (config_item('allow_remember_me')) { ?>
                                <div class="check" align="left">
                                    <input type="checkbox" id="check" align="left"/>
                                    <label for="check" name="remember_me" value="yes" align="left">Remember me</label>
                                </div>
                            <?php } ?>
                            <div class="input-group pull-right" style="">
                                <input type="submit" value="&nbsp;&nbsp;Log in&nbsp;&nbsp;" class="form-control btn btn-primary pull-right" style="border-radius:0px;">
                            </div>

                        </div>
                        <?php echo form_close(); ?>
                    <?php } else { ?>

                        <div style="border:1px solid red;">
                            <p>
                                Excessive Login Attempts
                            </p>
                            <p>
                                You have exceeded the maximum number of failed login attempts that allowed.
                            <p>
                            <p>
                                Your access to login and account recovery has been blocked for <?php echo ( (int) config_item('seconds_on_hold') / 60 ) ?> minutes.
                            </p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            </div>
            <div style="height:30%;"></div>
        </div><!-- md-8 -->
</div>
    </body>
</html>