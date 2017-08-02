<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('dateformate'))
{
    function dateformate($date = null){
     //   echo "Hello";die;
        $my_date    =   date('d/m/Y', strtotime($date));
        
        return $my_date;
    }   
}
