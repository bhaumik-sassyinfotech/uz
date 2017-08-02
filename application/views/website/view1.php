<br><br><br><br><br><br>
<?php
    foreach ($websiteData as $data)
    {
?>
    <div class="container " >
        <div class="row" >
            <div class="col-md-2">
                <img src="<?php echo UPLOAD_URL. 'website/'.@$data['image']; ?>" >
            </div>
            <div class="col-md-10" >
                <div class="col-md-12">
                  <span>Name: </span>
                    <?php echo @$data['website_name']; ?>
                </div>
                <br><br>
                <div class="col-md-10">
                    <span>Website URL: </span>
                    <?php echo @$data['website_url']; ?>
                </div>
                <br><br>
                <div class="col-md-2">
                    <?php //base64_encode( $data['id']) ?>
                    <a class="btn btn-primary " href="<?php echo base_url('website/space')."/".base64_encode( $data['id']); ?>" >Check Space</a>
                </div>
            </div>
        </div>
    </div>
        <hr>
<?php }?>