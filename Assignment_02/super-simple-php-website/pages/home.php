<?php
/**
 * 
 * @route: path="/" name="home"
 * @headline: Home
 * @seotitle: My Sample Page Title
 * @seodesc: This is my description to hope my seo ranking will be better
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * @navname: Home
 * @navicon: home
 * @navdisplay: 1:main
 * @navmobile: 1:main
 * 
 */

 ?>

 <div class="member_cards">

    <div class="row home_bereich">
        <div class="col-2">
            <span>Open Source PHP Framework</span>
            <h1 class="hero">Welcome to Super Simple PHP Website</h1>
            <div class="iconbox martop40" style="line-height: 32px;">
                <?php get_icon("check_circle",32,"iniconbox") ?>
                <h3>Open source</h3>
            </div>
            <div class="iconbox martop20" style="line-height: 32px;">
                <?php get_icon("check_circle",32,"iniconbox") ?>
                <h3>Easy to use features</h3>
            </div>
            <div class="iconbox martop20" style="line-height: 32px;">
                <?php get_icon("check_circle",32,"iniconbox") ?>
                <h3>Use it for free</h3>
            </div>

            <a target="_blank" href="<?php echo $config['github_link'] ?>" class="special_hover_btn martop40 btn button_prim">
                See on GitHub
                <?php get_icon("arrow_right",26,"iconhell") ?>
            </a>
        </div>
        <div class="col-2" style="text-align:center">
            <img class="colimg darkmode_logo" alt="WordPress Entwickler Darstellung" src="<?php imgSrc('laptop_codenlassen_home.svg','darkmode') ?>"/>
        </div>
    </div>

    <!-- typing stat -->
    <div class="home_bereich martop40" style="padding-top: 40px;padding-bottom: 40px;">

        <div class="answer_bubble">
            <div class="answer_bubble_inner">
            <span id="answer">...Ask a question!</span>
            </div>
        </div>

        <div class="fragen_wrap">

            <div class="chip chiphov cursor" style="line-height: 24px;" onclick="bubbles_answer(this)">
                <?php get_icon("typing",24,"inchip") ?>
                <span class="hidden_answer displaynone">
                    Sure, like I said. This is an open source project and the code is on <a class="button_link" target="_blank" href="<?php echo $config['github_link'] ?>">GitHub</a>.
                </span>
                <span>Source code?</span>
            </div>

            <div class="chip chiphov cursor" style="line-height: 24px;" onclick="bubbles_answer(this)">
                <?php get_icon("typing",24,"inchip") ?>
                <span class="hidden_answer displaynone">
                    You can use this framework for free to built your own website.
                </span>
                <span>Free?</span>
            </div>

            <div class="chip chiphov cursor" style="line-height: 24px;" onclick="bubbles_answer(this)">
                <?php get_icon("typing",24,"inchip") ?>
                <span class="hidden_answer displaynone">
                    If you need a developer you can contact me via <a class="button_link" target="_blank" href="https://coden-lassen.de">https://coden-lassen.de</a> - German clients only.
                </span>
                <span>Contact?</span>
            </div>

            <div class="chip chiphov cursor" style="line-height: 24px;" onclick="bubbles_answer(this)">
                <?php get_icon("typing",24,"inchip") ?>
                <span class="hidden_answer displaynone">
                    Easy. Check out the Documentation on <a class="button_link" target="_blank" href="<?php echo $config['github_link'] ?>">GitHub</a> or <a class="button_link" target="_blank" href="<?php echo sites('docu') ?>">here</a>.
                </span>
                <span>How?</span>
            </div>

            <div class="chip chiphov cursor" style="line-height: 24px;" onclick="bubbles_answer(this)">
                <?php get_icon("typing",24,"inchip") ?>
                <span class="hidden_answer displaynone">
                    Get to know me better <a class="button_link" target="_blank" href="<?php echo sites('about-us') ?>">here</a>.
                </span>
                <span>About me?</span>
            </div>

        </div>

    </div>
    <!-- typing END -->



    <?php showBlock('visit-github') ?>



 </div>
