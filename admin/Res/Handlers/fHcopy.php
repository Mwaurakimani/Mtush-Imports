<?php

include_once '../Php/modal.php';
if(isset($_FILES)){

    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

// $fileName = $_FILES['file']['name'];
// $fileType = $_FILES['file']['type'];
// $fileTmpName = $_FILES['file']['tmp_name'];
// $fileError = $_FILES['file']['error'];
// $fileSize = $_FILES['file']['size'];
// $fileContent = file_get_contents($_FILES['file']['tmp_name']);

//  echo $fileName."\n";
//  echo $fileType."\n";
//  echo $fileTmpName."\n";
//  echo $fileError."\n";
//  echo $fileSize."\n";


//  if($fileType !== 'image/png' || $fileType !== 'image/jpeg' || $fileType !== 'image/jpg' || $fileType !== 'image/jfif'){
//     var_dump((new FileInfoTool)->get_file($fileTmpName)->get_info());
//  }else{
//      echo "File not Supported";
//  }



// $image_upload = new image();

// $file_nm = $image_upload->fileTransfer($_FILES['file']);

// echo $file_nm;


}else{
    echo "not post";
}


// class image
// {
//     public function fileTransfer($file)
//     {
//         $file_name = $file['name'];
//         $target_dir = ROOT;
//         $filetmpname = $file['tmp_name'];
//         $filesize = $file['size'];
//         $fileerror = $file['error'];
//         $filetype = $file['type'];

//         move_uploaded_file($filetmpname, "../Images/products/". $file_name.".png");

//         return $file_name;
//     }
// }



// -------------------------------------------- file 2 --------------------------------------------------
if (isset($_FILES)) {

    $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    echo "hi";

    // $fileName = $_FILES['file']['name'];
    // $fileType = $_FILES['file']['type'];
    // $fileTmpName = $_FILES['file']['tmp_name'];
    // $fileError = $_FILES['file']['error'];
    // $fileSize = $_FILES['file']['size'];
    // $fileContent = file_get_contents($_FILES['file']['tmp_name']);

    //  echo $fileName."\n";
    //  echo $fileType."\n";
    //  echo $fileTmpName."\n";
    //  echo $fileError."\n";
    //  echo $fileSize."\n";


    //  if($fileType !== 'image/png' || $fileType !== 'image/jpeg' || $fileType !== 'image/jpg' || $fileType !== 'image/jfif'){
    //     var_dump((new FileInfoTool)->get_file($fileTmpName)->get_info());
    //  }else{
    //      echo "File not Supported";
    //  }



    // $image_upload = new image();

    // $file_nm = $image_upload->fileTransfer($_FILES['file']);

    // echo $file_nm;


} else {
    echo "not post";
}


// class image
// {
//     public function fileTransfer($file)
//     {
//         $file_name = $file['name'];
//         $target_dir = ROOT;
//         $filetmpname = $file['tmp_name'];
//         $filesize = $file['size'];
//         $fileerror = $file['error'];
//         $filetype = $file['type'];

//         move_uploaded_file($filetmpname, "../Images/products/". $file_name.".png");

//         return $file_name;
//     }
// }
