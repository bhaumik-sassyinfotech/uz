<?php
ini_set('max_execution_time', 0);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Space extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('space_model', 'space');
        $this->load->model('website_model', 'website');
    }

    public function index()
    {
        $data['Module'] = "Space";
        $data['websiteData'] = $this->website->getData();
        $data['spaceData'] = $this->space->getData();
        $data['saleData'] = $this->space->getSalePriceData();
        //        echo "<pre>";print_r($data);die();


        $this->load->view('templates/header', $data);
        $this->load->view('space/view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->space->delete($id);
        $this->session->set_flashdata('spaceDeleteSuccMsg', 'Space has been deleted successfully.');
        redirect(base_url() . 'space');
    }

    public function deleteSalePrice()
    {
        $id = $this->input->post('id');
        $this->space->deleteSalePriceByID($id);
        //        return $id;
    }

    public function getPageList()
    {
        $id = $this->input->post('id');

        $data = $this->space->getPageListByID($id);

        $arr = array();
        foreach ($data as $d) {
            $arr[] = $d;
        }

        echo json_encode($arr);
        //        return $data;
        //        echo "<pre>".print_r($data);

    }
//    function get_duplicates($array)
//    {
//        return array_unique(array_diff_assoc($array, array_unique($array)));
//        //        return array_unique(array_unique($array));
//    }
    function duplicates($array)
    {
        // true  => contains duplicates
        // false => no duplicates
        return count($array) !== count(array_unique($array));
    }

//    function checkSalesPriceOverlap( $start , $end , $webID , $pageID , $space=NULL )
//    {
//
//        //check end date > start date
//        foreach ( $start as $key => $val )
//        {
//            $start[$key] = strtotime($val);
//        }
//        foreach ( $end as $key => $val )
//        {
//            $end[$key] = strtotime($val);
//        }
//        if( count($start) > 1)
//        {
//            for ($i = 0; $i < count($start); $i++)
//            {
//                if ($start[$i] < $end[$i])
//                {
//                    for ($j = 0; $j < count($end); $j++)
//                    {
//                        if ($start[$i] === $start[$j] || $end[$i] === $end[$j])
//                        {
//                            echo $start[$i] . "=> End: " . $end[$i];
//                            echo "<br>" . "Exit";
//                            $flag = 0;
//                            return $flag;
//                            break;
//                        } else
//                        {
//                            $flag = 1;
//                        }
//                    }
//                } else
//                {
//                    //times overlap
//                    $flag = 0;
//                    return $flag;
//                    break;
//                }
//            }
//            return $flag;
//        } else
//        { // simply check for start date < end date
//
//        }
//
//    }
    function overLap( $start=NULL , $end=NULL , $edit_start=NULL , $edit_end=NULL )
    {

        $start_count      = count($start);
        $end_count        = count($end);
        $edit_start_count = count($edit_start);
        $edit_end_count   = count($edit_end);

        $startMerged = array();
        $endMerged   = array();
        $count = $start_count + $edit_start_count;

        for( $i=0; $i<($count); $i++ )
        {

            if( !empty($edit_start) && !empty($edit_end) && !empty($start) && !empty($end) )
            {
//                echo "if condn";
                $startMerged[$i] = strtotime($start[$i]);
                $endMerged[$i]   = strtotime($end[$i]);
                $startMerged[$i+$edit_start_count] = strtotime($edit_start[$i]);
                $endMerged[$i+$edit_start_count]   = strtotime($edit_end[$i]);
            } elseif ( !empty($start) && !empty($end) )
            {
//                echo "else condition";
                $startMerged[$i] = strtotime($start[$i]);
                $endMerged[$i]   = strtotime($end[$i]);
            } elseif ( !empty($edit_start) && !empty($edit_end) )
            {
                $startMerged[$i] = strtotime($edit_start[$i]);
                $endMerged[$i]   = strtotime($edit_end[$i]);
            }
            $is_overlap="FALSE";
            if( count($startMerged) > 1)
            {
                for ($i = 0; $i < count($startMerged); $i++)
                {
                    if ($startMerged[$i] < $endMerged[$i])
                    {
                        for ($j = 1; $j < count($endMerged); $j++)
                        {
                            //($endMerged[$i] > $startMerged[$j])
                            if ( ($startMerged[$i] === $startMerged[$j]) || ($endMerged[$i] === $endMerged[$j]) || ($startMerged[$i] >= $startMerged[$j] && $startMerged[$i] <= $endMerged[$j])  || ($startMerged[$j] >= $startMerged[$i] && $startMerged[$j] <= $endMerged[$i]) )
                            {
//                                echo $startMerged[$i] . "=> End: " . $endMerged[$i];
//                                echo "nested if overlap found";
                                $is_overlap = "TRUE";
//                                return $flag;
                                break;
                            } else
                            {
                                $is_overlap = "FALSE";
                            }
                        }
                    } else
                    {
                        //times overlap
                        $is_overlap = "TRUE";
//                        return $flag;
                        break;
                    }
                }
            } else
            { // simply check for start date < end date
                if( $startMerged[0] < $endMerged[0] )
                {
                    $is_overlap = "FALSE";
//                    return $flag;
                } else
                {
                    $is_overlap = "TRUE";
//                    return $flag;
                    break;
                }
            }
//            echo "<br> <br>overlap = ".$is_overlap;
        }
        return $is_overlap;

//        echo "<pre>"; print_r($startMerged);
//        echo "<br><hr><pre>"; print_r($endMerged);die;
    }


    function addedit($id = 0)
    {
        $data = array();
		$checkRange = 0;
		
        if ($id)
        {
            $salePriceData = $this->space->getSalePriceDataByID($id);
            $spaceData = $this->space->getDataByID($id);
            $web_id = $spaceData['website_id'];
			$pageData = $this->space->getPageListByID($web_id);

                       // echo "<pre>"; print_r($pageData);die;
            if (!empty($spaceData OR $salePriceData OR $pageData))
            {
                $data['spaceData'] = $spaceData;
                $data['salePriceData'] = $salePriceData;
                $data['pageData'] = $pageData;
            } else
                redirect('space');
            $data['action'] = "edit";
        } else
        {
            $data['action'] = "add";
        }

        if ($this->input->post())
        {
            $this->form_validation->set_rules('website_id', 'Website Name', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('page', 'Page', 'trim|required|max_length[100]');
            $this->form_validation->set_rules('website_url', 'Website URL', 'trim|required|valid_url');
            $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('base_price_per_day', 'Base Price Per Day', 'trim|required|numeric');
            $this->form_validation->set_rules('base_price_per_hour', 'Base Price Per Hour', 'trim|required|numeric');

            $data = array
            (
                'website_id'          => $this->input->post('website_id'),
                'website_url'         => $this->input->post('website_url'),
                'description'         => $this->input->post('description'),
                'page_id'             => $this->input->post('pageList'),
                'page'                => $this->input->post('page'),
                'status'              => $this->input->post('status'),
                'base_price_per_hour' => $this->input->post('base_price_per_hour'),
                'base_price_per_day'  => $this->input->post('base_price_per_day'),
                'banner_height'       => $this->input->post('banner_height'),
                'banner_width'        => $this->input->post('banner_width'),
            );

            if ($this->form_validation->run() === TRUE)
            {
                if (!empty($_FILES['image']['name']))
                {
                    $image = '';
                    $fileName = $_FILES['image']['name'];
                    $upload = uploadFile('image', 'img', 'space', $fileName, 212, 212);
                    $old_image = $this->input->post('old_image');

                    if ($old_image != '' && file_exists(UPLOAD_ON_ROOT . "space/" . $old_image))
                        unlink(UPLOAD_ON_ROOT . "/space/" . $old_image);
                    if (!empty($upload) && $upload['success'] == true)
                        $data['image'] = $upload['path'];
                    // $image =   $data['image'];

                }

                $id = $this->input->post('id');

//                $result = 1;


                if ($id)
                { /* Edit Data */
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $result = $this->space->update($id, $data);
                    $action = "updated";
                    $salePriceID = $this->input->post('edit_sale_price_id');
                    $editSaleHourlyPrice = $this->input->post('edit_sale_price_per_hour');
                    $editSaleDailyPrice = $this->input->post('edit_sale_price_per_day');
                    $editStartDate = $this->input->post('edit_startdate');
                    $editEndDate = $this->input->post('edit_enddate');

                    $hourlyPrice = $this->input->post('sale_price_per_hour');
                    $dailyPrice = $this->input->post('sale_price_per_day');
                    $start_date = $this->input->post('startdate');
                    $end_date = $this->input->post('enddate');
					
					//create array to check overlap
                    if(count($editStartDate) > 0)
                    {
                        $allDates = array();
                        if (!empty($start_date)) {
                            foreach ($start_date as $key => $sdate) {
                                if ($sdate != "") {
                                    $allDates[] = array('start' => $this->mysqlDate($sdate), 'end' => $this->mysqlDate($end_date[ $key ]));
                                }
                            }
                        }
                        if (!empty($editStartDate)) {
                            foreach ($editStartDate as $key => $esdate) {
                                if ($esdate != "") {
                                    $allDates[] = array('start' => $this->mysqlDate($esdate), 'end' => $this->mysqlDate($editEndDate[ $key ]));
                                }
                            }
                        }

                        //echo "<pre>";
                        //print_r($allDates);
                        if (!empty($allDates)) {
                            $checkRange = $this->checkIfOverlapped($allDates);
                        }
                        //echo $checkRange;
                        //print_r($this->input->post());
                        //exit;

                        //$overlapCheck = $this->overLap($start_date, $end_date, $editStartDate, $editEndDate);
                        //                    echo "Overlap = ".$overlapCheck;

                        //check for date overlapping
                        //if( $overlapCheck === "FALSE" ){
                        if ($checkRange == 0) {
                            //update sale price
                            if (!empty($allDates)) {
                                for ($i = 0; $i < count($editStartDate); $i++) {
                                    $updatedData = ['p_id'       => $id, //                            'created_at' => date("Y-m-d H:i:s"),
                                                    'updated_at' => date("Y-m-d H:i:s"), 'sale_price_per_hour' => $editSaleHourlyPrice[ $i ], 'sale_price_per_day' => $editSaleDailyPrice[ $i ], 'start_date' => $this->mysqlDate($editStartDate[ $i ]), 'end_date' => $this->mysqlDate($editEndDate[ $i ])];

                                    //print_r($updatedData);exit;

                                    $result = $this->space->updateSalePriceByID($salePriceID[ $i ], $updatedData);
                                }

                                //add sale price via dynamic field
                                for ($i = 0; $i < count($hourlyPrice); $i++) {
                                    $sale_data = ['p_id'               => $id, 'created_at' => date("Y-m-d H:i:s"), //'updated_at' => date("Y-m-d H:i:s"),
                                                  'sale_price_per_day' => $dailyPrice[ $i ], 'sale_price_per_hour' => $hourlyPrice[ $i ], 'start_date' => $this->mysqlDate($start_date[ $i ]), 'end_date' => $this->mysqlDate($end_date[ $i ])];
                                    $result = $this->space->insertSalePrice($sale_data);
                                }
                                $action = "updated";
                            }
                        } else {
                            $this->session->set_flashdata('overlapError', "Different sale price can not be set for same Day.");
                            redirect('space/addEdit/' . $this->input->post('id'));
                        }
                    }

                } else
                { /* Add Data */
                    $data['created_at'] = date("Y-m-d H:i:s");

                    $data['space_unique_id'] = unique_id();
                    $sale_data = array();
                    $hourlyPrice = $this->input->post('sale_price_per_hour');
                    $dailyPrice = $this->input->post('sale_price_per_day');
                    $start_date = $this->input->post('startdate');
                    $end_date = $this->input->post('enddate');
//                    $start = $start_date;
//                    $end = $end_date;
					if( count($hourlyPrice) > 0 )
					{
                      //create array to check overlap
                        $allDates = array();
                        if (!empty($start_date)) {
                            foreach ($start_date as $key => $sdate) {
                                if ($sdate != "") {
                                    $allDates[] = array('start' => $this->mysqlDate($sdate), 'end' => $this->mysqlDate($end_date[ $key ]));
                                }
                            }
                        }

                        //echo "<pre>";
                        //print_r($allDates);

                        if (!empty($allDates))
                        {
                            $checkRange = $this->checkIfOverlapped($allDates);
                        }

                        //print_r($this->input->post());

                        //exit;

                        //$overlapCheck = $this->overLap($start_date, $end_date);

                        //if($overlapCheck === "FALSE"){
                        if ($checkRange == 0)
                        {
                            $optresult = $this->space->insert($data);
                            if (!empty($allDates)) {
                                for ($i = 0; $i < count($hourlyPrice); $i++) {
                                    $sale_data = ['p_id' => $optresult, 'created_at' => date("Y-m-d H:i:s"), 'start_date' => $this->mysqlDate($start_date[ $i ]), 'end_date' => $this->mysqlDate($end_date[ $i ]), 'sale_price_per_hour' => $hourlyPrice[ $i ], 'sale_price_per_day' => $dailyPrice[ $i ]];
                                    $result = $this->space->insertSalePrice($sale_data);
                                }
                                $action = "added";
                            }
                        } else
                        {
                            $this->session->set_flashdata('overlapError', "Overlapping dates found.");

                            //set array to frontend
                            $data['web_url'] = $data['website_url'];
                            $datashow['spaceData'] = $data;
                            $pageData = $this->space->getPageListByID($data['website_id']);
                            $datashow['pageData'] = $pageData;
                            $datashow['post_data'] = $this->input->post();
                            //						echo "<pre>"; print_r($datashow);die;

                            $this->session->set_flashdata('inputError', $datashow);
                            redirect('space/addEdit/');
                        }
                    } else {
                        $result = $this->space->insert($data);
                        $action = "added";
                    }

                    //echo "<pre>";print_r($data);die;
                }
                if ($result) {
                    $this->session->set_flashdata('spaceAddUpdMsg', "Space has been " . $action . " successfully");
                } else {
                    $this->session->set_flashdata('spaceAddUpdMsg', "Space is not " . $action. " successfully");
                }
                redirect('space');
            } else {
                $this->session->set_flashdata('spaceError', validation_errors());

                $data['web_url'] = $data['website_url'];
                $pageData = $this->space->getPageListByID($data['website_id']);
                $datashow['spaceData'] = $data;
                $datashow['pageData'] = $pageData;
                $datashow['post_data'] = $this->input->post();

                $this->session->set_flashdata('inputError', $datashow);
//                echo "<pre>"; print_r(
                redirect('space/addEdit/'.$this->input->post('id'));
            }
        }
        $data['websiteData'] = $this->website->getData();


        $data['Module'] = "Space";
        $this->load->view('templates/header', $data);
        $this->load->view('space/addedit', $data);
        $this->load->view('templates/footer', $data);
    }
	
	public function checkIfOverlapped($ranges){
		$res = $ranges[0];
		//print_r($res);
		$countRanges = count($ranges);
		
		$overlap = 0;
		
		for ($i = 0; $i < $countRanges; $i++) {
			$checkRanges = $ranges;
			$r1s = $checkRanges[$i]['start'];
			$r1e = $checkRanges[$i]['end'];
			
			unset($checkRanges[$i]);	
			$new_ranges = array_values($checkRanges); 
			$new_countRanges = count($checkRanges);
			//echo "<pre>";print_r($new_ranges);
			//exit;
			
			for($ik = 0; $ik < $new_countRanges; $ik++){
				$r2s = $new_ranges[$ik]['start'];
				$r2e = $new_ranges[$ik]['end'];
				
				//echo "r1s:".$r1s."<br/>r1e:".$r1e."<br>r2s:".$r2s."<br/>r2e:".$r2e."<br/>";
				//echo "$r1s >= $r2s && $r1s <= $r2e || $r1e >= $r2s && $r1e <= $r2e || $r2s >= $r1s && $r2s <= $r1e || $r2e >= $r1s && $r2e <= $r1e";
				//exit;
				if ($r1s >= $r2s && $r1s <= $r2e || $r1e >= $r2s && $r1e <= $r2e || $r2s >= $r1s && $r2s <= $r1e || $r2e >= $r1s && $r2e <= $r1e) {
				
					//echo "sdsd";exit;
					//check for same s and e date
					/*if($r1s == $r1e || $r2s == $r2e){
						echo "same";exit;
					}*/
					$res = array(
						'start' => $r1s > $r2s ? $r1s : $r2s,
						'end' => $r1e < $r2e ? $r1e : $r2e
					);
					//print_r($res);exit;
					$overlap++;
					//return true;
				} //else return false;
			}
			
			

		}
		//var_dump(checkIfOverlapped($ranges));
		//return $res;
		//echo "<pre>";print_r($res);
		return $overlap;
	}
	public function mysqlDate($date){
	    list($d,$m,$y)=explode("-",$date);  		
		$dt=$y."-".$m."-".$d;
		if ($dt=='--')	$dt = "0000-00-00" ;
		return $dt;  // Return format yyyy-mm-dd  Database format Y-m-d
	}
}