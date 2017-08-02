<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="ThemeBucket" name="author">
    <link type="image/png" href="#" rel="shortcut icon">

    <title>Login</title>
    <link rel="shortcut icon" type="image/ico" href="<?php echo IMAGE_URL; ?>favicon.ico"/>
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>style.css">
    <link rel="stylesheet" href="<?php echo CSS_URL; ?>style-responsive.css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-body" s6116190883828193888="1" jhjlijpomuhn_9="1">
	<?php if($this->session->flashdata('invalidMsg')!=''){ ?>
		<div class="alert alert-danger" id="edit_succ" data-es="Aquï¿½ se muestra el resultado del evento">
			<?php  echo '   <h6>'.$this->session->flashdata('invalidMsg').'</h6>'; ?>
		</div> 
	<?php } ?>
	<?php if($this->session->flashdata('plzloginMsg')!=''){ ?>
		<div class="alert alert-success" id="edit_succ" data-es="Aquï¿½ se muestra el resultado del evento">
			<?php  echo '   <h6>'.$this->session->flashdata('plzloginMsg').'</h6>'; ?>
		</div> 
	<?php } ?>
	<?php if($this->session->flashdata('noEmailFoundMsg')!=''){ ?>
		<div class="alert alert-danger" id="edit_succ" data-es="Aquï¿½ se muestra el resultado del evento">
			<?php  echo '   <h6>'.$this->session->flashdata('noEmailFoundMsg').'</h6>'; ?>
		</div> 
	<?php } ?>
                    
	<?php if($this->session->flashdata('maillSucc')!=''){ ?>
		<div class="alert alert-success" id="edit_succ" data-es="Aquï¿½ se muestra el resultado del evento">
			<?php  echo '   <h6>'.$this->session->flashdata('maillSucc').'</h6>'; ?>
		</div> 
	<?php } ?>
	
	<div class="container">
		<form id="signinForm" role="form" class="form-signin" method="post" action="<?php echo base_url().'account/logcheck';?>">
			<div class="form-signin-heading text-center">
				<h1 class="sign-title">Sign In</h1>
                <!--                <h3>--><?php //echo SITE_TITLE;?><!--</h3>-->

                <div class="logo">
                    <a href="<?php echo base_url(); ?>"><img src="<?php echo IMAGE_URL; ?>logo1.png" alt=""></a>
                </div>
			</div>
			<div class="login-wrap">
				<input type="text" id="signin_id" name="signin_id" autofocus="" placeholder="Email ID" class="form-control required email">
				<input type="password" id="signin_password" name="signin_password" placeholder="Password" class="form-control required ">
				<button type="submit" class="btn btn-lg btn-login btn-block">
					<i class="fa fa-check"></i>
				</button>
				<label class="checkbox">
					<span class="pull-right">
						<a href="#myModal" data-toggle="modal"> Forgot Password?</a>
					</span>
				</label>
			</div>
		</form>

		<!-- Modal -->
		<form id="forgetpasswordForm" role="form" class="form-signin" method="post" action="<?php echo base_url().'account/forgetPassword';?>">
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
							<h4 class="modal-title">Forgot Password ?</h4>
						</div>
						<div class="modal-body">
							<p>Enter your e-mail address below to reset your password.</p>
							<input type="text" class="form-control placeholder-no-fix required email" autocomplete="off" placeholder="Email" name="forget_email" id="forget_email">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- modal -->
	</div>

	<!-- Placed js at the end of the document so the pages load faster -->

	<!-- Placed js at the end of the document so the pages load faster -->
	<script src="<?php echo JS_URL; ?>jquery-1.10.2.min.js"></script>
	<script src="<?php echo JS_URL; ?>bootstrap.min.js"></script>
	<script src="<?php echo JS_URL; ?>modernizr.min.js"></script>
	<script src="<?php echo JS_URL;?>jquery.validate.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
				$('#signinForm').validate();
				$('#forgetpasswordForm').validate();
		});
	</script>
</body>
</html>
