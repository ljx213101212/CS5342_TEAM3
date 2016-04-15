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

    function get_log_name(){

        $dir = OUT_IMG_PATH;
        $file = 'somefile.txt';
        $searchfor = 'name';

// the following line prevents the browser from parsing this as HTML.
        header('Content-Type: text/plain');

// get the file contents, assuming the file to be readable (and exist)
        $contents = file_get_contents($file);
// escape special characters in the query
        $pattern = preg_quote($searchfor, '/');
// finalise the regular expression, matching the whole line
        $pattern = "/^.*$pattern.*\$/m";
// search, and store all matching occurences in $matches
        if(preg_match_all($pattern, $contents, $matches)){
            echo "Found matches:\n";
            echo implode("\n", $matches[0]);
        }
        else{
            echo "No matches found";
        }
    }


}


?>