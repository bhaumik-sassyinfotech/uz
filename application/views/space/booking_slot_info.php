<tbody class="hrs-avail-tb-content-main ">
<?php 
	$current_date = date("Y-m-d");
	$current_time = date("H")."00";
	
	$time_slot = array('0000'=>'00:00 - 01:00','0100'=>'01:00 - 02:00','0200'=>'02:00 - 03:00','0300'=>'03:00 - 04:00','0400'=>'04:00 - 05:00','0500'=>'05:00 - 06:00','0600'=>'06:00 - 07:00','0700'=>'07:00 - 08:00','0800'=>'08:00 - 09:00','0900'=>'09:00 - 10:00','1000'=>'10:00 - 11:00','1100'=>'11:00 - 12:00','1200'=>'12:00 - 13:00','1300'=>'13:00 - 14:00','1400'=>'14:00 - 15:00','1500'=>'15:00 - 16:00','1600'=>'16:00 - 17:00','1700'=>'17:00 - 18:00','1800'=>'18:00 - 19:00','1900'=>'19:00 - 20:00','2000'=>'20:00 - 21:00','2100'=>'21:00 - 22:00','2200'=>'22:00 - 23:00','2300'=>'23:00 - 00:00');
	//print_r($time_slot);
	$ti=1;
	foreach($time_slot as $key=>$val){  
		if(count($bookingData)==1 && $bookingData[0]==24){
			$class = "disable";
			$chek_class = "disabled";
		}else{
			if(in_array($key,$bookingData)){
				$class = "disable";
				$chek_class = "disabled";
			}else{
				$class="";//active
				$chek_class = "";//checked
			}
			//default case for running time and date.
			if($current_time >= $key && $check_date==$current_date){
				$class = "disable";
				$chek_class = "disabled";
			}	
		}
		if($ti % 4 == 1){?>
		<tr class="">
		<?php }?>
		<td class="hrs-avail-tb-content-col">
			<div class="hrs-avail-tb-td">
				<a id="parent_time_slot_<?php echo $key;?>" href="javascript:void(0);" class="btn site-btn <?php echo $class;?>"><?php echo $val;?>
					<input type="checkbox" name="time_slot[]" value="<?php echo $key;?>" id="time_slot_<?php echo $key;?>" class="time_slot_book" <?php echo $chek_class;?> />
				</a>
			</div>
		</td>
		<?php if($ti % 4 == 0){?>
		</tr>
		<?php }?>
	<?php $ti++;}?>

<?php 

//allow to book for day
if(empty($bookingData) && $check_date!=$current_date){?>
<tr class="">
	<td class="hrs-avail-tb-content-col">
		<div class="hrs-avail-tb-td">
			<a id="parent_time_slot_2400" href="javascript:void(0);" class="btn site-btn">book for day
				<input type="checkbox" name="time_slot[]" value="2400" id="time_slot_2400" class="time_slot_book time_slot_book_day"/>
			</a>
		</div>
	</td>
</tr>
<?php }?>
	
<!--<tr class="">
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">00:00 - 01:00<input type="checkbox" name="time_slot[]" value="0000" id="time_slot_1" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">01:00 - 02:00<input type="checkbox" name="time_slot[]" value="0100" id="time_slot_2" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">02:00 - 03:00<input type="checkbox" name="time_slot[]" value="0200" id="time_slot_3" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">03:00 - 04:00<input type="checkbox" name="time_slot[]" value="0300" id="time_slot_4" class="time_slot" /></a></div></td>

</tr>
<tr class="">
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">04:00 - 05:00<input type="checkbox" name="time_slot[]" value="0400" id="time_slot_5" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn disable">05:00 - 06:00<input type="checkbox" name="time_slot[]" value="0500" id="time_slot_6" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn disable">06:00 - 07:00<input type="checkbox" name="time_slot[]" value="0600" id="time_slot_7" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn disable">07:00 - 08:00<input type="checkbox" name="time_slot[]" value="0700" id="time_slot_8" class="time_slot" /></a></div></td>

</tr>
<tr class="">
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">08:00 - 09:00<input type="checkbox" name="time_slot[]" value="0800" id="time_slot_9" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">09:00 - 10:00<input type="checkbox" name="time_slot[]" value="0900" id="time_slot_10" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">10:00 - 11:00<input type="checkbox" name="time_slot[]" value="1000" id="time_slot_11" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">11:00 - 12:00<input type="checkbox" name="time_slot[]" value="1100" id="time_slot_12" class="time_slot" /></a></div></td>

</tr>
<tr class="">
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">12:00 - 13:00<input type="checkbox" name="time_slot[]" value="1200" id="time_slot_13" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn active">13:00 - 14:00<input type="checkbox" name="time_slot[]" value="1300" id="time_slot_14" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn active">14:00 - 15:00<input type="checkbox" name="time_slot[]" value="1400" id="time_slot_15" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn active">15:00 - 16:00<input type="checkbox" name="time_slot[]" value="1500" id="time_slot_16" class="time_slot" /></a></div></td>

</tr>
<tr class="">
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn active">16:00 - 17:00<input type="checkbox" name="time_slot[]" value="1600" id="time_slot_17" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">17:00 - 18:00<input type="checkbox" name="time_slot[]" value="1700" id="time_slot_18" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">18:00 - 19:00<input type="checkbox" name="time_slot[]" value="1800" id="time_slot_19" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">19:00 - 20:00<input type="checkbox" name="time_slot[]" value="1900" id="time_slot_20" class="time_slot" /></a></div></td>

</tr>
<tr class="">
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">20:00 - 21:00<input type="checkbox" name="time_slot[]" value="2000" id="time_slot_21" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">21:00 - 22:00<input type="checkbox" name="time_slot[]" value="2100" id="time_slot_22" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">22:00 - 23:00<input type="checkbox" name="time_slot[]" value="2200" id="time_slot_23" class="time_slot" /></a></div></td>
	<td class="hrs-avail-tb-content-col"><div class="hrs-avail-tb-td"><a href="javascript:void(0);" class="btn site-btn ">23:00 - 24:00<input type="checkbox" name="time_slot[]" value="2300" id="time_slot_24" class="time_slot" /></a></div></td>

</tr>-->
</tbody>