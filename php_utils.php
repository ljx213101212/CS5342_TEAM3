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

            $temp = split('_', $value);
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


}


?>