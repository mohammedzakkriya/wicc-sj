<?php
/**
 * Plugin Name: Image Caption Hover Effects
 * Plugin URI: http://webcodingplace.com/wordpress-pro-plugins/image-caption-hover-effects-pro-wordpress-plugin/
 * Description: Create attractive and amazing hover effects for captions of images with CSS3 based animations.
 * Version: 3.0
 * Author: Rameez
 * Author URI: http://webcodingplace.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ich-effects
 */

/*

  Copyright (C) 2015  Rameez  rameez.iqbal@live.com

*/
require_once('plugin.class.php');

if( class_exists('Image_Hover_Gallery')){
	
	$just_initialize = new Image_Hover_Gallery;
}

?>