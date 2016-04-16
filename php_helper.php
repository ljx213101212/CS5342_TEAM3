<?php

include 'php_execute_matlab.php';
clean_folder();
$algo_name = $_POST['algo_select'];

//current path
if (isset($_FILES['image'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

    $file_algo = $_FILES['image']['algo_select'];

    $matlab_method_name = $algo_name;

    $expensions = array("jpg", "png", "jpeg");

    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "resource/" . $file_name);
        //start shell command to make matlan run
        exe_matlab($algo_name);
        //Keep waiting util matlab code finished
        echo json_encode(['success' => "image processed!"]);
    } else {
        print_r($errors);
    }
}

function clean_folder()
{

    $files = glob('resource/*'); // get all file names
    foreach ($files as $file) { // iterate files
        if (is_file($file))
            unlink($file); // delete file
    }

    $files = glob('result/*'); // get all file names
    foreach ($files as $file) { // iterate files
        if (is_file($file))
            unlink($file); // delete file
    }
}


?>