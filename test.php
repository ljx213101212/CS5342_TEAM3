<?php
//echo __FILE__; 
$dir = "/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/result";

$array = scandir($dir,1);

//print_r($array);



$result = "";
$mark = 0;
foreach ($array as $key => $value) {
    
    $temp = split('_',$value);
    //print_r($temp);
    foreach ($temp as $key2 => $value2) {
        
        if (!strcmp($value2,"reflection")){
            $mark = 1;
            //echo $value2;
        }
        if ($mark == 1){
            if ($key2 == 0){
                 $result = $result.$value2;
            }else{
                $result = $result."_".$value2;
            }
        }
    } 

    if ($mark == 1){
            break;
    }
}

echo $result;



?>