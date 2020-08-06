
$(function () {
    $("#sign_users_up").click(function (e) { 
        // e.preventDefault();
        // $('#sign_up_modal').css("display", "none");
        // $('.sign_up_modal').css("display", "none");
        alert(";sdlf");
        $('#overlay').css("display", "block");
        // $('#modal_confirm').css("display", "block");
        
        
    });
});
$('#sign_users_up').on('click', function() {
    //     $("#sign_up_form_id").valid();
    // });
   if( !$('#sign_up_form_id')[0].checkValidity())
    // alert(":invalid form")
    // alert(document.getElementById('test123').validationMessage);
    $('#test123'.validationMessage).show()
});

$("#sign_users_up").validate({
    rules: {
        test123: "required"
    },
    messages: {
        test123: "Please specify your name"

    }
})
$('#sign_users_up').on('click', function() {
    $("#sign_up_form_id").valid();
});

$('#btn').click(function() {
    $("#form1").valid();
});