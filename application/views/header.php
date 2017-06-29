<!DOCTYPE html>
<html lang="en">  
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script src="<?php echo base_url("assets/js/html2canvas.js"); ?>" ></script>
	<script src="<?php echo base_url("assets/js/download.min.js"); ?>" ></script>
	<script src="<?php echo base_url("assets/js/canvas2image.js"); ?>" ></script>
	<script src="<?php echo base_url("assets/js/base64.js"); ?>" ></script>

<!--     <script src="html2canvas.js"></script>
    <script src="download.min.js"></script>
    <script src="canvas2image.js"></script>
    <script src="base64.js"></script> -->
    <style>

body {
    margin :0;
    overflow: hidden;
}

#overlayLoading {
    opacity: 0.7;
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    top: 0;
    z-index: 3000;
    background: #000000;
}

.actions {
    position: absolute;
    right: 20px;
    bottom: 20px;
    z-index: 2000;
    padding: 25px;
}

#map-canvas {
    height: calc(100vh - 90px);
    width: 100%;
    margin: 0px;
    padding: 0px;
}

#map-canvas2 {
    height: 2750px;
    width: 4400px;
    position: relative;
}

#map-canvas2-wrapper {
    height: calc(100vh - 90px);
    width: 100%;
    overflow: scroll;
}

#ballsWaveG{
    position:relative;
    width:224px;
    height:53px;
    margin:auto;
    top: 50%;
}

.spinner {
  margin: -40px auto;
  width: 100px;
  height: 80px;
  text-align: center;
  font-size: 10px;
  top: 50%;
  position: relative;
}

.spinner > div {
  background-color: #fff;
  height: 100%;
  width: 15px;
  display: inline-block;
  
  -webkit-animation: sk-stretchdelay 1.2s infinite ease-in-out;
  animation: sk-stretchdelay 1.2s infinite ease-in-out;
}

.spinner .rect2 {
  -webkit-animation-delay: -1.1s;
  animation-delay: -1.1s;
}

.spinner .rect3 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

.spinner .rect4 {
  -webkit-animation-delay: -0.9s;
  animation-delay: -0.9s;
}

.spinner .rect5 {
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}

@-webkit-keyframes sk-stretchdelay {
  0%, 40%, 100% { -webkit-transform: scaleY(0.4) }  
  20% { -webkit-transform: scaleY(1.0) }
}

@keyframes sk-stretchdelay {
  0%, 40%, 100% { 
    transform: scaleY(0.4);
    -webkit-transform: scaleY(0.4);
  }  20% { 
    transform: scaleY(1.0);
    -webkit-transform: scaleY(1.0);
  }
}

</style>
</head>


<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
        <?php if ($this->session->userdata('isUserLoggedIn')) :?>
            <div class="navbar-header"><a href="#" class="navbar-brand"><?php echo isset($current_user)?"Welcome ".$current_user->name:""; ?></a></div>
	            <ul class="navbar-nav nav navbar-right">
	                <li><a href="<?php echo base_url('index.php/map/view'); ?>">Map</a></li>
	                <li><a href="<?php echo base_url('index.php/users/registration'); ?>">Add Users</a></li>
	                <li><a href="<?php echo base_url('index.php/users/logout'); ?>">Logout</a></li>
	                <!-- <li><a href="">ere</a></li> -->
	            </ul>
        	</div>
        <?php endif; ?>
    </nav>