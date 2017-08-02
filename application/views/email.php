<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title><?php echo SITE_TITLE; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Calibri, Arial;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
            border: 0;
        }

        .left-space {
            width: 50px;
        }

        .center-space {
            width: 550px;
        }

        .right-space {
            width: 50px;
        }

        .logo {
            float: left;
            padding: 12px 0 10px 0;
            background-color: #ffffff;
            border-top: 5px #00a0e1 solid;
        }

        .banner img {
            float: left;
            width: 100%;
        }

        .page-hidd {
            float: left;
            width: 100%;
            margin: 30px 0;
            font-size: 27px;
            color: #000000;
            text-align: center;
            text-decoration: underline;
        }

        .page-text {
            float: left;
            width: 100%;
            margin-bottom: 20px;
            font-size: 13px;
            color: #000000;
            text-align: left;
        }

        .get-started {
            text-transform: uppercase;
            color: #000;
        }

        .agent-img {
            width: 60px;
        }

        .agent-img img {
            float: left;
            width: 100%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .agent-text {
            font-size: 13px;
            color: #000000;
            text-align: left;
        }

        .agent-col2 {
            width: 140px;
            padding: 0 10px;
            border-right: 1px #c3c3c3 solid;
        }

        .agent-col3 {
            padding-left: 10px;
        }

        .got-line {
            float: left;
            width: 100%;
            margin-top: 15px;
            padding: 10px 0;
            background-color: #00aaee;
            border-bottom: 1px #3BBAED solid;
        }

        .got-line img {
            vertical-align: middle;
        }

        .got-line-more {
            padding: 3px 5px 5px 5px;
            background-color: #2c384e;
            color: #fff;
            text-decoration: none;
        }

        .footer-line {
            float: left;
            width: 100%;
            padding: 10px 0;
            background-color: #009fdf;
        }

        .footer-line-text1 {
            color: #fff;
            font-size: 10px;
        }

        .footer-line-text2 {
            width: 125px;
            color: #93dbf8;
            font-size: 11px;
        }

        .footer-line-text2 a {
            color: #93dbf8;
        }

        .footer-social-icon {
            width: 72px;
        }

        @media only screen and (max-width: 480px) {
            .left-space {
                width: 20px;
            }

            .right-space {
                width: 20px;
            }

            .page-hidd {
                font-size: 20px;
            }

            .page-text,
            .agent-text {
                font-size: 11px;
            }

            .got-line img {
                width: 170px;
            }

            .got-line-more {
                font-size: 12px;
            }

            .footer-line-text1 {
                font-size: 7px;
            }

            .footer-line-text2 {
                width: 105px;
                font-size: 9px;
            }

            .footer-social-icon {
                width: 80px;
            }
        }

    </style>
</head>

<body>
<table cellpadding="0" cellspacing="0" class="table">
    <tbody>
    <tr>
        <td class="logo">
            <table cellpadding="0" cellspacing="0" class="table">
                <tbody>
                <tr>
                    <td class="left-space"></td>
                    <td class="center-space"><img src="<?php echo IMAGE_PATH;?>logo.png" alt=""></td>
                    <td class="right-space"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td class="banner"><img src="<?php echo IMAGE_PATH;?>banner.jpg" alt=""></td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td align="center">
            <table cellpadding="0" cellspacing="0" class="table">
                <tbody>
                <tr>
                    <td class="left-space"></td>
                    <td class="center-space">
                        <table cellpadding="0" cellspacing="0" class="table">
                            <tbody>
                            <tr>
                                <td class="page-text">Name: <?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <td class="page-text">Email: <?php echo $email; ?></td>
                            </tr>
                            <tr>
                                <td class="page-text">
                                    Subject: <?php echo $subject; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="page-text">
                                    <strong>Message:</strong><br>
                                    <?php echo $message; ?>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </td>
                    <td class="right-space"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td class="footer-line">
            <table cellpadding="0" cellspacing="0" class="table">
                <tbody>
                <tr>
                    <td class="left-space"></td>
                    <td class="center-space">
                        <table cellpadding="0" cellspacing="0" class="table">
                            <tbody>
                            <tr>
                                <td class="footer-line-text1"><?php echo $config['copyright_text']; ?></td>

                                <td class="footer-social-icon">
                                    <a href="<?php echo $config['facebook_url']; ?>"><img
                                                src="<?php echo IMAGE_PATH;?>fb.png" alt=""></a>
                                    <a href="<?php echo $config['twitter_url']; ?>"><img
                                                src="<?php echo IMAGE_PATH;?>tr.png" alt=""></a>


                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="right-space"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
    </tr>
    </tbody>
</table>


</body>
</html>