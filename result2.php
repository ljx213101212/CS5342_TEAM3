<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Off-canvas navigation menu Tutorial">
    <meta name="keywords" content="slide-menu, sidebar, off-canvas, menu, navigation"/>
    <meta name="author" content="AcasA Programming">

    <title>Result</title>

    <link rel="stylesheet" type="text/css" href="css/app.css"/>
    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/slide.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/fileinput.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>

<?php
include 'php_constants.php';
include 'php_utils.php';
// echo INPUT_IMG_PATH;
$util = new Utils();
?>

<div class="result-container">
    <div class="well">
        <div class="row">
            <div class="col-lg-6 text-centered">
                <h3>Origin</h3>
                <?php

                //$dir = INPUT_IMG_PATH;
                //$array = scandir($dir, 1);
                $array = $util->get_input_array();
                $filecount = 0;
                if (glob(INPUT_IMG_PATH . '/*.{jpg,png}',GLOB_BRACE))
                {
                    $filecount = count(glob(INPUT_IMG_PATH . '/*.{jpg,png}',GLOB_BRACE));
                   // echo $filecount;
                }else{
                    echo "no image in resource folder";
                }
                ?>

                <?php
                    if ($filecount > 1){
                        $temp = "";
                        $width = 134/($filecount);
                        for ($x=0; $x<=$filecount-1; $x++){
                        $temparray = $array[$x];
                        $temp = $temp."<img class=\"img-responsive my-dotted-border\" src=\"".HTML_INPUT_IMG_PATH.$temparray."\"style=\"width:".$width."%;\"/>";   
                        }
                    }
                    else{
                        $temparray = $array[0];
                        $temp = "<img class=\"img-responsive my-dotted-border\" src=\"".HTML_INPUT_IMG_PATH.$temparray."\"style=\"width:67%;\"/>";
                    }
                ?>
                <?= $temp ?>

            </div>

            <?php
            $name_prefix = "background";
            $result = $util->get_output_image_name($name_prefix);
            copy(OUT_IMG_PATH.'/'.$result, OUT_ARCHIVE_IMG_PATH.'/'.$result);
            $temp = "";
            $temp = $temp."<h3>Result (".$name_prefix.")</h3>"."<img class=\"img-responsive my-dotted-border\" src=\"".HTML_OUTPUT_IMG_PATH.$result."\"style=\"width:67%;\"/>";
            $name_prefix = "reflection";
            $result = $util->get_output_image_name($name_prefix);
            copy(OUT_IMG_PATH.'/'.$result, OUT_ARCHIVE_IMG_PATH.'/'.$result);
            $temp = $temp."<h3>Result (".$name_prefix.")</h3>"."<img class=\"img-responsive my-dotted-border\" src=\"".HTML_OUTPUT_IMG_PATH.$result."\"style=\"width:67%;\"/>";
            ?>

            <div class="col-lg-6 text-centered"><?= $temp ?></div>
        </div>

    </div>

    <div class="row text-centered">

        <div class="col-lg-12">
            <a class="btn btn-info" href="/webapp/index.html"> GO BACK </a>
        </div>
    </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/plugins/canvas-to-blob.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
