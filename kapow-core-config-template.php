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
 * ASSETS
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
 * VIEWS
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
 *
 * @param string  $view_template_folder  The path to the folder.
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

/**
 * COMMENTS
 */

/**
 * Disable Comments
 *
 * If true, the global comments setting is set to disabled, the menu item for
 * comments is removed and the comment meta boxes are hidden.
 */
add_filter( 'kapow_core_disable_comments', '__return_true' );

/**
 * CONTENT
 */

/**
 * Content Tags
 *
 * The only tags that are allowed within our editor and excerpt (and meta for
 * that matter when hooked in correctly).
 *
 * Example:
 *
 * To add in additonal tags, just add them in manually.
 *
 * `$allowed_tags['i'] = array(
 *     'id'    => array(),
 *     'class' => array(),
 * );`
 * `return $allowed_tags;`
 *
 * @param array  $allowed_tags  Array of allowed tags.
 */
add_filter( 'kapow_core_content_tags', function( $allowed_tags ) {
	return $allowed_tags;
}, 1 );

/**
 * Content Protocols
 *
 * The only protcols that are allowed within our editor and excerpt (and meta for
 * that matter when hooked in correctly).
 *
 * Example:
 *
 * To add in additonal tags, just add them in manually.
 *
 * `$allowed_protocols[] = 'skype';``
 * `return $allowed_protocols;`
 *
 * @param array  $allowed_protocols  Array of allowed protocols.
 */
add_filter( 'kapow_core_content_protocols', function( $allowed_protocols ) {
	return $allowed_protocols;
}, 1 );

/**
 * DASHBOARD WIDGETS
 */

/**
 * Remove dashbaord widgets
 *
 * If true, the majority of dashbaord widgets will be removed. By all means you
 * can set this to false and copy the function in
 * `php/dashboard/class-dashboard-widgets.php` into your project and add/remove
 * your own widgets.
 */
add_filter( 'kapow_core_remove_widgets', '__return_true' );

/**
 * EDITOR
 */

/**
 * Show editor on posts page
 *
 * If true, the editor will be shown on the posts page.
 */
add_filter( 'kapow_core_show_editor_on_posts_page', '__return_true' );

/**
 * HOSTING
 */

/**
 * Hosting Menu Permitted User Names
 *
 * The usernames that are allowed to see the WPEngine hosting menus.
 *
 * Example:
 *
 * To add in additonal user names, you could write code to get all the
 * administrators, or at its simplest level manually add additonal items to the
 * array.
 *
 * `$user_names[] = 'mattwatson';`
 * `return $user_names;`
 *
 * @param array  $user_names  Array of permitted user names.
 */
add_filter( 'kapow_core_hosting_menu_permitted_user_names', function( $user_names ) {
	return $user_names;
}, 1 );
