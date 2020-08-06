/* landing page JS (vanilla) */

document.onreadystatechange = function () {
    if (document.readyState !== "complete") {
        document.querySelector(
            "body").style.visibility = "hidden";
        document.querySelector(
            "#loader").style.visibility = "visible";
    } else {
        document.querySelector(
            "#loader").style.display = "none";
        document.querySelector(
            "body").style.visibility = "visible";
        $(".main_container, .topnavs").css('opacity', '1');
    }
};

/*################### Tab - screen control Block ############################# */
/*################### Tab - screen control Block ############################# */

var tabs = document.querySelectorAll(".nav-tabs>li>a");
var ddm_items = document.querySelectorAll(".dropdown-menu>li>a");
var toggle = document.getElementById("toggle");
var b = document.getElementsByClassName("main_container");
var navfaq = document.querySelectorAll(".navbar_faq")
var stars = document.querySelectorAll(".stars");
let nav_bg = document.querySelectorAll(".navbar-bg")
let scrldown = document.querySelectorAll(".scrldown")
window.onscroll = function () {


    if (window.innerWidth > 768) {
        stars[0].style.display = "block";
    }
    if (document.body.scrollTop > 625 || document.documentElement.scrollTop > 625) {
        $(".headercss").css("display", "none");
        // alert("adsd")
    } else {
        $(".headercss").css('display', 'flex');
    }

    if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30 && window.innerWidth > 768) {
        navfaq[0].style.display = "none"
        scrldown[0].style.display = "none"
    } else {
        navfaq[0].style.display = "block"
        scrldown[0].style.display = "block"
    }
    if (window.innerWidth < 768) {
        if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
            navfaq[0].style.display = "none"
            scrldown[0].style.display = "none"
            if (document.body.scrollTop > 190 || document.documentElement.scrollTop > 190)
                stars[0].style.display = "block";
        } else {
            navfaq[0].style.display = "block"
            scrldown[0].style.display = "block"
        }

    } else if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
        stars[0].style.display = "block";

    }
    if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
        nav_bg[0].style = "background-image: none "

        // nav_bg[0].style = "background-color: #222222"
        nav_bg[0].classList += " blacknav"
        document.getElementsByClassName("blacknav")[0].style = "opacity: .3"
        document.getElementsByClassName("blacknav")[0].onmouseover = function () {
            document.getElementsByClassName("blacknav")[0].style = "opacity: 1"
            document.getElementsByClassName("blacknav")[0].style = "background-img: linear-gradient(to right, #555, #555, #555)"
            // for (let i= 0; i<6; i++)
            // document.querySelectorAll(".nav-tabs>li>a")[i].style = "color: gold;"
        }

        // document.getElementsByClassName("blacknav")[0].style = "background-color: #555"
    } else if (document.body.scrollTop < 600 || document.documentElement.scrollTop < 600) {
        nav_bg[0].style = "background-image: linear-gradient(to right, #f8fad9, white, #f8fad9)"
        nav_bg[0].classList.remove = "blacknav"
        if (window.innerWidth > 768) {
            for (let i = 0; i < 6; i++)
                document.querySelectorAll(".nav-tabs>li>a")[i].style = "color: #555;"
        }
    }
}

class togglehide {
    constructor() {
        var clickedbytoggle;
        var clickedbybody;
    }
    settog(val) {
        this.clickedbytoggle = val;
    }
    setbod(val) {
        this.clickedbybody = val;
    }
}
var myvar = new togglehide();
myvar.setbod(true);
for (var i = 0; i < tabs.length; i++) {
    tabs[i].onclick = function () {
        b[0].removeAttribute("data-target", "data-toggle");
    }
}
toggle.onclick = function () {
    if (b[0].hasAttribute("data-target", "data-toggle") && myvar.clickedbybody == true)
        b[0].removeAttribute("data-target", "data-toggle");
    else {
        myvar.settog(true);
        myvar.setbod(true);
        b[0].dataset.target = "#to_collapse";
        b[0].dataset.toggle = "collapse";
    }
}
b[0].onclick = function () {
    if (myvar.clickedbybody == false)
        b[0].removeAttribute("data-target", "data-toggle");
    else if (myvar.clickedbytoggle == true) {
        myvar.setbod(false);
    }
}


/* TAbs to collapse the  collapse bar */
window.onload = function () {
    if (window.innerWidth < 768) {
        setTimeout(function () { window.scrollTo(0, 55); }, 1)
    }

    var innerWidth = window.innerWidth;
    resize(innerWidth);

}
window.onresize = function () {
    var innerWidth = window.innerWidth;
    resize(innerWidth);
}
function resize(innerWidth) {
    if (innerWidth <= 768) {
        for (var i = 0; i < tabs.length; i++) {
            if ((tabs[i].textContent).toString().trim() != "Services") {
                tabs[i].dataset.target = "#to_collapse";
                tabs[i].dataset.toggle = "collapse";

            }
            ddm_items[i].dataset.target = "#to_collapse";
            ddm_items[i].dataset.toggle = "collapse"
        }

    } else {
        for (var i = 0; i < tabs.length; i++) {
            if ((tabs[i].textContent).toString().trim() != "Services")
                tabs[i].removeAttribute("data-target", "data-toggle")
            if (ddm_items[i] != null)
                ddm_items[i].removeAttribute("data-target", "data-toggle")

        }
    }
}

let collapsenav = document.getElementsByClassName("collapsenav");
class faqnav {
    constructor() {
        var height;
    }
    set(new_height) {
        this.height = collapsenav[0].style.height = new_height;
    }
    get() {
        var y = this.height.toString();
        return y;
    }
}

var navobject = new faqnav();
navobject.set("30px");
function faq(bool) {
    console.log(navobject.get())
    if (bool == 1) {
        if (navobject.height == "30px") {
            navobject.set("100px");
        } else
            navobject.set("30px");
    } else {
        if (navobject.height == "100px") {
            setTimeout(function () {
                navobject.set("30px");
            }, 3000)
        }
    }

}
function faq1() {
    console.log("kjhkg")
}
function bbb() {
    console.log("112132")
}


/*################### Tab - screen control Block End ############################# */
/*################### Tab - screen control Block End ############################# */
/* ___________________________________________________________________________________*/

/*################### body- header Popups control Block  ############################# */
/*################### Tab - screen control Block  ############################# */


/*################### body- header Popups control Block end ############################# */
/*################### Tab - screen control Block end ############################# */

/*########################################################## ############################# */
/*################### #############Guidee control Block####################### ############################# */

class stacks {
    constructor() {
        var hasclass;
        var variable;
        var counter;
    }
    set(st) {
        this.variable = st;
        this.hasclass = false;
        this.counter = -1;
    }
    setcount(index) {
        var x = this.counter;
        this.counter = x + index;
    }
}

var s1 = new stacks();
s1.set(document.querySelectorAll(".content"));
console.log(s1.variable[0])
s1.variable[0].style = 'z-index: 11';
// for (var i = 1; i<(s1.variable).length; i++){
//     s1.variable[i].style.transform = 'scale(1)';
//     s1.variable[i].style.filter= 'opacity(1)';
//     // s1.variable[i].style= 'top :' - i*10
// }
//  s1.variable[1].style.transform = 'scale(.8)';
//  s1.variable[1].style.filter= 'opacity(.5)';
//  s1.setcount(0)
var index = s1.variable.length - 1;
function stackslid(bool) {
    if (bool == 0) {
        s1.setcount(1);
        console.log(s1.counter)
        console.log("onde " + index)

        s1.variable[s1.variable.length - 1].classList.remove('animate')
        s1.variable[s1.counter].classList.add('animate')

        if (index != s1.counter) {
            // s1.variable[s1.counter+1].style.transform = 'scale(1)';
            // s1.variable[s1.counter+1].style.filter= 'opacity(1)';
            s1.variable[s1.counter + 1].style = 'z-index: 12';
            s1.variable[0].addEventListener('webkitAnimationEnd', function () {
                this.style.webkitAnimationName = '';
            }, false);
            s1.variable[s1.counter].addEventListener("animationend", function () {
                s1.variable[s1.counter].classList.remove('animate');
                s1.variable[s1.counter + 1].style = 'z-index: 12';
                s1.variable[s1.counter].style = 'z-index: 10';
            });
        } else {
            s1.variable[s1.counter].style = 'z-index: 10';
            // s1.variable[s1.counter].classList.remove('animate');
            // s1.variable[0].classList.remove('animate');
            s1.variable[0].style = 'z-index: 12';
            s1.counter = -1;
            // stackslid();
        }
    }
}

/*########################################################## ############################# */
/*################### #############Height control Block####################### ############################# */

/*########################################################## ############################# */
/*################### #############Height control Block####################### ############################# */
// animation Hello Guy
// document.getElementById("hometab").onclick = jump('services');
function jump(id) {
    console.log(id);
    let el = document.getElementById(id)
    el.scrollIntoView({ inline: "start", behavior: "smooth" })
}
/*########################################################## ############################# */
/*################### #################################### ############################# */
/*########################################################## ############################# */
/*################### #############Modal Log in and sign up####################### ############################# */

$(function () {
    // **************************************copy and paste are santisized and disabled*********************************
    // $('input[name="new_user_city"]').bind('copy paste cut',function(e) {
    //     e.preventDefault();
    //     alert('cut,copy & paste options are disabled !!');
    //   });

    // $('input[name="new_user_city"]').onpaste = function(e) {
    // //   if (!isText($(this).val()))
    //     e.preventDefault();
    // }
    // $('.input_modf').bind('paste', function (e) {
    //     e.preventDefault();
    //     alert('paste option is disabled !!');
    // });

// ****************************************************************************************************************

    $("#login_username_id").keyup(function (e) {
        // alert($("#login_username_id").val().length);
        if ($("#login_username_id").val().length < 10) {
            $("#login_user_icon").css("color", "red");
        } else{
            $("#login_user_icon").css("color", "lightgreen");
        }

    });
    $("#login_ATM_id").keyup(function (e) {
        // alert($("#login_username_id").val().length);
        if ($("#login_ATM_id").val().length != 16) {
            $("#login_ATM_icon").css("color", "red");
        } else{
            $("#login_ATM_icon").css("color", "lightgreen");
        }

    });
    $('#login_ATM_id').keypress(function (e) {
        if (($('#login_ATM_id').val().length >= 16)) {
            $(this).popover('show');
            return false;
        }
    });
    $("#login_password_id").keyup(function (e) {
        // alert($("#login_username_id").val().length);
        if ($("#login_password_id").val().length < 10) {
            $("#login_password_icon").css("color", "red");
        } else
            $("#login_password_icon").css("color", "lightgreen");

    });
    

    /*################################################################################################ */
    /*##########################################Sign up ############################################## */
    $('input[name="new_user_name"], input[name="new_user_fathers_name"], input[name="new_user_last_name"]').keypress(function (e) {
        // alert ("pressed");
        var s = String.fromCharCode(e.which);
        var keyCode = e.which ? e.which : e.keyCode

        if (!(keyCode >= 65 && keyCode <= 90) && !(keyCode >= 97 && keyCode <= 122)) {
            $(this).popover("show");
            return false;
        } else {
            $(this).popover("hide");
        }
    });

    $('input[name="new_user_ATM"], input[name="new_user_ATM_pin"],input[name="new_user_CVV"]').keypress(function (e) {
        // alert ("pressed");
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
            $(this).popover('show');
            return false;
        } else {
            $(this).popover('hide');
        }

        if (($('input[name="new_user_ATM"]').val().length >= 16) && $('input[name="new_user_ATM"]').is(':focus')) {
            // $(this).popover('show');
            return false;
        }
        // if the above is focus is not set the pin number wont be entered becasue if the atm 16 filled it will reture false
        if (($('input[name="new_user_CVV"]').val().length >= 3) && $('input[name="new_user_CVV"]').is(':focus')) {
            return false;
        }
        // if the above is focus is not set the pin number wont be entered becasue if the atm 16 filled it will reture false
    });
    $('input[name="new_user_ATM"]').focusout(function (e) {
        e.preventDefault();
        if ($('input[name="new_user_ATM"]').val().length <= 15) {
            $(this).popover('show');
        } else {
            $(this).popover('hide');
        }
    });
    $('#catch_email_error').blur(function (e) {
        $("#catch_email_error").popover('hide');
    });
    $('input[name="new_user_city"], input[name="new_user_subcity"]').keypress(function (e) {
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 65 && keyCode <= 90) && !(keyCode >= 97 && keyCode <= 122) && !(keyCode == 32)) {
            $(this).popover("show");
            return false;
        } else {
            $(this).popover("hide");
        }

    });


    $('input[name="new_user_phone_number"],input[name="new_user_woreda"]').keypress(function (e) {
        var keyCode = e.which ? e.which : e.keyCode
        if (!(keyCode >= 48 && keyCode <= 57)) {
            $(this).popover("show");
            return false;
        } else {
            $(this).popover("hide");
        }
    });
    /* *************************** ******************************* *************************************** ***************************/
/* *************************** *******************************Pop over info for cvv and exp date*********************************/
    $('#cvv_popover').popover({ html: true });
    $('#exp_popover').popover({ html: true });

    $('[data-toggle="popover"]').not('input[name="new_user_ATM"]').blur(function (e) {
        e.preventDefault(); 
        $('[data-toggle="popover"]').popover('hide');
    });

    $("catch_email_error").blur(function (e) {
        e.preventDefault();
        $("catch_email_error").popover('hide');
    });


    /*########################################################## ############################# */
/*################### #############message  control Block####################### ############################# */
$('.dismiss_message').click(function (e) { 
    e.preventDefault();
    $('#overlay').fadeOut(800);
});

/*########################################################## ############################# */
/*################### #############message control Block end####################### ############################# */

});




