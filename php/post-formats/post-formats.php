<?php
/**
 * Post Formats
 *
 * Functions relating to Post Formats
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

/**
 * Remove Post Formats
 */
function kapow_core_remove_post_formats() {
	remove_theme_support( 'post-formats' );
}
add_action( 'after_setup_theme', 'kapow_core_remove_post_formats', 100 );
