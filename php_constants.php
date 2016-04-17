<?php

//This is the working path. You need to modify it to make it fit in your system.

//$parts = explode('/', $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
//$last = end($parts);
//$result = "";
//for ($i = 0 ; $i < count($parts)-1; $i++){
//    $result = $result.$parts[$i]."/";
//}
//
//echo $result;
//gets the server root path
$work_path = "/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/";
//echo $work_path;

define("WORK_PATH", $work_path);
define("INPUT_IMG_PATH",WORK_PATH."resource"); //input image folder which named "resource"
define("OUT_IMG_PATH",WORK_PATH."result");//output image folder which named "result"
define("OUT_ARCHIVE_IMG_PATH",WORK_PATH."result_archive");//output achived image folder which named "result_archived"
define("OUT_RR1_IMG_PATH",WORK_PATH."result_rr1/");//output achived image folder which named "result_rr1"
define("OUT_RR2_IMG_PATH",WORK_PATH."result_rr2/");//output achived image folder which named "result_rr2"
define("OUT_RR3_IMG_PATH",WORK_PATH."result_rr3/");//output achived image folder which named "result_archived"

define("HTML_INPUT_IMG_PATH","/webapp/resource/");//it will be Referenced by result php page
define("HTML_OUTPUT_IMG_PATH","/webapp/result/");//webapp-> project root name



?>