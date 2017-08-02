<div class="left-side sticky-left-side adminhitsidebarmenu">
    <!--logo and iconic logo start-->
    <!--    <div class="logo">-->
    <!--        <a href="--><?php //echo base_url(); ?><!--">--><?php //echo SITE_TITLE;?><!--</a>-->
    <!--    </div>-->
    <div class="logo">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo IMAGE_URL; ?>logo1.png" alt=""></a>
    </div>
    <div class="logo-icon text-center">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo IMAGE_URL; ?>logo_icon.png" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">
        <!-- visible to small devices only -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">
                <img alt="" src="<?php echo IMAGE_URL; ?>photos/login.png" class="media-object">
                <div class="media-body">
                    <h4>
                        <?php echo $this->session->userdata('admin_name'); ?>
                    </h4>
                </div>
            </div>

            <h5 class="left-nav-title">Account Information</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
                <li><a href="<?php echo base_url() . 'account/profile'; ?>"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                <li><a href="<?php echo base_url() . 'account/logout'; ?>"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">

            <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>

            <?php if(CheckPermission('cms','edit')){ ?>
                <li class="menu-list">
                    <a href="<?php echo base_url('cms'); ?>"><i class="fa fa-file-text-o"></i>
                        <span>CMS</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo base_url('cms'); ?>"> View CMS</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if(CheckPermission('enquiries')){ ?>
                <li class="menu-list">
                    <a href="<?php echo base_url('enquiries'); ?>"><i class="fa fa-file-text-o"></i>
                        <span>Enquiries</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="<?php echo base_url('enquiries'); ?>"> View Enquiries</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if (CheckPermission('order', 'index'))
            { ?>
                <li class="menu-list"><a href="<?php echo base_url('order'); ?>"><i class="fa fa-list"></i> <span> Order Listing</span></a>
                    <ul class="sub-menu-list">
                        <?php if (CheckPermission('order', 'index')) { ?>
                            <li><a href="<?php echo base_url('order'); ?>"> View orders</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
			
			<?php if (CheckPermission('customer', 'index') || CheckPermission('customer', 'edit'))
            { ?>
                <li class="menu-list"><a href="<?php echo base_url('customer'); ?>"><i class="fa fa-group"></i> <span> Customers</span></a>
                    <ul class="sub-menu-list">
                        <?php if (CheckPermission('customer', 'index')) { ?>
                            <li><a href="<?php echo base_url('customer'); ?>"> View Customers</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
			
            <?php if(CheckPermission('users', 'addEdit') || CheckPermission('users', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('users'); ?>"><i class="fa fa-user"></i> <span> Users</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('users', 'addEdit')){ ?>
                            <li><a href="<?php echo base_url('users/addEdit'); ?>"> Add User</a></li>
                        <?php } ?>
                        <?php if(CheckPermission('users', 'index')){ ?>
                            <li><a href="<?php echo base_url('users'); ?>"> View Users</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if(CheckPermission('group', 'addEdit') || CheckPermission('group', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('group'); ?>"><i class="fa fa-group"></i> <span> Groups</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('group', 'addEdit')){ ?>
                            <li><a href="<?php echo base_url('group/addEdit'); ?>"> Add Group</a></li>
                        <?php } ?>
                        <?php if(CheckPermission('group', 'index')){ ?>
                            <li><a href="<?php echo base_url('group'); ?>"> View Groups</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if(CheckPermission('website', 'addEdit') || CheckPermission('website', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('website'); ?>"><i class="fa fa-list"></i> <span> Website</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('website', 'addEdit')){ ?>
                            <li><a href="<?php echo base_url('website/addEdit'); ?>"> Add Website</a></li>
                        <?php } ?>
                        <?php if(CheckPermission('website', 'index')){ ?>
                            <li><a href="<?php echo base_url('website'); ?>"> View Website</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if(CheckPermission('space', 'addEdit') || CheckPermission('space', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('space'); ?>"><i class="fa fa-dot-circle-o"></i> <span> Space</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('space', 'addEdit')){ ?>
                            <li><a href="<?php echo base_url('space/addEdit'); ?>"> Add Space</a></li>
                        <?php } ?>
                        <?php if(CheckPermission('space', 'index')){ ?>
                            <li><a href="<?php echo base_url('space'); ?>"> View Space</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php // Sale Price
            /*
            if(CheckPermission('sale_price', 'addEdit') || CheckPermission('sale_price', 'index')){ ?>
            <li class="menu-list"><a href="<?php echo base_url('sale_price'); ?>"><i class="fa fa-dot-circle-o"></i> <span> Sale Price</span></a>
                <ul class="sub-menu-list">
                  <?php if(CheckPermission('sale_price', 'addEdit')){ ?>
                    <li><a href="<?php echo base_url('sale_price/addEdit'); ?>"> Add Sale Price</a></li>
                  <?php } ?>
                  <?php if(CheckPermission('sale_price', 'index')){ ?>
                    <li><a href="<?php echo base_url('sale_price'); ?>"> View Sale Price</a></li>
                    <?php } ?>
                </ul>
            </li>
			<?php }

			*/?>

            <?php if(CheckPermission('coupons', 'addEdit') || CheckPermission('coupons', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('coupons'); ?>"><i class="fa fa-tasks	"></i> <span> Coupons</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('coupons', 'addEdit')){ ?>
                            <li><a href="<?php echo base_url('coupons/add'); ?>"> Add Coupon</a></li>
                        <?php } ?>
                        <?php if(CheckPermission('coupons', 'index')){ ?>
                            <li><a href="<?php echo base_url('coupons'); ?>"> View Coupons</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php /*if(CheckPermission('client_testimonial', 'addEdit') || CheckPermission('client_testimonial', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('client_testimonial'); ?>"><i class="fa fa-th"></i> <span> Client Testimonial</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('client_testimonial', 'addEdit')){ ?>
                            <li><a href="<?php echo base_url('client_testimonial/addEdit'); ?>"> Add Client Testimonial</a></li>
                        <?php } ?>
                        <?php if(CheckPermission('client_testimonial', 'index')){ ?>
                            <li><a href="<?php echo base_url('client_testimonial'); ?>"> View Client Testimonial</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php }*/ ?>
<!--            --><?php //if(CheckPermission('newsletter')){ ?>
<!--                <li class="menu-list"><a href="--><?php //echo base_url('newsletter'); ?><!--"><i class="fa fa-bars"></i> <span> Newsletter</span></a>-->
<!--                    <ul class="sub-menu-list">-->
<!--                        --><?php //if(CheckPermission('newsletter')){ ?>
<!--                            <li><a href="--><?php //echo base_url('newsletter'); ?><!--"> View Newsletter</a></li>-->
<!--                        --><?php //} ?>
<!--                    </ul>-->
<!--                </li>-->
<!--            --><?php //} ?>
<!--            --><?php //if(CheckPermission('slider', 'add') || CheckPermission('slider', 'index')){ ?>
<!--                <li class="menu-list"><a href="--><?php //echo base_url('slider'); ?><!--"><i class="fa fa-picture-o"></i> <span> Slider</span></a>-->
<!--                    <ul class="sub-menu-list">-->
<!--                        --><?php //if(CheckPermission('slider', 'add')){ ?>
<!--                            <li><a href="--><?php //echo base_url('slider/add'); ?><!--"> Add Slider</a></li>-->
<!--                        --><?php //} ?>
<!--                        --><?php //if(CheckPermission('slider', 'index')){ ?>
<!--                            <li><a href="--><?php //echo base_url('slider'); ?><!--"> View Slider</a></li>-->
<!--                        --><?php //} ?>
<!--                    </ul>-->
<!--                </li>-->
<!--            --><?php //} ?>

            <?php if(CheckPermission('template', 'index')){ ?>
                <li class="menu-list"><a href="<?php echo base_url('template'); ?>"><i class="fa fa-envelope-o"></i> <span> Templates</span></a>
                    <ul class="sub-menu-list">
                        <?php if(CheckPermission('template', 'index')){ ?>
                            <li><a href="<?php echo base_url('template'); ?>"> View Templates</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>

            <?php if($this->session->userdata('admin_group_id') == 1){ ?>
                <li class="menu-list">
                    <a href=""><i class="fa fa-cogs"></i>
                        <span> Settings</span></a>
                    <ul class="sub-menu-list">
                        <?php if($this->session->userdata('admin_group_id') == 1){ ?>
                            <li><a href="<?php echo base_url('setting'); ?>"> Setting</a></li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
        </ul>
        <!--sidebar nav end-->
    </div>
</div>
