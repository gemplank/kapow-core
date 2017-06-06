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
 * Clean Content
 *
 * If true, content (excpert, meta and body text) will be 'cleaned' (only
 * certain tags will be allowed).
 */
add_filter( 'kapow_core_clean_content', '__return_true' );

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
 * Remove TinyMCE Styles
 *
 * If true, the style selector, and the ability to add H1 text will be removed
 * from TinyMCE.
 */
add_filter( 'kapow_core_remove_tiny_mce_styles', '__return_true' );

/**
 * EMOJI
 */

/**
 * Remove Emoji
 *
 * If true, emoji will be disabled within WordPress.
 */
add_filter( 'kapow_core_remove_emoji', '__return_true' );

/**
 * FORMATTING
 */

/**
 * Add body classes
 *
 * If true, additional body classes will be added to pages.
 */
add_filter( 'kapow_core_add_body_classes', '__return_true' );

/**
 * Add iframe WCAG wrapper
 *
 * If true, WCAG compliant wrappers will be added to iFrames.
 */
add_filter( 'kapow_core_iframe_wcag_wrapper', '__return_true' );

/**
 * Add responsive embed wrappers
 *
 * If true, responsive wrappers will be added to embed components.
 */
add_filter( 'kapow_core_responsive_embed_wrapper', '__return_true' );

/**
 * HOSTING
 */

/**
 * Alter Hosting Menus
 *
 * If true, hosting menus will be altered to hide options from clients.
 */
add_filter( 'kapow_core_alter_hosting_menus', '__return_true' );

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

/**
 * POST
 */

/**
 * Alter Post Slug
 *
 * If true, the post slug and labels will be changed.
 */
add_filter( 'kapow_core_alter_alter_post_slug', '__return_false' );

/**
 * Post Slug
 *
 * The post slug. Default is `blog`.
 *
 * @param string  $post_slug  Post slug.
 */
add_filter( 'kapow_core_post_slug', function( $post_slug ) {
	return $post_slug;
}, 1 );

/**
 * Post Label
 *
 * The post label. Default is `Post`.
 *
 * @param string  $post_name_label  Post label.
 */
add_filter( 'kapow_core_post_name_label', function( $post_name_label ) {
	return $post_name_label;
}, 1 );

/**
 * Post Labels
 *
 * The post labels. Defaults are:
 *
 * array(
 *	 'name'                  => _x( 'Post', 'Post Type General Name', 'kapow-core' ),
 *	 'singular_name'         => _x( 'Post', 'Post Type Singular Name', 'kapow-core' ),
 *	 'menu_name'             => __( 'Post', 'kapow-core' ),
 *	 'name_admin_bar'        => __( 'Posts', 'kapow-core' ),
 *	 'archives'              => __( 'Post Archives', 'kapow-core' ),
 *	 'parent_item_colon'     => __( 'Parent Post:', 'kapow-core' ),
 *	 'all_items'             => __( 'All Posts', 'kapow-core' ),
 *	 'add_new_item'          => __( 'Add New Post', 'kapow-core' ),
 *	 'add_new'               => __( 'Add New', 'kapow-core' ),
 *	 'new_item'              => __( 'New Post', 'kapow-core' ),
 *	 'edit_item'             => __( 'Edit Post', 'kapow-core' ),
 *	 'update_item'           => __( 'Update Post', 'kapow-core' ),
 *	 'view_item'             => __( 'View Post', 'kapow-core' ),
 *	 'search_items'          => __( 'Search Posts', 'kapow-core' ),
 *	 'not_found'             => __( 'Not found', 'kapow-core' ),
 *   'not_found_in_trash'    => __( 'Not found in Trash', 'kapow-core' ),
 *	 'featured_image'        => __( 'Featured Image', 'kapow-core' ),
 *	 'set_featured_image'    => __( 'Set featured image', 'kapow-core' ),
 *	 'remove_featured_image' => __( 'Remove featured image', 'kapow-core' ),
 *	 'use_featured_image'    => __( 'Use as featured image', 'kapow-core' ),
 *	 'insert_into_item'      => __( 'Insert into Post', 'kapow-core' ),
 *	 'uploaded_to_this_item' => __( 'Uploaded to this Post', 'kapow-core' ),
 *	 'items_list'            => __( 'Posts list', 'kapow-core' ),
 *	 'items_list_navigation' => __( 'Posts list navigation', 'kapow-core' ),
 *	 'filter_items_list'     => __( 'Filter Posts list', 'kapow-core' ),
 * );
 *
 * @param array  $post_name_labels  Array of labels.
 */
add_filter( 'kapow_core_post_name_labels', function( $post_name_labels ) {
	return $post_name_labels;
}, 1 );

/**
 * Post Description
 *
 * The post description. Default is `Posts`.
 *
 * @param string  $post_name_label  Post Description.
 */
add_filter( 'kapow_core_post_name_description', function( $post_name_description ) {
	return $post_name_description;
}, 1 );

/**
 * POST FORMATS
 */

/**
 * Remove Post Formats
 *
 * If true, post formats will be removed.
 */
add_filter( 'kapow_core_remove_post_formats', '__return_true' );

/**
 * SECURITY
 */

/**
 * Limit Login Attempts
 *
 * If true, login attempts will be limited.
 */
add_filter( 'kapow_core_limit_login_attempts', '__return_true' );

/**
 * Limit Login Instances
 *
 * If true, login instances will be limited.
 */
add_filter( 'kapow_core_limit_login_instances', '__return_true' );

/**
 * Add X Frame Options Header
 *
 * If true, the header will be included.
 */
add_filter( 'kapow_core_x_frame_options_header', '__return_true' );

/**
 * USER
 */

/**
 * Remove Admin Bar
 *
 * If true, the admin bar will be removed for all but admins (by default)
 */
add_filter( 'kapow_core_remove_admin_bar', '__return_false' );

/**
 * Admin Bar Permitted user roles
 *
 * The roles that are allowed to see the admin bar.
 *
 * Example:
 *
 * To add in additonal user roles, just insert them into the array.
 *
 * `$permitted_user_roles[] = 'editor';`
 * `return $permitted_user_roles;`
 *
 * @param array  $permitted_user_roles  Array of permitted user roles.
 */
add_filter( 'kapow_core_admin_bar_permitted_user_roles', function( $permitted_user_roles ) {
	return $permitted_user_roles;
}, 1 );
