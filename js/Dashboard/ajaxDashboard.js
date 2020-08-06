$(function () {
    $('input').blur(function (e) { 
        e.preventDefault();
        $(this).css('border', '1px solid #ccc');;
    });
    let otpCode = Math.floor(100000 + Math.random() * 900000);
    $("#next").click(function (e) { 
        e.preventDefault();
        let date  = $('input[name="date"]').val();
        let bill  = $('input[name="BillNUmber"]').val();
        let fname  = $('input[name="Fname"]').val();
        let mname  = $('input[name="Mname"]').val();
        let lname  = $('input[name="Lname"]').val(); 
        let amount  = $('input[name="Amount"]').val();

        if (!date || !amount ){
           
           if (!date){
                $(".port").animate({ scrollTop: $('input[name="date"]').position().top }, 1000);
                $('input[name="date"]').css('border', '2px solid red');
                return;
            }
           if (!amount){
                $(".port").animate({ scrollTop: $('input[name="Amount"]').position().top }, 1000);
                $('input[name="Amount"]').css('border', '2px solid red');
                return;
            }
            if (!amount){
                $(".port").animate({ scrollTop: $('input[name="Amount"]').position().top }, 1000);
                $('input[name="Amount"]').css('border', '2px solid red');
                return;
            }
        }else if(!bill || !isNumber(bill)){
            $(".port").animate({ scrollTop: $('input[name="BillNUmber"]').position().top }, 1000);
            $('input[name="BillNUmber"]').css('border', '2px solid red');
            return;
        }else if(fname || !fname){
            $.each($('.nameClass'), function (indexInArray, valueOfElement) {
                let val = $(valueOfElement).val();
                if (!isText(val) || !val) {
                    $(".port").animate({ scrollTop: $(valueOfElement).position().top }, 1000);
                    $(valueOfElement).css('border', '2px solid red');
                    return;
                }
            });
        }
        let otpEmail = $("#emailNet").val();
        console.log (otpEmail);
        $.ajax({
            type: "POST",
            url : "./OTP.php",
            data: {otpEmail: otpEmail, otpCode:otpCode},
            beforeSend: function(){
                $("#next").css('display', 'none');
                $('.loadingBar').css('display', 'block');
            },
            complete: function(){
            }, 
            success: function (data) {
                if (data == 1){
                    // $("#next").css('display', 'block');
                    $('.loadingBar').css('display', 'none');
                    $('.otpDiv').css('display', 'block');
                    alert("We have sent you an email with a confirmation code");
                    $(".port").animate({ scrollTop: $('.otpDiv').position().top }, 1000);
                }else{
                    alert("Something went wrong, Please check your network and try again. If this carries on, Contact us");
                    $("#next").css('display', 'block');
                    $('.loadingBar').css('display', 'none');
                }
            }
        }).fail(function (xhr, ajaxOptions, throwError){
            alert(throwError);
        });
        return false;
    });
    $('.payBtn').click(function (e) { 
        e.preventDefault();
        if ($('.otpField').val() == otpCode){
            let date  = $('input[name="date"]').val();
            let bill  = $('input[name="BillNUmber"]').val();
            let fname  = $('input[name="Fname"]').val();
            let mname  = $('input[name="Mname"]').val();
            let lname  = $('input[name="Lname"]').val();
            let amount  = $('input[name="Amount"]').val();
            let paymentType = $(".payBtn").data('payment-type');
            let paidFor = fname + ' ' + mname + ' ' + lname;
            let userId = $('input[name="idNet"]').val();
            $.ajax({
                type: "POST",
                url: "../classes-ctrl/paymentHandlerDashboard.php",
                data: {paymentType: paymentType, paidFor: paidFor, forDate: date, forBillNumber:bill, amount:amount, userId:userId},
                success: function (data) {
                    if (data == 1){
                        alert ("You have Successfully paid your bill. Find the confirmation in your History");
                        $('input:not(input[name="emailNet"], input[name="idNet"])').val('');
                        $("#next").css('display', 'block');
                        $('.otpDiv').css('display', 'none');
                    }else{
                        alert ("Something went wrong, Please check your network and try again. If this carries on, Contact us")
                        $('input:not(input[name="emailNet"], input[name="idNet"])').val('');
                        $("#next").css('display', 'block');
                        $('.otpDiv').css('display', 'none');
                    }
                }
            }).fail(function (xhr, ajaxOptions, throwError){
                alert(throwError);
            });
        }else{

        }
        otpCode = Math.floor(100000 + Math.random() * 900000);
    });
});

function isText(text) {
    if (String(text).match("^[A-Za-z ]+$")) {
        return true;
    } else
        return false;
}
function isNumber(number) {
    var numbers = /^\d+$/;
    if (numbers.test(number)) {
        return true;
    } else
        return false;
}
