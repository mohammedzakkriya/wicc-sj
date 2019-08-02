<?php
/**
Plugin Name: Mix Master
Plugin URI: https://wordpress.techgasp.com/mix-master/
Version: 5.0.15
Author: TechGasp
Author URI: https://wordpress.techgasp.com
Text Domain: mix-master
Description: Mix Master is the wordpress plugin that you need to display mixcloud real-time streaming services.
License: GPL2 or later
*/
/*  Copyright 2013 TechGasp  (email : info@techgasp.com)
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
if(!class_exists('mix_master')) :
///////DEFINE///////
define( 'MIX_MASTER_VERSION', '5.0.15' );
define( 'MIX_MASTER_NAME', 'Mix Master' );

class mix_master{
public static function content_with_quote($content){
$quote = '<p>' . get_option('tsm_quote') . '</p>';
	return $content . $quote;
}
//SETTINGS LINK IN PLUGIN MANAGER
public static function mix_master_links( $links, $file ) {
if ( $file == plugin_basename( dirname(__FILE__).'/mix-master.php' ) ) {
		if( is_network_admin() ){
		$techgasp_plugin_url = network_admin_url( 'admin.php?page=mix-master' );
		}
		else {
		$techgasp_plugin_url = admin_url( 'admin.php?page=mix-master' );
		}
	$links[] = '<a href="' . $techgasp_plugin_url . '">'.__( 'Settings' ).'</a>';
	}
	return $links;
}

//END CLASS
}
add_filter('the_content', array('mix_master', 'content_with_quote'));
add_filter( 'plugin_action_links', array('mix_master', 'mix_master_links'), 10, 2 );
endif;

// HOOK ADMIN
require_once( dirname( __FILE__ ) . '/includes/mix-master-admin.php');
// HOOK ADMIN ADDONS
require_once( dirname( __FILE__ ) . '/includes/mix-master-admin-addons.php');
// HOOK WIDGET BASIC
require_once( dirname( __FILE__ ) . '/includes/mix-master-widget-basic.php');
