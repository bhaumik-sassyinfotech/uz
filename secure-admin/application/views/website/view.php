<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>
        </li>
        <li class="active"> View <?php echo $Module; ?> </li>
    </ul>
</div>

    <?php if ($this->session->flashdata('webAddUpdMsg') != '') { ?>
    <div class="alert alert-success" id="add_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('webAddUpdMsg') . '</h6>';
        $this->session->unset_userdata('webAddUpdMsg');
        ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('webDeleteSuccMsg') != '') { ?>
    <div class="alert alert-danger" id="del_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('webDeleteSuccMsg') . '</h6>';
        $this->session->unset_userdata('webDeleteSuccMsg');

        ?>
    </div>
<?php } ?>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <section class="panel">
                <header class="panel-heading pd-btm-25px">
                    View <?php echo $Module; ?> Details
					<div class="btn-group pull-right">
						<a href="<?php echo base_url('website/addEdit'); ?>" id="editable-sample_new" class="btn btn-primary">Add New <i class="fa fa-plus"></i></a>                    
				   </div>
                </header>
                <div class="panel-body">
                                       <div class="adv-table table-responsive">
                        <form name="cmsListForm" id="cmsListForm">
                            <table class="display table table-bordered table-striped icon-color-blk drag-row" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%">Logo </th>
                                        <th width="15%">Website Name </th>
                                        <th width="25%">Website URL </th>
                                        <th width="25%">Unique ID </th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>

                                <tbody class="drag-body">
                                    <?php
                                    $i = 1;
                                    foreach ($websiteData as $data):
                                        ?>
                                        <tr>
                                          
                                            <td><?php echo $i; ?></td>
                                            <td>
												<?php if ($data['image'] != '' && file_exists(UPLOAD_ON_ROOT .'/website/'. $data['image'])) { ?>
													<img style="width:50px;" src="<?php echo UPLOAD_URL_ROOT .'/website/'. $data['image']; ?>" >	
												<?php } else { ?>
													<img style="width:50px;" src="<?php echo IMAGE_URL . 'photos/default_user.png' ?>" alt="" />
												<?php } ?>
											</td>
                                            <td><?php echo $data['website_name']; ?></td>
                                            <td>
												<?php 
													echo substr($data['website_url'],0,42);
													$chklen = strlen($data['website_url']);
													if($chklen > 43){echo '...';}
												?>
											</td>
                                            <td>
												<?php 
													echo substr($data['website_unique_id'],0,19);
													$chklen = strlen($data['website_unique_id']);
													if($chklen > 20){echo '...';}
												?>
											</td>
                                            <td width="12%">
                                                <div>
                                                    <a href="<?php echo base_url() . 'website/addEdit/' . $data['id']; ?>"><i class="fa fa-edit " data-toggle="tooltip" title="Edit" data-original-title="Edit"></i> </a>
                                                    |
                                                    <a href="javascript:;" data-src="<?php echo base_url() . 'website/delete/' . $data['id']; ?>"  title="Delete" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Website" data-message="All pages and space related data to this website will be deleted."><i class="fa fa-trash-o"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;


                                    ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%">Logo </th>
                                        <th width="20%">Website Name </th>
                                        <th width="30%">Website URL </th>
                                        <th width="25%">Unique ID </th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>
<script>
    $('#dynamic-table').DataTable( { 
	    "aoColumnDefs": [{ "bSortable": false, "aTargets": [5] }]
    });
</script>