<?php
    include('../includes/02classAutoLoader_for_controllers.php');
    // $_POST['paymentType'] = 'Elcetri////ccc  bill';
    // $_POST['paidFor'] = 'beere rer rerer';
    // $_POST['forDate'] = 'jabna 2020';
    // $_POST['forBillNumber'] = 121312312312;
    // $_POST['amount'] = 12312.343;
    
    if (isset($_POST['paymentType']) 
        && isset($_POST['paidFor']) 
            && isset($_POST['forDate']) 
                && isset($_POST['forBillNumber']) 
                    && isset($_POST['amount'])
                        && isset($_POST['userId'])){
                        $sanitize =  new sanitize();
                        $paymentType = $sanitize->__sanitize ($_POST['paymentType'],6);
                        $paidFor =  $sanitize->__sanitize ($_POST['paidFor'],6);
                        $forDate= $sanitize->__sanitize ($_POST['forDate'],6);
                        $forBillNumber = $sanitize->__sanitize ($_POST['forBillNumber'],2);
                        $amount = $sanitize->__sanitize ($_POST['amount'],6);
                        $userId = $_POST['userId'];
                        $paymentHandler = new paymentHandler($userId, $paymentType, $paidFor, $forBillNumber, $forDate, $amount);
                        $stat = $paymentHandler->pay();

                        echo $stat;
                        // echo $paymentType .'<br>'. $paidFor .'<br>'. $forDate  .'<br>'. $forBillNumber  .'<br>'. $amount;
                        }