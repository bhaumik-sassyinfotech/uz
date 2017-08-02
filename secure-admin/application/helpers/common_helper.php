<?php

#fetch all records to display with filters

function GetAllRecord($table_name = '', $condition = array(), $is_single = FALSE, $select_fields = '*', $is_like = array(), $or_like = array(), $order_by = array())
{
    $CI = &get_instance();
    $CI->db->select($select_fields);
    if ($condition && count($condition))
        $CI->db->where($condition);
    if ($is_like && count($is_like)) {
        foreach ($is_like as $key => $val) {
            //            $cur_filter = array();
            //            $cur_filter = $val;
            //            foreach ($cur_filter as $key1 => $val1) {
            $CI->db->like($key, $val);
            //            }
        }
    }
    if ($or_like && count($or_like)) {
        foreach ($or_like as $key => $val) {
            //            $cur_filter = array();
            //            $cur_filter = $val;
            //            foreach ($cur_filter as $key1 => $val1) {
            $CI->db->like($key, $val);
            //            }
        }
    }
    if ($order_by && count($order_by)) {
        foreach ($order_by as $key => $val) {
            //            $cur_filter = array();
            //            $cur_filter = $val;
            //            foreach ($cur_filter as $key1 => $val1) {
            $order = $val ? $val : 'asc';
            $CI->db->order_by($key, $order);
            //            }
        }
    }
    $res = $CI->db->get($table_name);
    if ($is_single)
        return $res->row_array(); else
        return $res->result_array();
}

#joinTable query

function JoinData($table_name = '', $condition = array(), $join_table = '', $table_id = '', $join_id = '', $is_single = FALSE, $select = FALSE)
{
    $ci = &get_instance();
    if ($select) {
        $ci->db->select($select);
    }
    #$ci->db->select('first_name,last_name');
    if ($condition && count($condition))
        $ci->db->where($condition);
    $ci->db->from($table_name);
    if ($join_table)
        $ci->db->join($join_table, "$table_name.$table_id = $join_table.$join_id");
    $res = $ci->db->get();
    if ($is_single)
        return $res->row_array(); else
        return $res->result_array();
}

/* Return passed query result */

function getQueryResult($query = '', $is_single = FALSE)
{
    $ci = &get_instance();
    if ($query) {
        $res = $ci->db->query($query);
        if ($is_single)
            return $res->row_array(); else
            return $res->result_array();
    }

    return FALSE;
}

#insert update query with filter and flag

function Insert_Update_Data($table_name = '', $condition = array(), $data = array(), $is_insert = FALSE)
{
    $resultArr = array();
    $CI = &get_instance();
    if ($condition && count($condition))
        $CI->db->where($condition);
    if ($is_insert) {
        $CI->db->insert($table_name, $data);
        $insertid = $CI->db->insert_id();

        return $insertid;
        #return 0;
    } else {
        return $CI->db->update($table_name, $data);
        //return 0;
    }
}

#delete record from table

function delete($table_name = '', $condition = array())
{
    $CI = &get_instance();
    if (!empty($condition))
        $CI->db->where($condition);
    $result = $CI->db->delete($table_name);

    return $result;
}

#Upload File

function uploadFile($uploadFile, $filetype, $folder, $fileName = '', $width = 100, $height = 100)
{
    $CI = &get_instance();
    $resultArr = array();
    $config['max_size'] = '1024000';
    if ($filetype == 'img')
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
    if ($filetype == 'All')
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|zip|xls';
    if ($filetype == 'csv')
        $config['allowed_types'] = 'csv';
    if ($filetype == 'swf')
        $config['allowed_types'] = 'swf';
    if ($filetype == 'mp3')
        $config['allowed_types'] = 'mp3|wma|wav|.ra|.ram|.rm|.mid|.ogg';
    if ($filetype == '*')
        $config['allowed_types'] = '*';

    $config['upload_path'] = UPLOAD_ON_ROOT . $folder . '/';

    mkdir(UPLOAD_ON_ROOT . $folder, 0777, TRUE);

    if ($fileName != "") {
        $extension = explode(".", $fileName);
        $config['file_name'] = md5(uniqid() . time()) . "." . end($extension);
    }

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    if (!$CI->upload->do_upload($uploadFile)) {
        $resultArr['success'] = FALSE;
        $resultArr['error'] = $CI->upload->display_errors();
    } else {
        $resArr = $CI->upload->data();

        //        $config = array(
        //			'source_image' => $resArr['full_path'],
        //			'new_image' => UPLOAD_ON_ROOT. $folder . '/',
        //			'maintain_ratio' => true,
        //			'width' => $width,
        //			'height' => $height
        //		);
        //
        //        $CI->load->library('image_lib', $config);
        //        $CI->image_lib->initialize($config);
        //        $CI->image_lib->resize();

        $resultArr['success'] = TRUE;
        $resultArr['path'] = $resArr['file_name'];
    }

    return $resultArr;
}

function sendMail($toEmail, $subject = '', $mail_body = '', $from_email = '', $template_id = 0, $template_view, $data = array(), $rpl_to_email = '', $from_name = '', $ccMail = '')
{
    $C = &get_instance();
    if ($mail_body == '' && $template_id > 0 && $template_view != '') {
        $emailTemplate = GetAllRecord('email_template', array('emailtemplate_id' => $template_id), TRUE);
        if (!empty($emailTemplate))
            $data['templateText'] = $emailTemplate['emailtemplate_desc'];
        $mail_body = $C->load->view($template_view, $data, TRUE);
        if ($subject == '')
            $subject = $emailTemplate['emailtemplate_subject'];
    }
    $C->load->library('email');
    $config['mailtype'] = 'html';
    $config['protocol'] = 'sendmail';
    $config['mailpath'] = '/usr/sbin/sendmail';
    $config['charset'] = 'utf-8';
    $config['wordwrap'] = TRUE;
    if ($from_email == '')
        $from_email = "sassyinfotech@gmail.com";
    if ($from_name == '')
        $from_name = "Sassyinfotech";
    $C->email->initialize($config);
    $C->email->from($from_email, $from_name);
    $C->email->to($toEmail);
    if ($rpl_to_email)
        $C->email->reply_to($rpl_to_email, '');
    if ($ccMail)
        $C->email->cc($ccMail);
    $C->email->subject($subject);
    $C->email->message($mail_body);
    $C->email->send();
    #	echo $C->email->print_debugger();die;
    #	unset($C);
}

function create_unique_slug($string, $table, $field = 'slug', $id = 0, $unique_field = '', $key = NULL, $value = NULL)
{
    $t = &get_instance();
    $slug = url_title($string);
    $slug = strtolower($slug);
    $i = 0;
    $params = array();
    $params[ $field ] = $slug;

    if ($key)
        $params["$key !="] = $value;
    if ($id)
        $t->db->where($unique_field . '<>', $id);
    while ($t->db->where($params)->get($table)->num_rows()) {
        if (!preg_match('/-{1}[0-9]+$/', $slug))
            $slug .= '-' . ++$i; else
            $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

        $params[ $field ] = $slug;
    }

    return $slug;
}

/* Encrypt String */

function Encrypt($data)
{
    $password = "YB1605kf";
    $salt = substr(md5(mt_rand(), TRUE), 8);
    $key = md5($password . $salt, TRUE);
    $iv = md5($key . $password . $salt, TRUE);
    $ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
    $string = base64_encode('Salted__' . $salt . $ct);

    return str_replace('/', '_', $string);
}

/* Check permission */

function CheckPermission($controller, $method = "index")
{
    $access_key = json_decode($_SESSION['admin_priviledge'], TRUE);
    
	//echo "<div id='hitaccess' style='display:none;'><pre>";print_r($access_key);echo "</div>";
	$flag = 1;
    foreach ($access_key as $key => $value) {
        if ($controller == $key) {
            foreach ($value as $key1 => $value1) {
                if ($method == $key1) {
                    if ($value1 == '0') {
                        $flag = 0;
                    }
                } elseif (in_array($method, array("addEdit", "addedit")) && $key1 == 'add') {
                    if ($value1 == '0') {
                        $flag = 0;
                    }
                } elseif (in_array($method, array("addEdit", "addedit")) && $id > 0 && $key1 == 'edit') {
                    if ($value1 == '0') {
                        $flag = 0;
                    }
                }
            }
        }
    }

    return $flag;
}

function convert_number_to_words($number = 0)
{

    $number = str_replace(",", "", $number);
    $no = round($number);
    $point = abs(number_format((float)$number - (float)$no, 2) * 100);

    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fourteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'forty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[ $number ] . " " . $digits[ $counter ] . $plural . " " . $hundred : $words[ floor($number / 10) * 10 ] . " " . $words[ $number % 10 ] . " " . $digits[ $counter ] . $plural . " " . $hundred;
        } else
            $str[] = null;
    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ? $words[ $point / 10 ] . " " . $words[ $point = $point % 10 ] : '';
    $string_opt = $result . "Rupees  " . (($points) ? "," . $points . " Paise" : '');

    return $string_opt;
}

function unique_id()
{
    return substr(md5(microtime() * rand(0, 9999)), 0, 14);
}
