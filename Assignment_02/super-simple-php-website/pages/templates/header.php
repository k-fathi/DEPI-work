<span class="sidenavmenui mobilenone" onclick="member_toggle_nav()">
      <?php get_icon("arrow_back",32,"iconnav") ?>
</span>

<div class="m_header no_shadow">
      <div style="position:relative">
            <h2><?php echo $headline ?></h2>
            <div class="heins_underline"></div>
      </div>


      <div class="darklight" onclick="darkmode()">
            <div class="darklight_inner" id="more_sel_i">

                  <?php
                  if (isset($darkmode) && $darkmode == 'darkmode' ) {
                        ?>
                        <span id="span_lightmode">
                              <?php get_icon("lightmode",26,"iniconbox"); ?>
                        </span>
                        <span id="span_darkmode" style="display:none">
                              <?php get_icon("darkmode",26,"iniconbox"); ?>
                        </span>
                        <?php
                  }
                  else {
                        ?>
                        <span id="span_lightmode" style="display:none">
                              <?php get_icon("lightmode",26,"iniconbox"); ?>
                        </span>
                        <span id="span_darkmode">
                              <?php get_icon("darkmode",26,"iniconbox"); ?>
                        </span>
                        <?php
                  }
                  ?>

            </div>
      </div>
</div>



<div class="sidenav box-shadow-3 mobilenone" id="sidenav">
      <div class="sidenav_inner">

            <a href="/" class="sidenav_logo">
                  <div class="sidenavlogo">
                        <img class="darkmode_logo" alt="coden lassen logo" src="<?php imgSrc($config['logo'],'darkmode') ?>"/>
                        <?php echo $config['sitename'] ?>
                  </div>
            </a>

      

            <?php
            $nav_data = $this->showNavigation();

            $this_path = $_SERVER["REQUEST_URI"];

            $menu_active = "";

            foreach ( $nav_data['display'] as $nav_row ) {
                  $nav_headline_loop = $nav_row['nav_headlines'];

                  for ($i = 0; $i < sizeof($nav_headline_loop); $i++) {
                        $nav_headline = $nav_headline_loop[$i];
                        $nav_prefix = isset($nav_row['nav_prefix'][$i]) ? $nav_row['nav_prefix'][$i] : '';
                        $nav_link = $nav_row['nav_links'][$i];
                        $nav_icon = $nav_row['nav_icons'][$i];


                        $menu_active = "";
                        if ($this_path == $nav_link) {
                              $menu_active = "sidenav_active";
                        }
                        ?>
                        <a href="<?php echo $nav_link ?>" class="sidenav_row <?php echo $menu_active ?>">
                              <span>
                                    <?php
                                    if ($nav_prefix !== '') {
                                          ?><span class="menuesmall"><?php echo $nav_prefix ?></span><?php echo $nav_headline;
                                    } else {
                                          echo $nav_headline;
                                    }
                                    ?>
                              </span>
                              <span>
                                    <?php get_icon($nav_icon, 30, "i_in_nav_row") ?>
                                    <span class="tooltopmenu"><?php echo $nav_headline ?></span>
                              </span>
                        </a>
                        <?php
                  }
            }
            ?>

      </div>
</div>


<div class="mobile_bottom_nav desktopnone">
      <div class="mobile_bottom_nav_inner">


            <?php
            $this_structure = "/";
            if ( isset($structure[0]) ) {
                  $this_structure = "/" . $structure[0];
            }


            $structure_match = $this_structure;

            $count = 0;
            foreach ($nav_data['mobile_main'] as $nav_row) {
                  $nav_headline_loop = $nav_row['nav_headlines'];
                  $count++;

                  for ($i = 0; $i < sizeof($nav_headline_loop); $i++) {
                        $nav_headline = $nav_headline_loop[$i];
                        $nav_prefix = isset($nav_row['nav_prefix'][$i]) ? $nav_row['nav_prefix'][$i] : '';
                        $nav_link = $nav_row['nav_links'][$i];
                        $nav_icon = $nav_row['nav_icons'][$i];

                        $menu_active = "";
                        if ($this_path == $nav_link) {
                              $menu_active = "bottom_nav_i_active";
                        }

                        if ( $count == 1 && isset($nav_data['mobile_popup']) && sizeof($nav_data['mobile_popup']) > 0 ) {
                              ?>
                              <a onclick="open_mobile_menu()" class="bottom_nav_item">
                                    <div class="bottom_nav_i">
                                          <?php get_icon('menu',24,"coltxt") ?>
                                    </div>
                                    <span>Menü</span>
                              </a>
                              <?php
                        }
                        ?>
                        <a href="<?php echo $nav_link ?>" class="bottom_nav_item <?php echo $menu_active ?>">
                              <div class="bottom_nav_i">
                                    <?php get_icon($nav_icon,24,"coltxt") ?>
                              </div>
                              <span><?php echo $nav_headline ?></span>
                        </a>
                        <?php
                        

                  }

            }

            ?>


      </div>
</div>



<!-- mobile popup -->
<div id="mobile_menu_popup" class="popup_closed closepopup">
      <div class="mobile_menu_popup_head">
      <span class="mobile_menueclosei" onclick="close_all_popups()"><?php get_icon("close",30,"mobile_close_icon") ?></span>
      <img  style="height: 22px;" class="darkmode_logo" alt="coden lassen logo" src="<?php imgSrc('codenlassen-logo.svg','darkmode') ?>"/>
      <span style="font-size: 22px;"><?php echo $config['sitename'] ?></span>
      </div>


      <?php

      $count = 0;
      if ( isset($nav_data['mobile_popup']) && sizeof($nav_data['mobile_popup']) > 0 ) {
            $last_i = -1;
            foreach ($nav_data['mobile_popup'] as $nav_row) {
                  $nav_headline_loop = $nav_row['nav_headlines'];
                  for ($i = 0; $i < sizeof($nav_headline_loop); $i++) {
                        $last_i++;
                  }
            }
            foreach ($nav_data['mobile_popup'] as $nav_row) {
                  $nav_headline_loop = $nav_row['nav_headlines'];
                  
      
                  for ($i = 0; $i < sizeof($nav_headline_loop); $i++) {
                        $nav_headline = $nav_headline_loop[$i];
                        $nav_prefix = isset($nav_row['nav_prefix'][$i]) ? $nav_row['nav_prefix'][$i] : '';
                        $nav_link = $nav_row['nav_links'][$i];
                        $nav_icon = $nav_row['nav_icons'][$i];
      
                        if ($count == 0 || $count == 2 || $count == 4 || $count == 6 || $count == 8 || $count == 10) {
                              ?><div class="flex"><?php
                        }
                        ?>
                        <a href="<?php echo $nav_link ?>" class="mobile_menu_popup_item <?php echo $menu_active ?>">
                              <div class="mobile_menu_popup_i">
                                    <?php get_icon($nav_icon, 24, "coltxt") ?>
                              </div>
                              <span><?php echo $nav_headline ?></span>
                        </a>
                        <?php
                        if ($count == 1 || $count == 3 || $count == 5 || $count == 7 || $count == 9 || $count == $last_i) {
                              ?></div><?php
                        }
                        $count++;
                  }
            }
      }
      
      ?>

      <div class="flex">
            <?php
            foreach ($nav_data['official'] as $nav_row) {
                  $nav_headline_loop = $nav_row['nav_headlines'];

                  for ($i = 0; $i < sizeof($nav_headline_loop); $i++) {
                        $nav_headline = $nav_headline_loop[$i];
                        $nav_link = $nav_row['nav_links'][$i];
                        ?>
                        <a href="<?php echo $nav_link ?>" class="mobile_menu_officials button_link">
                              <span><?php echo $nav_headline ?></span>
                        </a>
                        <?php
                  }
            }
            ?>
      </div>

</div>
<!-- mobile popup -->