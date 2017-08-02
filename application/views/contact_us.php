
<div class="main-content full cms-pages" id="contact-us">
    <div class="uz-wrap full web-info-page">
        <div class="Website-add-sec full">
            <div class="container-fluid">
                <div class="ad full">
                    <span class="adtext">Contact Us</span>
                </div>

            </div>
        </div>
        <div class="contact-us-wrap full">

            <div class="gp-content-sec full contact-page other-page-content">
                <div class="container">
                    <div class=" contact-page-content full">
                        <div class=" contact-page-content-text full">
                            <p>Congue leo eget malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis
                                at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non
                                nisi.Praesent sapien massa, convallis a pellent</p>
                        </div>
                        <div class="contact-page-content-form full">
                            <?php if ($this->session->flashdata('contactSuccess')) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <?php
                                    echo $this->session->flashdata('contactSuccess');
                                    $this->session->unset_userdata('contactSuccess');

                                    ?>
                                </div>
                            <?php } else if ($this->session->flashdata('contactError')) { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <?php
                                    echo $this->session->flashdata('contactError');
                                    $this->session->unset_userdata('contactError');
                                    ?>
                                </div>
                            <?php } ?>
                            <form action="<?php echo base_url('contact_us/insert'); ?>" method="post"
                                  class="gp-contact-us-form" id="contact" name="contact"
                                  enctype="multipart/form-data">
                                <div class="form-group gp-contact-form-group">
                                    <input type="text" class="form-control required" name="name" id="name"
                                           placeholder="Name">
                                </div>
                                <div class="form-group gp-contact-form-group">
                                    <input type="email" class="form-control required email_valid" name="email" id="email"
                                           placeholder="Email">
                                </div>
                                <div class="form-group gp-contact-form-group subject">
                                    <input type="text" class="form-control required" name="subject" id="subject"
                                           placeholder="Subject">
                                </div>
                                <div class="form-group gp-contact-form-group message">
                                    <textarea id="message" class="form-control required" name="message" placeholder="Message"></textarea>
                                </div>

                                <div class="form-group gp-contact-form-group ">
                                    <div class="contact-submit-btn">
                                        <button type="submit" name="save" id="save" class="btn btn-default site-btn">
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-page-footer full">
                <div class="container">
                    <div class="contact-page-footer-inner full">
                        <div class="contact-page-footer-inner-col">
                            <div class="contact-page-footer-info">
                                <div class="contact-page-footer-info-col">
                                    <div class="contact-page-footer-info-img">
                                        <img src="<?php echo IMAGE_PATH; ?>contact-f.png" alt="gp-img">
                                    </div>

                                </div>
                                <div class="contact-page-footer-info-col">
                                    <p>
                                        <a href="tel:<?php echo $config['contact_number']; ?>"><?php echo $config['contact_number']; ?></a>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="contact-page-footer-inner-col">

                            <div class="contact-page-footer-info">
                                <div class="contact-page-footer-info-col">
                                    <div class="contact-page-footer-info-img">
                                        <img src="<?php echo IMAGE_PATH; ?>contact-f1.png" alt="gp-img">
                                    </div>

                                </div>
                                <div class="contact-page-footer-info-col">
                                    <p><a href="mailto:<?php echo $config['contact_email']; ?>?Subject=Hello"
                                          target="_top"><?php echo $config['contact_email']; ?></a></p>

                                </div>
                            </div>
                        </div>
                        <div class="contact-page-footer-inner-col">
                            <div class="contact-page-footer-info">
                                <div class="contact-page-footer-info-col">
                                    <div class="contact-page-footer-info-img">
                                        <img src="<?php echo IMAGE_PATH; ?>contact-f2.png" alt="gp-img">
                                    </div>

                                </div>
                                <div class="contact-page-footer-info-col">
                                    <p> <?php echo $config['office_address']; ?> </p>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('#contact').validate({
        rules: {
            message: {
                required: true,
                minlength: 8
            }
            ,
            email:{
                required: true,
//                email: true
            }
        },
        submitHandler: function (form) {

            $("#save").attr("disabled", true); //.html("Submitting your message.")
             form.submit(); // commented out for demo
        }
    });

</script>