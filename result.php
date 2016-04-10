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

<div class="container">
    <div class="well">
        <div class="row">
            <div class="col-lg-6">
                <h3>Origin</h3>
                <?php

                $dir = "/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/resource";
                $array = scandir($dir, 1);

                ?>
                <img class="my-dotted-border" src="/webapp/resource/<?= $array[0] ?>"/>
            </div>

            <?php
            $dir = "/Users/jixiang/Documents/ISS/SEProject/team_git/webapp/result";

            $array = scandir($dir, 1);

            $result = "";
            $mark = 0;
            foreach ($array as $key => $value) {

                $temp = split('_', $value);
                //print_r($temp);
                foreach ($temp as $key2 => $value2) {

                    if (!strcmp($value2, "reflection")) {
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

            ?>
            <div class="col-lg-6">
                <h3>Result</h3>
                <img class="my-dotted-border" src="/webapp/result/<?= $result?>"/>
            </div>
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