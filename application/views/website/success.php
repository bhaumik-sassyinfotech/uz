<div class="main-content full cms-pages">
    <div class="uz-wrap full web-info-page">
        <div class="Website-add-sec full">
            <div class="container-fluid">
                <div class="ad full">
                    <span class="adtext">Order Information</span>
                </div>

            </div>
        </div>
		
		<!--Error Succcess-->
		<?php /*if($this->session->flashdata('paymentSuccess')!=''){?>
		<div class="alert alert-success">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		  <?php echo $this->session->flashdata('tranid');?>
		  <?php echo $this->session->flashdata('paymentSuccess');?>
		</div>
		<?php }*/?>
        <div class="success-page">
            <section>
                <div class="container ">
                    <section class="error-wrapper text-center">
                        <h1><img alt="" src="<?php echo IMAGE_PATH;?>success.png" class="img-responsive" style="margin: 0 auto"></h1>
                        <div class="heading">
                            <h1>Thank You. </h1>
                            <?php if($this->session->flashdata('paymentSuccess')!=''){?>
							<h2><?php echo $this->session->flashdata('paymentSuccess');?></h2>
							<?php }?>
                        </div>
            <!--<a class="back-btn" href="<?php echo base_url();?>"> BOOK AGAIN</a>-->
					
					<?php if($this->session->flashdata('tranData')!=''){
						$tranData = $this->session->flashdata('tranData');
						//print_r($tranData);
						?>
					<table class="order-info">
						<tr>
							<td><b>Date</b></td>
							<td><?php echo date("F d, Y",strtotime($tranData['created_date']));?></td>
						</tr>
						<tr>
							<td><b>Order Number</b></td>
							<td><?php echo "UPZ#".$tranData['bk_id'];?></td>
						</tr>
						<tr>
							<td><b>Transaction ID</b></td>
							<td><?php echo $tranData['transaction_id'];?></td>
						</tr>
						<tr>
							<td><b>Total</b></td>
							<td><?php echo CURRENCY." ".$tranData['total'];?></td>
						</tr>
						<?php if($this->session->flashdata('bookingData')!=''){
							$bookingData = $this->session->flashdata('bookingData');
							//echo "<pre>";print_r($bookingData);
						}?>
					</table>
					<?php }?>
                    
                    </section>
                </div>
            </section>
        </div>
    </div>
</div>



