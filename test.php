<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 18/4/16
 * Time: 12:27 AM
 */

include 'php_constants.php';
include 'php_utils.php';
$util = new Utils();


//$folderPath = OUT_RR1_IMG_PATH;
//$temp_array = scandir($folderPath,1);
//$result_array = array();
//
//for ($i = 0; $i < count($temp_array);$i++){
//    if ($temp_array[$i] != '.DS_Store'
//        and $temp_array[$i] != '..'
//        and $temp_array[$i] != '.') {
//        /* $filename is legal; doesn't contain illegal character. */
//        array_push($result_array,$temp_array[$i]);
//    }
//    else {
//        /* $filename contains at least one illegal character. */
//        continue;
//    }
//
//}
//print_r($result_array);

if (mime_content_type('/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/result_rr1/2016_04_17_18_50_38/RR1_log.txt') == "text/plain"){
    $result_item->log_name = $file_name;
}

//back up log file
