<?php

//extract($_POST);
$errors     = array();
$imageTemp  = array();
$imageList  = array();
$imageSizeList = array();
$expensions = array("jpeg", "jpg", "png");
$success = 1;

clean_folder();

//print_r($_POST['id']);

$matlab_method_name = "RR3";

$file = $_FILES['image'];

//print_r($file);

//echo json_encode(['success' => count($imageTemp)]);


for ($i = 0 ; $i < count($file['tmp_name']); $i++){
	// $errors[] = $file['name'];
	// print_r ($errors);
	$file_name = $file['name'][$i];
	$file_size = $file['size'][$i];
	$file_tmp  = $file['tmp_name'][$i];
	$file_type = $file['type'][$i];
	$file_ext  = strtolower(end(explode('.', $file['name'][$i])));

	
	//print_r($file_name);

	if (in_array($file_ext, $expensions) === false) {
		$success = 0;
		$errors[] = $file_ext;
		$errors[] = "extension not allowed, please choose a JPEG or PNG file.";
	}

	if ($file_size > 4194304) {
		$success = 0;
		$errors[] = "File size must be smaller than 4 MB";
	}

	if (empty($errors) == true) {
		//move_uploaded_file($file_tmp, "resource/".$file_name);
		array_push($imageTemp, $file_tmp);
		array_push($imageList, $file_name);
		array_push($imageSizeList,$file_size);
	} else {
		$success = 0;
		print_r($errors);
		break;
	}


//echo json_encode(['success' => $file_name]);
}

if ((count($imageTemp) == count($imageList)) == 
	(count($imageSizeList) && count($imageTemp))){

	for ($i = 0 ; $i < count($imageTemp);$i++){
		//print_r($imageTemp[$i]);
		move_uploaded_file($imageTemp[$i], "resource/".$imageList[$i]);
	}

	//execute matlab file
	exe_matlab($matlab_method_name);
	echo json_encode(['success'=>"success"]); 

}else{
	echo json_encode(['error' => "some images uploaded cannnot be processed"]);
}



function clean_folder(){

	$files = glob('resource/*'); // get all file names
	foreach($files as $file){ // iterate files
  		if(is_file($file))
    	unlink($file); // delete file
	}
}

function exe_matlab($matlab_method_name){

    shell_exec('chmod 777 start2.sh');
    shell_exec('./start2.sh '.$matlab_method_name);
}



?>