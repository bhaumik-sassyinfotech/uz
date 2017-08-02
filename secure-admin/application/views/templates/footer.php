<?php
$class = strtolower($this->router->fetch_class());
$method = strtolower($this->router->fetch_method());
?>
<!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Permanently</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure about this ?</p>
            </div>
            <input type="hidden" name="remove_id" id="remove_id" >
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancelConfirmDelete" data-dismiss="modal">Cancel</button>
                <a href="javascript:;" type="button" class="btn btn-danger" id="confirm">Ok</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewDetail" role="dialog" aria-labelledby="ViewDetail" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure about this ?</p>
            </div>
            <!-- <input type="hidden" name="deleteProductImage" id="deleteProductImage" > -->
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default cancelConfirmDelete" data-dismiss="modal">Cancel</button>
                <a href="javascript:;" type="button" class="btn btn-danger" id="confirm">Ok</a>
            </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="confirmDeletebox" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Permanently</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure about this ?</p>
            </div>
            <input type="hidden" name="deleteProductImage" id="deleteProductImage" >
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancelConfirmDelete" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger cancelConfirmDelete comfirmDeleteReceipt" data-current="" data-payment="" data-dismiss="modal">Ok</button>
                <!--<a href="javascript:;" type="button" class="btn btn-danger" id="confirm">Ok</a>-->
            </div>
        </div>
    </div>
</div>

<!--<div class="modal fade" id="confirmMsg" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Your unit status</h4>
            </div>
            <div class="modal-body">
                <p>your unit is sold so you can not delete your unit.</p>
            </div>
            <input type="hidden" name="deleteProductImage" id="deleteProductImage" >
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancelConfirmDelete" data-dismiss="modal">Cancel</button>

            </div>
        </div>
    </div>
</div>-->
<div class="modal fade" id="alertDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" type="button" class="btn btn-primary confirmAlertClose"  >OK</a>
            </div>
        </div>
    </div>
</div>
<footer>
    <?php //echo $configData['copyright_text']; ?>
</footer>
</div>
<!-- page heading end-->
<!-- main content end-->

</section>
<script type="text/javascript">
    $('#viewDetail').on('show.bs.modal', function (e) {
        that = this;
        loder_image = "<?php echo IMAGE_URL ?>" + '/loader.gif';
        $(that).find('.modal-body').html('<div style="text-align:center;padding:100px"><img src="' + loder_image + '" width="50" height="50"></div>');
        dataId = $(e.relatedTarget).attr('data-value');
        dataSrc = $(e.relatedTarget).attr('data-src');
        if (dataSrc) {
            $.post(dataSrc, {property_id: dataId}, function (data) {
                result = $.parseJSON(data);
                if (result) {
                    $(that).find('.modal-body').html(result);
                }
            });

        }
        ttitle = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text(ttitle);



        //$(this).find('#confirm').attr('href', dataSrc);
    });

    $('#confirmDelete').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $id = $(e.relatedTarget).attr('data-id');
        $(this).find('#remove_id').val($id);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        dataSrc = $(e.relatedTarget).attr('data-src');
        $(this).find('#confirm').attr('href', dataSrc);
    });
    $('#confirmDeletebox').on('show.bs.modal', function (e) {
        $message = $(e.relatedTarget).attr('data-message');
        $(this).find('.modal-body p').text($message);
        $title = $(e.relatedTarget).attr('data-title');
        $(this).find('.modal-title').text($title);
        dataSrc = $(e.relatedTarget).attr('data-src');
        $(this).find('#confirm').attr('href', dataSrc);
    });
    //     $('#confirmMsg').on('show.bs.modal', function (e) {
    //        $message = $(e.relatedTarget).attr('data-message');
    //        $(this).find('.modal-body p').text($message);
    //        $title = $(e.relatedTarget).attr('data-title');
    //        $(this).find('.modal-title').text($title);
    //
    //    });
    $('.cancelConfirmDelete').click(function () {
//        console.log(e);
        $('#confirmDelete').find('#confirm').removeClass('deleteVideo');
        $('#confirmDelete').find('#confirm').removeClass('removeImage');
        $('#deleteProductImage').val('');
    });
    $('#confirmDelete').find('.modal-footer #confirm').on('click', function () {
        $('#confirmDelete').modal('hide');
    });
    $(document).on('click', '.confirmAlertClose', function () {
        $('#alertDelete').modal('hide');
    });
    function displayAlert(message) {
        $('#alertDelete').find('.modal-body p').text(message);
        $('#alertDelete').modal('show');
    }
</script>
<!-- Placed js at the end of the document so the pages load faster -->
<script src="<?php echo JS_URL; ?>jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?php echo JS_URL; ?>jquery.cookie.min.js"></script>

<script src="<?php echo JS_URL; ?>jquery.nicescroll.js"></script>

<script src="<?php echo JS_URL; ?>iCheck/jquery.icheck.js"></script>
<script src="<?php echo JS_URL; ?>icheck-init.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.5.2/underscore-min.js"></script>
<!--common scripts for all pages-->
<script src="<?php echo JS_URL; ?>scripts.js"></script>

<!--https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js-->

<?php if ($class == "client" && $method == "index") { ?>
    <script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <!--<script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>-->
    <!--<script  type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>-->
    <!--    <script  type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script  type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>-->
    <!--<script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>-->
    <!--<script  type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>-->

<?php }
?>
<!--dynamic table initialization -->
<?php if ($class == 'leads' && $method == 'addedit') { ?>
    <script type="text/javascript" src="<?php echo JS_URL; ?>dataTables.min.js"></script>
<?php } ?>
<script src="<?php echo JS_URL; ?>dynamic_table_init.js"></script>
<!--dynamic table-->
<!--pickers plugins-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>bootstrap-datepicker/js/bootstrap-timepicker.min.js"></script>
<!--<script type="text/javascript" src="--><?php //echo JS_URL; ?><!--bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>-->
<script type="text/javascript" src="<?php echo JS_URL; ?>jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="<?php echo JS_URL; ?>additional-methods.min.js"></script>
<!--pickers initialization-->
<script src="<?php echo JS_URL; ?>pickers-init.js"></script>
<!--pickers plugins-->
<!-- ckeditor -->
<script type="text/javascript" src="<?php echo JS_URL; ?>ckeditor/ckeditor.js"></script>
<!-- ckeditor -->
<!--file upload-->
<script type="text/javascript" src="<?php echo JS_URL; ?>bootstrap-fileupload.min.js"></script>
<!--file upload-->
<?php
//print_r($js); die;
if (isset($js)) {
    foreach ($js as $val) {
        echo '<script type="text/javascript" src="' . base_url() . 'assets/js/' . $val . '.js"></script>';
    }
}
?>
<script type="text/javascript">
    $(document).ready(function () {
        var unique_id = $('#unique_id').val();
        var link = $('#link').val();
        var base_url = '<?php echo base_url() ?>';
        jQuery.validator.addMethod("notNegative", function (value, element) {
            if ($.trim(value) != '') {
                if ($.trim(value) <= 0)
                    return false;
                else
                    return true;
            } else
                return true;
        }, "Value should be greater than 0");
        jQuery.validator.addMethod("alphabetNumeric", function (value, element) {
            return this.optional(element) || /^[a-z0-9\-\s]+$/i.test(value);
        }, "Allow only numbers and letters");
        jQuery.validator.addMethod("numericOnly", function (value, element) {
            return this.optional(element) || /^[0-9]+$/i.test(value);
        }, "Please enter numbers only.");
        jQuery.validator.addMethod("float", function (value, element) {
            return this.optional(element) || /^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/i.test(value);
        }, "Please enter proper value.");
        jQuery.validator.addMethod("validateImage", function (value, element) {
            if (value) {
                var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
                if ($.inArray($(element).val().split('.').pop().toLowerCase(), fileExtension) == -1)
                    return false;
                else
                    return true;
            } else
                return true;
        }, "Please enter valid image type.");

        jQuery.validator.addMethod("pdfOnly", function (value, element) {
            if (value) {
                var fileExtension = ['pdf'];
                if ($.inArray($(element).val().split('.').pop().toLowerCase(), fileExtension) == -1)
                    return false;
                else
                    return true;
            } else
                return true;
        }, "Please upload only pdf file.");

        jQuery.validator.addMethod("validateImagesize", function (value, element) {
            if (value) {
                var size = parseFloat(element.files[0].size / 1024 / 1024).toFixed(2);
                if (size > 5)
                    return false;
                else
                    return true;
            } else
                return true;

        }, 'Max size for image is 5MB.');

        jQuery.validator.addMethod("validatePhoneNo", function (value, element) {
//            return this.optional(element) || /^(\+){0,1}[0-9()-]*$/.test(value);
            if (this.optional(element) || /^(\+){0,1}[0-9()-\s]*$/.test(value) && value != '')
            {
                return true;
            } else
                return false;
        }, "Please enter valid contact number.");
        jQuery.validator.addMethod("validateNoLeadingZero", function (value, element) {
//        return this.optional(element) || /^(\+){0,1}[(0-9]{0,1}[0-9()-]*$/.test(value);
            if (value != '')
            {
                firstLetter = value.charAt(0);
                if (firstLetter == '0')
                    return false;
                else
                    return true;
            } else
                return true;
        }, 'Mobile number should not start with "0".');
        jQuery.validator.addMethod("pan_card_validate", function (value, element)
        {
            return this.optional(element) || /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
        }, "Invalid Pan Number");
        jQuery.validator.addMethod("validName", function (value, element)
        {
            return this.optional(element) || /^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/.test(value);
        }, "Only Characters, Numbers and Spaces are Allowed.");
        jQuery.validator.addMethod("email_valid", function (value, element)
        {
            return this.optional(element) || /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/.test(value);
        }, "Please enter valid email address format.");
        jQuery.validator.addMethod("validateSlug", function (value, element) {
            return this.optional(element) || /^[A-Za-z_-]*$/.test(value);
        }, "Only alphabets,dash and underscore are allowed");
        jQuery.validator.addMethod("validateName", function (value, element) {
            return this.optional(element) || /^[a-zA-Z\\.'-\s]+$/i.test(value);
        }, "Please enter valid name");
        jQuery.validator.addMethod("noSpecialChar", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
        }, "No Special Characters");

        jQuery.validator.addMethod("checkOnlySpace", function (value, element) {
//        if ( $.trim( $('#myInput').val() ) == '' ){
            if ( $.trim( value ) == '' ){
                return value.indexOf(" ") < 0 && value != "";
            } else
                return true;
        }, "Field cannot be left blank.");
        jQuery.validator.addMethod("noSpace", function (value, element) {
            if (value != '') {
                return value.indexOf(" ") < 0 && value != "";
            } else
                return true;
        }, "Space is not allowed");
        jQuery.validator.addMethod("imageonly", function (value, element) {
            var ext = $(element).val().split('.').pop().toLowerCase();
            if (ext != '')
            {
                if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'gif']) == -1) {
//                    $(this).removeClass("valid");
//                    $(this).addClass("error");
                    return false;
                } else
                {
                    return true;
                }
            }
            else
            {
                return true;
            }
        }, "Valid extensions are jpg|jpeg|png|gif.");
        jQuery.validator.addMethod("uploadLimit", function (val, element) {
            if (typeof element.files[0] != 'undefined' && element.files[0] != '') {
                var size = element.files[0].size;
                if (size > 3145728)// checks the file more than 3 MB
                {
                    return false;
                } else {
                    return true;
                }
            } else
                return true;
        }, "Please select File size less than 3 MB");
        jQuery.validator.addMethod("checkAlreadyExist", function (value, element) {
            if ($.trim(value) != '') {
                var isSuccess = true;
                $.ajax({url: base_url + link,
                    type: 'POST',
                    data: {field_value: value, unique_id: $('#' + unique_id).val()},
                    async: false,
                    success: function (data) {
                        data = $.parseJSON(data);
                        isSuccess = data.result === true ? true : false
                    }
                });
                return isSuccess;
            } else
                return true;
        }, "This Email address already exist.");

        $('#groupEditForm').validate();
        $('#customerEditForm').validate();

        $('#userEditForm').validate({
//            ignore: [],
            rules: {
                user_password:
                {
//                    required: true,
                    minlength: 6,
                },
                mobileno:
                {
                    required:true,
                    minlength:6,
                    maxlength:16
                },
                confirm_password: {equalTo: "#user_password"}
            },
            messages:
            {
                "user_password" : "Please enter at least 6 characters long password.",
                "confirm_password":"Passwords don't match.",
                "mobileno" :
                {
                    required: "Please enter valid contact number.",
//                    minlength: "Your contact number must be at least 6 digits long.",
//                    maxlength: "Your contact number can be at maximum 16 digits long.",
                    minlength: "Please enter valid contact number.",
                    maxlength: "Please enter valid contact number.",

                }
            }
        });
        $("#mentorEditForm").validate();

//        $("#spaceEditForm").validate({
//            ignore: [],
//            rules:
//            {
//                'website_url': {
//                    required: true,
//                    url: true
//                },
//                'description': {
//                    required: true,
//                    minlength: 8
//                },
//                'base_price_per_hour': {
//                    required: true,
//                    min: 1
//                },
//                'base_price_per_day': {
//                    required: true,
//                    min: 1
//                },
//                'sale_price_per_hour[]': {
//                    required: true,
//                    min: 1
//                },
//                'sale_price_per_day[]': {
//                    required: true,
//                    min: 1
//                },
//                'banner_width': {
//                    required: true,
//                    min: 1
//                },
//                'banner_height': {
//                    required: true,
//                    min: 1
//                }
//            },
//            messages:
//            {
//                'base_price_per_hour[]':
//                {
//                    required: "Please enter valid price.",
//                    min: "Please enter valid price."
//                },
//                'base_price_per_day[]':
//                {
//                    required: "Please enter valid price.",
//                    min: "Please enter valid price."
//                },
//               'banner_width':
//                {
//                    min: "Please enter a valid banner width/height."
//                },
//                'banner_height':
//                {
//                    min:"Please enter a valid banner width/height."
//                },
//                'sale_price_per_hour[]':
//                {
//                    min:"Please enter proper sale price."
//                },
//                'sale_price_per_day[]':
//                {
//                    min:"Please enter proper sale price."
//                }
//            }
//        });
        

        $("#partnerEditForm").validate();
        $("#mentor_testimonialEditForm").validate();
        $("#client_testimonialEditForm").validate();
        $("#cmsEditForm").validate();
        $("#configEditForm").validate();
        $('#settingForm').validate();
        $('#couponEditForm').validate();
        $("#emailtemplateEditForm").validate(
            {
//                ignore: [],
                debug: false,
                rules: {
                    emailtemplate_desc:
                        {
                            required: function ()
                            {
                                CKEDITOR.instances.emailtemplate_desc.updateElement();
                            }
                        }
                }
            });

        $('#demandletterForm').validate({
//            ignore: [],
            debug: false,
            rules: {
                demand_letter:
                    {
                        required: function ()
                        {
                            CKEDITOR.instances.demand_letter.updateElement();
                        }
                    }
            }
        });
    });
</script>
<script>
    var SITE_URL = '<?PHP echo base_url(); ?>';
    $(".fancybox").fancybox();
    $(document).ready(function () {
        $('#leads_step4').validate();
    })
	
	//admin Sidebar
$(window).load(function() {
	//var current_menu_class = $(".adminsidebarmenu .toggle-btn").hasClass( ".menu-collapsed" );
	//alert(current_menu_class);
	
	if (typeof $.cookie('menu_action_class') === 'undefined'){
		 //no cookie
		 $.cookie("menu_action_class", 1, { expires : 10 });
		 //alert("no cookie");
	} else {
		 //have cookie
		 //$.removeCookie("test");
		 //alert($.cookie("menu_action_class"));
		
		if($.cookie("menu_action_class")==1){
			//alert("one");
			$("body").removeClass( "left-side-collapsed" );
		}else if($.cookie("menu_action_class")==0){
			//alert("zero");
			$("body").addClass( "left-side-collapsed" );
		}
	}
	$( ".main-content #admin_menu_toggle" ).click(function() {
		setTimeout(function(){ 
			//alert("Hello"); 
			var current_menu_class = $("body").hasClass( "left-side-collapsed" );
			//alert(current_menu_class);
			
			if(current_menu_class == false){
				//alert(current_menu_class);
				 $.cookie("menu_action_class", 1, { expires : 10 });//days
				 //alert($.cookie("menu_action_class"));
			}else{
				//alert(current_menu_class);
				 $.cookie("menu_action_class", 0, { expires : 10 });//days
				 //alert($.cookie("menu_action_class"));
			}
			
		}, 1000);//after 3 seconds (3000 milliseconds)
	});
	
	
	
	
});	
	
</script>

</body>
</html>
