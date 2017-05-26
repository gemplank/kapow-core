<?php
/**
 * Kapow Core Config Template
 *
 * This file is not loaded by this plugin, it should be copied and referenced
 * in your project eiterh wholsale or by individual snippets.
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

 // The filters available are:
 //
 // - `kapow_core_do_public_enqueue` &mdash; show all the public asset enqueues.
 // - `kapow_core_do_public_css_enqueue` &mdash; show the public CSS enqueue.
 // - `kapow_core_do_public_js_enqueue` &mdash; show the public JS enqueue.
 // - `kapow_core_do_admin_enqueue` &mdash; show all the admin asset enqueues.
 // - `kapow_core_do_admin_css_enqueue` &mdash; show the admin CSS enqueue.
 // - `kapow_core_do_admin_editor_css_enqueue` &mdash; show the admin editor CSS enqueue.
 // - `kapow_core_do_admin_js_enqueue` &mdash; show the admin JS enqueue.
 // - `kapow_core_do_customizer_enqueue` &mdash; show the customizer CSS enqueue.
 //
 // #### Render Views
 // Views reside within the `/views` folder in the plugin, but you may wish to override these views in your theme.
 //
 // Use the filter `kapow_core_view_template_folder` to set where the view
 // sits within your theme. EG:
 //
 // `add_filter( 'kapow_core_view_template_folder', function() {
 // 	return get_stylesheet_directory() . '/template-parts/kapow-core/';
 // } );`
 //
 // You can also return a boolean for the filter `kapow_core_view_template_folder_check_exists`
 // to perform an optional check if the template exists in your theme. However best
 // practice is duplicating the `/views` folder within your theme at a custom location.
