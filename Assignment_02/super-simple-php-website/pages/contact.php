<?php
/**
 * 
 * @route: path="/contact" name="contact"
 * @headline: Contact
 * @seotitle: My Sample Page Title
 * @seodesc: This is my description to hope my seo ranking will be better
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * @navname: Contact
 * @navicon: send
 * @navdisplay: main
 * @navmobile: popup
 * 
 */


 $error = [];

 $error_txt = '';
 $is_error = '';
 
 // Processing form data when form is submitted
 if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
 
     $name = isset($_POST['name']) ? htmlspecialchars( $_POST['name'] ) : '';
     $mail = isset($_POST['mail']) ? strip_tags( $_POST['mail'] ) : '';
     $subject = isset($_POST['subject']) ? htmlspecialchars( $_POST['subject'] ) : '';
     $message = isset($_POST['message']) ? nl2br( strip_tags( $_POST['message'] ) ) : '';
     $datacheck = isset($_POST['datacheck']) ? strip_tags( $_POST['datacheck'] ) : '';
 
     $is_error = 'no';
 
     if ( $name == '' ) {
         $error['name'] = 'Please check the name.';
         $is_error = 'yes';
     }
     if ( $subject == '' ) {
         $error['subject'] = 'Please check the subject.';
         $is_error = 'yes';
     }
     if ( $mail == '' ) {
         $error['mail'] = 'Please check the email address.';
         $is_error = 'yes';
     }
     else if ( !is_email($mail) ) {
         $error['mail'] = 'Email address looks not correct.';
         $is_error = 'yes';
     }
     if ( $message == '' ) {
         $error['message'] = 'Message should not be empty';
         $is_error = 'yes';
     }
     if ( $datacheck !== 'yes' ) {
         $error['datacheck'] = 'Please accept the data-privacy';
         $is_error = 'yes';
     }
     
     $coreInstance = new Core();
 
     if ( $is_error == 'yes' ) {
         $error_txt = '<span class="sticky_hinweis sticky_error stickyleft">Formular not submitted. Please check the errors.</span>';
         echo $error_txt;
         ?>
         <script>
             const myTimeout = setTimeout(hide_hinweise, 4000);
 
             function hide_hinweise() {
                 var sticky_hinweis = document.getElementsByClassName('sticky_hinweis');
                 for ( i= 0; i<sticky_hinweis.length; i++ ) {
                     sticky_hinweis[i].style.display = 'none';
                 }
                 clearTimeout(myTimeout);
             }
         
         </script>
         <?php
         
         $coreInstance->tracking($request_url,'event','failed form submit');
     }
     else {
         // formular erfolgreich submitted
         
         $headline = 'Danke';
 
         $to = 'stefan@coden-lassen.de';
         $reply_to = $mail;
         $reply_to_name = $name;
         sendMail($to, $subject, $message, $reply_to, $reply_to_name);
 
         $coreInstance->tracking($request_url,'event','form submit');
         // END formular erfolgreich submitted
     }
 
     


}
// END Form



?>
<script>
    // prevent double submissions
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

    // toggle a switch
function switch_toggle(thiss) {
 
 if ( thiss.className.indexOf("switch_yes") > - 1 ) {
     thiss.classList.remove("switch_yes");
     var switch_active = "no";
 }
 else {
     thiss.classList.add("switch_yes");
     var switch_active = "yes";
 }

 var title = thiss.title;

 if ( title.indexOf("datacheck") > -1 ) {
     if ( switch_active == "yes" ) {
         document.getElementById("hidden_datacheck").value = "yes";
     }
     else {
         document.getElementById("hidden_datacheck").value = "no";
     }
     

 }

}
</script>


    <div class="member_cards">


        <?php
        /* Form not submitted */
        if ( $is_error == '' || $is_error == 'yes' ) {
        ?>

        <div class="row row1000 home_bereich" style="overflow:hidden">
            <div class="col-2">
                <h1 class="hero">Test contact form</h1>

                <form action="" method="post" id="contact_form" class="flexform">
                    <div class="form_left">

                        <div class="ivorinput">
                            <?php get_icon("person",32,"iniconbox") ?>
                                <div onclick="focus_input(this)" class="md_input martop20 <?php echo !empty($_POST["name"]) ? "md_input_valid" : "" ?>">
                                <label for="name">
                                    Name
                                </label>
                                <input id="name" onchange="this_validated_md(this)" onkeyup="this_validated_md(this)" name="name" type="text" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>"/>
                            </div>
                    
                            <?php
                            if ( isset($error["name"]) ) {
                                ?><span class="form_error"><?php echo $error["name"] ?></span><?php
                            }
                            ?>
                        </div>
                        

                        <div class="ivorinput">
                            <?php get_icon("mail",32,"iniconbox") ?>
                            <div onclick="focus_input(this)" class="md_input martop20 <?php echo !empty($_POST["mail"]) ? "md_input_valid" : "" ?>">
                                <label for="mail">
                                    Email address
                                </label>
                                <input id="mail" onchange="this_validated_md(this)" onkeyup="this_validated_md(this)" name="mail" type="email" value="<?php echo isset($_POST["mail"]) ? $_POST["mail"] : "" ?>"/>
                            </div>
                    
                            <?php
                            if ( isset($error["mail"]) ) {
                                ?><span class="form_error"><?php echo $error["mail"] ?></span><?php
                            }
                            ?>
                        </div>

                    </div>

                    
                    <div class="form_right">


                        <div class="ivorinput">
                            <?php get_icon("label",32,"iniconbox") ?>
                            <div onclick="focus_input(this)" class="md_input martop20 <?php echo !empty($_POST["subject"]) ? "md_input_valid" : "" ?>">
                                <label for="subject">
                                    Subject
                                </label>
                                <input id="subject" onchange="this_validated_md(this)" onkeyup="this_validated_md(this)" name="subject" type="text" value="<?php echo isset($_POST["subject"]) ? $_POST["subject"] : "" ?>"/>
                            </div>
                        
                            <?php
                            if ( isset($error["subject"]) ) {
                                ?><span class="form_error"><?php echo $error["subject"] ?></span><?php
                            }
                            ?>
                        </div>


                        <div class="ivorinput hiddensvgico">
                            <?php get_icon("write",32,"iniconbox") ?>
                            <div onclick="focus_input(this)" class="md_input martop20 <?php echo !empty($_POST["message"]) ? "md_input_valid" : "" ?>">
                                <label for="message">
                                    Message
                                </label>
                                <textarea class="kontakt_textarea" id="message" onchange="this_validated_md(this)" onkeyup="this_validated_md(this)" name="message"><?php echo isset($_POST["message"]) ? $_POST["message"] : "" ?></textarea>
                            </div>
                            <?php
                            if ( isset($error["message"]) ) {
                                ?><span class="form_error"><?php echo $error["message"] ?></span><?php
                            }
                            ?>
                        </div>
                    
                

                        <?php
                        $switch_class = "";
                        $datacheck_val = "no";
                        if ( isset($_POST["datacheck"]) && $_POST["datacheck"] == "yes" ) {
                            $switch_class = "switch_yes";
                            $datacheck_val = "yes";
                        }
                        ?>

                        <div class="ivorinput dis_wrap martop30" style="display:flex;">
                            <div class="switch_datacheck inline" style="padding-right:20px;">
                            
                                <div id="switch_datacheck" title="switch_datacheck" class="switch_bg <?php echo $switch_class ?>" onclick="switch_toggle(this)">
                                    <div class="switch_circle"></div>
                                </div>

                        </div>

                        <input type="hidden" id="hidden_datacheck" name="datacheck" value="<?php echo $datacheck_val ?>"/>

                        <div class="disclaimer inline">
                            Ich read the <a href="<?php echo sites('dataprivacy') ?>" class="button_link">dataprivacy</a> and I know my data will be used to answer 
                            my request.
                            <?php
                            if ( isset($error["datacheck"]) ) {
                                ?><span class="form_error"><?php echo $error["datacheck"] ?></span><?php
                            }
                            ?>
                        </div>
                    
                </form>
                
            </div>
            </div>

                
           

            <div class="martop40" style="margin-bottom:20px;" onclick="send_form('contact_form')">
                <div class="special_hover_btn_big btn_big button_prim">
                    Submit request
                    <?php get_icon("send",26,"iconhell") ?>
                </div>
            </div>

        </div>
                       


    
        <div class="col-2" style="position:relative;">
            <img style="position:absolute;right:-80px" class="rightabimg colimg" alt="WordPress Freelancer Kontakt" src="<?php imgSrc('kontakt-aufnehmen.svg','no') ?>"/>
        </div>

        </div>


      
        <!-- general -->
        <div id="general" class="home_bereich martop20" style="background:none;border:none;text-align:center">

                <div class="iconbox iconboxblock martop40" style="line-height: 32px;">
                    <?php get_icon("check_circle",32,"iniconbox") ?>
                    <h3 style="font-size:18px !important;">Fast response</h3>
                </div>
                <div class="iconbox iconboxblock martop20" style="line-height: 32px;">
                    <?php get_icon("check_circle",32,"iniconbox") ?>
                    <h3 style="font-size:18px !important;">stefan@coden-lassen.de</h3>
                </div>
                <div class="iconbox iconboxblock martop20" style="line-height: 32px;">
                    <?php get_icon("check_circle",32,"iniconbox") ?>
                    <h3 style="font-size:18px !important;">german and english</h3>
                </div>
            
        </div>
        <!-- general END -->

        <?php
        }
        /* END form not submitted */
        


        /* Form werfolgreich submitted */
        if ( $is_error == "no" ) {
        ?>
        <div class="row row1000 home_bereich" style="overflow:hidden">
            <div class="col-2">
                <h2 class="hero">Thank you for your email, <?php echo $name ?>!</h2>

                <p class="phero">
                    I will answer as soon as possible. Don't forget this is the sample page for an open source PHP framework you can use 
                    for free. So please also read the docu and check out github. Maybe you will find an answer. Best regards, Stefan.
                </p>

                <a href="<?php echo sites('kontakt') ?>" class="btn button_prim_ol martop20">
                    New request
                    <?php get_icon("mail",26,"colprimhov") ?>
                </a>

            </div>
            <div class="col-2" style="position:relative;">
                <img style="max-height: 320px;position: absolute;bottom: -20px;right:-30px" class="colimg relative_onmobile" alt="Danke für die Anfrage" src="<?php imgSrc('codenlassen_dankesehr.svg','no') ?>"/>
            </div>
        </div>
        
        <!-- general -->
        <div id="general" class="home_bereich martop20" style="background:none;border:none;text-align:center">

                <div class="iconbox iconboxblock martop40" style="line-height: 32px;">
                    <?php get_icon("check_circle",32,"iniconbox") ?>
                    <h3 style="font-size:18px !important;">Fast response</h3>
                </div>
                <div class="iconbox iconboxblock martop20" style="line-height: 32px;">
                    <?php get_icon("check_circle",32,"iniconbox") ?>
                    <h3 style="font-size:18px !important;">stefan@coden-lassen.de</h3>
                </div>
                <div class="iconbox iconboxblock martop20" style="line-height: 32px;">
                    <?php get_icon("check_circle",32,"iniconbox") ?>
                    <h3 style="font-size:18px !important;">german and english</h3>
                </div>
            

        </div>
        <!-- general END -->
        <?php
        }
        /* END Form successfull submitted */
        ?>


    </div>
