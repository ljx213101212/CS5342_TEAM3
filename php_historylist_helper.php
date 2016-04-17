<?php
/**
 * Created by PhpStorm.
 * User: jixiang
 * Date: 18/4/16
 * Time: 1:01 AM
 */

foreach (glob("Model/*.php") as $filename) {
    require_once($filename);
}
include 'php_constants.php';
include 'php_utils.php';


$test_rr_list = get_rr_list(1);
print_r($test_rr_list);


function get_rr_list($algo) //return value is an array like
//Array ( [0] => ItemM1 Object ( [reflection_img] => reflection_15422.png [shading_img] => shading_15422.png [log_name] => RR1_log.txt ) )
{
    $util = new \Utils();
    $rr_list = Array();
    //print_r ($rr_list);
    $rr_folder_array = array();
    $rr_folder_path = "";
    if ($algo == 1) {
        $rr_folder_path = OUT_RR1_IMG_PATH;
        $rr_folder_array = $util->get_subfolder_list($rr_folder_path);

        for ($i = 0; $i < count($rr_folder_array); $i++) {
            $list_item = new \ListItem();
            //echo "1";
            $rr_folder_name = $rr_folder_array[$i];
            $rr_folder_inner_path = $rr_folder_path . $rr_folder_name . '/';
            $temp = tranverse_rr_folder($rr_folder_inner_path, 1);
            //print_r($temp);
            array_push($rr_list,$temp);
            //print_r($rr_list);
        }
    } else if ($algo == 2) {
        $rr_folder_path = OUT_RR2_IMG_PATH;
        $rr_folder_array = $util->get_subfolder_list($rr_folder_path);
        for ($i = 0; $i < count($rr_folder_array); $i++) {
            $list_item = new \ListItem();
            $rr_folder_name = $rr_folder_array[$i];
            $rr_folder_inner_path = $rr_folder_path . $rr_folder_name;
            tranverse_rr_folder($rr_folder_inner_path, 2);
            array_push($rr_list, $list_item);

        }
    } else if ($algo == 3) {
        $rr_folder_path = OUT_RR3_IMG_PATH;
        $rr_folder_array = $util->get_subfolder_list($rr_folder_path);
        for ($i = 0; $i < count($rr_folder_array); $i++) {
            $list_item = new \ListItem();
            $rr_folder_name = $rr_folder_array[$i];
            $rr_folder_inner_path = $rr_folder_path . $rr_folder_name;
            tranverse_rr_folder($rr_folder_inner_path, 2);
            array_push($rr_list, $list_item);
        }
    } else {
        $rr_folder_path = OUT_RR1_IMG_PATH;
        $rr_folder_array = $util->get_subfolder_list($rr_folder_path);
        for ($i = 0; $i < count($rr_folder_array); $i++) {
            $list_item = new \ListItem();
            $rr_folder_name = $rr_folder_array[$i];
            $rr_folder_inner_path = $rr_folder_path . $rr_folder_name;
            tranverse_rr_folder($rr_folder_inner_path, 1);
            array_push($rr_list, $list_item);
        }
    }

    //print_r($rr_list);
    return $rr_list;

}


function tranverse_rr_folder($folder_path, $algo)
{
    $util = new \Utils();
    $item_array = $util->get_subfolder_list($folder_path); //relection.jpg RR1.log....
    $result_list_item = array();
    $result_item = null;


    //echo $file_name;
    if ($algo == 1) {
        $result_item = new \ItemM1();
        for ($j = 0; $j < count($item_array); $j++) {
            $file_name = $item_array[$j];
            $file_prefix_name = substr($item_array[$j], 0, strpos($item_array[$j], "_"));

            if ($file_prefix_name == 'shading') {
                $result_item->shading_img = $file_name;

            }
            if ($file_prefix_name == 'reflection') {
                $result_item->reflection_img = $file_name;
            }

            if (mime_content_type($folder_path . $item_array[$j]) == "text/plain") {
                $result_item->log_name = $file_name;
                //echo $folder_path.$item_array[$j];

            }
        }


    } else if ($algo == 2 or $algo == 3) {

        $result_item = new \ItemM2();

        for ($j = 0; $j < count($item_array); $j++) {
            $file_name = $item_array[$j];
            $file_prefix_name = substr($item_array[$j], 0, strpos($item_array[$j], "_"));
            if ($file_prefix_name == 'background') {
                $result_item->background_img = $file_name;
            }
            if ($file_prefix_name == 'reflection') {
                $result_item->reflection_img = $file_name;

            }
            if (mime_content_type($folder_path . $item_array[$j]) == "text/plain") {
                $result_item->log_name = $file_name;
            }

        }
    } else {
        $result_item = new \ItemM1();
        for ($j = 0; $j < count($item_array); $j++) {
            $file_name = $item_array[$j];
            $file_prefix_name = substr($item_array[$j], 0, strpos($item_array[$j], "_"));

            if ($file_prefix_name == 'shading') {
                $result_item->shading_img = $file_name;

            }
            if ($file_prefix_name == 'reflection') {
                $result_item->reflection_img = $file_name;
            }

            if (mime_content_type($folder_path . $item_array[$j]) == "text/plain") {
                $result_item->log_name = $file_name;
                //echo $folder_path.$item_array[$j];

            }
        }

    }

    array_push($result_list_item,$result_item);

    //print_r($result_list_item);



    return $result_list_item;

}

?>