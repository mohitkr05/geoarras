<?php 


function relativeDate($posted_date) {
    
    $tz = 0;    // change this if your web server and weblog are in different timezones
                // see project page for instructions on how to do this
    
    $month = substr($posted_date,4,2);
    
    if ($month == "02") { // february
    	// check for leap year
    	$leapYear = isLeapYear(substr($posted_date,0,4));
    	if ($leapYear) $month_in_seconds = 2505600; // leap year
    	else $month_in_seconds = 2419200;
    }
    else { // not february
    // check to see if the month has 30/31 days in it
    	if ($month == "04" or 
    		$month == "06" or 
    		$month == "09" or 
    		$month == "11")
    		$month_in_seconds = 2592000; // 30 day month
    	else $month_in_seconds = 2678400; // 31 day month;
    }
  
/* 
some parts of this implementation borrowed from:
http://maniacalrage.net/archives/2004/02/relativedatesusing/ 
*/
  
    $in_seconds = strtotime(substr($posted_date,0,8).' '.
                  substr($posted_date,8,2).':'.
                  substr($posted_date,10,2).':'.
                  substr($posted_date,12,2));
    $diff = time() - ($in_seconds + ($tz*3600));
    $months = floor($diff/$month_in_seconds);
    $diff -= $months*2419200;
    $weeks = floor($diff/604800);
    $diff -= $weeks*604800;
    $days = floor($diff/86400);
    $diff -= $days*86400;
    $hours = floor($diff/3600);
    $diff -= $hours*3600;
    $minutes = floor($diff/60);
    $diff -= $minutes*60;
    $seconds = $diff;

    if ($months>0) {
        // over a month old, just show date ("Month, Day Year")
        echo ''; the_time('F jS, Y');
    } else {
        if ($weeks>0) {
            // weeks and days
            $relative_date .= ($relative_date?', ':'').$weeks.' '.get_option('bizzthemes_relative_week').''.($weeks>1?''.get_option('bizzthemes_relative_s').'':'');
            $relative_date .= $days>0?($relative_date?', ':'').$days.' '.get_option('bizzthemes_relative_day').''.($days>1?''.get_option('bizzthemes_relative_s').'':''):'';
        } elseif ($days>0) {
            // days and hours
            $relative_date .= ($relative_date?', ':'').$days.' '.get_option('bizzthemes_relative_day').''.($days>1?''.get_option('bizzthemes_relative_s').'':'');
            $relative_date .= $hours>0?($relative_date?', ':'').$hours.' '.get_option('bizzthemes_relative_hour').''.($hours>1?''.get_option('bizzthemes_relative_s').'':''):'';
        } elseif ($hours>0) {
            // hours and minutes
            $relative_date .= ($relative_date?', ':'').$hours.' '.get_option('bizzthemes_relative_hour').''.($hours>1?''.get_option('bizzthemes_relative_s').'':'');
            $relative_date .= $minutes>0?($relative_date?', ':'').$minutes.' '.get_option('bizzthemes_relative_minute').''.($minutes>1?''.get_option('bizzthemes_relative_s').'':''):'';
        } elseif ($minutes>0) {
            // minutes only
            $relative_date .= ($relative_date?', ':'').$minutes.' '.get_option('bizzthemes_relative_minute').''.($minutes>1?''.get_option('bizzthemes_relative_s').'':'');
        } else {
            // seconds only
            $relative_date .= ($relative_date?', ':'').$seconds.' '.get_option('bizzthemes_relative_minute').''.($seconds>1?''.get_option('bizzthemes_relative_s').'':'');
        }
        
        // show relative date and add proper verbiage
    	echo ''.get_option('bizzthemes_relative_posted').' '.$relative_date.' '.get_option('bizzthemes_relative_ago').'';
    }
    
}

function isLeapYear($year) {
        return $year % 4 == 0 && ($year % 400 == 0 || $year % 100 != 0);
}

    if(!function_exists('how_long_ago')){
        function how_long_ago($timestamp){
            $difference = time() - $timestamp;

            if($difference >= 60*60*24*365){        // if more than a year ago
                $int = intval($difference / (60*60*24*365));
                $s = ($int > 1) ? ''.get_option('bizzthemes_relative_s').'' : '';
                $r = $int . ' '.get_option('bizzthemes_relative_year').'' . $s . ' '.get_option('bizzthemes_relative_ago').'';
            } elseif($difference >= 60*60*24*7*5){  // if more than five weeks ago
                $int = intval($difference / (60*60*24*30));
                $s = ($int > 1) ? ''.get_option('bizzthemes_relative_s').'' : '';
                $r = $int . ' '.get_option('bizzthemes_relative_month').'' . $s . ' '.get_option('bizzthemes_relative_ago').'';
            } elseif($difference >= 60*60*24*7){        // if more than a week ago
                $int = intval($difference / (60*60*24*7));
                $s = ($int > 1) ? ''.get_option('bizzthemes_relative_s').'' : '';
                $r = $int . ' '.get_option('bizzthemes_relative_week').'' . $s . ' '.get_option('bizzthemes_relative_ago').'';
            } elseif($difference >= 60*60*24){      // if more than a day ago
                $int = intval($difference / (60*60*24));
                $s = ($int > 1) ? ''.get_option('bizzthemes_relative_s').'' : '';
                $r = $int . ' '.get_option('bizzthemes_relative_day').'' . $s . ' '.get_option('bizzthemes_relative_ago').'';
            } elseif($difference >= 60*60){         // if more than an hour ago
                $int = intval($difference / (60*60));
                $s = ($int > 1) ? ''.get_option('bizzthemes_relative_s').'' : '';
                $r = $int . ' '.get_option('bizzthemes_relative_hour').'' . $s . ' '.get_option('bizzthemes_relative_ago').'';
            } elseif($difference >= 60){            // if more than a minute ago
                $int = intval($difference / (60));
                $s = ($int > 1) ? ''.get_option('bizzthemes_relative_s').'' : '';
                $r = $int . ' '.get_option('bizzthemes_relative_minute').'' . $s . ' '.get_option('bizzthemes_relative_ago').'';
            } else {                                // if less than a minute ago
                $r = ''.get_option('bizzthemes_relative_moments').' '.get_option('bizzthemes_relative_ago').'';
            }

            return $r;
        }
    }

/*
Plugin Name: WP-PageNavi 
Plugin URI: http://www.lesterchan.net/portfolio/programming.php 
*/ 

// Excerpt length

function bm_better_excerpt($length, $ellipsis) {
$text = get_the_content();
$text = strip_tags($text);
$text = substr($text, 0, $length);
$text = substr($text, 0, strrpos($text, " "));
$text = $text.$ellipsis;
return $text;
}

// Use Noindex for sections specified in theme admin



// Related Posts, tutorial found on: http://curtishenson.com/write-your-own-related-posts-plugin/

function bizz_get_related($post) {

    global $wpdb;
    
	$now = current_time('mysql', 1);
    $tags = wp_get_post_tags($post->ID);
    $show_date = 0;
    $limit = 3;
    $show_comments_count = 0;
            
    $taglist = "'" . $tags[0]->term_id. "'";
    $tagcount = count($tags);
    if ($tagcount > 1) {
        for ($i = 1; $i <= $tagcount; $i++) {
            $taglist = $taglist . ", '" . $tags[$i]->term_id . "'";
        }
    }
                            
    $q = "SELECT p.ID, p.post_title, p.post_date, p.comment_count, count(t_r.object_id) as cnt FROM $wpdb->term_taxonomy t_t, $wpdb->term_relationships t_r, $wpdb->posts p WHERE t_t.taxonomy ='post_tag' AND t_t.term_taxonomy_id = t_r.term_taxonomy_id AND t_r.object_id  = p.ID AND (t_t.term_id IN ($taglist)) AND p.ID != $post->ID AND p.post_status = 'publish' AND p.post_date_gmt < '$now' GROUP BY t_r.object_id ORDER BY cnt DESC, p.post_date_gmt DESC LIMIT $limit;";
    $related_posts = $wpdb->get_results($q);
	
        foreach ($related_posts as $related_post ){
            $output .= '<p class="rellist">&rsaquo;&nbsp;';
                    
                if ($show_date){
                    $dateformat = get_option('date_format');
                    $output .=   mysql2date($dateformat, $related_post->post_date) . " -- ";
                }
                    
                $output .=  '<a href="'.get_permalink($related_post->ID).'" title="'.wptexturize($related_post->post_title).'">'.wptexturize($related_post->post_title).'';
                    
                if ($show_comments_count){
                    $output .=  " (" . $related_post->comment_count . ")";
                }
                    
                $output .=  '</a></p>';
        }

    $output = '' . $output . '';
    return $output;   
}      

register_taxonomy('region', 'store', array(
'hierarchical' => true,  'label' => 'Region',
'query_var' => true, 'rewrite' => true));


function custom_login_logo() {
       
		echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/custom-login/custom-login.css" />';
}
add_action('login_head', 'custom_login_logo');

function change_wp_login_url() {
        echo bloginfo('url');
}
add_filter('login_headerurl', 'change_wp_login_url');

function change_wp_login_title() {
        echo get_option('blogname');
}
add_filter('login_headertitle', 'change_wp_login_title');

remove_action('wp_head', 'wp_generator');

do_action('arras_init');



add_action( 'init', 'create_store_type' );
function create_store_type() {
	$labels = array(
    'name' => _x('Stores', 'post type general name'),
    'singular_name' => _x('Store', 'post type singular name'),
    'add_new' => _x('Add New', 'store'),
    'add_new_item' => __('Add New Store'),
    'edit_item' => __('Edit Store'),
    'new_item' => __('New Store'),
    'all_items' => __('All Stores'),
    'view_item' => __('View Store'),
    'search_items' => __('Search Stores'),
    'not_found' =>  __('No stores found'),
    'not_found_in_trash' => __('No stores found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Stores'
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => true,
	'taxonomies' => array ('category'),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => 5,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments','custom-fields')
  ); 
 
  register_post_type('store',$args);
}
add_filter('post_updated_messages', 'create_store_type_messages');

function create_store_type_messages( $messages ) {
  global $post, $post_ID;

  $messages['store'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Store updated. <a href="%s">View store</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Store updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Store restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Store published. <a href="%s">View store</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Store saved.'),
    8 => sprintf( __('Store submitted. <a target="_blank" href="%s">Preview store</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Store scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview store</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Store draft updated. <a target="_blank" href="%s">Preview store</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

// Custom fields for WP write panel

/*
Plugin Name: Custom Write Panel
Plugin URI: http://wefunction.com/2008/10/tutorial-create-custom-write-panels-in-wordpress
Description: Allows custom fields to be added to the WordPress Post Page
Version: 1.0
Author: Spencer
Author URI: http://wefunction.com
/* ----------------------------------------------*/

//Custom Settings
$store_metaboxes = array(
		"video" => array (
			"name"		=> "video",
			"default" 	=> "",
			"label" 	=> __("Custom Video code"),
			"type" 		=> "textarea",
			"desc"      => __("Enter embaded code for video. eg. : youtube video code")
		),
		"address" => array (
			"name"		=> "address",
			"default" 	=> "",
			"label" 	=> __("Listing Address"),
			"type" 		=> "text",
			"desc"      => __("Enter listing place address. eg. : <b>230 Vine Street And locations throughout Old City,
Philadelphia, PA 19106</b>")
		),
		"geo_address" => array (
			"name"		=> "geo_address",
			"default" 	=> "",
			"label" 	=> __("Nearby Address"),
			"type" 		=> "text",
			"desc"      => __("Enter listing place address. eg. : <b>230 Vine Street And locations throughout Old City,
Philadelphia, PA 19106</b>")
		),
		"geo_latitude" => array (
			"name"		=> "geo_latitude",
			"default" 	=> "",
			"label" 	=> __("Latitude Form Map"),
			"type" 		=> "text",
			"desc"      => __("Enter Google Map Latitude. eg. : <b>39.955823048131286</b>")
		),
		"geo_longitude" => array (
			"name"		=> "geo_longitude",
			"default" 	=> "",
			"label" 	=> __("Longitude Form Map"),
			"type" 		=> "text",
			"desc"      => __("Enter Google Map Longitude. eg. : <b>-75.14408111572266</b>")
		),
		"timing" => array (
			"name"		=> "timing",
			"default" 	=> "",
			"label" 	=> __("Timing Information"),
			"type" 		=> "text",
			"desc"      => __("Enter Timing Information. eg. : <b>10.00 am to 6 pm</b>")
		),
		"contact" => array (
			"name"		=> "contact",
			"default" 	=> "",
			"label" 	=> __("Contact Information"),
			"type" 		=> "text",
			"desc"      => __("Enter Contact Information, Phone or mobile number. eg. : <b>(610) 388-1000</b>")
		),
		
		"email" => array (
			"name"		=> "email",
			"default" 	=> "",
			"label" 	=> __("Email Address"),
			"type" 		=> "text",
			"desc"      => __("Enter Address. eg. : <b>info@myplace.com</b>")
		),
		
		"website" => array (
			"name"		=> "website",
			"default" 	=> "",
			"label" 	=> __("Website"),
			"type" 		=> "text",
			"desc"      => __("Enter Website Address. eg. : <b>http://myplace.com</b>")
		)
		
		
	);
	

function storethemes_meta_box_content() {
    global $post, $store_metaboxes;
    $output = '';
    $output .= '<div class="store_metaboxes_table">'."\n";
	foreach ($store_metaboxes as $store_id => $store_metabox) {
    if($store_metabox['type'] == 'text' OR $store_metabox['type'] == 'select' OR $store_metabox['type'] == 'checkbox' OR $store_metabox['type'] == 'textarea')
			$store_metaboxvalue = get_post_meta($post->ID,$store_metabox["name"],true);
           	if ($store_metaboxvalue == "" || !isset($store_metaboxvalue)) {
                $store_metaboxvalue = $store_metabox['default'];
            }
            if($store_metabox['type'] == 'text'){
                $output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$store_id.'">'.$store_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><input size="100" class="store_input_text" type="'.$store_metabox['type'].'" value="'.$store_metaboxvalue.'" name="storethemes_'.$store_metabox["name"].'" id="'.$store_id.'"/></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$store_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }
            elseif ($store_metabox['type'] == 'textarea'){
				$output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$store_id.'">'.$store_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><textarea rows="5" cols="98" class="store_input_textarea" name="storethemes_'.$store_metabox["name"].'" id="'.$store_id.'">' . $store_metaboxvalue . '</textarea></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$store_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }
           elseif ($store_metabox['type'] == 'select'){
                $output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$store_id.'">'.$store_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><select class="store_input_select" id="'.$store_id.'" name="storethemes_'. $store_metabox["name"] .'"></p>'."\n";
                $array = $store_metabox['ostoreions'];
                if($array){
                    foreach ( $array as $id => $ostoreion ) {
                        $selected = '';
                        if($store_metabox['default'] == $ostoreion){$selected = 'selected="selected"';} 
                        if($store_metaboxvalue == $ostoreion){$selected = 'selected="selected"';}
                        $output .= '<ostoreion value="'. $ostoreion .'" '. $selected .'>' . $ostoreion .'</ostoreion>';
                    }
                }
                $output .= '</select><p><span style="font-size:11px">'.$store_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }
            elseif ($store_metabox['type'] == 'checkbox'){
                if($store_metaboxvalue == 'on') { $checked = 'checked="checked"';} else {$checked='';}
				$output .= "\t".'<div>';
                $output .= "\t\t".'<br/><p><strong><label for="'.$store_id.'">'.$store_metabox['label'].'</label></strong></p>'."\n";
                $output .= "\t\t".'<p><input type="checkbox" '.$checked.' class="store_input_checkbox"  id="'.$store_id.'" name="storethemes_'. $store_metabox["name"] .'" /></p>'."\n";
                $output .= "\t\t".'<p><span style="font-size:11px">'.$store_metabox['desc'].'</span></p>'."\n";
                $output .= "\t".'</div>'."\n";
            }        
        }
    
    $output .= '</div>'."\n\n";
    echo $output;
}
	


	
function storethemes_metabox_insert() {
    global $store_metaboxes;
    global $globals;
    $pID = $_POST['post_ID'];
    $counter = 0;
    foreach ($store_metaboxes as $store_metabox) { // On Save.. this gets looped in the header response and saves the values submitted
    if($store_metabox['type'] == 'text' OR $store_metabox['type'] == 'select' OR $store_metabox['type'] == 'checkbox' OR $store_metabox['type'] == 'textarea') // Normal Type Things...
        {
            $var = "storethemes_".$store_metabox["name"];
			 if (isset($_POST[$var])) {            
                if( get_post_meta( $pID, $store_metabox["name"] ) == "" )
                    add_post_meta($pID, $store_metabox["name"], $_POST[$var], true );
                elseif($_POST[$var] != get_post_meta($pID, $store_metabox["name"], true))
                    update_post_meta($pID, $store_metabox["name"], $_POST[$var]);
                elseif($_POST[$var] == "")
                    delete_post_meta($pID, $store_metabox["name"], get_post_meta($pID, $store_metabox["name"], true));
            }  
        } 
    }
}
function storethemes_meta_box() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box('storethemes-settings',$GLOBALS['themename'].' Custom Settings','storethemes_meta_box_content','store','normal','high');
    }
}

add_action('admin_menu', 'storethemes_meta_box');
add_action('save_post', 'storethemes_metabox_insert');

remove_action('wp_head', 'wp_generator');

function remove_dashboard_widgets() {

	global $wp_meta_boxes;

	
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action("wp_ajax_add_votes_options", "add_votes_options");
add_action("wp_ajax_nopriv_add_votes_options", "add_votes_options");
function add_votes_options() {
	if (!wp_verify_nonce($_POST['nonce'], 'voting_nonce'))
		return;
 
	$postid = $_POST['postid'];
	$ip = $_POST['ip'];
 
	$voter_ips = get_post_meta($postid, "voter_ips", true);
	if(!empty($voter_ips) && in_array($ip, $voter_ips)) {
		echo "null";
		die(0);
	} else {
		$voter_ips[] = $ip;
		update_post_meta($postid, "voter_ips", $voter_ips);
	}	
 
	$current_votes = get_post_meta($postid, "votes", true);
	$new_votes = intval($current_votes) + 1;
	update_post_meta($postid, "votes", $new_votes);
	$return = $new_votes>1 ? $new_votes." votes" : $new_votes." vote";
	echo $return;
	die(0);
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


function deals_stores() {
	// Make sure the Posts 2 Posts plugin is active.
	if ( !function_exists( 'p2p_register_connection_type' ) )
		return;

	p2p_register_connection_type( array(
		'id' => 'posts_to_stores',
		'from' => 'posts',
		'to' => 'stores'
	) );
}
add_action( 'init', 'deals_stores', 100 );

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('post','stores'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
	return $query;
    }
}