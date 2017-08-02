<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
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
                    View Pages Details
                </header>
                <?php if($this->session->flashdata('success'))
                { ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
                    <?php
                    $this->session->unset_userdata('success');
                } ?>
                <div class="panel-body">
                    <div class="adv-table table-responsive">
                        <table  class="display table table-bordered icon-color-blk table-striped" id="dynamic-table">
                            <thead>
                            <tr>

                                <th width="8%">ID</th>
                                <th>Page Title</th>
                                <th>Meta Keyword</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($ViewCms as $key => $Valuecms){
                                ?>
                                <tr >
                                    <td><?php echo $Valuecms['page_id']; ?></td>
                                    <td><?php echo $Valuecms['page_title']; ?></td>
                                    <td><?php echo $Valuecms['page_metakeyword']; ?></td>
                                    <td width="12%">
                                        <div>
                                            <a href="<?php echo base_url();?>cms/cmsedit/<?php echo $Valuecms['page_id'];?>"><i class="fa fa-edit" data-toggle="tooltip" title="Edit" data-original-title="edit"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>
<!--body wrapper end-->