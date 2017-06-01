<?php
/**
 * Kapow Core
 *
 * @link              https://github.com/mkdo/kapow-core
 * @package           kapow\kapow-core
 *
 * Plugin Name:       Kapow Core
 * Plugin URI:        https://github.com/mkdo/kapow-core
 * Description:       A brief description of the plugin.
 * Version:           0.1.0
 * Author:            Make Do <hello@makedo.net>
 * Author URI:        https://makedo.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kapow-core
 * Domain Path:       /languages
 */

/**
 * Configuration
 *
 * At the root of this project, there is a file called
 * `kapow-core-config-template.php`. All config is done via filters (with
 * default settings), this file lists all the hooks and filters, and has
 * snippets that can be pasted into your project to override them.
 *
 * This file is not loaded by this plugin, it should be copied and referenced
 * in your project.
 */

/**
 * Abort on Direct Call
 *
 * Abort if this file is called directly.
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Constants
 *
 * Sets the Top Level Domain (TLD) for use within constant. Then sets the
 * constants.
 */

// @codingStandardsIgnoreStart
if ( ! empty( $_SERVER['HTTP_HOST'] ) && $_SERVER['REQUEST_URI'] ) {
	$url = ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	$tld = explode( '.', wp_parse_url( $url, PHP_URL_HOST ) );
	$tld = end( $tld );
} else {
	$tld = 'dev';
}
// @codingStandardsIgnoreEnd

define( 'KAPOW_CORE_ROOT', __FILE__ );
define( 'KAPOW_CORE_NAME', 'Kapow Core' );
define( 'KAPOW_CORE_PREFIX', 'kapow_core' );
define( 'KAPOW_CORE_TLD', $tld );
define( 'KAPOW_CORE_IS_LOCKOUT_GLOBAL', false ); // Should the limit login feature lock by username, or globally?
define( 'KAPOW_CORE_MIN_PHP_VERSION', '5.6' );

/**
 * PHP Version Check
 *
 * Exit and display error if minium version of PHP is not met.
 *
 * Do this now before we start calling classes and namespaces, as the user may
 * be using a version of PHP that does not support those features.
 */
if ( version_compare( phpversion(), KAPOW_CORE_MIN_PHP_VERSION, '<' ) ) {
	$php_version_notice = sprintf(
		/* translators: 1: PHP version 2: plugin name */
	__( 'Your web-server is running an un-supported version of PHP. Please upgrade to version %1$s  or higher to avoid potential issues with %2$s and other Wordpress plugins.', 'kapow-core' ), KAPOW_CORE_MIN_PHP_VERSION, KAPOW_CORE_NAME );
	wp_die( esc_html( $php_version_notice ) );
}

/**
 * Security Constants
 *
 * WordPress lets people do things that they should never do in a controlled
 * environment. Lets fix that.
 */
require_once 'php/security/const-debug.php';              // Enable Debug when on .dev domain only.
require_once 'php/security/const-disallow-file-edit.php'; // Disallow file edit.
require_once 'php/security/const-disallow-file-mods.php'; // Disallow file installs unless on .dev domain.

/**
 * Classes
 */

// Main.
require_once 'php/class-controller-main.php';
require_once 'php/class-helper.php';
require_once 'php/class-settings.php';
require_once 'php/class-controller-assets.php';
require_once 'php/class-notices-admin.php';

// WP Admin.
require_once 'php/class-controller-admin.php';
require_once 'php/comments/class-comments.php';
require_once 'php/dashboard/class-dashboard-widgets.php';
require_once 'php/hosting/class-hosting.php';

// Content.
require_once 'php/class-controller-content.php';
require_once 'php/content/class-post-content-clean.php';
require_once 'php/editor/class-show-editor-on-posts-page.php';
require_once 'php/editor/class-tinymce.php';
require_once 'php/emoji/class-emoji.php';
require_once 'php/post-formats/class-post-formats.php';

// Formatting.
require_once 'php/class-controller-formatting.php';
require_once 'php/formatting/class-body-classes.php';
require_once 'php/formatting/class-iframes.php';
require_once 'php/formatting/class-responsive-embeds.php';

// Permalinks.
require_once 'php/class-controller-permalinks.php';
require_once 'php/post/class-post-slug.php';

// Security.
require_once 'php/class-controller-security.php';
require_once 'php/security/class-limit-login-attempts.php';
require_once 'php/security/class-login-one-user-instance.php';

// SEO.
require_once 'php/class-controller-seo.php';
require_once 'php/seo/class-bing-header.php';
require_once 'php/seo/class-content-language.php';
require_once 'php/seo/class-site-map-links.php';
require_once 'php/seo/class-site-map-per-language.php';

// Users.
require_once 'php/class-controller-users.php';
require_once 'php/user/class-admin-bar.php';


/**
 * Namespaces
 */

// Main.
use kapow\kapow_core\Controller_Main;
use kapow\kapow_core\Helper;
use kapow\kapow_core\Settings;
use kapow\kapow_core\Controller_Assets;
use kapow\kapow_core\Notices_Admin;

// WP Admin.
use kapow\kapow_core\Controller_Admin;
use kapow\kapow_core\Comments;
use kapow\kapow_core\Dashboard_Widgets;
use kapow\kapow_core\Hosting;

// Content.
use kapow\kapow_core\Controller_Content;
use kapow\kapow_core\Post_Content_Clean;
use kapow\kapow_core\Show_Editor_On_Posts_Page;
use kapow\kapow_core\TinyMCE;
use kapow\kapow_core\Emoji;
use kapow\kapow_core\Post_Formats;

// Formatting.
use kapow\kapow_core\Controller_Formatting;
use kapow\kapow_core\Body_Classes;
use kapow\kapow_core\IFrames;
use kapow\kapow_core\Responsive_Embeds;

// Permalinks.
use kapow\kapow_core\Controller_Permalinks;
use kapow\kapow_core\Post_Slug;

// Security.
use kapow\kapow_core\Controller_Security;
use kapow\kapow_core\Limit_Login_Attempts;
use kapow\kapow_core\Login_One_User_Instance;

// SEO.
use kapow\kapow_core\Controller_SEO;
use kapow\kapow_core\Bing_Header;
use kapow\kapow_core\Content_Language;
use kapow\kapow_core\Site_Map_Links;
use kapow\kapow_core\Site_Map_Per_Language;

// Users.
use kapow\kapow_core\Controller_Users;
use kapow\kapow_core\Admin_Bar;

/**
 * Instances
 */

// WP Admin.
$comments           = new Comments();
$dashboard_widgets  = new Dashboard_Widgets();
$hosting            = new Hosting();
$controller_admin   = new Controller_Admin(
	$comments,
	$dashboard_widgets,
	$hosting
);

// Content.
$post_content_clean        = new Post_Content_Clean();
$show_editor_on_posts_page = new Show_Editor_On_Posts_Page();
$tinymce                   = new TinyMCE();
$emoji                     = new Emoji();
$post_formats              = new Post_Formats();
$controller_content        = new Controller_Content(
	$post_content_clean,
	$show_editor_on_posts_page,
	$tinymce,
	$emoji,
	$post_formats
);

// Formatting.
$body_classes          = new Body_Classes();
$iframes               = new IFrames();
$responsive_embeds     = new Responsive_Embeds();
$controller_formatting = new Controller_Formatting(
	$body_classes,
	$iframes,
	$responsive_embeds
);

// Permalinks.
$post_slug             = new Post_Slug();
$controller_permalinks = new Controller_Permalinks(
	$post_slug
);

// Security.
$limit_login_attempts    = new Limit_Login_Attempts();
$login_one_user_instance = new Login_One_User_Instance();
$controller_security     = new Controller_Security(
	$limit_login_attempts,
	$login_one_user_instance
);

// SEO.
$bing_header           = new Bing_Header();
$content_language      = new Content_Language();
$site_map_links        = new Site_Map_Links();
$site_map_per_language = new Site_Map_Per_Language();
$controller_seo        = new Controller_SEO(
	$bing_header,
	$content_language,
	$site_map_links,
	$site_map_per_language
);

// Users.
$admin_bar         = new Admin_Bar();
$controller_users  = new Controller_Users(
	$admin_bar
);

// The main plugin.
$settings                 = new Settings();
$controller_assets  	  = new Controller_Assets();
$notices_admin  	      = new Notices_Admin();
$controller_main          = new Controller_Main(
	$settings,
	$controller_assets,
	$notices_admin,
	$controller_admin,
	$controller_content,
	$controller_formatting,
	$controller_permalinks,
	$controller_security,
	$controller_seo,
	$controller_users
);

/**
 * Run main instance
 */
$controller_main->run();
