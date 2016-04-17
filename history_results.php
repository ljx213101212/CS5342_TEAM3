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
    <!--    <link rel="stylesheet" type="text/css" href="css/normalize.css"/>-->
    <!--    <link rel="stylesheet" type="text/css" href="css/style.css"/>-->
    <!--    <link rel="stylesheet" type="text/css" href="css/slide.css"/>-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-select.css"/>
    <link rel="stylesheet" type="text/css" href="css/history_results.css"/>
    <!--    <link rel="stylesheet" type="text/css" href="css/fileinput.css"/>-->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>

<?php
include 'php_historylist_helper.php';

function append_history_list($algo){
    $test_rr_list = get_rr_list($algo);
    //print_r($test_rr_list[0][0]->reflection_img);
    $result = '';

    for ($i = 0 ; $i < count($test_rr_list); $i++) {

        $result = $result.'<div class="col-lg-3 col-md-4 col-xs-6 thumb"><a class="thumbnail" href="#"><img class="img-responsive" src="http://placehold.it/400x300"></a></div>';
    }

    return $result;


}
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">GO BACK TO HOME</a>
        </div>


        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-12">
            <h1 class="page-header">HISTORY</h1>
            <select id="method-picker" class="page-header selectpicker">
                <option>ALL</option>
                <option>RR1</option>
                <option>RR2</option>
                <option>RR3</option>
            </select>

        </div>

        <div class="insert-panel">



        </div>


    </div>

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; Your Website 2014</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->
<script src="js/jquery.min.js"></script>
<script src="js/plugins/canvas-to-blob.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>

<script>
    var picker_value = $('#method-picker').selectpicker('val');

    update_list(picker_value);
    $('#method-picker').on('changed.bs.select', function (e) {
        // do something...
        picker_value = $('#method-picker').selectpicker('val');
        update_list(picker_value);
    });


    function update_list(picker_value) {
        if (picker_value === 'RR1') {
            $('.insert-panel').html('<?=append_history_list(1)?>');

        } else if (picker_value === 'RR2') {
            $('.insert-panel').html('<?=append_history_list(2)?>');

        } else if (picker_value === 'RR3') {
            $('.insert-panel').html('<?=append_history_list(3)?>');

        } else if (picker_value === 'ALL') {
            $('.insert-panel').html('<?=append_history_list(1)?>');
        } else {
            $('.insert-panel').html('<?=append_history_list(1)?>');
        }
    }

</script>



</body>
</html>