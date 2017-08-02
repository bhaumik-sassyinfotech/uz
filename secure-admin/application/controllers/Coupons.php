<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Coupons extends CI_Controller
{
	function __construct(){
		parent::__construct();
		
		$this->load->model('coupons_model','coupon');
		$this->load->model('utility_model','utilityModel');
	}
	public function index(){
		$data['Module'] = "Coupon"; 
		$data['configData'] = $this->utilityModel->getConfigData();
		$data['couponData'] = $this->coupon->getData();
		
		$this->load->view('templates/header',$data);
		$this->load->view('coupon/view',$data);
		$this->load->view('templates/footer',$data);
	}
	public function view()
	{
		$data['configData'] = $this->utilityModel->getConfigData();
		$data['action'] = "view";
		$data['Module'] = "Coupon"; 
		$coupon_id = $this->uri->segment(3);
		$data['couponData'] = $this->coupon->getDataByID($coupon_id);
		
		$this->load->view('templates/header',$data);
		$this->load->view('coupon/addedit',$data);
		$this->load->view('templates/footer',$data);
	}
	public function edit()
	{
		$data['action'] = "edit";
		$data['Module'] = "Coupon"; 
		$coupon_id = $this->uri->segment(3);
		$data['couponData']	= $this->coupon->getDataByID($coupon_id);
		$data['configData'] = $this->utilityModel->getConfigData();
		
		$this->load->view('templates/header',$data);
		$this->load->view('coupon/addedit',$data);
		$this->load->view('templates/footer',$data);
	}
	public function delete()
	{
		$coupon_id = $this->uri->segment(3);
		$this->coupon->delete($coupon_id);
		$this->session->set_flashdata('DeleteSuccMsg','Coupon has been deleted successfully.');
		redirect( base_url().'coupons');
	}
	function add()
	{
		$data['action'] = "add";
		$data['Module'] = "Coupon";
		$data['configData']		= $this->utilityModel->getConfigData();
				
		$this->load->view('templates/header',$data);
		$this->load->view('coupon/addedit',$data);
		$this->load->view('templates/footer',$data);
	}
	
	function addedit()
	{ 
		$data['configData'] =  $this->utilityModel->getConfigData();
		$action 			=  $this->input->post('action');
		$coupon_name		=  $this->input->post('coupon_name');
		$coupon_code		=  $this->input->post('coupon_code');
		$coupon_startdate	=  $this->mysqlDate($this->input->post('coupon_startdate'));
		$coupon_enddate		=  $this->mysqlDate($this->input->post('coupon_enddate'));
		$coupon_discount	=  $this->input->post('coupon_discount');
		$coupon_description	=  $this->input->post('coupon_description');
		$coupon_limit		=  $this->input->post('coupon_limit');
		$coupon_status		=  $this->input->post('coupon_status');
		$coupon_type		=  $this->input->post('coupon_type');
										
		if( $action == "add" )
		{	
//			$coupon_created_by	=  $this->session->userdata('a_user_id');
            $coupon_created_by =  $this->session->userdata('admin_id');
			$data = array(
				'coupon_id'	 			=> '',
				'coupon_name'			=> $coupon_name,
				'coupon_code'			=> $coupon_code,
				'coupon_startdate'		=> $coupon_startdate,
				'coupon_enddate'		=> $coupon_enddate,
				'coupon_discount'		=> $coupon_discount,
				'coupon_description'	=> $coupon_description,
				'coupon_limit'			=> $coupon_limit,
				'coupon_limit_remain'	=> $coupon_limit,
				'coupon_status'			=> $coupon_status,
				'coupon_type'			=> $coupon_type,
				'coupon_created_by'		=> $coupon_created_by,
				'coupon_is_deleted'		=> 'false'
			);
							
			$this->coupon->insert($data);
			$insert_coupon_id = $this->db->insert_id();
		
			$data = array(
							'coupon_order'		=>  $insert_coupon_id
						);
		
			$this->coupon->update($insert_coupon_id,$data);
		
			$this->session->set_flashdata('AddSuccMsg','Coupon has been added successfully.');
			redirect( base_url().'coupons');
		}
		elseif ( $action == "edit" )
		{
			$coupon_id	= $this->input->post('coupon_id');
						
			$data = array(
						'coupon_name'			=> $coupon_name,
						'coupon_code'			=> $coupon_code,
						'coupon_startdate'		=> $coupon_startdate,
						'coupon_enddate'		=> $coupon_enddate,
						'coupon_discount'		=> $coupon_discount,
						'coupon_description'	=> $coupon_description,
						'coupon_limit'			=> $coupon_limit,
						'coupon_status'			=> $coupon_status,
						'coupon_type'			=> $this->input->post('old_coupon_type'),
						'coupon_is_deleted'		=> 'false'
					);
			
			$this->coupon->update($coupon_id,$data);
			$this->session->set_flashdata('EditSuccMsg','Coupon has been updated successfully.');
			redirect( base_url().'coupons');
		}		
		
		$data['Module'] = "Coupon"; 
		$data['couponData'] = $this->coupon->getData();
		$this->load->view('templates/header',$data);
		$this->load->view('coupon/view',$data);
		$this->load->view('templates/footer',$data);
	}
	
	function checkCode()
	{
		$coupon_code	= $this->input->post('id');
		$this->db->where('coupon_code',$coupon_code);
		$this->db->where('coupon_is_deleted','false');
		$q		= $this->db->get('coupon_details');
		
		if($q->num_rows() > 0)
		{
			echo "Code already exist.";
		}
	}
	
	public function mysqlDate($date) 
	{
	    list($d,$m,$y)=explode("-",$date);
	    		
		$dt=$y."-".$m."-".$d;
		if ($dt=='--')	$dt = "0000-00-00" ;

		return $dt;  // Return format yyyy-mm-dd  Database format Y-m-d
	}
	
	public function sortdata()
	{
		$post_data = $_POST['oldorder'];
		
		foreach( $post_data as $key=>$value )
		{
			$data = array(
						'coupon_order'	=> 	$value,
					);
		
			$this->coupon->update($key,$data);
		}
		echo json_encode("Success");
		exit;
	}
}
