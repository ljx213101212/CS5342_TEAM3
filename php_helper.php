<?php

//current path
 if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

      $file_algo = $_FILES['image']['algo_select'];

      // print_r($file_name);
      // print_r($file_algo);
      
      $expensions= array("jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      // if($file_size > 2097152){
      //    $errors[]='File size must be excately 2 MB';
      // }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"resource/".$file_name);
         shell_exec('chmod 777 start.sh');
         shell_exec('./start.sh '.$file_name);
         echo json_encode(['success'=>"image processed!"]); 
      }else{
         print_r($errors);
      }

    //start shell command to make matlan run
      
   }

   
?>