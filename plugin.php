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
$url = ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$tld = explode( '.', wp_parse_url( $url, PHP_URL_HOST ) );
$tld = end( $tld );

// Constants.
define( 'KAPOW_CORE_ROOT', __FILE__ );
define( 'KAPOW_CORE_NAME', 'Kapow Core' );
define( 'KAPOW_CORE_PREFIX', 'kapow_core' );
define( 'KAPOW_CORE_PERMITTED_USERNAME', 'makedo' );
define( 'KAPOW_CORE_TLD', $tld );

// Should the login lockout droplet lock by username, or globally?
define( 'KAPOW_CORE_IS_LOCKOUT_GLOBAL', false );

// Security Constants.
require_once 'php/security/const-debug.php';              // Enable Debug when on .dev domain only.
require_once 'php/security/const-disallow-file-edit.php'; // Disallow file edit.
require_once 'php/security/const-disallow-file-mods.php'; // Disallow file installs unless on .dev domain.

// Classes.
require_once 'php/class-helper.php';
require_once 'php/class-settings.php';
require_once 'php/class-controller-assets.php';
require_once 'php/class-controller-main.php';
require_once 'php/class-notices-admin.php';

// Namespaces.
use kapow\kapow_core\Helper;
use kapow\kapow_core\Settings;
use kapow\kapow_core\Controller_Assets;
use kapow\kapow_core\Controller_Main;
use kapow\kapow_core\Notices_Admin;

// Instances.
$settings                 = new Settings();
$controller_assets  	  = new Controller_Assets();
$notices_admin  	      = new Notices_Admin();
$controller_main          = new Controller_Main(
	$settings,
	$controller_assets,
	$notices_admin
);

// Go.
$controller_main->run();

// TODO:
// Make all the below class based. However we don't want the controller being
// overloaded, so suggest we break it up into other controllers, such as
// `$controller_security->run()` etc...
require_once 'php/comments/comments.php';
require_once 'php/content/post-content-clean.php';
require_once 'php/dashboard/dashboard-widgets.php';
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
