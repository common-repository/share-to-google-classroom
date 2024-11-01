<?php 
	
/*
Plugin Name: Share to Google Classroom
Description: A plugin that adds a shortcode to quickly create a Share to Google Classroom button
Version:     1.0
Author:      Priten Shah
Author URI:  https://pritenhshah.com
License:     GPL2
License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/* Copyright 2020 Priten H. Shah (email :contact@pritenhshah.com)
Share to Google Classroom is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Share to Google Classroom is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Share to Google Classroom. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.html.

*/

// Load Google Api

wp_register_script( 'google_api', 'https://apis.google.com/js/platform.js', array( 'jquery' ) );


function load_google_api() {
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'share_to_google') ) {
        wp_enqueue_script('google_api');
    }
}
add_action( 'wp_enqueue_scripts', 'load_google_api');

// Shortcode to Create Button
function share_to_google( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'url' => get_permalink(),
			'size' => '32',
			'theme' => 'classic',
			'title' => get_the_title(),
			'itemtype' => 'assignment',
			'body'  => '',
			
		),
		$atts,
		'share_to_google'
	);
	$content = '<span class="gclassroom"><g:sharetoclassroom url="'.$atts['url'].'" size="'.$atts['size'].'" theme="'.$atts['theme'].'"  title="'.$atts['title'].'" itemtype="'.$atts['itemtype'].'" body="'.$atts['body'].'"></g:sharetoclassroom><span class="glcassroom_text"> Share to Google Classroom</span></span>';
	return $content;


}
add_shortcode( 'share_to_google', 'share_to_google' );

?>