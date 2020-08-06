<?php
DEFINE  ('ET_PAY_Email', 'bereketababub44@gmail.com');
DEFINE ('ET_PAY_Email_password', 'bereketababu1144B');
require '../PHPMailerAutoload.php';
class emailer{
    private $user_email;
    private $username;
    private $password;
    private $stat;
    public function __construct($user_email, $username, $password)
    {
        $this->user_email = $user_email;
        $this->username = $username;
        $this->password = $password;
        $this->__send();
    }

    private function __send(){
        $mail = new PHPMailer;
        // $mail->SMTPDebug = 4;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = ET_PAY_Email;                 // SMTP username
        $mail->Password = ET_PAY_Email_password;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        $mail->setFrom(ET_PAY_Email, 'ET-Pay Security Controls');
        $mail->addAddress($this->user_email);     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo(ET_PAY_Email);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        if ($this->username != 'NULLETPAYVALUE'){
            $mail->Subject = 'Your ET-Pay Username and Password';
            $mail->Body    = '<h1>Please dont show this to anyone </h1> <h2>Username-> '.$this->username.'<br> Password-> '.$this->password.'</h2>';
            $mail->AltBody = 'username-->'.$this->username.'------- Password->'.$this->password;
        }
        else if ($this->username == 'NULLETPAYVALUE') {
            $mail->Subject = 'ET-Pay Confirmation Code';
            $mail->Body    = '<h1>Please dont show this to anyone </h1> <h2>6 Digit Code-> '.$this->password.'<br>';
            $mail->AltBody = '6 Digit Code-->'.$this->password;
    
        }else {
            $mail->Subject = 'ET-Pay Confirmation Code';
            $mail->Body    = 'error';
            $mail->AltBody = '6 Digit Code--> error';
        }

        if(!$mail->send()) {
            /* for debugging Uncomment the error stat,emt below*/
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            $this->stat= 0;
        } else 
            $this->stat= 1;
        
    }

    public function getstat(){
            return $this->stat;
    }
}
// $test =  new emailer("bereketababub@gmail.com", "bereket3345", "12312shkjhf");
