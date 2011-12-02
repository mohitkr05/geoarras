<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php arras_document_title() ?></title>
<?php arras_document_description() ?>

<?php if ( is_search() || is_author() ) : ?>
<meta name="robots" content="noindex, nofollow" />
<?php endif ?>

<?php if ( ($feed = arras_get_option('feed_url') ) == '' ) : ?>
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('rss2_url') ?>" title="<?php printf( __( '%s latest posts', 'arras' ), esc_html( get_bloginfo('name'), 1 ) ) ?>" />
<?php else : ?>
<link rel="alternate" type="application/rss+xml" href="<?php echo $feed ?>" title="<?php printf( __( '%s latest posts', 'arras' ), esc_html( get_bloginfo('name'), 1 ) ) ?>" />
<?php endif; ?>

<?php if ( ($comments_feed = arras_get_option('comments_feed_url') ) == '' ) : ?>
<link rel="alternate" type="application/rss+xml" href="<?php bloginfo('comments_rss2_url') ?>" title="<?php printf( __( '%s latest comments', 'arras' ), esc_html( get_bloginfo('name'), 1 ) ) ?>" />
<?php else : ?>
<link rel="alternate" type="application/rss+xml" href="<?php echo $comments_feed ?>" title="<?php printf( __( '%s latest comments', 'arras' ), esc_html( get_bloginfo('name'), 1 ) ) ?>" />
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( !file_exists(ABSPATH . 'favicon.ico') ) : ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/images/favicon.ico" />
<?php else: ?>
<link rel="shortcut icon" href="<?php echo get_bloginfo('url') ?>/favicon.ico" />
<?php endif; ?>

<?php
wp_enqueue_script('jquery');
wp_enqueue_script('jquery-ui-tabs', null, array('jquery-ui-core', 'jquery'), null, false); 

if ( is_home() || is_front_page() ) {
	wp_enqueue_script('jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.min.js', 'jquery', null, true);
	
}

if ( !function_exists('pixopoint_menu') ) {
	wp_enqueue_script('hoverintent', get_template_directory_uri() . '/js/superfish/hoverIntent.js', 'jquery', null, false);
	wp_enqueue_script('superfish', get_template_directory_uri() . '/js/superfish/superfish.js', 'jquery', null, false);
}

if ( is_singular() ) {
	wp_enqueue_script('comment-reply');
	wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', 'jquery', null, false);
	wp_enqueue_script('jquery-cycle', get_template_directory_uri() . '/js/vote.js', 'jquery', null, true);
	?><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=191872274179005";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php }

?>

<?php wp_head(); ?>
</head>

<body <?php arras_body_class() ?>>
<script type="text/javascript">
//<![CDATA[
(function(){
var c = document.body.className;
c = c.replace(/no-js/, 'js');
document.body.className = c;
})();
//]]>
</script>
<?php arras_body() ?>
<div class="ribbon">
  <a href="#" rel="me">Promote your business</a>
</div>
<div id="top-menu" class="clearfix">
<?php arras_above_top_menu() ?>
	<?php 
	if ( function_exists('wp_nav_menu') ) {
		wp_nav_menu( array( 
			'sort_column' => 'menu_order', 
			'menu_class' => 'sf-menu menu clearfix', 
			'theme_location' => 'top-menu',
			'container_id' => 'top-menu-content',
			'fallback_cb' => ''
		) );
	}
	?>
<?php arras_below_top_menu() ?>

</div><!-- #top-menu -->

<div id="header">

	<div id="branding" class="clearfix">
	<div class="logo">
		<?php if ( is_home() || is_front_page() ) : ?>
		<h1 class="blog-name"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
		<h2 class="blog-description"><?php bloginfo('description'); ?></h2>
		<?php else: ?>
		<span class="blog-name"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></span>
		<span class="blog-description"><?php bloginfo('description'); ?></span>
		<?php endif ?>
	</div>
	<div id="searchbar"><?php get_search_form() ?></div>
	</div><!-- #branding -->
</div><!-- #header -->

<?php arras_above_nav() ?>
<div id="nav">
	<div id="nav-content" class="clearfix">
	<?php 
	if ( function_exists('pixopoint_menu') ) {
		pixopoint_menu();
	} elseif ( function_exists('wp_nav_menu') ) {
		wp_nav_menu( array( 'sort_column' => 'menu_order', 'menu_class' => 'sf-menu menu clearfix', 'theme_location' => 'main-menu', 'fallback_cb' => 'arras_nav_fallback_cb' ) );
	} else { ?>
		<ul class="sf-menu menu clearfix">
			<li><a href="<?php bloginfo('url') ?>"><?php _e( arras_get_option('topnav_home') ); ?></a></li>
			<?php 
			if (arras_get_option('topnav_display') == 'pages') {
				wp_list_pages('sort_column=menu_order&title_li=');
			} else if (arras_get_option('topnav_display') == 'linkcat') {
				wp_list_bookmarks('category='.arras_get_option('topnav_linkcat').'&hierarchical=0&show_private=1&hide_invisible=0&title_li=&categorize=0&orderby=id'); 
			} else {
				wp_list_categories('hierarchical=1&orderby=id&hide_empty=1&title_li=');	
			}
			?>
		</ul>
	<?php } ?>
	<?php arras_beside_nav() ?>
	</div><!-- #nav-content -->
</div><!-- #nav -->
<?php arras_below_nav() ?>
<?php if(!is_single()) {?>
<?php if(is_home()) {?>
<div id="map">
<h1 class="vibbon">
   <strong class="vibbon-content">Browse the Stores</strong>
</h1>
<?php echo GeoMashup::map('width=100%&load_empty_map=true&cluster_max_zoom=12&map_content=global&zoom=12&add_overview_control=false&add_map_type_control=false&background_color=c0c0c0&marker_select_info_window=true&marker_select_center=false&marker_select_highlight=false&marker_select_attachments=false&auto_info_open=false&enable_scroll_wheel_zoom=false&center_lat=28.616457&center_lng=77.226264');?>
<?php echo GeoMashup::category_legend() ?>
</div>
<?php } elseif (is_archive()||is_category()) {?>
<div id="map">
<?php echo GeoMashup::map();?>
</div>
<?php }?>
<?php }?>
<?php if(is_home()) {?>	
	<h1 class="vibbon">
   <strong class="vibbon-content">Check Out Latest Deals</strong>
</h1>
<?php }?>	
<div id="wrapper">
	
	<?php arras_above_main() ?>
  
	<div id="main" class="clearfix">
    <div id="container" class="clearfix">

