<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Beauty n Dream </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- favicon -->
    <link href="<?php echo base_url(); ?>assets/img/logo.ico" rel="shortcut icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/iCheck/square/blue.css">

    <!-- SWEET ALERT -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.min.css"; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.css"; ?>">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div style="width: 360px;padding-bottom:50px;margin:0 auto">
		<div style="text-align: center;">
			<img src="<?php echo base_url()?>/assets/css/newlogo.png" height="250" width="250" alt="wa">
		</div>
        <div class="login-box-body" style="border-radius: 15px;">
            <form action="<?php echo base_url('auth/login'); ?>" method="POST">
                <div class="form-group has-feedback">
                    <!--<input type="email" class="" placeholder="Email"> -->
                    <input type="text" name="username" class="form-control" placeholder="Nama User" id="active" autocomplete="off">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Kata Sandi" autocomplete="off">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Masuk">
                    </div>
                    <!-- /.col -->
                </div>

				<table style="margin-top:15px;width:100%">
					<tr>
						<td style="width:25%;padding-right:5px;text-align:right">
							<a class="link-wa" href="https://wa.me/6289513155559" target="_blank" rel="noopener noreferrer" >
								<img src="<?php echo base_url()?>/assets/css/loginwa.png" height="50" width="50" alt="wa">
							</a>
						</td>
						<td style="width:75%;font-weight:bold;font-size:20px">
							<a style="color:#333" href="https://wa.me/6289513155559" target="_blank" rel="noopener noreferrer" >
								BOOKING APPOINTMENT
							</a>
						</td>
					</tr>
				</table>

				<div style="margin-top:15px;text-align:center;border-radius:15px;">
					<video style="width:320px;height:320px;border-radius:15px" loop="true" autoplay="autoplay" controls>
						<source src="<?php echo base_url()?>/assets/css/video.mp4" type="video/mp4">
					</video>
				</div>
					
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- SWEET ALERT -->
    <script src="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.min.js"; ?>"></script>
    <script src="<?php echo base_url()."assets/vendor/sweet-alert2/sweetalert2.js"; ?>"></script>

    <!-- jQuery 3 -->
    <script src="<?php echo base_url()."assets/"; ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url()."assets/"; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url()."assets/"; ?>plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
    </script>
</body>

</html>
