<div class="home_bereich martop40" style="margin-bottom: -60px;border-bottom-right-radius: 0px;border-bottom-left-radius: 0px;text-align: center;">

        <?php
        $nav_data = $this->showNavigation();
        $menu_active = "";

        ?>
        <div class="footer_officials">
        <?php
        foreach ($nav_data['official'] as $nav_row) {
                $nav_headline_loop = $nav_row['nav_headlines'];

                for ($i = 0; $i < sizeof($nav_headline_loop); $i++) {
                        $nav_headline = $nav_headline_loop[$i];
                        $nav_link = $nav_row['nav_links'][$i];
                        ?>
                        <a href="<?php echo $nav_link ?>"><?php echo $nav_headline ?></a>
                        <?php
                }
        }
        ?>


    </div>

    <div class="footer_bottom_last martop20">
            <div>©<?php echo date('Y') ?> <?php echo $config['sitename'] ?></div>
    </div>

</div>


 
