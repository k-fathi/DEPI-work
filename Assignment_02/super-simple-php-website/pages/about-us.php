<?php
/**
 * 
 * @route: path="/about-me" name="about-me"
 * @headline: About me
 * @seotitle: My Sample Page Title
 * @seodesc: This is my description to hope my seo ranking will be better
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * @navname: About me
 * @navicon: person
 * @navdisplay: 5:main
 * @navmobile: main
 * 
 */

$birthDate = "01/13/1993";
$birthDate = explode("/", $birthDate);
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));



?>
<div class="member_cards">

    <div class="row home_bereich chipsgrey">
        <div class="col-2">
            <span>Hello, hello</span>
            <h1 class="hero" style="margin-bottom:40px;">Stefan, <?php echo $age ?> Years old from Germany.</h1>
            
            <?php
            $skill_chips = ['PHP', 'Symfony', 'Python', 'Django', 'React', 'Material UI' , 'HTML', 'CSS' , 'Javascript'];
            foreach ( $skill_chips as $chip ) {
                ?>
                <div class="chip" style="line-height: 24px;">
                    <?php get_icon("heart",24,"inchip") ?>
                    <span><?php echo $chip ?></span>
                </div>
                <?php
            }
            ?>

            <div class="martop">
                <a target="_blank" href="<?php echo $config['stefan_github'] ?>" class="special_hover_btn martop40 btn button_prim">
                    Stefan at GitHub
                    <?php get_icon("arrow_right",26,"iconhell") ?>
                </a>
            </div>


        </div>
        <div class="col-2" style="position:relative;text-align:center">
            <img class="colimg darkmode_logo" src="<?php echo imgSrc('stefan-codenlassen-ich.svg','darkmode') ?>" alt="WordPress Freelancer Stefan"/>
        </div>
    </div>

    <!-- bubbles -->
    <div class="home_bereich martop40 home_bereich_none" style="max-width: 850px;margin: auto;padding-top: 80px;padding-bottom: 40px;">

        <div class="bubble_wrap_prim">
            <div class="answer_bubble">
                <div class="answer_bubble_inner">
                <span id="antwort">Why did you create this PHP framework?</span>
                </div>
            </div>
        </div>

        <div class="bubble_wrap_white" align="right">
            <div class="answer_bubble">
                <div class="answer_bubble_inner">
                    <span id="antwort">
                        I love coding - that's it.
                    </span>
                </div>
            </div>
        </div>
        

    </div>
    <!-- bubbles END -->



    <!-- 3 fingers -->
    <div class="home_bereich martop40" style="overflow:hidden;padding-top: 40px;padding-bottom: 40px;">

        <h2 class="heross" style="margin-bottom:80px;">
            If you want to use this design and framework:
        </h2>


        <div class="col-finger">
            <img alt="ein Finger zeigen" class="darkmode_logo" src="<?php imgSrc('finger-1.svg','darkmode') ?>"/>
            <div class="dinge">
                <h3>Clone the Github repository</h3>

                <p class="pheros">
                    Clone the Github Repository via terminal command, visual code studio extention or download the zip manually.
                </p>
            </div>
        </div>


        <div class="col-finger">
            <img alt="zwei Finger zeigen" class="darkmode_logo" src="<?php imgSrc('finger-2.svg','darkmode') ?>"/>
            <div class="dinge">
                <h3>Edit the code</h3>

                <p class="pheros">
                    Edit config/config.php and secrets/secrets.php and of course all the code you want to edit.
                </p>
            </div>
        </div>


        <div class="col-finger">
            <img alt="drei Finger zeigen" class="darkmode_logo" src="<?php imgSrc('finger-3.svg','darkmode') ?>"/>
            <div class="dinge">
                <h3>Upload the code to your webspace</h3>

                <p class="pheros">
                    You can download the code as zip and upload it to your webspace via FTP or of course you can do it via terminal and ssh or 
                    many other ways.
                </p>

            </div>
        </div>


    </div>
    <!-- END 3 fingers -->



    <?php showBlock('visit-github') ?>

            
</div>
