<?php
/**
 * Kapow Core Config Template
 *
 * This file is not loaded by this plugin, it should be copied and referenced
 * in your project either wholsale or by individual snippets.
 *
 * All hooks and filters are set to their defaults.
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

/**
 * Assets
 *
 * We highly recommend that the appropriate filters are used to deactivate all
 * enqueues, and these are concatenated and enqueued within your own workflow.
 */

/**
 * Do public enqueue
 *
 * If false, no public facing script or style enqueues will run.
 */
add_filter( 'kapow_core_do_public_enqueue', '__return_true' );

/**
 * Do public CSS enqueue
 *
 * If false, the public style enqueues will not run.
 */
add_filter( 'kapow_core_do_public_css_enqueue', '__return_true' );

/**
 * Do public JS enqueue
 *
 * If false, the public scripts enqueues will not run.
 */
add_filter( 'kapow_core_do_public_js_enqueue', '__return_false' );

/**
 * Do admin enqueue
 *
 * If false, no admin script or style enqueues will run.
 */
add_filter( 'kapow_core_do_admin_enqueue', '__return_false' );

/**
 * Do admin CSS enqueue
 *
 * If false, the admin style enqueues will not run.
 */
add_filter( 'kapow_core_do_admin_css_enqueue', '__return_false' );

/**
 * Do admin JS enqueue
 *
 * If false, the admin scripts enqueues will not run.
 */
add_filter( 'kapow_core_do_admin_editor_css_enqueue', '__return_false' );

/**
 * Do Customizer enqueue
 *
 * If false, no customizer script or style enqueues will run.
 */
add_filter( 'kapow_core_do_customizer_enqueue', '__return_false' );


/**
 * Views
 *
 * There are no views currently in the theme, however:
 *
 * Views reside within the `/views` folder in the plugin, but you may wish to
 * override these views in your theme.
 */

/**
 * View template folder
 *
 * Sets the folder that the plugin should look in for the views.
 *
 * Example:
 *
 * To look for the files within your theme's `template-parts/kapow-core` directory
 * add the following code:
 *
 * `return get_stylesheet_directory() . '/template-parts/kapow-core/';`
 */
add_filter( 'kapow_core_view_template_folder', function( $view_template_folder ) {
	return $view_template_folder;
}, 1 );

/**
 * View template folder - Check Exists
 *
 * You can set this to true to check if a file exists, and if it dosnt fallback
 * to the default `/views` folder in the plugin. Useful for overriding just one
 * view.
 */
add_filter( 'kapow_core_view_template_folder_check_exists', '__return_false' );
