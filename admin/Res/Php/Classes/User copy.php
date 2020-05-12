
<?php
  /*
   * User Parent Class
   
  trait  appUser
  {
    protected $userID;            //userID
    protected $userFirstName;     //firstname
    protected $userLastName;      //lastname
    protected $userOtherName;     //othername
    protected $gender;            //userGender
    protected $userDOB;           //date of birth
    protected $userName;          //nickname/username
    protected $userEmailAddress;  //primaryemailaddress
    protected $userPhoneNumber;  //primaryphonenumbe
    protected $userCountryCode;   //countrycode
    protected $userCountry;       //country
    protected $userLocationID;    //lyricornmapid
    protected $userRegDate;       //dateenroled
    protected $accStatus;         //authorisation set
    protected $accountType;       //account type
    protected $profilePicture;    //profile image


    //getterFunctions
    public function getuserID(){
      return $this->userID;
    }
    public function getuserFirstName(){
      return $this->userFirstName;
    }
    public function getuserLastName(){
      return $this->userLastName;
    }
    public function getuserOtherName(){
      return $this->userOtherName;
    }
    public function getuserDOB(){
      return $this->userDOB;
    }
    public function getgender(){
      return $this->gender;
    }
    public function getuserName(){
      return $this->userName;
    }
    public function getuserEmailAddress(){
      return $this->userEmailAddress;
    }
    public function getuserPhoneNumber(){
      return $this->userPhoneNumber;
    }
    public function getuserCountryCode(){
      return $this->userCountryCode;
    }
    public function getuserCountry(){
      return $this->userCountry;
    }
    public function getuserLocationID(){
      return $this->userLocationID;
    }
    public function getaccStatus(){
      return $this->accStatus;
    }
    public function getaccType(){
      return $this->accountType;
    }
    public function getConnection(){
      return $this->connection;
    }
    public function getprofilepicture(){
      return $this->profilePicture;
    }

    //setterFunctions
    public function setuserID($var){
      $this->userID = $var;
    }
    public function setuserFirstName($var){
      $this->userFirstName = $var;
    }
    public function setuserLastName($var){
      $this->userLastName = $var;
    }
    public function setuserOtherName($var){
      $this->userOtherName = $var;
    }
    public function setuserDOB($var){
      $this->userDOB = $var;
    }
    public function setgender($var){
      $this->gender = $var;
    }
    public function setuserName($var){
      $this->userName = $var;
    }
    public function setuserEmailAddress($var){
      $this->userEmailAddress = $var;
    }
    public function setuserPhoneNumber($var){
      $this->userPhoneNumber = $var;
    }
    public function setuserCountryCode($var){
      $this->userCountryCode = $var;
    }
    public function setuserCountry($var){
      $this->userCountry = $var;
    }
    public function setuserLocationID($var){
      $this->userLocationID = $var;
    }
    public function setuserRegDate($var){
      $this->$userRegDate = $var;
    }
    public function setaccStatus($var){
      $this->accStatus = $var;
    }
    public function setaccType($var){
      $this->accountType = $var;
    }
    public function setconnection($var){
      $this->connection = $var;
    }
    public function setprofilepicture($var){
      $this->profilePicture = $var;
    }



    //other methods
    //SignUp users
    public function userpassdata($var,$conn){
      $data = json_decode($var);

      $thisuser = new subuser();

      if(isset($data->firstName)){
        $thisuser->setuserFirstName($data->firstName);
      }
      if(isset($data->lastName)){
        $thisuser->setuserLastName($data->lastName);
      }
      if(isset($data->otherName)){
        $thisuser->setuserOtherName($data->otherName);
      }
      if(isset($data->gender)){
        $thisuser->setgender($data->gender);
      }
      if(isset($data->DOB)){
        $thisuser->setuserDOB($data->DOB);
      }
      if(isset($data->userName)){
        $thisuser->setuserName($data->userName);
      }
      if(isset($data->emailAddress)){
        $thisuser->setuserEmailAddress($data->emailAddress);
      }
      if(isset($data->phoneNumber)){
        $thisuser->setuserPhoneNumber($data->phoneNumber);
      }
      if(isset($data->countryCode)){
        $thisuser->setuserCountryCode($data->countryCode);
      }
      if(isset($data->country)){
        $thisuser->setuserCountry($data->country);
      }
      if(isset($data->location)){
        $thisuser->setuserLocationID($data->location);
      }
      if(isset($data->profilePicture)){
        $thisuser->setgender($data->profilePicture);
      }
      if(isset($data->password)){
        $password = $data->password;
      }
      if(isset($data->status)){
        $thisuser->setaccStatus($data->status);
      }


      if(isset($data->Currentemail)){
        $exist = $this->ifEmailExist($data->Currentemail,$conn);
      }else{
        $exist = $this->ifEmailExist($thisuser->getuserEmailAddress(),$conn);
      }


      if(!$exist){
        echo 'Creating the new user<br>';
        $ID = $this->generateUUID();
        try {
          //prepare query
          $stmt = $conn->prepare("INSERT INTO tbl_users (UUID) VALUES (?)");

          //bind parameters
          $bind = $stmt->bind_param("s",$ID);

          //catch bind error
          if($bind === false){
            throw new Exception("Error, could not process data submitted.");
          }

          //execute
          $stmt->execute();
          $stmt->close();

          //catch execution error
          if($stmt === false){
            throw new Exception("Error, count not execute database query.");
          }


          //we now insert userdata to the database

          $inval = [
              $thisuser->getuserFirstName(),
              $thisuser->getuserLastName(),
              $thisuser->getuserOtherName(),
              $thisuser->getgender(),
              $thisuser->getuserName(),
              $thisuser->getuserEmailAddress(),
              $thisuser->getuserPhoneNumber(),
              $thisuser->getuserCountryCode(),
              $thisuser->getuserCountry(),
              $thisuser->getuserLocationID(),
              $thisuser->getaccStatus(),
              $thisuser->getaccType(),
              $thisuser->getprofilepicture()
          ];
          $filednames = [
            'userFirstName',
            'userLastName',
            'userOtherName',
            'gender',
            'userName',
            'userEmailAddress',
            'userPhoneNumber',
            'userCountryCode',
            'userCountry',
            'userLocationID',
            'accountStatus',
            'accountType',
            'profilePicture'
          ];

          $combined  = array_combine($filednames, $inval);
          foreach ($combined as $k => $v) {
            if($v){
              $stmt = $conn->prepare("UPDATE tbl_users SET $k=? WHERE UUID=?");
              $stmt->bind_param('ss',$v, $ID);
              $stmt->execute();
              $stmt->close();
            }
          }

          //enter date
          date_default_timezone_set('Africa/Nairobi');

          $regdate = date('Y-m-d H:i:s');
          $dateofbirth = $thisuser->getuserDOB();;

            //pass date of birth
          if(isset($dateofbirth)){
            $stmt = $conn->prepare("UPDATE tbl_users SET userDOB=? WHERE UUID=?");
            $stmt->bind_param('ss',$dateofbirth,$ID);
            $stmt->execute();
            $stmt->close();
          }


          $password = password_hash($password,PASSWORD_DEFAULT);
          //pass date of registration and password
          $stmt = $conn->prepare("UPDATE tbl_users SET regDate=?,password=? WHERE UUID=?");
          $stmt->bind_param('sss',$regdate,$password,$ID);
          $stmt->execute();
          $stmt->close();



          $user = $this->getUserformEmail($thisuser->getuserEmailAddress(),$conn);

            $ID = $user['UUID'];
            $obj = $user;


          return $obj;

          }catch (Exception $e) {
            if($bind){
              header('Location: '.ROOT.'/SignUp?signup=501');
            }
            if($stmt){
              header('Location: '.ROOT.'/SignUp?signup=502');
            }

            die($e->getMessage());
        }
      }
      else{
        echo 'executing';
        $Record = $this->getUserformEmail($data->Currentemail,$conn);
        $ID = $Record['UUID'];
        $obj = $Record;

        $inval = [
            $thisuser->getuserFirstName(),
            $thisuser->getuserLastName(),
            $thisuser->getuserOtherName(),
            $thisuser->getgender(),
            $thisuser->getuserName(),
            $thisuser->getuserEmailAddress(),
            $thisuser->getuserPhoneNumber(),
            $thisuser->getuserCountryCode(),
            $thisuser->getuserCountry(),
            $thisuser->getuserLocationID(),
            $thisuser->getaccStatus(),
            $thisuser->getaccType(),
            $thisuser->getprofilepicture()
        ];
        $filednames = [
          'userFirstName',
          'userLastName',
          'userOtherName',
          'gender',
          'userName',
          'userEmailAddress',
          'userPhoneNumber',
          'userCountryCode',
          'userCountry',
          'userLocationID',
          'accountStatus',
          'accountType',
          'profilePicture'
        ];

        $combined  = array_combine($filednames, $inval);
        foreach ($combined as $k => $v) {
          if($v){
            $stmt = $conn->prepare("UPDATE tbl_users SET $k=? WHERE UUID=?");
            $stmt->bind_param('ss',$v, $ID);
            $stmt->execute();
            $stmt->close();
          }
        }

        //enter date
        date_default_timezone_set('Africa/Nairobi');
        $date = date('Y-m-d H:i:s');

        if($data->password){
          echo 'pass word changed';
          $password = password_hash($password,PASSWORD_DEFAULT);
          //pass date and password
          $stmt = $conn->prepare("UPDATE tbl_users SET password=? WHERE UUID=?");
          $stmt->bind_param('ss',$password,$ID);
          $stmt->execute();
          $stmt->close();
        }

        $dateofbirth = $thisuser->getuserDOB();;

        //pass date of birth
        if(isset($dateofbirth)){
          $stmt = $conn->prepare("UPDATE tbl_users SET userDOB=? WHERE UUID=?");
          $stmt->bind_param('ss',$dateofbirth,$ID);
          $stmt->execute();
          $stmt->close();
        }

        $obj = $this->getUserformEmail($thisuser->getuserEmailAddress(),$conn);

        echo $thisuser->getuserEmailAddress();

        return $obj;

      }
    }

    public function userlogin($var,$conn){
      $data = json_decode($var);

      $thisuser = new subuser();

      $thisuser->setuserEmailAddress($data->emailAddress);
      $email = $data->emailAddress;
      $pass = $data->password;

      //get user password
      $user = $this->getUserformEmail($email,$conn);
      $dbpassword = $user['password'];

      if(password_verify($pass,$dbpassword)){
        return $user;
      }else{
        return false;
      }
    }

    public function userlogout($root_doc){
      session_start();
      session_unset();
      session_destroy();

      header("location:".ROOT);
      exit();
    }

    //Universal Unique Idetifier
    public function generateUUID(){
      return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
    }

    //check if the email exists
    public function ifEmailExist($email,$conn){
      $sql = "SELECT * FROM tbl_users WHERE userEmailAddress = '$email'";
      $result = mysqli_query($conn, $sql);
      $resaultnumber = mysqli_num_rows($result);
      mysqli_close($conn);

      if($resaultnumber > 0){
        return true;
      }else{
        return false;
      }
    }

    //get user using their email address
    public function getUserformEmail($email,$conn){
      $sql = "SELECT * FROM tbl_users WHERE userEmailAddress = '$email'";
      $result = mysqli_query($conn, $sql);
      mysqli_close($conn);

      while($row = $result->fetch_assoc()) {
        $obj = $row;

        return $obj;
      }
    }

    //check if the file name exist
    public function ifImageNameExist($filename,$conn){
      $sql = "SELECT * FROM tbl_users WHERE profilePicture = '$filename'";
      $result = mysqli_query($conn, $sql);
      $resaultnumber = mysqli_num_rows($result);
      mysqli_close($conn);

      if($resaultnumber > 0){
        return true;
      }else{
        return false;
      }
    }

    //transfering media files to the system
    public function fileTransfer($file,$conn,$Root,$reg){
      $file_name = $file['name'];

      //test if file is empty
      if(!empty($file_name)){
        //were to place it
          $target_dir = $Root."Res/Images/Profile";

          $filetmpname = $file['tmp_name'];
          $filesize = $file['size'];
          $fileerror = $file['error'];
          $filetype = $file['type'];

          $fileExt = explode('.',$file_name);
          $fileExt = strtolower(end($fileExt));

          $allow = array('jpg','jpeg','png');

           if(in_array($fileExt,$allow)){
             if ($fileerror === 0){
               if ($filesize < 5000000 ) {
                 //consider mtrand
                 $fileNamenew = uniqid('',true).'.'.$fileExt;

                 $currentPic = $reg['profilePicture'];
                 $fullfilename = '../Res/Images/Profile/'.$currentPic;


                 if (file_exists($fullfilename)) {
                   if (!($fullfilename == '../Res/Images/Profile/default.jpg')) {
                      unlink($fullfilename);
                      echo "deleted";
                   }
                  }


                 $exist = $this->ifImageNameExist($fileNamenew,$conn);

                 if($exist){
                   $fileNamenew = uniqid('',true).'.'.$fileExt;
                 }else{
                    $filelocation = $target_dir.'/'.$fileNamenew;

                    $fileNamenew_pass = "'".$fileNamenew."'";

                    move_uploaded_file($filetmpname,$filelocation);

                    echo('executing');
                    $stmt = $conn->prepare("UPDATE tbl_users SET profilePicture=? WHERE UUID=?");
                    $stmt->bind_param('ss',$fileNamenew,$reg['UUID'] );
                    $stmt->execute();
                    $stmt->close();
                 }




               }else {
                 // the file size is too large
               }

               //there was an error uploading the image
             }else{
             }

           }else{
             //the file is not saved in the correct format
           }
      }
    }

    //delete the user
    //can only be done by the administrator


    //Not tested
    public function deleteauser($userid,$conn){
      //not tested!!!!!!!!!!!!!
      $stmt = $conn->prepare("DELETE FROM `tbl_users` WHERE UUID=?;");
      $stmt->bind_param('s',$userid);
      $stmt->execute();
      $stmt->close();
    }
    public function closedb(){
      $this->connection->close();
      echo 'closed';
    }
    public function getorders(){

      $sql = "SELECT * FROM show_customer_orders Where OrderID=1";

      return $this->connection->query($sql);
    }

  }
