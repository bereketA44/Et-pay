    $(function () {
    
    $('#login_form_id').submit(function(e){
        // $("#login_username_id").popover('show')
        if ($("#login_username_id").val().length < 10){
            vibrate ( $(".login_modal"));
            $("#login_username_id").popover('show');
            return false;
        }
        if (($('#login_ATM_id').val().length < 16)) {
            vibrate ( $(".login_modal"));
            $('#login_ATM_id').popover('show');
            return false;
        }
        if ($("#login_password_id").val().length < 10) {
            vibrate ( $(".login_modal"));
            $("#login_password_id").val("");
            $('#login_password_id').popover('show');
            $("#login_password_icon").css("color", "red");
            $("#login_password_id").attr("placeholder", "Password too short");
            return false;
        }
    });
    $("#login_username_id, #login_ATM_id, #login_password_id").focus(function (e) { 
        // $('#login_false').css ("display", "none");
        $('#login_false').fadeOut();
    });

    $('#cookie_checkbox').click(function (e) { 
        if($('#cookie_checkbox').is(':checked')) { 
            $('#label_for_popover').popover('show');
        }else {
            $('#label_for_popover').popover('hide');
        }
    });
    $("#cookie_checkbox").blur(function (e) { 
        $('#label_for_popover').popover('hide');
    });

        $('#log_users_in').click(function (e){
            e.preventDefault();
            let username = $('#login_username_id');
            let atm_num = $('#login_ATM_id');
            let password = $('#login_password_id');
            if (!username.val() || !atm_num.val() || !password.val()) {
                $('#login_form_id').submit();
                return;
            }else if (username.val().length < 10 || atm_num.val().length< 16 || password.val().length < 10){ 
                $('#login_form_id').submit();
                return;
            }
            else if (!isUsername(username.val())){
                vibrate ( $(".login_modal"));
                $(username).popover ("show");

            } else if (!isNumber(atm_num.val())){
                $(atm_num).popover ("show")
            } 
            else if (!isUsername(password.val())){
                $(password).popover ("show")
            } else {
                let atmNumbertoString =atm_num.val();
                // let atmNumbertoString = '0000123123';
                console.log(atmNumbertoString);
                $.ajax({
                    type: "POST",
                    url: "../ET-pay/classes-ctrl/accessControl.php",
                    data: {userName:username.val(), ATM: atmNumbertoString, Password: password.val()},
                    success: function (data) {
                        if(data == 1){
                            $('#login_form_id').submit();
                        }else if (data == 0){
                            vibrate ( $(".login_modal"));
                            $("#login_username_id").val("");
                            $("#login_username_id").attr("placeholder", "User name doesnt exist");
                            // $('#login_false').css ("display", "block")
                            $('#login_false').fadeIn();
                        }else {
                            vibrate ( $(".login_modal"));
                            $("#login_username_id").val("");
                            $('#login_failed_error_message').text("Something went wrong, Please recheck and try again");
                            $('#login_false').fadeIn();
                        }
                    }
                }).fail(function (xhr, ajaxOptions, throwError){
                    alert(throwError);
                });
            }
        });
    });

    function isUsername(text) {
        if (String(text).match("^[A-Za-z0-9-]+$")) {
            return true;
        } else{
            return false;
        }
    }
    function isNumber(number) {
        var numbers = /^\d+$/;
        if (numbers.test(number)) {
            return true;
        } else
            return false;
    }
    function vibrate(element){
        element.animate({ left: '30px' }, 20);
        element.animate({ left: '-70px' }, 20);
        element.animate({ left: '30px' }, 20);
        element.animate({ left: '-70px' }, 20);
        element.animate({ left: '0px' }, 20);
    }
