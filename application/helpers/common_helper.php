<?php


function isCustomerLogin()
{
    $CI = &get_instance();
    if ($CI->session->userdata('customer_id') && $CI->session->userdata('customer_logged_in')) {
        $customer_id = $CI->session->userdata('customer_id');
        $userData = GetAllRecord('booking_ads_customer', array('status' => 1, 'is_deleted' => 0, 'uid' => $customer_id), TRUE, 'uid');
        if (empty($userData)) {
            $sess_array = array('customer_id', 'customer_first_name', 'customer_last_name', 'customer_mobileno', 'customer_email', 'customer_logged_in');
            $CI->session->unset_userdata($sess_array);

            return FALSE;
        } else
            return TRUE;
    } else
        return FALSE;
}


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
    if ($res) {
        if ($is_single)
            return $res->row_array(); else
            return $res->result_array();
    } else
        return FALSE;
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

        $config = array('source_image' => $resArr['full_path'], 'new_image' => UPLOAD_ON_ROOT . $folder . '/', 'maintain_ratio' => TRUE, 'width' => $width, 'height' => $height);

        $CI->load->library('image_lib', $config);
        $CI->image_lib->initialize($config);
        $CI->image_lib->resize();

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

function sendMailNew($toEmail, $subject = '', $mail_body = '', $from_email = '', $template_key = '', $parse = array(), $rpl_to_email = '', $from_name = '')
{
    $C = &get_instance();
    if ($mail_body == '' && $template_key != '') {
        $emailTemplate = GetAllRecord('email_template', array('emailtemplate_key' => $template_key), TRUE);
        if (!empty($emailTemplate))
            $mail_body = $C->parser->parse_string($emailTemplate['emailtemplate_desc'], $parse, TRUE);
        if ($subject == '')
            $subject = $emailTemplate['emailtemplate_subject'];
    }
    $mail_body = emailHeader() . $mail_body . emailFooter();
    $config = footerSettings();
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
    $C->email->subject($subject);
    $C->email->message($mail_body);
    $C->email->send();
}


function emailHeader()
{
    $html = '<!DOCTYPE html>
    <html>
    <head>
    <title>' . SITE_TITLE . '</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
        table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
        img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */
    
        /* RESET STYLES */
        img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
        table{border-collapse: collapse !important;}
        body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
    
        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        @media screen and (max-width: 525px) {
    
            .wrapper {
              width: 100% !important;
                max-width: 100% !important;
            }
    
            .logo img {
              margin: 0 auto !important;
            }
    
            /* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
            .mobile-hide {
              display: none !important;
            }
    
            .img-max {
              max-width: 100% !important;
              width: 100% !important;
              height: auto !important;
            }
            .responsive-table {
              width: 100% !important;
            }
    
            .padding {
              padding: 10px 5% 15px 5% !important;
            }
    
            .padding-meta {
              padding: 30px 5% 0px 5% !important;
              text-align: center;
            }
    
            .no-padding {
              padding: 0 !important;
            }
    
            .section-padding {
              padding: 50px 15px 50px 15px !important;
            }
    
            
    
        }
    
        div[style*="margin: 16px 0;"] { margin: 0 !important; }
    </style>
    </head>
    <body style="margin: 0 !important; padding: 0 !important;">
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="background: linear-gradient(to bottom,#b00f1a 0%,#b41018 18%,#c51515 35%,#d01815 52%,#de1a13 69%,#ee2011 84%,#f8220f 100%);">
             
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;" class="wrapper">
                    <tr>
                        <td align="center" valign="top" style="padding: 1px 1px;" class="logo">
                            <a href="#" target="_blank">
                                <img alt="Logo" src="' . IMAGE_PATH . 'logo.png" width="100" height="60" style="display: block; font-family: Helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px; float:left" border="0">
                            </a>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        
        <tr>
            <td bgcolor="#F5F7FA" align="center" style="padding: 30px 15px 30px 15px;" class="section-padding">
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                <tr>
                <td align="center" valign="top" width="500">
                <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 700px;" class="responsive-table">
                    <tr>
                        <td>
                            <!-- TITLE SECTION AND COPY -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="left" style="padding: 20px 0 20px 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;" class="padding">';

    return $html;
}

function emailFooter()
{
    $html = '</td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
        <tr>
            <td align="center" style="background: linear-gradient(to bottom,#b00f1a 0%,#b41018 18%,#c51515 35%,#d01815 52%,#de1a13 69%,#ee2011 84%,#f8220f 100%);
    padding: 10px 0px;">
                <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="500">
                <tr>
                <td align="center" valign="top" width="500">
                <![endif]-->
                <!-- UNSUBSCRIBE COPY -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="max-width: 500px;" class="responsive-table">
                    <tr>
                        <td align="center" style="font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#FFF;">
                            Copyright @Upzurge
                            <br>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
            </td>
        </tr>
    </table>
    </body>
    </html>
    ';

    return $html;
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

function checkCustomerData()
{
    $CI = &get_instance();
    $is_empty = FALSE;
    $customer_id = $CI->session->userdata('customer_id');
    $userData = GetAllRecord('booking_ads_customer', array('status' => 1, 'is_deleted' => 0, 'uid' => $customer_id), TRUE);
    if(empty($userData))
    { // user doesn't exist.
        $is_empty=TRUE;
        return $is_empty;
    } else
    {
        if( empty($userData['address']) OR empty($userData['city']) OR empty($userData['state']) OR empty($userData['country']) OR empty($userData['street']) OR empty($userData['zip_code']) )
        { // user data is partially filled.
            $is_empty=TRUE;
            return $is_empty;
        } else
        { // all data of user is filled.
            $is_empty=FALSE;
            return $is_empty;
        }
    }


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

/* Decrypt String */
function Decrypt($data)
{
    $password = "YB1605kf";
    $data = str_replace('_', '/', $data);
    $data = base64_decode($data);
    $salt = substr($data, 8, 8);
    $ct = substr($data, 16);
    $key = md5($password . $salt, TRUE);
    $iv = md5($key . $password . $salt, TRUE);
    $pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);

    return $pt;
}

/* Check permission */

function CheckPermission($controller, $method = "index")
{
    $access_key = json_decode($_SESSION['admin_priviledge'], TRUE);
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
        if ($number) 
        {
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
    return substr(md5(microtime() * rand(0, 9999)), 0, 15);
}


function footerSettings()
{
    $CI = &get_instance();
    $query = $CI->db->get_where('space', array('is_deleted' => 0));

    $data['bannerData'] = $query->result_array();
    $configData = GetAllRecord('config');
    $config = array();
    foreach ($configData as $key => $val)
    {
        $config[ $val['config_key'] ] = $val['config_value'];
    }

    return $config;

}

