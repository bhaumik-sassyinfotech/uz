<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>
        </li>
        <li class="active"> View <?php echo $module; ?> </li>
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
                    View <?php echo $module; ?> Details
                </header>
                <div class="panel-body">
					<div class="adv-table table-responsive">
                        <form name="cmsListForm" id="cmsListForm">
                            <table  class="display table table-bordered table-striped icon-color-blk drag-row" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name </th>
                                        <th>Subject </th>
                                        <th>Message</th>
                                        <th>View</th>
                                    </tr>
                                </thead>

                                <tbody class="drag-body">
                                    <?php
                                    $i = 1;
                                    foreach ($enqData as $data):
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo $data['subject']; ?></td>
                                            <td><?php
                                                echo substr($data['message'],0,25);
                                                $chklen = strlen($data['message']);
                                                if($chklen > 26){echo '...';}
                                                 ?></td>
                                            <td><a href="<?php echo base_url('enquiries/enquiryDetail')."/". $data['id']; ?>"><i class="fa fa-eye" data-toggle="tooltip" title="View Info" data-original-title="view"></i></a></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    endforeach;
                                    ?>
                                </tbody>
                                
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name </th>
                                        <th>Subject </th>
                                        <th>Message</th>
                                        <th>View</th>
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
	"aoColumnDefs": [{ "bSortable": false, "aTargets": [4] }]   
    });                            
</script> 
<script type="text/javascript">
	/*function become_details ( oTable, nTr ){
		var aData = oTable.fnGetData( nTr );
		var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
		sOut += '<tr><td>Personal Statement:</td><td>'+aData[5]+'</td></tr>';
		sOut += '<tr><td>Experience:</td><td>'+aData[6]+'</td></tr>';
		sOut += '<tr><td>Looking For:</td><td>'+aData[7]+'</td></tr>';
		sOut += '<tr><td>Interest:</td><td>'+aData[8]+'</td></tr>';
		sOut += '<tr><td>Function:</td><td>'+aData[9]+'</td></tr>';
		sOut += '<tr><td>Message:</td><td>'+aData[10]+'</td></tr>';
		sOut += '</table>';
		return sOut;

	}
	jQuery(document).ready(function(){
		

		//Insert a 'details' column to the table

		

		var nCloneTh = document.createElement( 'th' );

		var nCloneTd = document.createElement( 'td' );

		nCloneTd.innerHTML = "<img src='"+IMAGE_URL+"details_open.png'>";

		nCloneTd.className = "center";



		$('#become_mentor thead tr').each( function () {

			this.insertBefore( nCloneTh, this.childNodes[0] );

		} );



		$('#become_mentor tbody tr').each( function () {

			this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );

		} );



		

		//Initialse DataTables, with no sorting on the 'details' column

		

		var oTable = $('#become_mentor').dataTable( {

			"aoColumnDefs": [

				{ "bSortable": false, "aTargets": [ 0 ] }

			],

			"aaSorting": [[1, 'asc']]

		});



		// Add event listener for opening and closing details

		 // Note that the indicator for showing which row is open is not controlled by DataTables,

		// rather it is done here

		 

		$(document).on('click','#become_mentor tbody td img',function () {

			var nTr = $(this).parents('tr')[0];

			if ( oTable.fnIsOpen(nTr) )

			{

				// This row is already open - close it //

				this.src = IMAGE_URL+"details_open.png";

				oTable.fnClose( nTr );

			}

			else

			{

				//Open this row //

				this.src = IMAGE_URL+"details_close.png";

				oTable.fnOpen( nTr, become_details(oTable, nTr), 'details' );

			}

		} );
	});*/
	
</script>
