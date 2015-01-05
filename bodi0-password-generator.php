<?php
defined( 'ABSPATH' ) or exit();
/*
Plugin Name: bodi0`s Password generator
Plugin URI: http://
Description: Generating and using random sequence of numbers and/or text or special characters in password fields while creating or editiing users, brain-free.
Version: 0.2
Text Domain: bodi0-password-generator
Domain Path: /languages
Author: Budiony Damyanov
Author URI: mailto:budiony@gmail.com
Email: budiony@gmail.com
License: GPL2

		Copyright 2014  bodi0  (email : budiony@gmail.com)
		
		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.
		
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.
		
		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $wpdb;
/*Plugin file name*/
$plugin = plugin_basename( __FILE__ );

/*Actions*/
add_action('init', 'bodi0_password_generator_plugin_internationalization');
/*Admin menu page*/
add_action('admin_menu', 'bodi0_password_generator_plugin_admin_actions');




/*Settings link*/
add_filter('plugin_action_links_'.$plugin, 'bodi0_password_generator_plugin_add_settings_link');

/*Action executed when plugin is uninstalled*/
register_uninstall_hook(__FILE__, 'bodi0_password_generator_plugin_uninstall' );
/*Action executed when plugin is deactivated*/
register_deactivation_hook(__FILE__, 'bodi0_password_generator_plugin_deactivate');
/*Action executed when plugin is activated*/
register_activation_hook(__FILE__, 'bodi0_password_generator_plugin_install');


/*Hooks*/
/*Add a password generator form on user creation, user profile update*/
add_action('user_new_form', 'bodi0_password_generator_ajax_form');
add_action('show_user_profile', 'bodi0_password_generator_ajax_form');
add_action('edit_user_profile', 'bodi0_password_generator_ajax_form');

// Install plugin
if (!function_exists('bodi0_password_generator_plugin_install')) {
	function bodi0_password_generator_plugin_install() {
		
		global $wpdb;
		if (version_compare(PHP_VERSION, '5.2.4', '<'))	{
			bodi0_password_generator_plugin_trigger_error('PHP version below 5.2.4 is not supported. Even though version PHP 5.2.4 was released in August 2007 ('.(date('Y') - 2007).' years ago), it appears, that there are still lazy and careless hosting service providers. Please yell to those "system administrators" and upgrade to PHP 5.2.4 or newer.', E_USER_ERROR);
			die();
		}
		// Important: Check if current user can install plugins
		if ( !current_user_can( 'activate_plugins' ) )  return;
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "activate-plugin_{$plugin}" );
		//Setup plugin options
		foreach ($plugin_options as $key=>$value) {
			add_option( $key, $value ); 
		}
		if(!empty($wpdb->last_error)) wp_die($wpdb->print_error());

	}
}

//Deactivate plugin
if (!function_exists('bodi0_password_generator_plugin_deactivate')) {
	function bodi0_password_generator_plugin_deactivate() {
		global $wpdb;

		// Important: Check if current user can deactivate plugins
		if ( !current_user_can( 'activate_plugins' ) )  return;
		$plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
		check_admin_referer( "deactivate-plugin_{$plugin}" );	
		if(!empty($wpdb->last_error)) wp_die($wpdb->print_error());
	} 
}

//Uninstall plugin
if (!function_exists('bodi0_password_generator_plugin_uninstall')) {
	function bodi0_password_generator_plugin_uninstall() {
		global $wpdb;
		// Important: Check if current user can uninstall plugins
		if ( !current_user_can( 'delete_plugins' ) ) return;
		check_admin_referer( 'bulk-plugins' );
		if(!empty($wpdb->last_error)) wp_die($wpdb->print_error());
	}
}


//Admin panel functions
if (!function_exists('bodi0_password_generator_plugin_menu')) {
	function bodi0_password_generator_plugin_menu() {
		//Important: Check if current user is logged
		if ( !is_user_logged_in() ) die();
		include_once ("bodi0-password-generator-admin.php");
	}
}

//Register admin menu
if (!function_exists('bodi0_password_generator_plugin_admin_actions')) {
	function bodi0_password_generator_plugin_admin_actions() {
		add_options_page(__("User password generator","bodi0-password-generator"), __("User password generator","bodi0-password-generator"), 'manage_options', 'bodi0-password-generator', 'bodi0_password_generator_plugin_menu');
	}
}
//Translations
if (!function_exists('bodi0_password_generator_plugin_internationalization')) {
	function bodi0_password_generator_plugin_internationalization() {
	  load_plugin_textdomain( 'bodi0-password-generator', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}
//Settings link
if (!function_exists('bodi0_password_generator_plugin_add_settings_link')) {
	function bodi0_password_generator_plugin_add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page='.basename( __FILE__ ).'">'.__("Administration","bodi0-password-generator").'</a>';
		array_push( $links, $settings_link );
		return $links;
	}
}

//Custom password generation form
if(!function_exists('bodi0_password_generator_ajax_form')) {
	function bodi0_password_generator_ajax_form () {
		include('bodi0-password-generator-form.php');
		}
	}


//Custom error handling
if (!function_exists('bodi0_password_generator_plugin_trigger_error')) {
	function bodi0_password_generator_plugin_trigger_error($message, $errno) {
		if(isset($_GET['action']) && $_GET['action'] == 'error_scrape') {
			echo '<strong style="font-family:\'Open Sans\', Arial, Helvetica, sans-serif">' . $message . '</strong>';
			exit;
		} else {
			trigger_error($message, $errno);
		}
	}

}

?>