<?php

class dashBoardLoader {

    public $passwordTest;

    public function onCreate($user){
        // var_dump($user);
        
        $this->passwordTest($user[1][0]['password']);
    }

    /**
     * This method ensures that the user is not using the default password
     */
    public function passwordTest($password)
    {
        if(password_verify("password", $password)){
            $this->passwordTest = false;
            return;
        }else{
            $this->passwordTest = true;
            return;
        }
    }
}
