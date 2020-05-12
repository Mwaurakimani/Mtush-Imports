<?php
include_once '../Php/modal.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = $moderator->getConnection();
      $F_name = isset($_REQUEST['F_name']) ?  ($_REQUEST['F_name']) : $F_name = "";
      $L_name = isset($_REQUEST['L_name']) ?  ($_REQUEST['L_name']) : $L_name = "";
      $nationalID = isset($_REQUEST['UserID']) ?  ( $_REQUEST['UserID']) : $nationalID = "";
      $Gender = isset($_REQUEST['Gender']) ?  ( $_REQUEST['Gender']) : $Gender = "";
      $O_name = isset($_REQUEST['O_name']) ?  ($_REQUEST['O_name']) : $O_name = "";
      $U_name = isset($_REQUEST['U_name']) ?  ($_REQUEST['U_name']) : $U_name = "";
      $Email = isset($_REQUEST['Email']) ?  ($_REQUEST['Email']) : $Email = "";
      $P_Number = isset($_REQUEST['P_Number']) ?  ($_REQUEST['P_Number']) : $P_Number = "";
      $Address = isset($_REQUEST['Address']) ?  ($_REQUEST['Address']) : $Address = "";
      $Role = isset($_REQUEST['Role']) ?  ($_REQUEST['Role']) : $Role = "";
      $Status = isset($_REQUEST['Status']) ?  ($_REQUEST['Status']) : $Status = "";


    if (empty($F_name) || empty($nationalID) || empty($L_name) || empty($Gender) || empty($Email) || empty($P_Number) || empty($Address) || empty($Role) || empty($Status)) {
        if(empty($F_name)) {
            echo "F_name";
            exit;
        }
        if (empty($nationalID)) {
            echo "nationalID";
            exit;
        }
        if(empty($L_name)) {
            echo "L_name";
            exit;
        }
        if(empty($Gender)) {
            echo "Gender";
            exit;
        }
        if(empty($O_name)) {
            echo "O_name";
            exit;
        }
        if(empty($U_name)) {
            echo "U_name";
            exit;
        }
        if(empty($P_Number)) {
            echo "P_Number";
            exit;
        }
        if(empty($Role)) {
            echo "Role";
            exit;
        }
        if(empty($Status)) {
            echo "Status";
            exit;
        }
        exit;
    }else{
        if ( 
            !preg_match("/^[a-zA-Z]*$/", $F_name) || 
            !preg_match("/^[a-zA-Z]*$/", $L_name) ||
            !preg_match("/^[a-zA-Z]*$/", $O_name) || 
            !preg_match("/^[a-zA-Z]*$/", $Gender) || 
            !preg_match("/^[a-zA-Z]*$/", $Status) || 
            !preg_match("/^[a-zA-Z]*$/", $Role) ||  
            !preg_match("/^[0-9+]*$/", $P_Number)
            ) {

            if (!preg_match("/^[a-zA-Z]*$/", $F_name)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[a-zA-Z]*$/", $L_name)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[a-zA-Z]*$/", $Gender)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[a-zA-Z]*$/", $O_name)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[a-zA-Z0-9_]*$/", $U_name)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[0-9+\\s]*$/", $P_Number)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[a-zA-Z]*$/", $Role)) {
                echo "error";
                exit;
            }
            if (!preg_match("/^[a-zA-Z]*$/", $Status)) {
                echo "error";
                exit;
            }
                
            
        }else{
            if (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
                echo "invalid email address";
                exit;
            }else{
                if(!empty($U_name)){
                    if(!preg_match("/^[a-zA-Z0-9_]*$/", $U_name)){
                        echo "invalid username";
                        exit;
                    }
                }
                $exist = $moderator->ifItemExist($Email, "tbl_moderators", "userEmailAddress", $conn);
                
                if($exist){
                    $UserData = array(
                        'F_name' => encodeToHTML($F_name),
                        'L_name' => encodeToHTML($L_name),
                        'NID' => encodeToHTML($nationalID),
                        'O_name' => encodeToHTML($O_name),
                        'U_name' => encodeToHTML($U_name),
                        'Gender' => encodeToHTML($Gender),
                        'Email' => encodeToHTML($Email),
                        'P_Number' => encodeToHTML($P_Number),
                        'Address' => encodeToHTML($Address),
                        'Role' => encodeToHTML($Role),
                        'Status' => encodeToHTML($Status)
                    );

                    $UserData = json_encode($UserData);
                    $reg = $moderator->userpassdata($UserData, $moderator->getConnection());

                    if ($reg[0]) {
                        $_SESSION['REG_EMAIL'] = $reg[1][0]['userEmailAddress'];
                        echo "sucessful";
                        exit;
                    } else {
                        echo "error adding record";
                        exit;
                    }
                    exit;
                }else{
                    $UserData = array(
                        'F_name' => encodeToHTML($F_name),
                        'L_name' => encodeToHTML($L_name),
                        'NID' => encodeToHTML($nationalID),
                        'O_name' => encodeToHTML($O_name),
                        'U_name' => encodeToHTML($U_name),
                        'Gender' => encodeToHTML($Gender),
                        'Email' => encodeToHTML($Email),
                        'P_Number' => encodeToHTML($P_Number),
                        'Address' => encodeToHTML($Address),
                        'Role' => encodeToHTML($Role),
                        'Status' => encodeToHTML($Status)
                    );

                    $UserData = json_encode($UserData);
                    $reg = $moderator->userpassdata($UserData, $moderator->getConnection());

                    if ($reg[0]) {
                        $_SESSION['REG_EMAIL'] = $reg[1][0]['userEmailAddress'];
                        echo "sucessful";
                    } else {
                        echo "error adding record";
                    }
                }
            }
        }
    }
    
}elseif($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    $admin->deleteall("tbl_moderators",$conn = $admin->getConnection());
}else{
    echo "not POst";
}

?>
