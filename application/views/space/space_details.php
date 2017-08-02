<div class="main-content full">
    <div class="uz-wrap full web-info-page">
        <div class="Website-add-sec full">
            <div class="container-fluid">
                <div class="ad full">
                    <span class="adtext">WEBSITES</span>
                    <p>Choose Your Appropriate Type & Ad Spots</p>
                </div>

            </div>
        </div>

        <div class="uz-lp-black-strip full">
            <div class="container">
                <div class="black-strip-text full">
                    <p><span><?php echo $websiteData['website_name']; ?></span> - <?php echo $websiteData['short_description']; ?></p>

                </div>

            </div>
        </div>

		<!--Error Message-->
		<?php if($this->session->flashdata('bookingError')!=''){?>
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
		  <strong>Sorry!</strong> <?php echo $this->session->flashdata('bookingError');?>
		</div>
		<?php }?>
		
        <div class="banner-info-wrap full">
            <div class="banner-info-sec1 full">
                <div class="container">
                    <div class="banner-info-sec1-inner full">
                        <div class="banner-info-sec1-col">
                            <div class="banner-info-sec1-img">
                                <img src="<?php echo base_url() . 'timthumb/timthumb.php'; ?>?src=<?php echo UPLOAD_URL . 'space/' . $spaceData['image'] . '&h=420&w=540'; ?>" />
                            </div>
                        </div>
                        <div class="banner-info-sec1-col">
                            <div class="banner-info-sec1-info">
                                <div class="banner-info-sec1-info-hd full">
                                    <h2 class="title">
                                        <?php echo $spaceData['page']; ?>
                                    </h2>
                                    <h2 class="size">Banner Size: <span><?php echo $spaceData['banner_width']."x".$spaceData['banner_height']; ?></span></h2>

                                </div>
                                <div class="banner-info-sec1-info-content full">
                                    <div class="full info-content-up full">
                                        <p class="full"><?php echo $spaceData['description']; ?></p>
                                    </div>
                                    <div class="full info-content-bottom full">
                                        <div class="rates">
                                            <p>
                                                <span>Hourly Rate: </span>
                                                <span><?php echo CURRENCY;?><?php echo $spaceData['base_price_per_hour']; ?> </span>
                                            </p>
                                            <p>
                                                <span>Daily Rate:  </span>
                                                <span><?php echo CURRENCY;?><?php echo $spaceData['base_price_per_day']; ?></span>
                                            </p>

                                        </div>
										<?php
//										if (!empty($salePriceData) && count($salePriceData) > 0 )
										if( !empty($salePriceData) )
                                        {
                                            ?>
                                                <div class="info-content-btn special-price">
                                                    <button class="btn" data-toggle="modal" data-target="#specialPrices">
                                                        Check Special Offers
                                                    </button>
                                                </div>
                                            <?php
                                        }
										?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            
			<!--Bookings-->
			
			<div class="banner-info-sec2 full loader-container">
              <div class="container">
				<div class="loading" style="display: none;"><div class="content"><img src="<?php echo base_url().'assets/images/loader.gif'; ?>"/></div></div>
                    <div class="boooking-clnd">
                        <div class="tab-content">
                            <div id="bhour" class="tab-pane fade in active">
                                <div class="clnd-div full">
                                    <div class="clnd-div-col">
                                        <div class="cal1"></div>
                                    </div>
                                    <div class="clnd-div-col">
                                        <div class="hrs-avail full">
                                            <div class="hrs-avail-hd">
                                                <h2>Hours Availability</h2>
                                            </div>
                                            <div class="hrs-avail-content">
                                                <table id="hrs-avail-tb" class="table hrs-avail-tb" width="100%" cellspacing="0">
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
								</div>                                
                            </div>
                            
                        </div>
						
						<!--Booking-->
						<div class="day-selected full">
							<form name="book_ads_datetime" action="<?php echo base_url();?>website/book_ads_datetime" method="POST" class="book_ads_datetime_form">
							<!--booking hidden infos-->
							<input type="hidden" name="booking_web_id" id="booking_web_id" class="" value="<?php echo $WebId;?>"  class="" />
							<input type="hidden" name="booking_space_id" id="booking_space_id" class="" value="<?php echo $spaceID;?>"  class="" />
							<input type="hidden" name="booking_current_date" value="<?php echo date("Y-m-d");?>" id="booking_current_date" class="" />
							<input type="hidden" name="booking_space_rate_hourly"  id="booking_space_rate_hourly" class="" value="<?php echo $spaceData['base_price_per_hour']; ?>" />
							<input type="hidden" name="booking_space_rate_daily"  id="booking_space_rate_daily" class="" value="<?php echo $spaceData['base_price_per_day']; ?>" />
							<input type="hidden" name="booking_net_price" id="booking_net_price" class="" value="0" >
							
							
							<div class="day-selected-inner">
								<table id="hrs-avail-tb-data" class="table hrs-avail-tb" width="100%" cellspacing="0">
									<thead class="hrs-avail-tb-head ">
									<tr>
										<th class="hrs-avail-tb-head-col">Days Selected With Number Of Hours</th>
										<th class="hrs-avail-tb-head-col">Charge Per Hour / Day </th>
										<th class="hrs-avail-tb-head-col">Total Amount </th>

									</thead>
									<tbody id="booking_list" class="hrs-avail-tb-content-main ">
									
									<tr class="final_amount_col">
										<td class="hrs-avail-tb-content-col"></td>
										<td class="hrs-avail-tb-content-col">Total Net Price: </td>
										<td class="hrs-avail-tb-content-col"><?php echo CURRENCY;?><span id="final_net_price" class="net_price">0</span></td>
									</tr>
									<tr>
										<td colspan="3"><button type="submit" name="add_booking" id="add_booking_data" class="btn btn-default site-btn" disabled>Submit</button></td>
									</tr>
									<tr><td colspan="3"><span>* Special sale price will be applied if there will be any.</span></td></tr>
									</tbody>
								</table>
								
							</div>
								
						</form>
						</div>
						<!--Booking-->
						
                    </div>

                </div>

            </div>
			<!--Booking-->
        </div>

    </div>
</div>

<!--MODAL DIALOG-->

<div class="modal fade" id="specialPrices" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Sale Prices</h4>
            </div>
            <div class="modal-body">
                <table id="hrs-avail-tb-list" class="table hrs-avail-tb" width="100%" cellspacing="0">
                    <thead class="hrs-avail-tb-head ">
                    <tr>
                        <th class="hrs-avail-tb-head-col">Charge Per Hour</th>
                        <th class="hrs-avail-tb-head-col">Charge Per Day</th>
                        <th class="hrs-avail-tb-head-col">Start Date</th>
                        <th class="hrs-avail-tb-head-col">End Date</th>

                    </thead>
                    <tbody class="hrs-avail-tb-content-main ">
                    <?php
                        $date = strtotime(date("Y/m/d"));

                    foreach ($salePriceData as $sale) {
//                        if(strtotime($sale['end_date']) < $date)
//                        {
                            ?>
                            <tr class="">
                                <td class="hrs-avail-tb-content-col">
                                    <div class="hrs-avail-tb-td"><?php echo CURRENCY; ?><?php echo $sale['sale_price_per_hour']; ?></div>
                                </td>
                                <td class="hrs-avail-tb-content-col">
                                    <div class="hrs-avail-tb-td"><?php echo CURRENCY; ?><?php echo $sale['sale_price_per_day']; ?></div>
                                </td>
                                <td class="hrs-avail-tb-content-col">
                                    <div class="hrs-avail-tb-td"><?php echo date("Y/m/d" , strtotime($sale['start_date'])); ?></div>
                                </td>
                                <td class="hrs-avail-tb-content-col">
                                    <div class="hrs-avail-tb-td"><?php echo date("Y/m/d" , strtotime($sale['end_date'])); ?></div>
                                </td>

                            </tr>
                            <?php
//                        } // end foreach
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php 
$month_range = date("Y-m-d", strtotime(" +2 months"));
$calndr_sdate = date("Y-m-")."01";
$calndr_edate = date("Y-m-",strtotime($month_range)).date('t',strtotime($month_range));
?>

<script src="<?php echo JS_PATH; ?>jquery-dateFormat.js"></script>
<script type="text/javascript">

function get_ads_price_bydate(date,spaceid,current_time_slot){
	$.ajax({
			url: '<?php echo base_url('website/get_ads_price_info_bydate');?>',
			type: 'post',
			dataType: "json",
			async : false,
			data:'date='+date+'&spaceid='+spaceid+'&time_slot='+current_time_slot,
			beforeSend: function () {
				$('.loading').show();
			},
			success:function(data){
				//alert("hererere");
				if(data.result=='success'){
					$("#booking_space_rate_hourly").val(data.price_per_hour);
					$("#booking_space_rate_daily").val(data.price_per_day);
				}else{
					
				}
				$('.loading').fadeOut("slow");
			}
		});
}

function get_current_timeslot_bydate(date,spaceid){
	$.ajax({
			url: '<?php echo base_url('website/get_booking_slot_info_by_date');?>',
			type: 'post',
			//dataType: "json",
			async : false,
			data:'date='+date+'&spaceid='+spaceid,
			beforeSend: function () {
				$('.loading').show();
			},
			success:function(data){
				//alert("hererere");
				if(data){
					$('table#hrs-avail-tb').html(data);
				}
				var time_slot_date = $("#booking_current_date").val();
				var book_slot_date_id =  "time_"+time_slot_date.replace(/-/g, "");
				var booking_slots = $('#'+book_slot_date_id+' input').length;
				//alert(booking_slots);
				
				if(booking_slots > 0){
					$('#'+book_slot_date_id+' input').each(function(index) {
						// index has the count of the current iteration
						var book_slot_val = $(this).val();
						if(book_slot_val==2400){
							//alert('244');
							$('input:checkbox.time_slot_book').each(function () {
								   $(this).prop("checked","checked");
								   $(this).attr("disabled","disabled");
								   //var sThisVal = (this.checked ? $(this).val() : "");
							});
							$('input:checkbox.time_slot_book_day').removeAttr("disabled");
						}else{
							//alert("sss");
							$('input:checkbox.time_slot_book_day').attr("disabled","disabled");
						}
						$('table#hrs-avail-tb #parent_time_slot_'+book_slot_val).addClass('active');
						$('table#hrs-avail-tb input#time_slot_'+book_slot_val).attr('checked', 'checked');
						
						console.log( $(this).val() );
					});
				}
				$('.loading').fadeOut("slow");
			}
		});
}
get_current_timeslot_bydate('<?php echo date("Y-m-d");?>','<?php echo $spaceID;?>');

// Call this from the developer console and you can control both instances
var calendars = {};
$(window).load(function() {
	//store booking dates
	var eventMonthArray = [];
	
	// Here's some magic to make sure the dates are happening this month.
    var thisMonth = moment().format('YYYY-MM');
    // Events to load into calendar
    var eventArray = [
		<?php if(!empty($bookedDates)){
			foreach($bookedDates as $bookingdate){?>
				{
					date: '<?php echo $bookingdate;?>'
				},
		<?php }}?>
	];
	
    // The order of the click handlers is predictable. Direct click action
    // callbacks come first: click, nextMonth, previousMonth, nextYear,
    // previousYear, nextInterval, previousInterval, or today. Then
    // onMonthChange (if the month changed), inIntervalChange if the interval
    // has changed, and finally onYearChange (if the year changed).
    calendars.clndr1 = $('.cal1').clndr({
        events: eventArray,
		daysOfTheWeek: ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'],
        constraints: {
				startDate: '<?php echo $calndr_sdate;?>',
				endDate: '<?php echo $calndr_edate;?>'
			},
		classes: {
				today: "selected-date",
		},
		clickEvents: {
            click: function (target) {
                //alert(target.date);
				var book_date = target.date.format('YYYY-MM-DD');
				var book_spaceid = '<?php echo $spaceID;?>';
				//console.log(book_date);
               
				if (!$(target.element).hasClass('event') && !$(target.element).hasClass('past') && !$(target.element).hasClass('inactive')) {
					$('.cal1 .day').removeClass('selected-date');
					$(target.element).addClass('selected-date');
					$("#booking_current_date").val(book_date);
//					  alert(book_date);
					get_current_timeslot_bydate(book_date,book_spaceid);
					$("#hrs-avail-tb").show();
				}else{
					if($(target.element).hasClass('event')){
						alert("Whole day is booked on "+book_date+", please select other convenient date to publish your advertisement");
					}
					if($(target.element).hasClass('past')){
						alert("Can't book for past date!");
					}
					if($(target.element).hasClass('inactive')){
						alert("Can't book for inactive date!");
					}
					$("#hrs-avail-tb").hide();
				}
				
				if(target.events.length) {
					var selectedClass = '.date'+target.date.format('YYYY-MM-DD');
				}
				//console.log('Cal-1 clicked: ', target);
            },
            today: function () {
                //console.log('Cal-1 today');
            },
            nextMonth: function () {
                //console.log('Cal-1 next month');
            },
            previousMonth: function () {
                //console.log('Cal-1 previous month');
            },
            onMonthChange: function (month) {
				var current_month = month.format('MM');
				var current_year = month.format('YYYY');
				
				$('.loading').show();
				$("#booking_current_date").val('<?php echo date("Y-m-d");?>');
				$("#hrs-avail-tb").hide();
				
				$.each( eventMonthArray, function( key, value ) {
				  //alert( key + ": " + value );
				  $('.calendar-day-'+value).addClass('booked-hit-parse');
				});
				
				console.log('Cal-1 month changed');
				$('.loading').fadeOut("slow");
            },
            nextYear: function () {
                console.log('Cal-1 next year');
            },
            previousYear: function () {
                console.log('Cal-1 previous year');
            },
            onYearChange: function () {
                console.log('Cal-1 year changed');
            },
            nextInterval: function () {
                console.log('Cal-1 next interval');
            },
            previousInterval: function () {
                console.log('Cal-1 previous interval');
            },
            onIntervalChange: function () {
                console.log('Cal-1 interval changed');
            }
        },
        multiDayEvents: {
            singleDay: 'date',
            endDate: 'endDate',
            startDate: 'startDate'
        },
        showAdjacentMonths: true,//next/previous month dates visible on current month
        adjacentDaysChangeMonth: false //change the month of next or previous by date
    });
	
	var booked_hrs_tot = {}; 
	var booked_price_tot = {};
	var tot_booking_price = 0;
	
	$("table#hrs-avail-tb").on("click", ".time_slot_book", function() { 
		 var time_slot_val = $(this).val();
		 var space_id = $("#booking_space_id").val();
		 var time_slot_date = $("#booking_current_date").val();
		 var book_slot_date_id =  "time_"+time_slot_date.replace(/-/g, "");
		 var book_timeslot_id =  "time_"+time_slot_date.replace(/-/g, "")+time_slot_val;
		 
		 var booking_new_date = new Date(time_slot_date);
		 var booking_date_display = $.format.date(booking_new_date, "D MMM yyyy");
		 
		 //ajax call Update price value use ajax >> async : false,.
		 get_ads_price_bydate(time_slot_date,space_id,time_slot_val);
		 
		 var booking_slot_rate_hourly = $("#booking_space_rate_hourly").val();
		 var booking_slot_rate_daily = $("#booking_space_rate_daily").val();
		 var booking_net_price = $("#booking_net_price").val();
		 
		if ($(this).is(':checked')) {
			if(time_slot_val==2400){
				//alert(time_slot_val);
				var booking_price = booking_slot_rate_daily;
				
				$('input:checkbox.time_slot_book').each(function () {
					   $(this).prop("checked","checked");
					   $(this).attr("disabled","disabled");
				});
				$('input:checkbox.time_slot_book_day').removeAttr("disabled");
				
			}else{
				var booking_price = booking_slot_rate_hourly;
				$('input:checkbox.time_slot_book_day').attr("disabled","disabled");
			}
			
			
			$(this).parent().addClass('active');
			$('td.calendar-day-'+time_slot_date).addClass('booked-hit-parse');
			
			//price and hours calculations
			tot_booking_price = parseFloat(tot_booking_price) + parseFloat(booking_price);
			//alert(tot_booking_price);
			$("#final_net_price").html(tot_booking_price);
			
			//for booking slot tot time and price
			if(!(book_slot_date_id in booked_hrs_tot)){
				//alert('nooo');
				if(time_slot_val==2400){
					booked_hrs_tot[book_slot_date_id] = 24;
				}else{
					booked_hrs_tot[book_slot_date_id] = 1;
				}
				//add price for time slot
				booked_price_tot[book_slot_date_id] = booking_price;
			}else{
				if(time_slot_val==2400){
					booked_hrs_tot[book_slot_date_id] = 24;
				}else{
					booked_hrs_tot[book_slot_date_id] = booked_hrs_tot[book_slot_date_id]+1;
				}
				//add price for time slot
				booked_price_tot[book_slot_date_id] = parseFloat(booked_price_tot[book_slot_date_id]) + parseFloat(booking_price);
			}
			
			var booking_slot_data = '<tr id="'+book_slot_date_id+'" class=""><td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td">'+booking_date_display+' (<span id="booked_hrs_tot_'+book_slot_date_id+'">'+booked_hrs_tot[book_slot_date_id]+'</span> Hours)</div></td><td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><?php echo CURRENCY;?>'+booking_price+'</div></td><td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td" ><?php echo CURRENCY;?><span id="tot_slot_amount_'+book_slot_date_id+'">'+booked_price_tot[book_slot_date_id]+'</span></div></td><input type="hidden" name="booking_time_slot['+time_slot_date+'][]" id="'+book_timeslot_id+'" value="'+time_slot_val+'" class="booking_time_slot"></tr>';
			
			if ( $( "#"+book_slot_date_id ).length ) {
				$( "#"+book_slot_date_id ).append('<input type="hidden" name="booking_time_slot['+time_slot_date+'][]" id="'+book_timeslot_id+'" value="'+time_slot_val+'" class="booking_time_slot">');
			}else{
				$('#booking_list .final_amount_col').before(booking_slot_data);
				eventMonthArray.push(time_slot_date);
			}
			//Update Price tot
			$("#booked_hrs_tot_"+book_slot_date_id).text(booked_hrs_tot[book_slot_date_id]);
			$("#tot_slot_amount_"+book_slot_date_id).text(booked_price_tot[book_slot_date_id]);
			$("#booking_net_price").val(tot_booking_price);
			
		} else {
			//alert("not checked");
			
			if(time_slot_val==2400){
				//alert(time_slot_val);
				var booking_price = booking_slot_rate_daily;
				$('input:checkbox.time_slot_book').each(function () {
				   //alert("ssss");
				   $(this).removeAttr("disabled");
				   $(this).removeAttr("checked");
				   //var sThisVal = (this.checked ? $(this).val() : "");
				});
			}else{
				var booking_price = booking_slot_rate_hourly;
			}
			
			$(this).parent().removeClass('active');
			
			
			//price and hours calculations
			tot_booking_price = parseFloat(tot_booking_price) - parseFloat(booking_price);
			$("#final_net_price").html(tot_booking_price);
			
			//for booking slot tot time and price
			if(time_slot_val==2400){
				booked_hrs_tot[book_slot_date_id] = 0;
			}else{
				booked_hrs_tot[book_slot_date_id] = booked_hrs_tot[book_slot_date_id]-1;
			}
			//alert(booked_hrs_tot[book_slot_date_id]);
			
			//remove price for time slot
			booked_price_tot[book_slot_date_id] = parseFloat(booked_price_tot[book_slot_date_id]) - parseFloat(booking_price);
			
			var tot_booking_slot = $( "#"+book_slot_date_id+" .booking_time_slot" ).length;
			//alert(tot_booking_slot);	
			
			if ( tot_booking_slot > 1 ) {
				$("#"+book_timeslot_id).remove();
			}else{
				$("#"+book_slot_date_id).remove();
				$('td.calendar-day-'+time_slot_date).removeClass('booked-hit-parse');
				//eventMonthArray.remove(time_slot_date);
				eventMonthArray.splice( $.inArray(time_slot_date, eventMonthArray), 1 );
				
				$('input:checkbox.time_slot_book_day').removeAttr("disabled");
			}
			//Update Price tot
			$("#booked_hrs_tot_"+book_slot_date_id).text(booked_hrs_tot[book_slot_date_id]);
			$("#tot_slot_amount_"+book_slot_date_id).text(booked_price_tot[book_slot_date_id]);
			$("#booking_net_price").val(tot_booking_price);
		}
		 
		//add_booking_data enabled /disabled 
		if(tot_booking_price > 0){
			$("#add_booking_data").prop("disabled", false); 
		}else{
			$("#add_booking_data").prop("disabled", true);
		} 
		 
	});
	
});	
</script>