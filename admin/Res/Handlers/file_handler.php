<?php
header('Content-Type: application/json');
include_once '../Php/modal.php';

$returned = array(
    false,
);
$urltemp = array();
if (isset($_FILES) || !empty($_FILES)) {

    $returned = array(
        false
    );

    $count = 5;

    $images_filter = array(
        "image/jpeg",
        "image/png"
    );

    $video_filter = array(
        "video/mp4"
    );

    $audio_filter = array(
        "audio/mp3",
        "audio/mpeg",
    );

    // var_dump($_FILES['media']);

    function restructureFilesArray($files)
    {
        $output = [];
        foreach ($files as $attrName => $valuesArray) {
            foreach ($valuesArray as $key => $value) {
                $output[$key][$attrName] = $value;
            }
        }
        return $output;
    }

    $all_files = restructureFilesArray($_FILES['media']);
    

    foreach($all_files as $value){
        $this_file = ((new FileInfoTool)->get_file($value['tmp_name'])->get_info());
        
        //test if image
        if( in_array($this_file['mime'],$images_filter)){
            $size = getimagesize($value['tmp_name']);

            $width = $size[0];
            $height = $size[1];



            $elem = array(
                "ID"=>"generated",
                "Name" => "id + mime",
                "width" => $width,
                "height" => $height,
                "size" => $this_file['size'],
                "mimeType" => $this_file['mime'],
                "path_from_root" => "will be edited",
            );


            //test if image is greater than 10 mb
            if($elem['size'] > 10000000){
                echo "image size too large";
                exit();
            }else{
                $current_elem;

                foreach($all_files as $values2){
                    foreach($values2 as $key1=>$value1){
                        if($value1 == $value['tmp_name'] ){
                            $current_elem = ($values2);
                        }
                    }
                }

                $ext = explode(".",$current_elem['name']);
                $ext = end($ext);
                $targetDirectory =  "../../../test/res/images/productsImages/";

                $name = genname($ext, $targetDirectory);

                $move = $targetDirectory.$name[1];

                move_uploaded_file($value['tmp_name'], $move);

                $elem = array(
                    "UUID" => $name[0],
                    "img_name" => $name[1],
                    "img_width" => $width,
                    "img_height" => $height,
                    "size" => $this_file['size'],
                    "mime_type" => $this_file['mime'],
                    "path_from_root"=> USER_ROOT."res/images/productsImages/".$name[1]
                );

                $item =  json_encode($elem);

                $ret = $moderator->Create_file($item, "tbl_image_db");

                $uuid = $moderator->generateUUID();

                $id = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());
                $id = $id[1][0]['ListOrder'];

                $dataset = array(
                    "UUID"=>$uuid,
                    "image_id"=>$elem['UUID'],
                    "product_id" => $id
                );

                $table = 'image_prod_domain';



                $ref = $moderator->add_to_database($dataset, $table, $moderator->getConnection(),"ssi","(?,?,?)");

                if($ref && $ref){
                    $returned[0] = true;
                    array_push($urltemp, $ret);
                }              
            }
        } elseif(in_array($this_file['mime'], $video_filter)){
            echo (json_encode($returned));
            exit();
        } elseif (in_array($this_file['mime'], $audio_filter)) {
            echo (json_encode($returned));
            exit();
        } else {
            echo (json_encode($returned));
            exit();
        }
    }
    array_push($returned, $urltemp);

      echo (json_encode($returned));
}else{
      echo (json_encode($returned));
}
