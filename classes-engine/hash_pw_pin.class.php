<?php
    class hash_pw_pin{
        private $salted_rawpin;
        private $salted_rawpassword;
        private $salt;

        public function __construct(){
            $this->salt = "~*E2tep6Y0*~*Y69t93E5*~";
        }

        public function hashpin($rawpin){
            $this->salted_rawpin = $this->salt.$rawpin;
            /* 
                using PHP native password hashing API 
                Argon2I algorithm after salting the raw input 
            */
            $hashed_pin = password_hash($this->salted_rawpin, PASSWORD_ARGON2I);
            return $hashed_pin;
        }

        public function hashpassword($rawpassword){
            $this->salted_rawpassword = $this->salt.$rawpassword;
            /* 
                using PHP native password hashing API 
                Argon2I algorithm after salting the raw input 
            */
            $hashed_passowrd = password_hash($this->salted_rawpassword, PASSWORD_ARGON2I);
            return $hashed_passowrd;
        }
    }

?>