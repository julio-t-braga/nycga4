<?php
/**
 * Additional, helpful admin menu additions in Multisite context.
 *
 * @package    Multisite Toolbar Additions
 * @subpackage Network Items
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013-2014, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/multisite-toolbar-additions/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.5.0
 */

/**
 * Prevent direct access to this file.
 *
 * @since 1.5.0
 */
if ( ! defined( 'WPINC' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'admin_menu', 'mstba_site_submenu_install_plugins' );
/**
 * For Super Admins: Add a very handy "Add New" submenu for sub site admin
 *    "Plugins" menu.
 *
 * @since 1.5.0
 */
function mstba_site_submenu_install_plugins() {
	
	/** Bail early, if not in a subsite admin */
	if ( /*! is_multisite() ||*/ is_network_admin() || class_exists( 'Multisite_Add_New_Plugin' ) ) {

		return NULL;

	}  // end if

	/** Add "Plugins" submenu "Add New" */
	add_plugins_page(
		__( 'Add New', 'multisite-toolbar-additions' ),
		__( 'Add New', 'multisite-toolbar-additions' ),
		'manage_network',
		'plugin-install.php'
	);

}  // end of function mstba_site_submenu_install_plugins


add_action( 'admin_menu', 'mstba_site_submenu_additions', 20 );
/**
 * For Super Admins: Add a very handy "Add New" submenu for sub site admin
 *    "Plugins" menu.
 *
 * @since 1.7.0
 */
function mstba_site_submenu_additions() {
	
	/** Bail early, if not in a subsite admin */
	if ( /*! is_multisite() ||*/ is_network_admin() ) {

		return NULL;

	}  // end if

	/** Add "Plugins" submenu "Network Plugins" */
	add_plugins_page(
		__( 'Network Plugins', 'multisite-toolbar-additions' ),
		__( 'Network Plugins', 'multisite-toolbar-additions' ),
		'manage_network',
		'network/plugins.php'
	);

	/** Add "Themes" submenu "Network Theme Editor" */
	if ( !( defined( 'DISALLOW_FILE_EDIT' ) && DISALLOW_FILE_EDIT )
		&& current_user_can( 'edit_themes' )
	) {

		add_theme_page(
			__( 'Network Theme Editor', 'multisite-toolbar-additions' ),
			__( 'Network Theme Editor', 'multisite-toolbar-additions' ),
			'manage_network',
			'network/theme-editor.php'
		);

	}  // end if

}  // end of function mstba_site_submenu_additions