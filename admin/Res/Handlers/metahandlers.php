<?php
include_once '../Php/modal.php';
include_once '../Php/View.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : "";

    if ($action == "open_manager") {
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
        if (!empty($email)) {
            $_SESSION['REG_EMAIL'] = $email;
            echo "sucessful";
            exit;
        } else {
            exit;
        }
    } elseif ($action == "logout") {
        $moderator->userlogout();
    } elseif ($action == "newuser") {
        unset($_SESSION["REG_EMAIL"]);
    } elseif ($action == "adding_category" || $action == "adding_tag" || $action == "adding_attributes" || $action == "adding_attributes_val") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

        if (!isset($data)) {
            exit;
        } else {
            if(isset($_SESSION["VARIANCE_ID"])){
                $ID = $_SESSION["VARIANCE_ID"];

                $data = json_decode($data);

                $name = $data->name;
                $slung = $data->slung;
                $parent = $data->_parent;
                $description = $data->description;

                function call_back_category($data)
                {
                    // get all data
                    $filednames = [
                        'cat_name',
                        'cat_slung',
                        'cat_parent',
                        'cat_description'
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->parent,
                        $data->description,
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }
                function call_back_tag($data)
                {
                    // get all data
                    $filednames = [
                        'tag_name',
                        'tag_slung',
                        'tag_description'
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->description,
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }
                function call_back_attribute($data)
                {
                    // get all data
                    $filednames = [
                        'att_name',
                        'att_slung',
                        'att_description'
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->description,
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }
                function call_back_attribute_val($data)
                {
                    // get all data
                    $filednames = [
                        'value_name',
                        'value_slung',
                        'value_description',
                        "att_Bond"
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->description,
                        $_SESSION['ATT_ID']
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }

                $UserData = array(
                    'oName' => encodeToHTML($name),
                    'oSlung' => encodeToHTML($slung),
                    'parent' => encodeToHTML($parent),
                    'description' => encodeToHTML($description),
                );
                $data = json_encode($UserData);


                $conn = $moderator->getConnection();

                if ($action == 'adding_category') {
                    $table = "tbl_category";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_category',$ID);
                }
                if ($action == 'adding_attributes') {
                    $table = "tbl_attributes";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_attribute',$ID);
                }
                if ($action == 'adding_tag') {
                    $table = "tbl_tags";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_tag',$ID);
                }
                if ($action == 'adding_attributes_val') {
                    $table = "tbl_attributes_values";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_attribute_val',$ID);
                }

            }else{
                $data = json_decode($data);

                $name = $data->name;
                $slung = $data->slung;
                $parent = $data->_parent;
                $description = $data->description;

                function call_back_category($data)
                {

                    // get all data
                    $filednames = [
                        'cat_name',
                        'cat_slung',
                        'cat_parent',
                        'cat_description'
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->parent,
                        $data->description,
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }
                function call_back_tag($data)
                {
                    // get all data
                    $filednames = [
                        'tag_name',
                        'tag_slung',
                        'tag_description'
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->description,
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }
                function call_back_attribute($data)
                {
                    // get all data
                    $filednames = [
                        'att_name',
                        'att_slung',
                        'att_description'
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->description,
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }
                function call_back_attribute_val($data)
                {
                    // get all data
                    $filednames = [
                        'value_name',
                        'value_slung',
                        'value_description',
                        "att_Bond"
                    ];

                    $values = [
                        $data->oName,
                        $data->oSlung,
                        $data->description,
                        $_SESSION['ATT_ID']
                    ];

                    $combined  = array_combine($filednames, $values);

                    return $combined;
                }

                $UserData = array(
                    'oName' => encodeToHTML($name),
                    'oSlung' => encodeToHTML($slung),
                    'parent' => encodeToHTML($parent),
                    'description' => encodeToHTML($description),
                );
                $data = json_encode($UserData);


                $conn = $moderator->getConnection();

                if ($action == 'adding_category') {
                    $table = "tbl_category";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_category');
                }
                if ($action == 'adding_attributes') {
                    $table = "tbl_attributes";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_attribute');
                }
                if ($action == 'adding_tag') {
                    $table = "tbl_tags";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_tag');
                }
                if ($action == 'adding_attributes_val') {
                    $table = "tbl_attributes_values";
                    $ret  = $moderator->catalog_massaction($conn, $data, $table, 'call_back_attribute_val');
                }
                

                unset($_SESSION["VARIANCE_ID"]);
            }

            echo (json_encode($ret));
        }
    } elseif ($action == "render_parent_select") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

        if(!empty($data)){
            exit;
        }else{
            $responce = $moderator->getitemsbyref("None", "tbl_category", "cat_parent", $moderator->getConnection());
            
            if($responce[0]){
                ?>
                <option value="None">None</option>
                <?php
                $initializer = 0;
                $max = count($responce[1]);
                for($initializer;$initializer < $max;$initializer++){
                ?>
                <option value="<?php echo $responce[1][$initializer]['cat_name']; ?>"><?php echo $responce[1][$initializer]['cat_name']; ?></option>
                <?php
                }
            }else{
                exit;
            }
        }

        unset($_SESSION["VARIANCE_ID"]);

    } elseif ($action == "select_variance"){
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;


        if(!empty($data)){
            $id = $data['id'];
            $table = $data['table'];
            $_SESSION["VARIANCE_ID"] = $id;

            if($table == 'category'){
                $responce = $moderator->getitemsbyref($id, "tbl_category", "UUID", $moderator->getConnection());
            } else if($table == 'attribute'){
                $responce = $moderator->getitemsbyref($id, "tbl_attributes", "UUID", $moderator->getConnection());
            } else if($table == 'tag'){
                $responce = $moderator->getitemsbyref($id, "tbl_tags", "UUID", $moderator->getConnection());
            } else if ($table == 'attribute_val') {
                $responce = $moderator->getitemsbyref($id, "tbl_attributes_values", "UUID", $moderator->getConnection());
            }else{
                exit;
            }
            
            echo (json_encode($responce));
        }else{
            exit;
        }
    } elseif ($action == "reset_variance"){
        unset($_SESSION["VARIANCE_ID"]);
        echo "category unset";
    } elseif ($action == "bulk_apply"){
        
        $res = $moderator->getitemsbyref($_SESSION['CURRENT_USER'], "tbl_moderators", "userEmailAddress", $moderator->getConnection());

        if($res[0] != true){
            echo "problem validating user";
            exit();
        }else{
            //get role
            $role = $res[1][0]['Role'];
            //get data
            $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

            
            if(!empty($data)){
                $intent = $data[0];
                

                switch ($intent) {
                    case 'Delete':
                        if($role == "Admin"){
                            $Form = $data[1];
                            $ids = $data[2];
                            

                            switch ($Form) {
                                case "Category":
                                    $resp = array(
                                        "errors"=>"false",
                                        "statement" => " ",
                                        "succesful" => " ",
                                        "unsuccesful" => ["null"]
                                    );
                                    $unsuccessful = [];
                                    $successful = [];
                                    foreach ($data[2] as $value) {
                                        //delete where id = $value
                                        if($value == 1){
                                            continue;
                                        }
                                        $delete = $admin->deleteitem($value, "tbl_category",$admin->getConnection());

                                        if($delete){
                                            array_push($successful,$value);
                                            continue;
                                        }else{
                                            array_push($unsuccessful, $value);
                                            continue;
                                        }
                                    }

                                    $errors = count($unsuccessful);

                                    if($errors > 0){
                                        $resp;
                                    }else{
                                        $resp['errors'] = false;
                                        $resp['Statement'] = "Deleted Successfully";
                                        $resp['succesful'] = $successful;
                                        $resp['unsuccesful'] = $unsuccessful;

                                        echo(json_encode($resp));
                                    }

                                    break;
                                case "tag":
                                    $resp = array(
                                        "errors" => "false",
                                        "statement" => " ",
                                        "succesful" => " ",
                                        "unsuccesful" => ["null"]
                                    );
                                    $unsuccessful = [];
                                    $successful = [];
                                    foreach ($data[2] as $value) {
                                        //delete where id = $value
                                        $delete = $admin->deleteitem($value, "tbl_tags", $admin->getConnection());

                                        if ($delete) {
                                            array_push($successful, $value);
                                            continue;
                                        } else {
                                            array_push($unsuccessful, $value);
                                            continue;
                                        }
                                    }

                                    $errors = count($unsuccessful);

                                    if ($errors > 0) {
                                        $resp;
                                    } else {
                                        $resp['errors'] = false;
                                        $resp['Statement'] = "Deleted Successfully";
                                        $resp['succesful'] = $successful;
                                        $resp['unsuccesful'] = $unsuccessful;

                                        echo (json_encode($resp));
                                    }

                                    break;
                                case "attribute":
                                    $resp = array(
                                        "errors" => "false",
                                        "statement" => " ",
                                        "succesful" => " ",
                                        "unsuccesful" => ["null"]
                                    );
                                    $unsuccessful = [];
                                    $successful = [];
                                    foreach ($data[2] as $value) {
                                        //delete where id = $value
                                        $delete = $admin->deleteitem($value, "tbl_attributes", $admin->getConnection());

                                        if ($delete) {
                                            array_push($successful, $value);
                                            continue;
                                        } else {
                                            array_push($unsuccessful, $value);
                                            continue;
                                        }
                                    }

                                    $errors = count($unsuccessful);

                                    if ($errors > 0) {
                                        $resp;
                                    } else {
                                        $resp['errors'] = false;
                                        $resp['Statement'] = "Deleted Successfully";
                                        $resp['succesful'] = $successful;
                                        $resp['unsuccesful'] = $unsuccessful;

                                        echo (json_encode($resp));
                                    }

                                    break;
                                case "attribute_val":
                                    $resp = array(
                                        "errors" => "false",
                                        "statement" => " ",
                                        "succesful" => " ",
                                        "unsuccesful" => ["null"]
                                    );
                                    $unsuccessful = [];
                                    $successful = [];
                                    foreach ($data[2] as $value) {
                                        //delete where id = $value
                                        $delete = $admin->deleteitem($value, "tbl_attributes_values", $admin->getConnection());

                                        if ($delete) {
                                            array_push($successful, $value);
                                            continue;
                                        } else {
                                            array_push($unsuccessful, $value);
                                            continue;
                                        }
                                    }

                                    $errors = count($unsuccessful);

                                    if ($errors > 0) {
                                        $resp;
                                    } else {
                                        $resp['errors'] = false;
                                        $resp['Statement'] = "Deleted Successfully";
                                        $resp['succesful'] = $successful;
                                        $resp['unsuccesful'] = $unsuccessful;

                                        echo (json_encode($resp));
                                    }

                                    break;
                                default:
                                    echo "Your favorite color is neither red, blue, nor green!";
                            }

                        }else{
                            echo "cannot delete";
                            exit();
                        }
                        break;
                    case 'Disable':
                        echo "disabling";
                        break;
                    default:
                        echo "default here right";
                }
            }else{
                echo "not available";
                exit();
            }

        }

        // var_dump($res);
    } elseif ($action == "set_var"){

        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "";

        if(!empty($data)){
            $_SESSION['ATT_ID'] = $data;

            echo $_SESSION['ATT_ID'];
        }

    } elseif ($action == "assign_attribute") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

        if (!isset($data)) {
            exit;
        }else{
            $data = encodeToHTML($data);
            attribute_component($data,$moderator);
        }
    } elseif ($action == "set_vendor"){
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

        if(!isset($data)){
            echo "no data";
            exit();
        }else{
            $_SESSION['CURRENT_VENDOR'] = $data;
        }
    } elseif ($action == "reset_vendor") {
        unset($_SESSION["CURRENT_VENDOR"]);
        echo "hi";
    } elseif ($action == "set_roduct") {
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

        if (!isset($data)) {
            echo "no data";
            exit();
        } else {
            $_SESSION['CURRENT_PRODUCT'] = $data;
        }
    } elseif ($action == "reset_product") {
        unset($_SESSION["CURRENT_PRODUCT"]);
        echo "hi";
    } elseif($action == "change_password"){
        $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;
        if (!isset($data)) {
            exit;
        } else {
            //test if email and the session ID are the same
            //this will ensure the user changing the password for
            //designated user for the account unless his account type is admin

            //unPackage
            $data = json_decode($data);

            //assign variables
            $emailAddress = $data->email;
            $currentPassword = $data->currentPassword;
            $newPassword = $data->newPassword;
            $confirmPassword = $data->confirmPassword;
            

            $user =  $moderator->getitemsbyref($_SESSION['CURRENT_USER'], "tbl_moderators", "userEmailAddress", $moderator->getConnection());
            $accountType;
            $userPassword;
            if($user[0] == true){
                $accountType = $user[1][0]['Role'];
                $userPassword = $user[1][0]['password'];
            }else{
                echo "Not designated User \n";
                echo "Action Termination \n";
                exit();
            }

            if($emailAddress == $_SESSION['CURRENT_USER'] || $accountType == "Admin"){
                //user Verified
                // confirm the current password

                if (!password_verify($currentPassword, $userPassword) || $newPassword == "password") {
                    echo "Invalid password entered";
                    exit();
                } else {
                    //verified the password
                    //confirm its not the same password

                    if (password_verify($newPassword, $userPassword)) {
                        echo "Same password used";
                        exit();
                    }else{
                        $password = password_hash($newPassword, PASSWORD_DEFAULT);

                        $dataset = array(
                            "password" => $password,
                        );
                        $conditionValues = array(
                            $statement = "userEmailAddress=? ",
                            $values = array(
                                $emailAddress
                            )
                        );

                        $table = 'tbl_moderators';

                        $returning = $moderator->update_database($dataset, $table, $moderator->getConnection(),$conditionValues, "ss");

                        if ($returning){
                            echo "password Updated";
                            exit();
                        }else{
                            echo "error occurred";
                        }
                    }

                }

            }
        }
    } else {
        echo "null";
    }
} else {
    echo "not POst";
}

?>

