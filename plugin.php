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

// Abort if this file is called directly.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// URL based parameters.
$url = ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; // WPCS: input var okay.
$tld = explode( '.', wp_parse_url( $url, PHP_URL_HOST ) );
$tld = end( $tld );

// Constants.
define( 'KAPOW_CORE_ROOT', __FILE__ );
define( 'KAPOW_CORE_NAME', 'Kapow Core' );
define( 'KAPOW_CORE_PREFIX', 'kapow_core' );
define( 'KAPOW_CORE_PERMITTED_USERNAME', 'makedo' );
define( 'KAPOW_CORE_TLD', $tld );
define( 'KAPOW_CORE_MIN_PHP_VERSION', '5.6' );
define( 'KAPOW_CORE_IS_LOCKOUT_GLOBAL', false ); // Should the limit login feature lock by username, or globally?

// Exit and display error if minium version of PHP is not met.
//
// Do this now before we start calling classes and namespaces, as the user may
// be using a version of PHP that does not support those features.
if ( version_compare( phpversion(), KAPOW_CORE_MIN_PHP_VERSION, '<' ) ) {
	$php_version_notice = sprintf( __( 'Your web-server is running an un-supported version of PHP. Please upgrade to version %1$s  or higher to avoid potential issues with %2$s and other Wordpress plugins.', 'kapow-core' ), KAPOW_CORE_MIN_PHP_VERSION, KAPOW_CORE_NAME );
	wp_die( esc_html( $php_version_notice ) );
}

// Configuration.
// TODO

// Security Constants.
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
require_once 'php/comments/comments.php';
require_once 'php/dashboard/dashboard-widgets.php';

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

/**
 * Instances
 */
$comments                 = new Comments();
$dashboard_widgets        = new Dashboard_Widgets();
$controller_admin         = new Controller_Admin(
	$comments,
	$dashboard_widgets
);

// The main plugin.
$settings                 = new Settings();
$controller_assets  	  = new Controller_Assets();
$notices_admin  	      = new Notices_Admin();
$controller_main          = new Controller_Main(
	$settings,
	$controller_assets,
	$notices_admin,
	$controller_admin
);

// Go.
$controller_main->run();

// TODO:
// Make all the below class based. However we don't want the controller being
// overloaded, so suggest we break it up into other controllers, such as
// `$controller_security->run()` etc...
require_once 'php/content/post-content-clean.php';

require_once 'php/editor/show-editor-on-posts-page.php';
require_once 'php/editor/tinymce.php';
require_once 'php/emoji/emoji.php';
require_once 'php/formatting/body-classes.php';
require_once 'php/formatting/iframe.php';
require_once 'php/formatting/responsive-embeds.php';
require_once 'php/hosting/hosting-wp-engine.php';
require_once 'php/post/add-blog-to-post-slug.php';
require_once 'php/post-formats/post-formats.php';
require_once 'php/security/limit-login-attempts.php';
require_once 'php/security/login-one-user-instance.php';
require_once 'php/seo/wpml-bing-compatible-header.php';
require_once 'php/seo/wpml-set-content-language.php';
require_once 'php/seo/yoast-wpml-alternate-links-to-site-map.php';
require_once 'php/seo/yoast-wpml-sitemap-per-translation.php';
require_once 'php/user/disable-admin-bar.php';
