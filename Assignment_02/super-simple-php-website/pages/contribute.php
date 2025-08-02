<?php
/**
 * 
 * @route: path="/contribute" name="contribute"
 * @headline: Contribute
 * @seotitle: My Sample Page Title
 * @seodesc: This is my description to hope my seo ranking will be better
 * @seokeywords: a few keywords
 * 
 * navigation data:
 * @navname: Contribute
 * @navicon: heart
 * @navdisplay: 5:main
 * @navmobile: popup
 * 
 */
?>
<div class="member_cards">

    <div class="row home_bereich chipsgrey">
        <div class="col-2">
            <span>Thank you!</span>
            <h1 class="hero" style="margin-bottom:40px;">
                Contribute to this framework.
            </h1>
            
            <?php
            $skill_chips = ['PHP', 'super', 'simple', 'mini-framework'];
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
                <a target="_blank" href="<?php echo $config['github_link'] ?>" class="special_hover_btn martop40 btn button_prim">
                    contribute via GitHub
                    <?php get_icon("arrow_right",26,"iconhell") ?>
                </a>
            </div>


        </div>
        <div class="col-2" style="position:relative;text-align:center">
            <img class="colimg" src="<?php echo imgSrc('individuelles-wordpress-codesnippet-php.svg','darkmode') ?>" alt="WordPress Freelancer Stefan"/>
        </div>
    </div>

    <!-- bubbles -->
    <div class="home_bereich martop40 home_bereich_none" style="max-width: 850px;margin: auto;padding-top: 80px;padding-bottom: 40px;">

        <div class="bubble_wrap_prim">
            <div class="answer_bubble">
                <div class="answer_bubble_inner">
                <span id="antwort">Do you want to improve this mini framework?</span>
                </div>
            </div>
        </div>

        <div class="bubble_wrap_white" align="right">
            <div class="answer_bubble">
                <div class="answer_bubble_inner">
                    <span id="antwort">
                        Check out GitHub and send a pull request!
                    </span>
                </div>
            </div>
        </div>
        

    </div>
    <!-- bubbles END -->




    <?php showBlock('visit-github') ?>

            
</div>
