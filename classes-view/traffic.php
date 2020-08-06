<?php
    include ('./ajaxValidateCS.php');
?>
<style>
    .mainContent{
        width: 80vw;
        background-color: whitesmoke;
        height: 700px;
        display: grid;
        grid-template-rows: 80px auto;
        font-family: Optima, Helvetica, sans-serif;
        box-shadow: 1px 1px 20px black;

    }
    .header {
        background-color: #171520;
        color: gold;
        font-weight: 500;
        padding: 0 30px;

        text-align: center;
    }
    .header>span>h2 {
        display: inline-block;
    }
    .account-status{
        float: right;
    }
    .mainField{
        background-image: url(../media/Dashboard/traffic.png);
        background-repeat: no-repeat;
        background-color: whitesmoke;
        padding: 0 50px;
        padding: 30px 0;
    }
    .loadingBar{
        display: none;
        font:100px Impact;
        line-height: 5px;
        animation: dots .5s infinite;
        margin-left: -20px;
    }
    label{
        font-size: 22px;
        font-weight: 700;
    }

    #next {
        width: 90px;
        font-size: 24px;
        background-color: #2a2038;
        color: goldenrod;
        transition: background-color linear .2s;
    }
    #next:hover{
        background-color: #1e1d1f;
        color: gold;
    }

    @keyframes dots {
  0% {
    color: black;
  }
  20%{
    color: whitesmoke;
    transform: translateX(20px);
  }
  40% {
    color: black;
    transform: translateX(40px);
  }
  60% {
    color: whitesmoke;
      transform: translateX(60px);
  }
  80%{
    color: black;
    transform: translateX(80px);
  }
  100% {
      color: black;
  }
}
.namebox {
    border-bottom: 2px solid lightgrey; 
    text-align: center; 
    margin-bottom:20px;
    border-top: 2px solid lightgrey;
    width: 90vw;
    white-space: normal;
}
.popover {
    top: -100px !important;
    left: 0px !important;
}
.otpDiv{
    display: none;
}
.otpField{
    /* width: 200px; */
    margin-bottom: 30px;
    border: 1px solid greenyellow;
}
.payBtn{
    display: block;
    font-size: 20px;
}
@media (max-width: 768px){
    .mainContent{
        width: 93vw;
    }
    .form-control{
        width: 90vw;
        margin-left: 10px;
    }
}
</style>

<div class="mainContent">
    <div class="header">
        <h2>Traffic Bill</h2>
    </div>
    <div class="mainField">
    <form action="javascript:void(0);" class="form-horizontal" id="paymentForm">
            <div class="form-group">
                <label for="date" class="control-label col-sm-3 col-xs-12">Enter Paymnet Date (month/year): </label>
                <div class="col-sm-6 col-xs-12">
                    <input type="month" name="date" placeholder="Date" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="BillNUmber" class="control-label col-sm-3 col-xs-12">Enter Licence Number: </label>
                <div class="col-sm-6 col-xs-12">
                    <input type="Number" name="BillNUmber" placeholder="Licence Number"class="form-control " required>
                </div>
            </div>
            <div class="namebox">
                <h3>Enter the name of the person you are paying for</h3>
            </div>
            <div class="form-group">
                <label for="Fname" class="control-label col-sm-3 col-xs-12 ">Enter First Name: </label>
                <div class="col-sm-6 col-xs-12">
                    <input type="Text" name="Fname" placeholder="First Name"class="form-control nameClass" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Mname" class="control-label col-sm-3 col-xs-12">Enter Middle Name: </label>
                <div class="col-sm-6 col-xs-12">
                    <input type="Text" name="Mname" placeholder="Middle Name"class="form-control nameClass" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Lname" class="control-label col-sm-3 col-xs-12">Enter Last Name: </label>
                <div class="col-sm-6 col-xs-12">
                    <input type="Text" name="Lname" placeholder="Last Name"class="form-control nameClass" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Amount" class="control-label col-sm-3 col-xs-12">Enter Amount: </label>
                <div class="col-sm-6 col-xs-12">
                    <input type="Number" name="Amount" placeholder="Amount in Birr"class="form-control " required>
                </div>
            </div>
            <div class="col-xs-offset-5 targetdiv" >
                <input type="text" name="emailNet" id="emailNet" value="<?php echo $GLOBALS['getEmail'];?>" style="display: none"> 
                <input type="text" name="idNet" id="idNet" value="<?php echo $GLOBALS['id'];?>" style="display: none">
                                <!-- passing emails and UID to emailer class and oaymnet handler -->
                <button type="button" class="btn btn-info" id="next" >Next</button>
                <p class= "loadingBar">.</p>
            </div>
            <div class="form-group otpDiv">
                <label for="otp" class=" col-sm-offset-2 control-label col-sm-3 col-xs-12">Enter the code here: </label>
                <div class="col-sm-3 col-xs-12">
                    <input type="number" name="otp" id="otp" placeholder="Enter Code Here" class="form-control otpField " >
                    <p id="message"></p>
                </div>
                <button data-payment-type="Traffic Bill" class="btn btn-success payBtn col-sm-offset-6 col-xs-offset-5 col-sm-1 ">Pay!</button>
            </div>
        </form>
    </div>
</div>
<script src="../js/Dashboard/ajaxDashboard.js"></script>