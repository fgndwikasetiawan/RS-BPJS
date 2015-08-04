<html>
<?php
  if (isset($this->session->userdata['logged_in'])) {
    header("location: http://localhost/login/index.php/user_authentication/user_login_process");
  }
?>
<head>
<title>Login Form</title>
<link href="<?php echo assets_url(); ?>/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                </div>
                <div style="padding-top:30px" class="panel-body" >

                    <div style="<?php if(!isset($message_display)) echo "display:none"; ?>" id="login-alert" class="alert <?php if (isset($alert_class)) echo $alert_class; ?> col-sm-12">

                                                                  <?php
                                                                    if (isset($message_display)) {
                                                                      echo "<div class='message'>";
                                                                      echo $message_display;
                                                                      echo "</div>";
                                                                    }
                                                                  ?>

                    </div>

                    <form id="loginform" class="form-horizontal" role="form" method="POST" action="<?php echo base_url(); ?>auth/user_login_process">

                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="name" type="text" class="form-control" name="username" value="" placeholder="username">
                                </div>

                        <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="password">
                                </div>


                            <div style="margin-top:10px" class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                  <input class="btn btn-success" type="submit" value="Login">
                                </div>
                            </div>

                        </form>



                    </div>
                </div>
    </div>

</div>


<?php echo form_close(); ?>

<script src="<?php echo assets_url();?>/js/bootstrap.min.js"></script>
</body>
</html>
