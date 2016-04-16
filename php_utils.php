<?php

include 'php_constants.php';


class Utils
{

    function get_input_array()
    {

        $dir = INPUT_IMG_PATH;
        $input_array = scandir($dir, 1);

        return $input_array;
    }

    function get_output_image_name($prefix)
    {
        $dir = OUT_IMG_PATH;

        $array = scandir($dir, 1);

        $result = "";
        $mark = 0;
        foreach ($array as $key => $value) {

            $temp = explode('_', $value);//$temp = split('_', $value);
            //print_r($temp);
            foreach ($temp as $key2 => $value2) {

                if (!strcmp($value2, $prefix)) {
                    $mark = 1;
                }
                if ($mark == 1) {
                    if ($key2 == 0) {
                        $result = $result . $value2;
                    } else {
                        $result = $result . "_" . $value2;
                    }
                }
            }
            if ($mark == 1) {
                break;
            }
        }

        return $result;
    }

    function get_log_name(){

        $dir = OUT_IMG_PATH;
        $file_ext = scandir($dir, 1);


        for ($i = 0; $i < count($file_ext); $i++) {
            $ext = pathinfo($dir.$file_ext[$i], PATHINFO_EXTENSION);
            if ($ext == 'txt') {
                return $file_ext[$i];
            }

        }
    }


    function get_exe_time($txt_name){

        $txt_path = OUT_IMG_PATH.'/'.$txt_name;
        $handle = fopen($txt_path, "r") or die("Unable to open file!");
//echo fread($myfile, filesize($src.$txt_name));
//$handle = fopen("inputfile.txt", "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                //echo $line;
                $domain = strstr($line, ':');
                if ($domain) {
                    $exe_time = explode(":", $domain);
                    //echo $exe_time[1];
                    return $exe_time[1];
                }
            }

            fclose($handle);
        } else {
            // error opening the file.
        }

        fclose($handle);
    }


}


?>
