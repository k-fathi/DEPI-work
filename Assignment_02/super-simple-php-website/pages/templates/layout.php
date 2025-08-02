<?php
$file = isset($route['file']) ? $route['file'] : '';
$headline = isset($route['headline']) ? $route['headline'] : '';
$seotitle = isset($route['seotitle']) ? $route['seotitle'] : '';
$seodesc = isset($route['seodesc']) ? $route['seodesc'] : '';
$seokeywords = isset($route['seokeywords']) ? $route['seokeywords'] : '';
?>
<!DOCTYPE html>
	<html lang="de">
	<head>
		<meta charset="utf-8" />
		<meta name="color-scheme" content="light">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
		<?php
		if ( isset($seodesc) ) {
			?>
			<meta name="description" content="<?php echo $seodesc ?>">
			<?php
		}
		if ( isset($seokeywords) ) {
			?>
			<meta name="keywords" content="<?php echo $seokeywords ?>">
			<?php
		}
		?>
  		
		<link rel="icon" type="image/x-icon" href="<?php imgSrc('favico.svg','darkmode') ?>">
		<title><?php echo $seotitle; ?></title>
		<link href="/static/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/static/css/responsive.css" rel="stylesheet" type="text/css" /> 


		<script src="/static/js/jquery.js"></script>
		<script src="/static/js/script.js"></script>

        <?php
        // add additional scripts if needed
        if ( isset($header_scripts) ) {
            echo $header_scripts;
        }
        ?>

	<style>
		:root {
			--prim: <?php echo $config['primary_color'] ?>;
		}
		:root .darkmode {
			--prim: <?php echo $config['primary_color_darkmode'] ?>;
		}
	</style>
	</head>

	<body id="body" class="<?php if (isset($_COOKIE["sidenav"])) { echo $_COOKIE["sidenav"]; } ?> <?php echo $darkmode ?>">
	
		<?php
		if ( !isset($header) ) {
			include 'header.php';
		}
		?>


		<div class="member_main">

			<?php
			if ( isset($other_content) ) {
				echo $other_content;
			}
			else {
				$route_file = 'pages/' . $file;
				if ( isset($route_file) ) {
					include $route_file;
				}
			}
			?>

            <div class="mobilenone">
                <?php
                if ( !isset($footer) ) {
                    include 'footer.php';
                }
                ?>
            </div>

        </div>

		
		<!-- bg -->
		<div id="bg" style="display:none" onclick="close_all_popups()"></div>
		<!-- bg END -->

		<?php
		$logo_url = "codenlassen-logo.svg";
		if (isset($_COOKIE["darkmode"]) && $_COOKIE["darkmode"] == "darkmode" ) {
			$logo_url = "codenlassen-logodarkmode.svg";
		}
		?>

		<!-- create new popup -->
		<div id="more_popup" class="popup_closed closepopup box-shadow-3">
                <div class="account_popup_head" style="padding-bottom:0px;">
					<label class="poplabelhead">
						<img class="darkmode_logo" alt="coden lassen logo" src="<?php imgSrc($config['logo'],'darkmode') ?>"/>
						<span><?php echo $config['sitename'] ?></span>
					</label>
                </div>

                <div class="account_popup_body">

					<div onclick="darkmode()" class="account_popup_row_action hovfill">
					<?php
					if (isset($darkmode) && $darkmode == 'darkmode' ) {
						?>
						<span id="span_lightmode">
							<?php get_icon("lightmode",32,"iniconbox"); ?>
							<span class="txt">lightmode</span>
						</span>
						<span id="span_darkmode" style="display:none">
							<?php get_icon("darkmode",32,"iniconbox"); ?>
							<span class="txt">darkmode</span>
						</span>
						<?php
					}
					else {
						?>
						<span id="span_lightmode" style="display:none">
							<?php get_icon("lightmode",32,"iniconbox"); ?>
							<span class="txt">lightmode</span>
						</span>
						<span id="span_darkmode">
							<?php get_icon("darkmode",32,"iniconbox"); ?>
							<span class="txt">darkmode</span>
						</span>
						<?php
					}
					?>

					</div>


                </div>

            </div>
            <!-- create new popup END -->

		<!-- alert -->
		<div class="alert alert_hidden closepopup box-shadow-3" id="alert">

		<div class="alert_inner">
    
			<div class="alert_head">
				<div id="alert_loader"></div>
				<h3 id="alert_head" class="nomargin">headline</h3>
			</div>
			<div class="alert_body" id="alert_body">Text ets tsa jkash asjkas</div>
			<div class="alert_footer" id="alert_footer">
				<div class="btn button_sec" id="alert_botton_sec" onclick="close_alert()">secondary</div>
				<div class="btn button_prim" id="alert_botton_prim" onclick="popup_action()"></div>
			</div>
			<input type="hidden" id="alert_action" value="close"/>
			
		</div>
		</div>
		<!-- alert END -->

		<?php
		if ( isset($config['tracking']) && $config['tracking'] == true ) {
			$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
			$referrer = str_replace("http://localhost/", "", $referrer);
			$referrer = str_replace("https://", "", $referrer);
			$referrer = str_replace("http://", "", $referrer);
			$referrer = str_replace("coden-lassen.de", "", $referrer);
			?>
			<img style="display:none" src="/track/track?p?track=track&referrer=<?php echo $referrer ?>" alt="tracking_pixel"/>
			<?php
		}
		?>
		
	<script>
	// Hide Header on on scroll down
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.m_header').outerHeight();

$(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    
    // Make sure they scroll more than delta
    if(Math.abs(lastScrollTop - st) <= delta)
        return;
    
    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
	if (st == 0){
		$('.m_header').addClass('no_shadow');
	}
	else {
		$('.m_header').removeClass('no_shadow');
		$('.member_tabs').removeClass('no_shadow');
	}
	if (st > lastScrollTop && st > navbarHeight){
        // Scroll Down
        $('.m_header').removeClass('nav-down').addClass('nav-up');
    } else {
        // Scroll Up
        if(st + $(window).height() < $(document).height()) {
            $('.m_header').removeClass('nav-up').addClass('nav-down');

        }
    }
    
    lastScrollTop = st;
}
	</script>


	</body>
	</html>