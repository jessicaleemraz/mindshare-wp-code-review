<?php
/*
 *	Plugin Name: Mindshare Code Review Plugin
 *	Plugin URI:
 *	Description: WP Code Review Assignment: use a JSON API endpoint, with a shortcode
 *	Author: Jessi Lee Mraz
 *	Version: 1.0
 *	Author URI: http://www.jessicaleemraz.com/
 *	License: GPL2
 *	License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *	Text Domain: wp-mindshare-jessileemraz
*/

// Hook in the style
function mindshare_scripts () {
// Get plugin stylesheet
	wp_enqueue_style( 'mindshare-style', plugin_dir_url(__FILE__) . 'css/style.css', '1.0', 'all');
	}
	add_action( 'wp_enqueue_scripts', 'mindshare_scripts');

// Get Mindshare JSON
function wpmindshare_plugin_posts () {
	$str = file_get_contents("https://mind.sh/are/wp-json/posts"); 
// Decode the JSON as associative arrays
	$json_a=json_decode($str, true); 
// Echo Featured Img, Linked Title, and Content	
	foreach($json_a as $json){
	?><div id='creativeblock'><?php
	if ($json['featured_image']['link']) {
	echo "<div id='feaimg'><img src=".$json['featured_image']['link']."></div>";
	} else {
	
	}
	echo "<div id='featitle'><a href=".$json['link'].">".$json['title']."</a></div>";
	echo "<div id='feacontent'>".$json['content']."</div>";
	?></div><?php
	}

// Shortcode Parameters

}
add_shortcode( 'mindshareposts', 'wpmindshare_plugin_posts' );
	
?>