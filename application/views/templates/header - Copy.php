<DOCTYPE html>
    <html lang="en">
    <head>
        <link rel="shortcut icon" type="image/ico" href="<?php echo IMAGE_PATH; ?>favicon.ico"/>
        <title><?php echo SITE_TITLE; ?></title>
        <script src="<?php echo JS_PATH; ?>jquery-3.2.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>font-awesome.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>custom.css"/>

        <script src="<?php echo JS_PATH; ?>bootstrap.min.js"></script>
    </head>
    <body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
        <hr>
        <div class="container-fluid">
            <div class="navbar-header col-md-4">
                <a class="navbar-brand" href="#"><?php echo SITE_TITLE; ?></a>
                <!--                    <a class="navbar-brand" href="#"><img src="-->
                <?php //echo IMAGE_PATH.'logo1.png';?><!--"></a>-->
            </div>
            <div class="col-md-8">
                <ul class="nav navbar-nav">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About <?php echo ucfirst(strtolower(SITE_TITLE)); ?></a></li>
                    <li><a href="<?php echo base_url('website'); ?>">Website</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
            </div>
        </div>
    </nav>