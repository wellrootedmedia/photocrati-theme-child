<?php
//echo get_stylesheet_directory_uri();
    $preset = Photocrati_Style_Manager::get_active_preset();
    extract($preset->to_array());

	$rcp = $wpdb->get_results("SELECT fs_rightclick,lightbox_mode,lightbox_type FROM ".$wpdb->prefix."photocrati_gallery_settings WHERE id = 1");
	foreach ($rcp as $rcp) {
		$fs_rightclick = $rcp->fs_rightclick;
		$lightbox_mode = $rcp->lightbox_mode;
		$lightbox_type = $rcp->lightbox_type;
	}
	$music = $wpdb->get_results("SELECT music_blog,music_blog_auto,music_blog_file,music_blog_controls,music_cat,music_cat_auto,music_cat_file,music_cat_controls FROM ".$wpdb->prefix."photocrati_gallery_settings WHERE id = 1");
	foreach ($music as $music) {
		$music_blog = $music->music_blog;
		$music_blog_auto = $music->music_blog_auto;
		$music_blog_controls = $music->music_blog_controls;
		$music_blog_file = $music->music_blog_file;
		$music_cat = $music->music_cat;
		$music_cat_auto = $music->music_cat_auto;
		$music_cat_controls = $music->music_cat_controls;
		$music_cat_file = $music->music_cat_file;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 9 ]> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> class='ie9'><!--<![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
    <?php
    Photocrati_Fonts::render_google_font_link(array(
        array($font_style, $font_weight, $font_italic),
        array($sidebar_font_style, $sidebar_font_weight, $sidebar_font_italic),
        array($sidebar_title_style, $sidebar_title_weight, $sidebar_title_italic),
        array($title_style, $title_font_weight, $title_italic),
        array($h1_font_style, $h1_font_weight, $h1_font_italic),
        array($h2_font_style, $h2_font_weight, $h2_font_italic),
        array($h3_font_style, $h3_font_weight, $h3_font_italic),
        array($h4_font_style, $h4_font_weight, $h4_font_italic),
        array($h5_font_style, $h5_font_weight, $h5_font_italic),
        array($description_style, $description_font_weight, $description_font_italic),
        array($menu_font_style, $menu_font_weight, $menu_font_italic),
        array($submenu_font_style, $submenu_font_weight, $submenu_font_italic),
        array($footer_widget_style, $footer_widget_weight, $footer_widget_italic),
        array($footer_font_style, $footer_font_weight, $footer_font_italic)
    ));
    ?>
    <title><?php
        if ( is_single() ) { single_post_title(); }
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); print ' | '; bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); }
        elseif ( is_search() ) { bloginfo('name'); print ' | Search results for ' . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); print ' | Not Found'; }
        else { bloginfo('name'); wp_title('|'); get_page_number(); }
    ?></title>

	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />

	<!-- IMPORTANT! Do not remove this code. This is used for enabling & disabling the dynamic styling -->
		<?php if($dynamic_style) { ?>

            <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/styles/dynamic-style.php" />
			<?php if($logo_menu_position == 'left-right') { ?>
			<!--[if lt IE 8]>
			<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/style-ie7-menufix.css" type="text/css" />
			<![endif]-->
			<?php } ?>

        <?php } else { ?>

            <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/styles/style.css" />
			<?php if($logo_menu_position == 'left-right') { ?>
			<!--[if lt IE 8]>
			<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/style-ie7-menufix.css" type="text/css" />
			<![endif]-->
			<?php } ?>

        <?php } ?>
    <!-- End dynamic styling -->

    <!--[if IE 8]>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/style-ie.css" type="text/css" />
    <![endif]-->

    <!--[if lt IE 8]>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/style-ie7.css" type="text/css" />
    <![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/admin/css/jquery.lightbox-0.5.css" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php
	if( !is_admin()){
		wp_enqueue_script('jquery');
        if ($preset->custom_js) wp_enqueue_script('photocrati-custom-js', site_url('?photocrati-js'));
	 }
	?>

	<?php wp_head(); ?>

	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url'); ?>" title="<?php printf( __( '%s latest posts', 'photocrati-framework' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'photocrati-framework' ), wp_specialchars( get_bloginfo('name'), 1 ) ); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if($fs_rightclick == "ON") { ?>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/clickprotect.js"></script>
	<?php } ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/jquery-ui.min.css" />
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/navbar-static-top.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/css/supersized.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/dist/css/supersized.shutter.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/dist/css/custom.css" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/dist/css/media.query.css" rel="stylesheet">

    <?php
    $pageTitle = get_the_title();
    switch ($pageTitle) {
        case "Contact Us":
            echo '<link href="' . get_stylesheet_directory_uri() . '/dist/css/contact-page.css" rel="stylesheet">';
            break;
        case "About Us":
            echo '<link href="' . get_stylesheet_directory_uri() . '/dist/css/about-page.css" rel="stylesheet">';
            break;
    }
    ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/scripts/jquery.jplayer.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/scripts/jplayer.style.css" />

<?php if($lightbox_type == 'fancy') { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/admin/css/jquery.fancybox-1.3.4.css" type="text/css" />
<?php } else if($lightbox_type == 'light') { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/admin/css/jquery.fancybox-1.3.4-light.css" type="text/css" />
<?php } else if($lightbox_type == 'thick') { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/admin/css/jquery.fancybox-1.3.4-thick.css" type="text/css" />
<?php } ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/admin/js/jquery.fancybox-1.3.4.pack.js"></script>

<script type="text/javascript">
//<![CDATA[
jQuery.noConflict();

(function () {
	var div = document.createElement('div'),
	ref = document.getElementsByTagName('base')[0] ||
		    document.getElementsByTagName('script')[0];

	div.innerHTML = '&shy;<style> iframe { visibility: hidden; } </style>';

	ref.parentNode.insertBefore(div, ref);

	jQuery(window).load(function() {
		div.parentNode.removeChild(div);
	});
})();

	function formatTitle(title, currentArray, currentIndex, currentOpts) {
		return '<div id="tip7-title"><span><a href="javascript:;" onclick="jQuery.fancybox.close();"><img src="<?php bloginfo('template_url'); ?>/admin/css/closelabel.gif" alt="close label" /></a></span>' + (title && title.length ? '<b>' + title + '</b>' : '' ) + 'Image ' + (currentIndex + 1) + ' of ' + currentArray.length + '</div>';
	}
	//]]>
	jQuery(document).ready(function() {

	jQuery("a.decoy").fancybox({
		'overlayColor'		: '#0b0b0f',
		'overlayOpacity'	: 0.8,
		'centerOnScroll'	: true,
		<?php if($lightbox_type == 'fancy') { ?>
		'titlePosition'		: 'outside'
		<?php } else if($lightbox_type == 'light') { ?>
		'titlePosition'		: 'inside',
		'titleFormat'		: formatTitle
		<?php } else if($lightbox_type == 'thick') { ?>
		'titlePosition' 	: 'inside',
		'showNavArrows'		: false,
    	'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
			var gettitle;
			gettitle = '<span id="fancybox-title-inside">'+title+'<BR><span class="counter">Image ' +  (currentIndex + 1) + ' of ' + currentArray.length + ' &nbsp;&nbsp;';
			if(currentIndex != 0) {
			gettitle = gettitle + '<a onclick="jQuery.fancybox.prev();" style="cursor:pointer;">&laquo; Prev</a> | ';
			}
			gettitle = gettitle + '<a onclick="jQuery.fancybox.next();" style="cursor:pointer;">Next &raquo;</a></span>';

			gettitle = gettitle + '<div id="close_button"><a onclick="jQuery.fancybox.close();" style="cursor:pointer;">Close</a></div></span>';

			return gettitle;
    	}
		<?php } ?>
		//'href'				: ''+site+''
	});

	<?php

	$lightbox_selector = '.photocrati_lightbox_always';
	$lightbox_custom = null;

	switch($lightbox_mode)
	{
		case 'always':
		{
			$lightbox_custom = 'a:has(\\\'[class*=\\\'wp-image\\\']\\\'), .photocrati_lightbox';

			break;
		}
		case 'never':
		{
			break;
		}
		case 'manual':
		default:
		{
			$lightbox_custom = '.photocrati_lightbox';

			break;
		}
	}

	if ($lightbox_custom != null)
	{
		$lightbox_selector .= ', ' . $lightbox_custom;
	}

	if ($lightbox_selector != null)
	{
	?>

	var lighboxSelector = '<?php echo $lightbox_selector; ?>';

	jQuery(lighboxSelector).fancybox({
		'overlayColor'		: '#0b0b0f',
		'overlayOpacity'	: 0.8,
		'centerOnScroll'	: true,
		<?php if($lightbox_type == 'fancy') { ?>
		'titlePosition'		: 'outside'
		<?php } else if($lightbox_type == 'light') { ?>
		'titlePosition'		: 'inside',
		'titleFormat'		: formatTitle
		<?php } else if($lightbox_type == 'thick') { ?>
		'titlePosition' 	: 'inside',
		'showNavArrows'		: false,
		'titleFormat'       : function(title, currentArray, currentIndex, currentOpts) {
			var gettitle;
			gettitle = '<span id="fancybox-title-inside">'+title+'<BR><span class="counter">Image ' +  (currentIndex + 1) + ' of ' + currentArray.length + ' &nbsp;&nbsp;';
			if(currentIndex != 0) {
			gettitle = gettitle + '<a onclick="jQuery.fancybox.prev();" style="cursor:pointer;">&laquo; Prev</a> | ';
			}
			gettitle = gettitle + '<a onclick="jQuery.fancybox.next();" style="cursor:pointer;">Next &raquo;</a></span>';

			gettitle = gettitle + '<div id="close_button"><a onclick="jQuery.fancybox.close();" style="cursor:pointer;">Close</a></div></span>';

			return gettitle;
		}
		<?php } ?>
	});

	<?php
	}
	?>

});
</script>

<?php if(is_single() || is_page()) { ?>

	<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function() {

		<?php if(get_post_meta($post->ID, 'music', true) == "YES") { ?>

		jQuery("#jquery_jplayer").jPlayer({
			ready: function () {
				<?php if(get_post_meta($post->ID, 'music_auto', true) == "YES") { ?>
				this.element.jPlayer("setFile", "<?php echo get_post_meta($post->ID, 'music_file', true); ?>").jPlayer("play");
				<?php } else { ?>
				this.element.jPlayer("setFile", "<?php echo get_post_meta($post->ID, 'music_file', true); ?>");
				<?php } ?>
			},
			oggSupport: false,
			preload: 'none',
			swfPath: "<?php echo get_bloginfo('template_directory'); ?>/scripts"
		})
		.jPlayer("onSoundComplete", function() {
			this.element.jPlayer("play");
		});

		<?php } ?>

	});
	</script>

	<?php if(get_post_meta($post->ID, 'music_controls', true) == "NO") { ?>

	<style type="text/css">
	.jp-single-player {
		display:none;
	}
	</style>

	<?php } ?>

<?php } ?>


<?php if(is_category() || is_archive()) { ?>

	<?php if($music_cat == "ON") { ?>

	<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function() {

		jQuery("#jquery_jplayer").jPlayer({
			ready: function () {
				<?php if($music_cat_auto == "YES") { ?>
				this.element.jPlayer("setFile", "<?php echo $music_cat_file; ?>").jPlayer("play");
				<?php } else { ?>
				this.element.jPlayer("setFile", "<?php echo $music_cat_file; ?>");
				<?php } ?>
			},
			oggSupport: false,
			preload: 'none',
			swfPath: "<?php echo get_bloginfo('template_directory'); ?>/scripts"
		})
		.jPlayer("onSoundComplete", function() {
			this.element.jPlayer("play");
		});

	});
	</script>

	<?php if($music_cat_controls == "NO") { ?>

	<style>
	.jp-single-player {
		display:none;
	}
	</style>

	<?php } ?>

	<?php } ?>

<?php } ?>


</head>

<body <?php body_class(); ?> id="themebody">

<div id="<?php echo (is_front_page()) ? "wrap" : ""; ?>">
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-static-top">
        <div class="navbar-inner">
            <div class="container">

                <div class="navbar-header">
                    <section class="navbar-menu-display"></section>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="row">
                    <?php
                    $walker = new Menu_With_Description;
                    wp_nav_menu( array(
                        'theme_location' => '',
                        'menu' => 'Menu Main Nav',
                        'container' => 'div',
                        'container_class' => 'navbar-collapse collapse',
                        'container_id' => '',
                        'menu_class' => 'nav navbar-nav',
                        'menu_id' => '',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'before' => '',
                        'after' => '',
                        'link_before' => '',
                        'link_after' => '',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 0,
                        'walker' => $walker
                    ) ); ?>
                    <div class="navbar-logo">
                        <a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-black.png" width="300" /></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">