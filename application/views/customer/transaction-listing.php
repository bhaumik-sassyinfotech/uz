<br><br><br><br><br>
<style>
    table tr th, td {text-align: center;}
</style>
<div class="container">
    <div class="al-table" id="advertisement">
        <div class="al-table-col col-md-3 col-sm-3 col-xs-12">
            <?php $this->load->view('templates/customerSidebar'); ?>
        </div>
        <div class="al-table-col col-md-9 col-sm-9 col-xs-12">
            <h1>Transaction Listing</h1>
            <div class="table-responsive web-info-list-main-table">
                <table class="table table-bordered table info-list-tb" id="info-list-tb" style="width: 100%">
                    <thead class="info-list-tb-head ">
                    <tr>
                        <th class="info-list-tb-head-col" style="padding:20px">ID</th>
                        <th class="info-list-tb-head-col" style="margin:20px 30px">Transaction ID</th>
                        <th class="info-list-tb-head-col">Website Name</th>
                        <th class="info-list-tb-head-col">Location Name</th>
                        <th class="info-list-tb-head-col">Total Days</th>
                        <th class="info-list-tb-head-col">Total Hours</th>
                        <th class="info-list-tb-head-col">Total (<?php echo CURRENCY; ?>)</th>
                        <th class="info-list-tb-head-col">Booking Date</th>
                        <th class="info-list-tb-head-col" style="padding: 20px 30px">Action</th>
                    </tr>
                    </thead>
                    <tbody class="info-list-tb-content-main ">

                    <?php
                    $i = 1;
                    //                             echo "<pre>"; print_r($transactionData);
                    foreach ($transactionData as $key => $trans) {
                        ?>
                        <tr>
                            <td class="info-list-tb-content-col" style="width: 5%"><?php echo $i++;
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo $trans['transaction_id'];
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo $trans['website_name'];
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo $trans['page'];
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo $trans['tot_days'];
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo $trans['tot_hours'];
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo $trans['total'];
                                ?></td>
                            <td class="info-list-tb-content-col"><?php echo date("Y/m/d H:i", strtotime($trans['created_date']));
                                ?></td>
                            <td class="info-list-tb-content-col">
                                <!--                                         View|Download PDF-->
                                <a style="margin-right: 10px" target="_blank" href="<?php echo base_url('customer/printTransaction/') . "view/" . $trans['bkID']; ?>"><i style="color: #000" class="fa fa-eye"  title="View" aria-hidden="true"></i></a>
                                |<a style="margin-left: 10px" href="<?php echo base_url('customer/printTransaction/') . "download/" . $trans['bkID']; ?>"><i style="color: #000" class="fa fa-download" title="Download" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>