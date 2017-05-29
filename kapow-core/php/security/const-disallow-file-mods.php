<?php
/**
 * File Install
 *
 * We would like all of the plugins to be managed within the repo, also we shouldn't
 * really be putting plugins direclty on the live site without testing them.
 *
 * @since	0.1.0
 *
 * @package kapow\kapow_core
 */

// Disable Plugin and Theme Update and Installation
//
// Unless our domain ends in .dev (development environment).
if ( 'dev' !== KAPOW_CORE_TLD && ! defined( 'DISALLOW_FILE_MODS' ) ) {
	define( 'DISALLOW_FILE_MODS', true );
}
