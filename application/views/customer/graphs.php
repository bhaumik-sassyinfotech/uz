<br><br><br><br><br>
<head>
    <script type="text/javascript">
        //        alert('test');
        function call_barChart()
        {
            google.charts.load('current', {'packages': ['bar']});
            google.charts.setOnLoadCallback(barChart);
        }

        //bar chart
        function barChart()
        {
            var barChartData = <?php echo $barChartData; ?>;
            var data = new google.visualization.arrayToDataTable(barChartData);

            var options = {
                title: 'Chess opening moves1',
                legend: {position: 'none'},
                chart: {
                    title: 'Stats of whole plan',
//                    subtitle: 'popularity by percentage3'
                },
                bars: 'vertical', // Required for Material Bar Charts.//vertical//horizontal
                axes: {
                    x: {
                        0: {side: 'bottom', label: 'Date'} // Top x-axis.//top//bottom
                    },
                    y: {
                        0: {side: 'left', label: 'Clicks'}
                    }
                },
                bar: {groupWidth: "25%"}
            };

            var chart = new google.charts.Bar(document.getElementById('barchart'));
            chart.draw(data, options);
        }

        //line chart
        function call_lineChart()
        {
            google.charts.load('current', {'packages': ['line']});
            google.charts.setOnLoadCallback(lineChart);
        }

        function lineChart(lineChartData)
        {
            if (typeof lineChartData == 'undefined') {
                var lineChartData = <?php echo $lineChartData; ?>;
            }

            var data = new google.visualization.arrayToDataTable(lineChartData);
            var options =
                {
                    pointSize: 20,
                    chart: {
                        title: 'Advertisement visits on daily basis.',
                        subtitle: 'in visits per hour basis'
                    },
                    hAxis: {
                        viewWindow:
                        {
                            min: 0,
                            max: 25
                        },
                        ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23] // display labels every 25
//                        ticks: [1] // display labels every 25
                    },

                    axes: {
                        x: {
                            0: {side: 'bottom', label: 'Hours'}
                        },
                        y: {
                            0: {side: 'left', label: 'Visits'}
                        }
                    }
                };

            var chart = new google.charts.Line(document.getElementById('linechart'));

            chart.draw(data, google.charts.Line.convertOptions(options));
        }
    </script>
</head>
<br><br>
<div class="yangon-container">
    <div class="container graph">
        <div class="al-table">
            <div class="col-md-3 col-sm-3">
                <div class="al-table-col">
                    <?php $this->load->view('templates/customerSidebar'); ?>
                </div>
            </div>
            <div class="col-md-9 col-sm-9">
                <h1 style="padding-left: 15px;">My Advertisement</h1>
                <div class="back-button"><a href="<?php echo base_url('customer/advertisements');?>" class="btn-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></div>
                    <a href="#" type="button" class="banner-link" data-toggle="modal" data-target="#myModal">Banner Image</a>
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="info-list-tb" class="table info-list-tb table-bordered" width="100%" cellspacing="0">
                            <thead class="info-list-tb-head ">
                                <tr>
                                    <th class="info-list-tb-head-col">Date</th>
                                    <th class="info-list-tb-head-col">Hours</th>
                                    <th class="info-list-tb-head-col">Per hour Page</th>
                                    <th class="info-list-tb-head-col">Status</th>
                                </tr>
                            </thead>
                            <tbody class="info-list-tb-content-main ">
                            <?php
                            if(!empty( $exhausted ))
                            {
                                foreach ( $exhausted as $ads)
                                {
                                    ?>
                                    <tr class="">
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td"><?php echo $ads['booking_date'];?></div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td"><?php echo $ads['tot_hours']." hours (".$ads['slots'].")";?></div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td">
                                            <?php echo CURRENCY.$ads['tot_amount']; ?>
                                            </div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td" style="color: red">
                                                Exhausted
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if(!empty($live))
                            {
                                foreach ($live as $key => $ads)
                                {
                                    ?>
                                    <tr class="">
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td"><?php echo $ads['booking_date'];?></div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td"><?php echo $ads['tot_hours']." hours (".$ads['slots'].")";?></div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td">
                                                <?php echo CURRENCY.$ads['tot_amount']; ?>
                                            </div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td" style="color: #5ca712">
                                                Live
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if(!empty ($scheduled))
                            {
                                foreach ($scheduled  as $key => $ads)
                                {
                                    ?>
                                    <tr class="">
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td"><?php echo $ads['booking_date'];?></div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td"><?php echo $ads['tot_hours']." hours (".$ads['slots'].")"; ?></div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td">
                                                <?php echo CURRENCY.$ads['tot_amount']; ?>
                                            </div>
                                        </td>
                                        <td class="info-list-tb-content-col">
                                            <div class="info-list-tb-td" style="color: #000">
                                                Scheduled
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $bk_id; ?>" id="bk_id" name="bk_id" />
                <?php
                    if($chart_is_empty == TRUE)
                    {
                        ?>
                        <div class="col-md-6 col-sm-6 chart">
                            <div id="barchart">
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>No data found for bar chart.</strong>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 chart">
                            <div id="linechart">
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>No Data found for line chart.</strong>
                                </div>
                            </div>
                        </div>
                        <?php
                    } else
                    {
                        ?>
                        <div class="col-md-6 col-sm-6 chart">
                            <div id="barchart">
                                <script>
                                    call_barChart();
                                </script>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 chart">
                            <select name="linechart_date" id="linechart_date">
                                <option value="">Select Date</option>
                                <?php
                                foreach ($dropdown as $key => $val)
                                {
                                    echo '<option value="'.$val.'">'.$val.'</option>';
                                }
                                ?>
                            </select>
                            <div id="linechart">
                                <script>
                                    call_lineChart();
                                </script>
                            </div>
                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
<!--                <h4 class="modal-title">Booking Banner Image</h4>-->
            </div>
            <div class="modal-body">
                <?php
                    if (!empty($live))
                    {
                        ?>
                        <img src="<?php echo UPLOAD_URL_ROOT . "user_booking/" . $live[0]['booking_banner_image']; ?>" alt="banner image">
                        <?php
                    } else if (!empty($exhausted))
                    {
                        ?>
                        <img src="<?php echo UPLOAD_URL_ROOT . "user_booking/" . $exhausted[0]['booking_banner_image']; ?>" alt="banner image">
                        <?php
                    } else {
                        ?>
                        <img src="<?php echo UPLOAD_URL_ROOT . "user_booking/" . $scheduled[0]['booking_banner_image']; ?>" alt="banner image">
                        <?php
                    } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>


<script type="text/javascript">
    $("#linechart_date").change(function()
    {
        var id   = $('#bk_id').val();
        var dropdate = $("#linechart_date option:checked").val();

        var dataString = {'bk_id':id , 'date':dropdate};
        console.log(dataString);
        $.ajax({
            url: "<?php echo base_url().'customer/lineChart_ajax' ?>",
            type:"POST",
            data: dataString,
            success: function(result)
            {
                if(result){
//                    lineChart($.parseJSON(result));
                    lineChart($.parseJSON(result));
                    console.log(result);

                }

            }

    });

    });
</script>

