document.onreadystatechange = function () {
    if (document.readyState !== "complete") { 
        // document.querySelector(
        //     "body").style.visibility = "hidden";
        var filterVal = 'blur(10px)';
        $('.container-fluid')
        .css('filter',filterVal)
        .css('webkitFilter',filterVal)
        .css('mozFilter',filterVal)
        .css('oFilter',filterVal)
        .css('msFilter',filterVal);

        // document.querySelector(
        //     "#loader").style.visibility = "visible";
    } else {
        document.querySelector(
            "#loader").style.display = "none";
        document.querySelector(
            "body").style.visibility = "visible";
        // $(".main_container, .topnavs").css('opacity', '1');
        var filterVal = 'blur(0px)';
        $('.container-fluid')
        .css('filter',filterVal)
        .css('webkitFilter',filterVal)
        .css('mozFilter',filterVal)
        .css('oFilter',filterVal)
        .css('msFilter',filterVal);
    }
};

$(function () {
    /* --------------------------------
        Side bar toggle button
        show or hide  the side bar n click
       --------------------------------*/
    if ($(window).width()<769){
        $('.logout-div, .sPhonebrand').css('display', 'none');
        $('.menu-bar, .port').css('margin-left', $(window).width()-50);
        $('.sidebar').css('width', $(window).width()-50);
        $('.profile').click(function (e) { 
            e.preventDefault();
            $("#menuToggle").trigger('click');
        });
        profilePage();
        $('.port').css('opacity', '.5');
    }else {
        setTimeout(function(){
            $("#profile").click();
        },1);
    }
    $('#sidebar-toggle, #menuToggle').click(function (e) { 
        e.preventDefault();
        if ($('#sidebar-toggle').hasClass('glyphicon-menu-left')){
            $('.sidebar-top, .sidebar-middle').fadeOut(300);
            if ($(window).width()<769){
                $('.sidebar').css('width', '0px');
                $('.menu-bar, .port').css('margin-left', '0px');
                $('.logout-div, .sPhonebrand').delay(800).fadeIn()
                $('.port').css('opacity', '1');
            }else {
                $('.sidebar').css('width', '20px');
                $('.sidebar').css('background-color', '#2a2038');
                $('.menu-bar, .port').css('margin-left', '20px');
            }
            $('#sidebar-toggle').removeClass('glyphicon-menu-left');
            $('#sidebar-toggle').addClass('glyphicon-menu-right');
        }else if ($('#sidebar-toggle').hasClass('glyphicon-menu-right')){
            $('.sidebar').css('background-color', '#171520');
            if ($(window).width()<769){
                $('.logout-div, .sPhonebrand').fadeOut(50);
                $('.menu-bar, .port').css('margin-left', $(window).width()-50);
                $('.sidebar').css('width', $(window).width()-50);
                $('.port').css('opacity', '.5');
            }else{
                $('.menu-bar, .port').css('margin-left', '230px');
                $('.sidebar').css('width', '230px');
                $(".port").css('width', '95vw');
            }
            $('#sidebar-toggle').removeClass('glyphicon-menu-right');
            $('#sidebar-toggle').addClass('glyphicon-menu-left');
            $('.sidebar-top, .sidebar-middle').delay(400).fadeIn()
        }
    });
    // $(window).resize(function () { 
    // });
    // $('#profile').trigger('click');
    $("#profile").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/profile.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);
            }
        });
    });
    $("#history").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/history.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);            
                }
        });
    });
    $("#elecBill").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/electric.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);            
                }
        });
    });
    $("#phoneBill").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/phoneWifi.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);            
                }
        });
    });
    $("#waterBill").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/water.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);            
                }
        });
    });
    $("#trafficBill").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/traffic.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php'; 
                else
                    $(".port").html(data);            
                }
        }); 
    });

    $("#taxBil").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/tax.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);
                }
        });
    });
    $("#settings").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/settings.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);
                }
        });
    });

    $("#contactUs").click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/contact us.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);
                }
        });
    });

    $("#logOut").click(function (e) { 
        e.preventDefault();
        window.location = './login quick.php';
        
    });
    $('#info, #infoTab').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "../classes-view/info.php",
            beforeSend: function(){
                $("#loader").show();
                $("#gearM1").text("please Wait");
                $("#gearM2").hide();
            },complete: function(){
                $('#loader').hide();
            },
            success: function (data) {
                if (data.search("Session and/or Cookie not found")>-1)
                    window.location = './login quick.php';
                else
                    $(".port").html(data);            }
        });
    });
});

function profilePage(){  // USed for first page
    $.ajax({
        type: "GET",
        url: "../classes-view/profile.php",
        beforeSend: function(){
            $("#loader").show();
            $("#gearM1").text("please Wait");
            $("#gearM2").hide();
        },complete: function(){
            $('#loader').hide();
        },
        success: function (data) {
            $(".port").html(data);
        }
    });
}