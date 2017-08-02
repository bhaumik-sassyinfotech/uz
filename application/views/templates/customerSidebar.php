<?php
$curMethod=$this->router->fetch_method();
?>
<ul class="al-left-menu">
    <li><a href="<?php echo base_url()?>">Home</a></li>
    <li><a class= '<?php if($curMethod == 'myaccount') echo "allm-active active";?>' href="<?php echo base_url('customer/myaccount');?>">My Account</a></li>
<!--    <li><a class='--><?php //if($curMethod  == 'credits') echo "allm-active active";?><!--'  href="--><?php //echo base_url();?><!--">Billing Information</a></li>-->
    <li><a class='<?php if($curMethod  == 'advertisements' OR $curMethod  == 'ads_exhausted' OR $curMethod  == 'ads_live') echo "allm-active active";?>' href="<?php echo base_url('customer/advertisements');?>">My Advertisements</a></li>
    <li><a class='<?php if($curMethod  == 'transaction') echo "allm-active active";?>'  href="<?php echo base_url('customer/transaction');?>">Transactions</a></li>
<!--    <li><a href="--><?php //echo base_url('customer/logout') ?><!--">Logout</a></li>-->

</ul>