<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
        <li class="active"> View <?php echo $Module; ?> </li>
    </ul>
</div>
<?php
if ($this->session->flashdata('addUpdMsg') != '') { ?>
    <div class="alert alert-success" id="add_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('addUpdMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('DeleteSuccMsg') != '') { ?>
    <div class="alert alert-success" id="del_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('DeleteSuccMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<!-- page heading end--><!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <section class="panel">
                <header class="panel-heading pd-btm-25px">
                    View <?php
                    echo $Module; ?> Detail
                </header>
                <div class="panel-body">
                    <div class="adv-table table-responsive">
                        <form name="userListForm" id="userListForm">
                            <table class="display table table-bordered table-striped icon-color-blk drag-row" id="dynamic-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody class="drag-body">
                                <?php
                                $totalData = count($dataList);

                                if (!empty($dataList)) {
                                    foreach ($dataList as $key => $data) { ?>
                                        <tr>
                                            <td width="9%"><?php echo $key + 1; ?></td>
                                            <td><?php echo $data['first_name'] . " " . $data['last_name']; ?></td>
                                            <td><?php echo $data['email']; ?></td>
                                            <td><?php echo $data['mobile_no']; ?></td>
                                            <th>
                                                <?php $status = $data['status'];

                                                    if ($status == 0)
                                                    {
                                                        $class = "label label-warning";
                                                        $msg = "INACTIVE";
                                                    }
                                                    else if ( $status == 1 )
                                                    {
                                                        $class = "label label-success";
                                                        $msg = "ACTIVE";
                                                    }
                                                    ?>
                                                <span class="<?php echo $class; ?>"> <?php echo $msg; ?></span>
                                            </th>
                                            <td width="11%">
                                                <div>
                                                    <a href="<?php echo base_url() . 'customer/edit/' . $data['uid']; ?>" title="Edit"><i class="fa fa-edit" data-trigger="hover" data-toggle="tooltip" data-original-title="Edit"></i> </a>
                                                    <!--|
                                                    <a href="javascript:;" data-src="<?php echo base_url() . 'users/delete/' . $data['user_id']; ?>" title="Delete" type="button" data-toggle="modal" data-target="#confirmDelete"
                                                       data-title="Delete User" data-message="Are you sure you want to delete this user?"><i class="fa fa-trash-o"></i></a>-->
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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
<!--body wrapper end-->
<script>
    $('#dynamic-table').DataTable({
        "aoColumnDefs": [{"bSortable": false, "aTargets": [5]}]
    });
</script> 