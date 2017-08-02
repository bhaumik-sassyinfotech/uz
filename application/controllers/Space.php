<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/15/2017
 * Time: 3:26 PM
 */
class Space extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'WebsiteModel' , 'website' );
        $this->load->model( 'SpaceModel'   , 'space' );
    }

    public function view($id)
    {
        $data['spaceData']     = $this->space->getSpaceByID($id);
        $data['salePriceData'] = $this->space->getSalePriceByID($id);

        $this->load->view('templates/header');
        $this->load->view('space/view',$data);
        $this->load->view('templates/footer');

    }

    public function getStates()
    {
        $name = $this->input->post('country');
        $data = $this->space->getState($name);
        $arr = array();
        foreach ($data as $d) {
            $arr[] = $d;
        }

        echo json_encode($arr);
    }

	
	public function showads(){	
		header("Content-type: application/javascript");	
		$version=$_GET["v"];		
		$web=$_GET["webID"];		
		$spc=$_GET["spaceID"];		
		$spaceRes['banner_height']='100';
		$spaceRes['banner_width']='100';
		$unitsize='%';
		//echo $version."===".$web."===".$spc; 		
		$today = date("Y-m-d");
	if( $version == 1 ){
		if( !empty($web) && !empty($spc) ){
			$unitsize='px';
			$query = $this->db->get_where('space' , array( 'space_unique_id' => $spc , 'is_deleted' => 0 ,  'status' => 1) );
			$spaceRes = $query->row_array();
			$banner_height = $spaceRes['banner_height'];
			$banner_width = $spaceRes['banner_width'];
			
			//echo $spaceRes['id'];
			//echo "<pre>";
			//print_r($spaceRes);
			/* $query = $this->db->get_where( 'booking_ads_main' , array('space_id' => $spaceRes['id'] , 'payment_status' => 'Completed' , 'is_active' => 1 , 'is_deleted' => 0 )); */
			
			
			$this->db->select('bkm.*,bkd.booking_date');
			$this->db->join('booking_ads_details bkd', 'bkd.bk_id = bkm.id' , 'left');
			$this->db->where('bkd.booking_date >=',date("Y-m-d"));
			
			$query = $this->db->get_where( 'booking_ads_main as bkm' , array('bkm.space_id' => $spaceRes['id'] , 'bkm.payment_status' => 'Completed' , 'bkm.is_active' => 1 , 'bkm.is_deleted' => 0 ));
			$bm_res = $query->result_array();
			//print_r( $bm_res);exit;
			
			$data = array();
			$today = date("Y-m-d");//"2017-07-13";//
			$time = str_replace(":","",date("H:i"));//"1450";//
			foreach( $bm_res as $key => $val ){
				//print_r($val);
				$query = $this->db->get_where('booking_ads_details' , array( 'bk_id'=>$val['id'],'booking_date' => $today , 'is_deleted' => 0 , 'booking_hours_from <= ' => $time , 'booking_hours_to >=' => $time   ));
				//echo $this->db->last_query();die;
				//$data[$key] = $query->result_array();
				$data = $query->row_array();
				if(!empty($data)){
					break;
				}
			}
			//echo "<br><br><pre>"; print_r($data);die;
				
				if(!empty($data)){
					$bk_query = $this->db->get_where( 'booking_ads_main' , array('id' => $data['bk_id']));
					$bkData = $bk_query->row_array();
					if(!empty($bkData)){
						//Add to view count data
						$viewData['bk_id'] = $data['bk_id'];
						$viewData['web_id'] = $spaceRes['website_id'];
						$viewData['space_id'] = $spaceRes['id'];
						$viewData['ip_address'] = $_SERVER['REMOTE_ADDR'];//'10.0.0.12';
						$viewData['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
						$viewData['views_count'] = 1;
						$viewData['view_date'] = date("Y-m-d H:i:s");
						$view_id = $this->db->insert('booking_ads_views', $viewData);
						
						echo "document.getElementById('upzurge".$spc."').innerHTML=\"<a href='".$bkData['booking_banner_url']."' target='_blank'><img style='width:100%' src='".base_url()."assets/uploads/user_booking/".$bkData['booking_banner_image']."' /></a>\";document.getElementById('upzurge".$spc."').style.width='".$banner_width."px';document.getElementById('upzurge".$spc."').style.height='".$banner_height."px';";
					}else{
						echo "document.getElementById('upzurge".$spc."').innerHTML=\"<div style='width:".$spaceRes['banner_width'].$unitsize.";height:".$spaceRes['banner_height'].$unitsize.";background-color:#ebebeb;padding:3%;color:#fa230f;'><h2>Visit upzurge to book this space</h2><a href='".base_url()."website/spaceDetails/".base64_encode($spaceRes['id'])."' target='_blank'>Click Here</a></div>\";";
					}
				}else{
					echo "document.getElementById('upzurge".$spc."').innerHTML=\"<div style='width:".$spaceRes['banner_width'].$unitsize.";height:".$spaceRes['banner_height'].$unitsize.";background-color:#ebebeb;padding:3%;color:#fa230f;'><h2>Visit upzurge to book this space</h2><a href='".base_url()."website/spaceDetails/".base64_encode($spaceRes['id'])."' target='_blank'>Click Here</a></div>\";";
				}
				
				/* if(!empty($bm_res)){
					echo "document.getElementById('upzurge".$spc."').innerHTML=\"<a href='".$bm_res[0]['booking_banner_url']."' target='_blank'><img style='width:100%' src='".base_url()."assets/uploads/user_booking/".$bm_res[0]['booking_banner_image']."' /></a>\";";
				}else{
					echo "document.getElementById('upzurge".$spc."').innerHTML=\"<div style='width:".$spaceRes['banner_width'].$unitsize.";height:".$spaceRes['banner_height'].$unitsize.";background-color:#ebebeb;padding:10%;color:#fa230f;'><h2>Visit upzurge to book this space</h2><br><a href='".base_url()."website/spaceDetails/".base64_encode($spaceRes['id'])."' target='_blank'>Click Here</a></div>\";";
				} */
			}else{
				echo "document.getElementById('upzurge".$spc."').innerHTML=\"<div style='width:".$spaceRes['banner_width'].$unitsize.";height:".$spaceRes['banner_height'].$unitsize.";background-color:#ebebeb;padding:3%;color:#fa230f;'><h2>Visit upzurge to book this space</h2><br><a href='".base_url()."website/spaceDetails/".base64_encode($spaceRes['id'])."' target='_blank'>Click Here</a></div>\";";
			}
		}else{
				echo "document.getElementById('upzurge".$spc."').innerHTML=\"<div style='width:".$spaceRes['banner_width'].$unitsize.";height:".$spaceRes['banner_height'].$unitsize.";background-color:#ebebeb;padding:3%;color:#fa230f;'><h2>Visit upzurge to book this space</h2><a href='".base_url()."website/spaceDetails/".base64_encode($spaceRes['id'])."' target='_blank'>Click Here</a></div>\";";
			}		
	}
    
}