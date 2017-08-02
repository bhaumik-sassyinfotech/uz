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

<?php if ($this->session->flashdata('addUpdMsg') != '') { ?>
    <div class="alert alert-success" id="add_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('addUpdMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('DeleteSuccMsg') != '') { ?>
    <div class="alert alert-success" id="del_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('DeleteSuccMsg') . '</h6>'; ?>
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
						<a href="<?php echo base_url('client_testimonial/addEdit'); ?>" id="editable-sample_new" class="btn btn-primary">Add New <i class="fa fa-plus"></i></a>                    
				   </div>
                </header>
                <div class="panel-body">
                                       <div class="adv-table table-responsive">
                        <form name="cmsListForm" id="cmsListForm">
                            <table  class="display table table-bordered table-striped icon-color-blk drag-row" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="15%">Full Name </th>
                                        <th width="25%">Place </th>
                                        <th width="25%">Description </th>
                                        <th width="10%">Is View </th>
                                        <th width="10%">Edit</th>
                                    </tr>
                                </thead>

                                <tbody class="drag-body">
                                    <?php
                                    $totalData = count($client_testimonialData);
                                    $i = 1;
                                    foreach ($client_testimonialData as $data):
                                        ?>
                                        <tr>
                                          
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo $data['place']; ?></td>
                                            <td>
												<?php 
													echo substr($data['description'],0,19);
													$chklen = strlen($data['description']);
													if($chklen > 20){echo '...';}
												?>
											</td>
                                            <td>
												<?php
													if($data['is_view'] == 0){
														echo "No";
													}else{
														echo "Yes";
													}
												?>
											</td>
                                            <td width="12%">
                                                <div>
                                                    <a href="<?php echo base_url() . 'client_testimonial/addEdit/' . $data['id']; ?>"><i class="fa fa-edit tooltips" data-trigger="hover" data-toggle="tooltip" title="" data-original-title="Edit"></i> </a>
                                                    |
                                                    <a href="javascript:;" data-src="<?php echo base_url() . 'client_testimonial/delete/' . $data['id']; ?>"  title="Delete" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Client Testimonial" data-message="Are you sure you want to delete this Client testimonial ?"><i class="fa fa-trash-o"></i></a>
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
                                        <th width="15%">Full Name </th>
                                        <th width="25%">Place </th>
                                        <th width="25%">Description </th>
                                        <th width="10%">Is View </th>
                                        <th width="10%">Edit</th>
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