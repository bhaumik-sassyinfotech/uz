<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>
        </li>
		<li>
            <a href="<?php echo base_url() . 'enquiries'; ?>">View All Enquiries</a>
        </li>
        <li class="active"> View <?php echo $module; ?> </li>
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
                    View <?php echo $module; ?>
                </header>
                <div class="panel-body">
					<div class="adv-table table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td><b>Name:</b></td>
                                <td><?php echo $enqData['name'];?></td>
                            </tr>
							<tr>
                                <td><b>Email:</b></td>
                                <td><?php echo $enqData['email'];?></td>
                            </tr>
							<tr>
                                <td><b>Subject:</b></td>
                                <td><?php echo $enqData['subject'];?></td>
                            </tr>
							<tr>
                                <td><b>Message:</b></td>
                                <td><?php echo nl2br($enqData['message']);?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>