<?php
    header("Content-type: application/javascript");
//run some PHP and echo value into JS object code here



///php database >> get data >> print in containerid
//Javascript only >> no jquery
$ci = &get_instance();


$version=$_GET["v"];
$web=$_GET["webID"];
$spc=$_GET["spaceID"];

// echo $version."===".$web."===".$spc; //test
$today = date("Y-m-d");
if( $version == 1 )
{
    if( !empty($web) && !empty($spc) )
    {
        $query = $this->db->get_where('space' , array( 'space_unique_id' => $spc , 'is_deleted' => 0 ,  'status' => 1) );
        $spaceRes = $query->row_array();
        $query = $this->db->get_where( 'booking_ads_main' , array('space_id' => $spaceRes['id'] , 'payment_status' => 'Completed' , 'is_active' => 1 , 'is_deleted' => 0 ));
        $bm_res = $query->result_array();
        $data = array();
        $today = date("Y-m-d");
        $time = str_replace(":","",date("H:i"));
        foreach( $bm_res as $key => $val )
        {
            // $this->db->select('*');
            // $this->db->from('booking_ads_details');
            // $this->db->where('booking_date >= ');
            $query = $this->db->get_where('booking_ads_details' , array( 'booking_date' => $today , 'is_deleted' => 0 , 'booking_hours_from >= ' => $time , 'booking_hours_to <=' => $time   ));

            $data[$key] = $query->result_array();
        }
        echo "<br><br><pre>"; print_r($data);die;
    }
}


    ?>
alert('test');
var containerid = '<?php echo $_GET["container"]; ?>';
// document.write(img);
// document.write("<br>");
// document.write(name);
document.getElementById(containerid).innerHTML =img+'<br>'+name;
// $("#content").html('htmlsd');

// $(document).ready(function(){
//     function showRoom(){
//         $.ajax({
//             type:"GET",
//             url:"../test/db.php",
//             data:{action:id},
//             success:function(data){
//                 $("#"+containerid).html(data);
//                 // console.log(data);
//             }
//         });
//     }
//     showRoom();
// });

// alert(id);


