<?php
header('Content-type: application/json');
include_once '../Php/modal.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resp = array(
        "responce_code"=>0,
        "responce_data"=>null
    );

    $conn = $moderator->getConnection();
    $name = isset($_REQUEST['name']) ?  ( $_REQUEST['name']) : $name = "";
    $city1 = isset($_REQUEST['city1']) ?  ( $_REQUEST['city1']) : $city1 = "";
    $Address1 = isset($_REQUEST['Address1']) ?  ( $_REQUEST['Address1']) : $Address1 = "";
    $city2 = isset($_REQUEST['city2']) ?  ( $_REQUEST['city2']) : $city2 = "";
    $Address2 = isset($_REQUEST['Address2']) ?  ( $_REQUEST['Address2']) : $Address2 = "";
    $POBox = isset($_REQUEST['POBox']) ?  ( $_REQUEST['POBox']) : $POBox = "";
    $contact_name = isset($_REQUEST['contact_name']) ?  ( $_REQUEST['contact_name']) : $contact_name = "";
    $contact_title = isset($_REQUEST['contact_title']) ?  ( $_REQUEST['contact_title']) : $contact_title = "";
    $Phone = isset($_REQUEST['Phone']) ?  ( $_REQUEST['Phone']) : $Phone = "";                                                                                                                                                                                               
    $Email = isset($_REQUEST['Email']) ?  ( $_REQUEST['Email']) : $Email = "";
    $website = isset($_REQUEST['website']) ?  ( $_REQUEST['website']) : $website = "";
    $Notes = isset($_REQUEST['Notes']) ?  ( $_REQUEST['Notes']) : $Notes = "";


    if (empty($name) || empty($city1) || empty($Address1) || empty($contact_name) || empty($contact_title) || empty($Phone)) {
        $resp['responce_code'] = 1;
        var_dump($resp);
        exit;
    } else {
        if (
            !preg_match("/^[a-zA-Z0-9,.!? ]*$/", $name) ||
            !preg_match("/^[0-9+]*$/", $Phone)
        ) {

            if (!preg_match("/^[a-zA-Z]*$/", $name)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[0-9+\\s]*$/", $Phone)) {
                echo "error";
                exit;
            }
        } else {
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
                echo "invalid email address";
                exit;
            } else {
                if (!empty($name)) {
                    if (!preg_match("/^[a-zA-Z0-9,.!? ]*$/", $name)) {
                        echo "invalid Vendor Name";
                        exit;
                    }
                }
                $exist = false;
                
                if(isset($_SESSION['CURRENT_VENDOR'])){
                    $exist = true;
                }else{
                    $exist = false;
                }

                if ($exist) {
                    $USER = $_SESSION['CURRENT_USER'];
                    $res = $moderator->getitemsbyref($USER, "tbl_moderators", "userEmailAddress", $conn);
                    $user = $res[1][0]['UUID'];

                    $UserData = array(
                        'vendorName' => encodeToHTML($name),
                        'city1' => encodeToHTML($city1),
                        'address1' => encodeToHTML($Address1),
                        'city2' => encodeToHTML($city2),
                        'address2' => encodeToHTML($Address2),
                        'postalCode' => encodeToHTML($POBox),
                        'contactName' => encodeToHTML($contact_name),
                        'contactTitle' => encodeToHTML($contact_title),
                        'Phone' => encodeToHTML($Phone),
                        'Email' => encodeToHTML($Email),
                        'Url' => encodeToHTML($website),
                        'Note' => encodeToHTML($Notes),

                        'createdBy' => $user,
                        'modifiedBy' => $user
                    );


                    $UserData = json_encode($UserData);

                    $reg = $moderator->update_vendor($UserData, $moderator->getConnection(), $_SESSION['CURRENT_VENDOR']) ;

                    if ($reg[0]) {
                        $_SESSION['CURRENT_VENDOR'] = $reg[1][0]['UUID'];

                        $resp = array(
                            "responce_code" => 1,
                            "responce_data" => $res
                        );

                        echo json_encode($reg);
                    } else {
                        echo "error adding record";
                    }
                } else {
                    $USER = $_SESSION['CURRENT_USER'];
                    $res = $moderator->getitemsbyref($USER, "tbl_moderators", "userEmailAddress", $conn);
                    $user = $res[1][0]['UUID'];

                    $UserData = array(
                        'vendorName' => encodeToHTML($name),
                        'city1' => encodeToHTML($city1),
                        'address1' => encodeToHTML($Address1),
                        'city2' => encodeToHTML($city2),
                        'address2' => encodeToHTML($Address2),
                        'postalCode' => encodeToHTML($POBox),
                        'contactName' => encodeToHTML($contact_name),
                        'contactTitle' => encodeToHTML($contact_title),
                        'Phone' => encodeToHTML($Phone),
                        'Email' => encodeToHTML($Email),
                        'Url' => encodeToHTML($website),
                        'Note' => encodeToHTML($Notes),

                        'createdBy' => $user,
                        'modifiedBy' => $user
                    );


                    $UserData = json_encode($UserData);

                    $reg = $moderator->update_vendor($UserData, $moderator->getConnection(),null);

                    if ($reg[0]) {
                        $_SESSION['CURRENT_VENDOR'] = $reg[1][0]['UUID'];

                        $resp = array(
                            "responce_code" => 1,
                            "responce_data" => $res
                        );

                        echo json_encode($reg);
                    } else {
                        echo "error adding record";
                    }
                }
            }
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $admin->deleteall("tbl_moderators", $conn = $admin->getConnection());
} else {
    echo "not POst";
}

?>
      