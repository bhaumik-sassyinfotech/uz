<?php

class Logincheck {

    function isLogin() {
        session_start();
        $CI = & get_instance();
        $login = false;
        $controller = $CI->router->fetch_class();
        $method = $CI->router->fetch_method();
        if ($controller != 'account' || ($controller == 'account' && $method == "profile")) {
            if (!($CI->aauth->is_loggedin())) {
                redirect('account');
            } else {
                $login = true;
            }

            if ($login && ($controller != 'account' || ($controller == 'account' && $method == "profile"))) {
//                $access_key = json_decode($CI->session->userdata('admin_priviledge'), true);
//                $access_key = json_decode($_SESSION['admin_priviledge'], true);
                $priviledgeData = GetAllRecord('user_group', array('is_deleted' => 0, 'group_id' => $CI->session->userdata('admin_group_id')), true, 'group_privilege');
                if (!empty($priviledgeData))
                    $access_key = json_decode($priviledgeData['group_privilege'], true);
                else
                    $access_key = json_decode($_SESSION['admin_priviledge'], true);

                $id = $CI->uri->segment(3);
                foreach ($access_key as $key => $value) {
                    if ($controller == $key) {
                        foreach ($value as $key1 => $value1) {
                            if ($method == $key1) {
                                if ($value1 == '0') {
                                    header("Location: " . base_url('dashboard/denied'));
                                    exit();
                                }
                            } elseif (in_array($method, array("addEdit", "addedit")) && $key1 == 'add') {
                                if ($value1 == '0') {
                                    header("Location: " . base_url('dashboard/denied'));
                                    exit();
                                }
                            } elseif (in_array($method, array("addEdit", "addedit")) && $id > 0 && $key1 == 'edit') {
                                if ($value1 == '0') {
                                    header("Location: " . base_url('dashboard/denied'));
                                    exit();
                                }
                            }
                        }
                    }
                }
                //  }
            }
        }
    }

}

?>
