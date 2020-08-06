<?php

class create_cred {
    private $firstname;
    private $fathersname;
    private $username;
    private $password;

    public function __construct($firstname, $fathersname)
    {
        $this->firstname = $firstname;
        $this->fathersname = $fathersname;
        $this->generateUsername();
        $this->generatePassword();
        return true;
    }

    private function generateUsername(){
        $tempfname = mb_substr($this->firstname,0,3);
        $tempftname= mb_substr($this->fathersname,0,3);
        $this->username=$tempfname.$tempftname."-".mb_substr(uniqid(),5,2).mb_substr(uniqid(),9,2);
        // echo "<h1>".$tempUname."</h1>";
    }
    private function generatePassword(){
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $chars= 'abcdefghijklmnpqrstuvwxyz';
        $chars.= '123456789';
        $this->password = mb_substr(str_shuffle(sha1(uniqid().time()).$chars),0,10);
        // echo $password;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
}

// $new = new user_cred("bereket", "ababu");
// echo $new->getUsername();
// echo $new->getPassword();