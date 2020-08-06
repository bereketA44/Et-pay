/*
    Ajax calls and their corresponding actions are laoded here
    Documnet name :ajax.js
    Backup made on the 3.back up folder
    3/29/2020
*/




$(function () {
    $('.name_class').val("Berelet");
    $('input[name="new_user_ATM"]').val(1231231231231231);
    $('input[name="new_user_ATM_pin"]').val(1231);
    $('input[name="new_user_CVV"]').val(123);
    $('input[name="new_user_woreda"]').val(13);
    $('input[name="new_user_expdate"]').val("13/12");
    $('input[name="new_user_Email"]').val("bereketababub@gmail.com");
    $('input[name="new_user_Email_conf"]').val("bereketababub@gmail.com");
    $('input[name="new_user_phone_number"]').val(13);

    
    
    $('#signUp_form_id').submit(function(e){
       
        let email = $('input[name="new_user_Email"]').val();
        let atm_num = $('input[name="new_user_ATM"]').val();

        console.log("hidden value 1 ---->"+$('#hidden_input').val())
        $.ajax({
            type: "POST",
            url: "../ET-pay/classes-engine/check_user.class.php",
            data: {email:email, ATM: atm_num},
            success: function (data) {
                if ( data =='no'){
                    console.log ("not fount");
                    $('#hidden_input').val(0);
                }else if(data == "yes"){
                    console.log('@ ajajx yeeeeesssssssssssssssssssssssssss');
                    $('#hidden_input').val(1);
                    console.log("hidden value 2 ---->"+$('#hidden_input').val())
                }
            }
        }).fail(function (xhr, ajaxOptions, throwError){
            alert(throwError);
            $('#hidden_input').val(-1);
        });

        setTimeout(function () {
            console.log("hidden value 3 ---->"+$('#hidden_input').val())
            if ( $('#hidden_input').val()==0)
                return false;
            else if ( $('#hidden_input').val()==1){
                console.log ("value 1")
            // $('#signUp_form_id').submit()
            s_try(1);
            }
        }, 3000);
        // $(this).unbind('submit');
        // return false;
    });
});


function s_try(bool) {
    console.log ("called outside");
    if (bool == 1)
    $('#signUp_form_id').bind("submit", function () {
        console.log ("called");
        return true;
    });
    
    // $('#signUp_form_id').submit(function (e) {
       
        
    // });
    

}



function sign_up_val() {
    let email = $('input[name="new_user_Email"]').val();
    let email_conf = $('input[name="new_user_Email_conf"]').val();
    let atm_num = $('input[name="new_user_ATM"]').val();
    // if(check_user(email, atm_num)==1){
    //     console.log("=====>>>>"+check_user(email, atm_num));     
    //     alert ("ere useru ale");
    //     console.log('@ sigup yeeeeesssssssssssssssssssssssssss');
    //     return false;
    // }else{
        $.each($('.name_class'), function (indexInArray, valueOfElement) {
            //  console.log($(valueOfElement).val());
            let val = $(valueOfElement).val();
            console.log ($(valueOfElement).val());
            if (!isText(val)) {
                $("#signUp_form_id").submit(function(e){
                    return false;
                });
                $(".modal").animate({ scrollTop: $(valueOfElement).position().top }, 1000);
                setTimeout(function () {
                    $(valueOfElement).popover('show');
                }, 1200
                );
                return false;
                exit();
            }
        });
        $.each($('.number_class'), function (indexInArray, valueOfElement) {
            //  console.log($(valueOfElement).val());
            let val = $(valueOfElement).val();
            if (!isNumber(val)) {
                $(".modal").animate({ scrollTop: $(valueOfElement).position().top }, 1000);
                setTimeout(function () {
                    $(valueOfElement).popover('show');
                }, 1200
                );
                return false;
            }
        });

        if ($("#new_user_bank_name option:selected").val() == 'void') {
            $(".modal").animate({ scrollTop: $('#new_user_bank_name').position().top }, 1000);
            setTimeout(function () {
                $('#new_user_bank_name').popover("show");
            }, 1200
            );

            return false;
        } else {
            $('#new_user_bank_name').popover("hide");
        }

        if (!isEmail(email)) {
            $(".modal").animate({ scrollTop: $('input[name="new_user_Email"]').position().top }, 1000);
            setTimeout(function () {
                $('input[name="new_user_Email"]').popover('show');
            }, 1100
            );
            return false;
        }
        else if (!isEmail(email_conf)) {
            $(".modal").animate({ scrollTop: $('input[name="new_user_Email_conf"]').position().top }, 1000);
            setTimeout(function () {
                $('input[name="new_user_Email_conf"]').popover('show');
            }, 1100
            );
            return false;
        }
        else if (email.localeCompare(email_conf) != 0) {
            $(".modal").animate({ scrollTop: $('input[name="new_user_Email_conf"]').position().top }, 1000);
            setTimeout(function () {
                $('#catch_email_error').popover('show');
            }, 1100
            );
            return false;
            exit();
        }
        else if (($('input[name="new_user_ATM"]').val().length < 16)) {
            $(".modal").animate({ scrollTop: $('input[name="new_user_ATM"]').position().top }, 1000);
            setTimeout(function () {
                $('input[name="new_user_ATM"]').popover('show');
            }, 1200
            );
            return false;
        }
        else if (($('input[name="new_user_ATM_pin"]').val().length < 4)) {
            $(".modal").animate({ scrollTop: $('input[name="new_user_ATM"]').position().top }, 1000);
            setTimeout(function () {
                $('input[name="new_user_ATM_pin"]').popover('show');
            }, 1200
            );
            return false;
        }
        else if (($('input[name="new_user_CVV"]').val().length < 3)) {
            $(".modal").animate({ scrollTop: $('input[name="new_user_ATM"]').position().top }, 1000);
            setTimeout(function () {
                $('input[name="new_user_CVV"]').popover('show');
            }, 1200
            );
            return false;
        }
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    // alert(email);
    // alert(regex.test(email));
    return regex.test(email);
}
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



function check_user(email, atm_num, callback){
    //  return true;
    let stat= -2;
     $.post('../ET-pay/classes-engine/check_user.class.php', {'email' : email, 'ATM': atm_num}, function (data){

        if (data == 0 || data =='0'){
            stat = 0;
        }else if(data == "yes"){
            console.log('@ ajajx yeeeeesssssssssssssssssssssssssss');
            stat = 1;
        }
    }).fail(function (xhr, ajaxOptions, throwError){
        alert(throwError);
        stat = -1;
    });

        console.log("before return" + stat);
        return stat;
  
}
