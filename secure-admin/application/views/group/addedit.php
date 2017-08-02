<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('group'); ?>">View All <?php echo $Module; ?></a>
        </li>
        <li class="active"><?php echo ucfirst($action) . " " . $Module; ?></li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">
                <header class="panel-heading">
                    <?php echo $action . " " . $Module; ?>
                </header>

                <div class="panel-body">
                    <form id="groupEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url() . 'group/addEdit'; ?>">
                        <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                        <input type="hidden" name="group_id" id="group_id" value="<?php echo @$group_id; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                 <div class="bottom-spacing">
                                <label for="exampleInputEmail1">Group Name : </label>
                                <input type="text" name="group_name" id="group_name" class="form-control required checkAlreadyExist" value="<?php echo @$group_name; ?>" placeholder="Group Name" >
                                <input type="hidden" name="unique_id" id="unique_id" value="group_id" />
                                <input type="hidden" name="link" id="link" value="group/checkName" />
                            </div>
                            </div>

                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-12 col-sm-12">
                                <label>Group Privileges:</label>
                            </div>
                        </div>
                        <?php
                        $privileges_array = json_decode(privileges_array);
                        $privileges = json_decode(@$group_privilege, true);
                        ?>	

                        <div class="form-group clearfix">
                            <?php
                            $i = 1;
                            foreach ($privileges_array as $key => $value) {
                                ?>
                                
                                <div class="col-md-3 col-sm-3">
                                       <div class="bottom-spacing">
                                    <label for="users"><b><?php echo ucfirst(str_replace("_", " ", $key)); ?> : </b></label></br>
                                    <?php
                                    foreach ($value as $k => $v) {

                                        $val = (isset($privileges[$key][$k])) ? $privileges[$key][$k] : 0;
                                        ?>
                                        <input type="checkbox" name="privileges[<?php echo $key; ?>][<?php echo $k; ?>]" id="<?php echo $key . '_' . $k; ?>" value="<?php echo $val; ?>" <?= ($val == 1) ? 'checked="checked"' : '' ?>/><?php
                                        if ($k == "index") {
                                            echo "  list";
                                        } else {
                                            echo "  " . $k;
                                        }
                                        ?><br>
                                        <?php
                                    }
                                    ?>
                                </div>
                                </div>
                                <?php
                                if ($i % 4 == 0) {
                                    echo '<div class="row"><div class="col-xs-12"><hr></div></div>';
                                }
                                $i++;
                            }
                            ?>
                        </div>

                        <div class="col-md-12 pd0 col-sm-12">
                            <input value="Save" type="submit" id="submit" name="submit" class="btn btn-primary"/>
                            <a class="btn btn-default" href="<?php echo base_url('group'); ?>"> Cancel</a>	
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

