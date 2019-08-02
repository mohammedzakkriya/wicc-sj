<?php
global $wpdb, $blog_id;
////////////////////////////////////
//AMP CHECK FUNCTION FOR RECAPTCHA//
////////////////////////////////////
if( is_multisite() ){
	$spam_master_amp_check_fun = get_blog_option($blog_id, 'spam_master_amp_check_fun');
}
else {
	$spam_master_amp_check_fun = get_option('spam_master_amp_check_fun');
}
if ($spam_master_amp_check_fun == 'true'){
	function spam_master_amp_check() {
		if (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint () ) {
			return 'true';
		}
		else{
			return 'false';
		}
	}
}
else {
	function spam_master_amp_check() {
		return 'false';
	}
}
?>
