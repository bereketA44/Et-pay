/*
    Ajax calls and their corresponding actions are laoded here
    Documnet name :ajax.js
    Backup made on the 3.back up folder
    3/29/2020
*/

$(function () {
    // $('.name_class').val("bereket");
    // $('input[name="new_user_ATM"]').val(1231231231231231);
    // $('input[name="new_user_ATM_pin"]').val(1231);
    // $('input[name="new_user_CVV"]').val(123);
    // $('input[name="new_user_woreda"]').val(13);
    // $('input[name="new_user_expdate"]').val("13/12");
    // $('input[name="new_user_Email"]').val("bereketababub@gmail.com");
    // $('input[name="new_user_Email_conf"]').val("bereketababub@gmail.com");
    // $('input[name="new_user_phone_number"]').val(13);

    
    
    $('#signUp_form_id').submit(function(e){
        let email = $('input[name="new_user_Email"]').val();
        let email_conf = $('input[name="new_user_Email_conf"]').val();
        let atm_num = $('input[name="new_user_ATM"]').val();
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
                    }, 1200);
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
                }, 1200);
    
                return false;
            } else {
                $('#new_user_bank_name').popover("hide");
            }
    
            if (!isEmail(email)) {
                $(".modal").animate({ scrollTop: $('input[name="new_user_Email"]').position().top }, 1000);
                setTimeout(function () {
                    $('input[name="new_user_Email"]').popover('show');
                }, 1100);
                return false;
            }
            else if (!isEmail(email_conf)) {
                $(".modal").animate({ scrollTop: $('input[name="new_user_Email_conf"]').position().top }, 1000);
                setTimeout(function () {
                    $('input[name="new_user_Email_conf"]').popover('show');
                }, 1100);
                return false;
            }
            else if (email.localeCompare(email_conf) != 0) {
                $(".modal").animate({ scrollTop: $('input[name="new_user_Email_conf"]').position().top }, 1000);
                setTimeout(function () {
                    $('#catch_email_error').popover('show');
                }, 1100);
                return false;
                exit();
            }
            else if (($('input[name="new_user_ATM"]').val().length < 16)) {
                $(".modal").animate({ scrollTop: $('input[name="new_user_ATM"]').position().top }, 1000);
                setTimeout(function () {
                    $('input[name="new_user_ATM"]').popover('show');
                }, 1200);
                return false;
            }
            else if (($('input[name="new_user_ATM_pin"]').val().length < 4)) {
                $(".modal").animate({ scrollTop: $('input[name="new_user_ATM"]').position().top }, 1000);
                setTimeout(function () {
                    $('input[name="new_user_ATM_pin"]').popover('show');
                }, 1200);
                return false;
            }
            else if (($('input[name="new_user_CVV"]').val().length < 3)) {
                $(".modal").animate({ scrollTop: $('input[name="new_user_ATM"]').position().top }, 1000);
                setTimeout(function () {
                    $('input[name="new_user_CVV"]').popover('show');
                }, 1200);
                return false;
            }
    });

    $('#sign_users_up').click(function (e) { 
        e.preventDefault();
        let email = $('input[name="new_user_Email"]').val();
        let atm_num = $('input[name="new_user_ATM"]').val();
        let bank = $('select[name="new_user_bank_name"]').val();

        if (!email || !atm_num || !bank) {
            $('#signUp_form_id').submit();
        }else {
            console.log ("bankv" + bank)
            $.ajax({
                type: "POST",
                url: "../ET-pay/classes-ctrl/accessControl.php",
                data: {email:email, ATM: atm_num, Bank: bank},
                success: function (data) {
                    if ( data >= 1){
                        // console.log ("not fount");
                        $("#overlay").css('display', "block");
                        $('#message_info').html('You have already signed up with Et-pay. Please use the username'+
                    ' and password sent to your email address to log in. Please check your spam folder if you havent gotten any.');
                    }else if(data == 0){
                        console.log('@ ajajx yeeeeesssssssssssssssssssssssssss');
                        $('#signUp_form_id').submit();
                    }else {
                        $("#overlay").css('display', "block");
                        $('#message_info').html('Something went wrong, Please make sure you have no empty fields and try gain in a couple of minutes!');
                    }
                }
            }).fail(function (xhr, ajaxOptions, throwError){
                alert(throwError);
            });
        }
    });
});


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


