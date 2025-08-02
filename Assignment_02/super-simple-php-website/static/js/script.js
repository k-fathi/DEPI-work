// chat like js for homepage
function bubbles_answer(thiss) {

    let ans = thiss.getElementsByClassName("hidden_answer")[0].innerHTML;

    document.getElementById("answer").innerHTML = ".";
    setTimeout(function(){ document.getElementById("answer").innerHTML = "."; }, 200);
    setTimeout(function(){ document.getElementById("answer").innerHTML = ".."; }, 300);
    setTimeout(function(){ document.getElementById("answer").innerHTML = "..."; }, 400);
    setTimeout(function(){ document.getElementById("answer").innerHTML = "..." + ans; }, 600);
}

// send form without submit button
function send_form(form_id) {
    document.getElementById(form_id).submit();
    document.getElementById("bg").style.display = "";
}

// toggle the popup top right corner
function more_popup() {
    var more_sel_i = document.getElementById("more_sel_i");
    var more_popup = document.getElementById("more_popup");
    var bg = document.getElementById("bg");
    if ( more_sel_i.className.indexOf("more_opened") > - 1) {
        more_sel_i.classList.remove("more_opened");
        more_popup.classList.add("popup_closed");
        bg.style.display = "none";
    }
    else {
        more_sel_i.classList.add("more_opened");
        more_popup.classList.remove("popup_closed");
        bg.style.display = "";
    }
  }


// close the popup top right corner
function close_more_popup() {
    var more_sel_i = document.getElementById("more_sel_i");
    var more_popup = document.getElementById("more_popup");
    var bg = document.getElementById("bg");
    more_sel_i.classList.remove("more_opened");
    more_popup.classList.add("popup_closed");
    bg.style.display = "none";

}


// a nicer alert than the basic onw
function show_alert(headline,body,sec,prim,big) {
    document.getElementById("bg").style.display = "";
    document.getElementById("alert").classList.remove("alert_hidden");
    document.getElementById("alert_head").innerHTML = headline;
    document.getElementById("alert_body").innerHTML = body;
    if ( big == "big" ) {
        document.getElementById("alert").classList.add("alert_big");
    }
    else {
        document.getElementById("alert").classList.remove("alert_big");
    }
    if ( sec == "hide" ) {
        document.getElementById("alert_botton_sec").style.display = "none";
    }
    else {
        document.getElementById("alert_botton_sec").style.display = "";
        document.getElementById("alert_botton_sec").innerHTML = sec;
    }
    document.getElementById("alert_botton_prim").innerHTML = prim;

    document.getElementById("alert_footer").style.visibility = "";
    document.getElementById("alert_footer").style.display = "";
}


// close all popups with class closepopup
function close_all_popups() {
    document.getElementById("bg").style.display = "none";

    var all_ele = document.getElementsByClassName("closepopup");
    for ( var i=0; i<all_ele.length; i++ ) {
        all_ele[i].classList.add("popup_closed");
    }
    close_more_popup();
    close_alert();
}

// close the alert
function close_alert() {
    document.getElementById("bg").style.display = "none";
    document.getElementById("alert").classList.add("alert_hidden");
    document.getElementById("alert").classList.remove("alert_big");
}

// must have dark mode
function darkmode() {
    var element = document.body;
    if ( element.className.indexOf("darkmode") > -1 ) {
        element.classList.remove("darkmode");
        deletecookie('darkmode');
        document.getElementById("span_darkmode").style.display = "";
        document.getElementById("span_lightmode").style.display = "none";
        var img_src = document.getElementsByClassName("darkmode_logo");
        for ( i=0; i<img_src.length; i++ ) {
            var old_src = img_src[i].src;
            var new_src = old_src.replace("darkmode.svg",".svg");
            img_src[i].src = new_src;
        }
    }
    else {
        element.classList.add("darkmode");
        setcookie('darkmode','darkmode',1000);
        document.getElementById("span_darkmode").style.display = "none";
        document.getElementById("span_lightmode").style.display = "";
        var img_src = document.getElementsByClassName("darkmode_logo");
        for ( i=0; i<img_src.length; i++ ) {
            var old_src = img_src[i].src;
            var new_src = old_src.replace(".svg","darkmode.svg");
            img_src[i].src = new_src;
        }
        
    }
    close_all_popups();
    
 }

// set cookie
function setcookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// get cookie
function getcookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

// delete cookie
function deletecookie( cname ) {
    document.cookie = cname + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/";
    if ( cname == "PHPSESSID" || cname == " PHPSESSID" ) {
        location.reload();
    }
    else {
        try {
            generate_cookie_table();
        }
        catch(e) {

        }
    }
}

// open mobile menu overlay
function open_mobile_menu() {

    var mobile_menu_popup = document.getElementById("mobile_menu_popup");
    if ( mobile_menu_popup.className.indexOf("popup_closed") > -1 ) {
        mobile_menu_popup.classList.remove("popup_closed");
        document.getElementById("bg").style.display = "";
    }
    else {
        mobile_menu_popup.classList.add("popup_closed");
        document.getElementById("bg").style.display = "none";
    }
    

 }


 
function focus_input(thiss) {
    try {
        thiss.getElementsByTagName("input")[0].focus();
    }
    catch(e) {
        thiss.getElementsByTagName("textarea")[0].focus();
    }
    
}


// material design like label position
function this_validated(thiss) {

        if ( thiss.value == "" ) {
            thiss.classList.remove("text_validated");
        }
        else {
            thiss.classList.add("text_validated");
        }
    
}

// material design like label position
function this_validated_md(thiss) {
        if ( thiss.value == "" ) {
            thiss.parentElement.classList.remove("md_input_valid");
        }
        else {
            thiss.parentElement.classList.add("md_input_valid");
        }
   
}

// toggle the navigation
function member_toggle_nav() {
    var der_body = document.getElementById("body");
    if ( der_body.className.indexOf("sidenav_close") > - 1) {
        der_body.classList.remove("sidenav_close");
        deletecookie('sidenav');
    }
    else {
        der_body.classList.add("sidenav_close");
        setcookie('sidenav','sidenav_close',1000);
    }
}