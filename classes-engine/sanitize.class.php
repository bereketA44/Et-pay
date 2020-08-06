<?php
class sanitize{
 /* private $nameString; //0
    private $spacedString; //1
    private $number; //2
    private $email; //3
 */
    public function __sanitize($input, $target)
    {
        if($target == 0){ // for names
            return preg_replace("/[^A-Za-z]/", '', htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8'));
            
        }else if($target == 1){ // for spaced strings
            return preg_replace("/[^A-Za-z]/", ' ', htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8'));
            
        }else if($target == 2){// for numbers
            return preg_replace("/[^0-9]/", '', htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8'));
            
        }else if($target == 3){ // for email
            return htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8');
        }else if($target == 4){ // for date
            return preg_replace("/[^0-9\/]/", '', htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8'));
        }else if ($target == 5){ // for username and password
            return preg_replace("/[^A-Za-z0-9-]/", '', htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8'));
        }else if ($target == 6){ // for spaced values (for paymentHandler)
            return preg_replace("/[^A-Za-z0-9-. ]/", ' ', htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8'));
        }
        else {
            return 0;
        }
    }
}