<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Off-canvas navigation menu Tutorial">
    <meta name="keywords" content="slide-menu, sidebar, off-canvas, menu, navigation"/>
    <meta name="author" content="AcasA Programming">

    <title>Off-canvas navigation menu Tutorial</title>

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
                ?>
                <img id="input-img" class="img-responsive my-dotted-border"
                     src="<?= HTML_INPUT_IMG_PATH ?><?= $array[0] ?>"/>
            </div>

            <?php
            $name_prefix = "reflection";
            $result = $util->get_output_image_name($name_prefix);
            ?>
            <div class="col-lg-6 text-centered">
                <h3>Result</h3>
                <img id="output-img" class="img-responsive my-dotted-border"
                     src="<?= HTML_OUTPUT_IMG_PATH ?><?= $result ?>"/>
            </div>
        </div>

    </div>

    <div class="row text-centered">

        <div class="col-lg-12">
            <a class="btn btn-info" href="/webapp/index.html"> GO BACK </a>
        </div>
    </div>

    <section role="main">

                    <div class="row">
                        <div class="span4">
                            <div id="image-data">

                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                        70% Complete (danger)
                                    </div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width:40%">
                                        40% Complete (success)
                                    </div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"
                                         aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                        50% Complete (info)
                                    </div>
                                </div>

                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                        60% Complete (warning)
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
        </section>


    <div id="page-wrapper">

        <h1>Text File Reader</h1>
        <div>
            Select a text file:
            <input type="file" id="fileInput">
        </div>
        <pre id="fileDisplayArea"><pre>

    </div>

</div>


<script src="js/jquery.min.js"></script>
<script src="js/plugins/canvas-to-blob.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/resemble.js"></script>


<script>

    var pathArray = window.location.pathname.split( '/' );
    var log_file = pathArray[1] + "/result";
    alert(log_file);

//    var reg = /\b\w+\b(?=\.(txt))/;
//    var str = "abc.gif, admin.txt, root.gif, xxx";
//    if(reg.test(str)){
//        alert(RegExp.$1);// 依次弹出gif txt gif
//    }

//    var fileDisplayArea = document.getElementById('fileDisplayArea');
//    function readTextFile(file)
//    {
//        var rawFile = new XMLHttpRequest();
//        rawFile.open("GET", file, false);
//        rawFile.onreadystatechange = function ()
//        {
//            if(rawFile.readyState === 4)
//            {
//                if(rawFile.status === 200 || rawFile.status == 0)
//                {
//                    var allText = rawFile.responseText;
//                    fileDisplayArea.innerText = allText
//                }
//            }
//        }
//        rawFile.send(null);
//    }
//
//    readTextFile("file:///C:/your/path/to/file.txt");

</script>


<script>

    var fileData = $('#input-img').attr('src');
    var api = resemble(fileData).onComplete(function (data) {
        console.log(data);
        /*
         {
         red: 255,
         green: 255,
         blue: 255,
         brightness: 255
         }
         */
    });

</script>


</body>
</html>