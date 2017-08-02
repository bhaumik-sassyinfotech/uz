<div class="main-content full cms-pages">
    <div class="uz-wrap full web-info-page">
        <div class="Website-add-sec full">
            <div class="container-fluid">
                <div class="ad full">
                    <span class="adtext">Order Information</span>
                </div>

            </div>
        </div>
		
		<!--Error Message-->
		<?php if($this->session->flashdata('paymentError')!=''){?>
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		  <?php echo $this->session->flashdata('paymentError');?>
		</div>
		<?php }?>
        <div class="fail-page">
            <section>
                <div class="container ">
                    <section class="error-wrapper text-center">
                        <h1><img alt="" src="<?php echo IMAGE_PATH;?>fail.png" class="img-responsive" style="margin: 0 auto; padding-bottom: 20px"></h1>
                        <strong>Opps..</strong>
                        <div class="heading">
                            <h1>Something went wrong with the payment process. </h1>
                            <h2>Please try again!</h2>
                        </div>
                        <a class="back-btn" href="<?php echo base_url();?>website"> BOOK AGAIN</a>
                    </section>
                </div>
            </section>
        </div>
    </div>
</div>



