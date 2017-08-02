<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="description for website">
    <meta name="keywords" content="key for website">
    <meta name="author" content="Sassy infotech">
    <link rel="shortcut icon" type="image/ico" href="<?php echo IMAGE_PATH;?>favicon.ico"/>
    <link rel="shortcut icon" href="#" type="image/png">
    <title><?php echo SITE_TITLE; ?></title>

    <link href="<?php echo CSS_PATH;?>bootstrap.css" rel="stylesheet" type="text/css">

    <!--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous" />-->
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>css-stars.css ">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>aos1.css ">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>clndr.css ">
    <link rel="stylesheet" href="<?php echo CSS_PATH;?>owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>animate.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>responsive.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH;?>custom_style.css" media="all" />


<!--    <script type="text/javascript" src="--><?php //echo JS_PATH;?><!--jquery-3.2.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="<?php echo JS_PATH;?>jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<header class="header">


    <nav class="navbar navbar-default navbar-fixed-top uz-nav-de">

        <div class="nav-uz full">
            <div class="nav-uz-u full">
                <div class="container-fluid">
                    <div class="nav-uz-u-inner full">
                        <ul>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo $config['contact_number'];?>"><?php echo $config['contact_number'];?></a></li>
                            <?php if(isCustomerLogin()) { ?>
                                <li><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo base_url('customer/myaccount'); ?>">My account</a></li>
                                <li><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo base_url('customer/logout'); ?>">Logout</a></li>
                                <?php } else { ?>
                                    <li><i class="fa fa-user" aria-hidden="true"></i> <a href="<?php echo base_url('customer'); ?>">Login</a></li>
                               <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="nav-uz-main full">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header header-logo">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-menu" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <h1><a class="navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo IMAGE_PATH;?>logo.png" alt="book-img"></a></h1>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right nav-uz-r" id="navigation-menu">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_url(); ?>">Home </a></li>
                            <li><a href="<?php echo base_url('about_us');?>">About us </a></li>
                            <li><a href="<?php echo base_url('website')?>">Websites </a></li>
                            <li><a href="<?php echo base_url('help');?>">Help </a></li>
                            <?php if( !isCustomerLogin() ) { ?>
                                <li><a href="<?php echo base_url('customer/signup'); ?>">Register </a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url('contact_us') ?>">Contact Us </a></li>

                        </ul>
                        <button type="button" class="navbar-toggle collapsed navbar-toggle-mb" data-toggle="collapse" data-target="#navigation-menu" aria-expanded="false">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div><!-- /.navbar-collapse -->


                </div><!-- /.container -->
            </div>
            <div class="nav-uz-l full">

            </div>
        </div>

    </nav>


</header>