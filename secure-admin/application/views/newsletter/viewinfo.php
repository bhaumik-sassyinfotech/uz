<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>
        </li>
		<li>
            <a href="<?php echo base_url() . 'newsletter'; ?>">View All Newsletters</a>
        </li>
        <li class="active"> View <?php echo $Module; ?> </li>
    </ul>
</div>
<!-- page heading end-->
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <section class="panel">
                <header class="panel-heading pd-btm-25px">
                    View <?php echo $Module; ?>
                </header>
                <div class="panel-body">
					<div class="adv-table table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td><b>First Name:</b></td>
                                <td><?php echo $newsletterData['firstname'];?></td>
                            </tr>
							<tr>
                                <td><b>Last Name:</b></td>
                                <td><?php echo $newsletterData['lastname'];?></td>
                            </tr>
							<tr>
                                <td><b>Email:</b></td>
                                <td><?php echo $newsletterData['email'];?></td>
                            </tr>
							<tr>
                                <td><b>Contact Number:</b></td>
                                <td><?php echo $newsletterData['number'];?></td>
                            </tr>
							<tr>
                                <td><b>Country:</b></td>
                                <td><?php echo $newsletterData['country_name'];?></td>
                            </tr>
							<tr>
                                <td><b>State:</b></td>
                                <td><?php echo $newsletterData['state_name'];?></td>
                            </tr>
							<tr>
                                <td><b>City:</b></td>
                                <td><?php echo $newsletterData['city_name'];?></td>
                            </tr>
							<tr>
                                <td><b>Pincode:</b></td>
                                <td><?php echo $newsletterData['pincode'];?></td>
                            </tr>
                            <?php  if($newsletterData['message']){ ?>
                            <tr>
                                <td><b>Message:</b></td>
                                <td><?php echo $newsletterData['message'];?></td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>