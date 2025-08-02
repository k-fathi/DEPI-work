<?php
/**
 * 
 * @route: path="/docu" name="Docu"
 * @headline: Docu
 * @seotitle: My Sample Page Title
 * @seodesc: This is my description to hope my seo ranking will be better
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * @navname: Docs
 * @navicon: code
 * @navdisplay: 5:main
 * @navmobile: main
 * 
 */

?>
<div class="member_cards">

    <div class="row home_bereich chipsgrey">
        <div class="col-2">
            <span>Lets code!</span>
            <h1 class="hero" style="margin-bottom:40px;">
                Documentation and code examples
            </h1>
            <p class="phero">
                Lets code together. I show you how to handle the framework.
            </p>


        </div>
        <div class="col-2" style="position:relative;text-align:center">
            <img class="colimg darkmode_logo" src="<?php echo imgSrc('wordpress-programmierung-referenzen.svg','darkmode') ?>" alt="WordPress Freelancer Stefan"/>
        </div>
    </div>

    <!-- bubbles -->
    <div class="home_bereich martop40 home_bereich_none" style="max-width: 850px;margin: auto;padding-top: 80px;padding-bottom: 40px;">

        <div class="bubble_wrap_prim">
            <div class="answer_bubble">
                <div class="answer_bubble_inner">
                <span id="antwort">Any programming skills needed to use the framework?</span>
                </div>
            </div>
        </div>

        <div class="bubble_wrap_white" align="right">
            <div class="answer_bubble">
                <div class="answer_bubble_inner">
                    <span id="antwort">
                        Yes at least html, css to create nice content.
                    </span>
                </div>
            </div>
        </div>
        

    </div>
    <!-- bubbles END -->



    <!-- codes -->
    <div class="home_bereich martop40" style="overflow:hidden;padding-top: 40px;padding-bottom: 40px;">

        <h2 class="heross">
            How to use the framework:
        </h2>

        <p class="phero">
            1. Download the code from <a target="_blank" class="button_link" href="<?php echo $config['github_link'] ?>">Github</a> 
        </p>

        <div class="bold colprim">via terminal</div>
        <div class="code_highlight" style="margin-bottom:40px;">
            <?php highlight_string('git clone https://github.com/stefan-klaes/super-simple-php-website.git') ?>
        </div>

        <p>Or download the code from Github and extract the zip.</p>

        <p class="phero martop40">
            2. edit the code 
        </p>

        <p>
            Edit config/config.php and secrets/secrets.php and of course all the code you want to edit.
        </p>

        <p class="phero martop40">
            3. Upload the code to your webspace
        </p>

        <p>
            You can download the code as zip and upload it to your webspace via FTP or of course you can do it via terminal and ssh or 
            many other ways.
        </p>
       
    </div>
    <!-- END codes -->


    <!-- codes -->
    <div class="home_bereich martop40" style="overflow:hidden;padding-top: 40px;padding-bottom: 40px;">

        <h2 class="heross">
            Creating a new page:
        </h2>

        <p>
            1. Navigate to the pages folder and create a new php file e.g. "services.php"
        </p>

        <p>
            2. Add the follwing php code to the top.

        <div class="bold colprim">pages/services.php</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
/**
 * 
 * @route: path="/services" name="services"
 * @headline: Services
 * @seotitle: My Sample Page Title
 * @seodesc: This is my description to hope my seo ranking will be better
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * @navname: Services
 * @navicon: code
 * @navdisplay: 3:main
 * @navmobile: :2main
 * 
 */
') ?>
        </div>

        <p>
            Lets go line by line:
        </p>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
/**
 * 
 * > the route for this site is /services so you can reach the site via your-domain.com/services
 * > the name of this site is "services" you can use it in functions like sites("services") to link this page
 * @route: path="/services" name="services"
 * 
 * > The headline is displayed on top of the page like here it is "Docu" (scroll a little bit up)
 * @headline: Services
 * 
 * > The title is shown in the browser tab and important for SEO
 * @seotitle: My Sample Page Title
 * 
 * > The description will be added as metadata to this page
 * @seodesc: This is my description to hope my seo ranking will be better
 * 
 * > Same for the keywords
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * 
 * > This name will appear in the navigation
 * @navname: Services
 * 
 * > Chose an icon from static/icons
 * @navicon: code
 * 
 * > this item will be the 3rd at display
 * @navdisplay: 3:main
 * 
 * > and the 2nd at mobile navigation. If you want it to appear in the mobile popup write "popup"
 * @navmobile: :2main
 * 
 */
') ?>
        </div>

        <p>Now you can add your HTML content and of course use PHP</P>
       
    </div>
    <!-- END codes -->


    <!-- codes -->
    <div class="home_bereich martop40" style="overflow:hidden;padding-top: 40px;padding-bottom: 40px;">

        <h2 class="heross">
            Important functions
        </h2>


        <div class="bold colprim martop20">display an image</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// save your images in static/img
// if you want to use a darkmode variant for an image save it with ...darkmode
// e.g. your-image.svg and your-imagedarkmode.svg
// use "darkmode" in imgSrc function to enable the darkmode image
// use "darkmode_logo" class to immediatly change the image to darkmode without reload

?>
<img class="colimg darkmode_logo" src="<?php echo imgSrc("your-image.svg","darkmode") ?>" alt="WordPress Freelancer Stefan"/>
') ?>
        </div>
    
        <div class="bold colprim martop20">buttons</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// use class class="special_hover_btn btn button_prim"
// use php function sites("services") to link to page with name services
// use php function get_icon("arrow_right",26,"myclass") to add icon
// the icon has height 26px, and an extra class with name "myclass" can leave it blank
    
?>
<a href="<?php echo sites("services") ?>" class="special_hover_btn btn button_prim">
    See services
    <?php get_icon("arrow_right",26,"myclass") ?>
</a>
') ?>
        </div>

        <div class="bold colprim martop20">Use global strings</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// you can use data from config/config.php
// e.g. your sitename and everythin you set up

?>
<h2>Welcome to <?php echo $config["sitename"] ?></h2>
') ?>
        </div>

        <div class="bold colprim martop20">Add new icons</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// If you want to add icons please open the svg file in browser
// copy between <svg></svg> without the svg tags
// create a file in static/icons
// e.g. static/icons/new-icon.php
// use it like this

?>
<p>My new icon looks like this: <?php get_icon("new-icon",26,"") ?></p>
') ?>
        </div>

        <div class="bold colprim martop20">Setup designs/blocks you can use everywhere</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// check out includes/blocks/visit-github.php
// that is an example (scroll to the bottom of the page to see it)
// create a new block in includes/blocks/my-block.php
// add content, e.g. <p>Hello, my name is Stefan</p>
// display the block like this:
    
<?php showBlock("my-block") ?>
') ?>
        </div>

        <div class="bold colprim martop20">enable email functionality</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// add your credentials in secrets/secrets.php
// install phpmailer class via terminal
// open the terminal and navigate to includes/libs
// command: cd includes/libs
// now install compaser packages
// command: composer install
// now you can use the sendMail function

$to = "stefan@coden-lassen.de";
$subject = "Test subject";
$reply_to = "";
$reply_to_name = "";
$message = "Test message";
sendMail($to, $subject, $message, $reply_to, $reply_to_name);
    
<?php showBlock("my-block") ?>
') ?>
        </div>

        <div class="bold colprim martop20">enable database connection</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// add your credentials in secrets/secrets.php
// you can now use the php function db_connect()
// this will return an connection in a variable
// you can now use it like this in a page:

$pdo = $this->db_connect();

$sql = "INSERT INTO tracking (datum, type, seite, referrer, session, event, para) 
        VALUES (:datum, :type, :seite, :referrer, :session, :event, :para)";

$stmt = $pdo->prepare($sql);

$data = [
    "datum" => $datum,
    "type" => $type,
    "seite" => $seite,
    "referrer" => $referrer,
    "session" => $session,
    "event" => $event,
    "para" => $para
];

$stmt->execute($data);
') ?>
        </div>


        <div class="bold colprim martop20">enable website tracking</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// add your credentials in secrets/secrets.php for the databse
// enable tracking in config/config.php and set
// "tracking" => true,
// create a table in your database with name "trackin" and the colums:
// date, type, page, referrer, session, event, para
// thats it
// you can also enable local tracking for dev tests
') ?>
        </div>


        <div class="bold colprim martop20">Menu options</div>
        <div class="code_highlight" style="margin-bottom:40px;">
<?php highlight_string('
<?php
// the menu is handled via the pages in "pages" folder
// on top of every page like pages/docu.php where I am right now are instructions
/*
// this is the name visible in the menu
* @navname: Docs 
// this is the icon from static/icons (static/icons/code.php in this case)
* @navicon: code
// the 5th position in the main nav on display.
// You could also write main or 1:main or delete the line if you don\'t it to be visible.
// You could write "official" if it is somethink like the imprint
* @navdisplay: 5:main 
// main or popup. Main is in mobile bottoom nav, popup when you click on the menu button
* @navmobile: main 
*/
') ?>
        </div>
       
    </div>
    <!-- END codes -->



    <?php showBlock('visit-github') ?>

            
</div>
