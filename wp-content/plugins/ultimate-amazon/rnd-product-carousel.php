<?php 
/*
Plugin Name: Ultimate Amazon for WordPress
Author: Tacitus Tech
Author URI: http://rndexperts.com/
Plugin URI: http://rndexperts.com/
Description: Ultimate Amazon turns your written work into a beautifully rendered Amazon shop. We'll fetch the properly formed ASIN URL from each newly created post. We'll also fetch the main product image for you and insert that into WordPress's Media database. Then we'll create an XML file and will save it into the database so that you can reference all of the Amazon products your writers are writing about. The products can then be displayed using the included carousel, which is a beautifully functional HTML5, touch-compatible, Retina-capable way of building your authors' recommended items into your WordPress site in any location you choose. This truly is the Ultimate Amazon for WordPress.
Version: 1.0
*/

require_once(ABSPATH . 'wp-admin/includes/image.php');
include "library/amazon_api_class.php";
class RND_Product_Caousel extends AmazonProductAPI {
	
	var $plugin_name;
	public function RND_Product_Caousel() {
		register_activation_hook( __FILE__ , array( $this, 'sis_carousel_check_WP_ver') );
		
		/*Variables*/
		$this->plugin_name = 'carousel-slider';
		$this->public_key = get_option('asinp_aws_public_key');
		$this->private_key = get_option('asinp_aws_private_key');
		// $this->associate_tag = get_option('asinp_aws_associate_tag');
		$this->associate_tag = 'amazon0156-20';
		/*Hooks*/
		//register_activation_hook(  __FILE__, array( $this, 'asinp_activation') );
		add_action( 'admin_menu', array( $this , 'asinp_admin_menu' ) );
		add_action('save_post', array( $this, 'asinp_save_post') );
		add_action( 'wp_enqueue_scripts', array( $this, 'asinp_enqueue_script_style' ), 10 );
		add_action( 'admin_enqueue_scripts', array( $this, 'asinp_enqueue_script_style' ), 10 );
		add_shortcode('asinp_display', array($this, 'asinp_display') );
	}
	function sis_carousel_check_WP_ver() {
		$options_array = array(
			// Most important owl features
	      	'max_items' => '5',
	      	'items_desktop' => '4',
	      	'items_desktop_small' => '3',
	      	'items_tablet' => '2',
	      	'items_mobile' => '1',
	      	'items_single' => 'false',
	      	//Basic Speeds
	      	'slide_speed' => '200',
	      	'pagination_speed' => '800',
	      	'rewind_speed' => '1000',
	      	//Autoplay
	      	'autoplay' => 'true',
	      	'stoponhover' => 'true',
	      	//Navigation
	      	'navigation' => 'false',
	      	'navigation_bg_color' => '#869791',
	      	'navigation_arrow_color' => '#ffffff',
	      	'scrollperpage' => 'false',
	      	//Pagination
	      	'pagination' => 'false',
	      	'pagination_bg_color' => '#869791',
	      	'paginationnumbers' => 'false',
	      	'pagination_num_color' => '#ffffff',
	      	//Transitions
	      	'transitionstyle' => 'fade',
	    );
		if ( get_option( 'sis_carousel_settings' ) !== false ) {
			// The option already exists, so we just update it.
	      	update_option( 'sis_carousel_settings', $options_array );
	   } else{
	   		// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
	   		add_option( 'sis_carousel_settings', $options_array );
	   }
	}
	
	public function asinp_enqueue_script_style() {
       //wp_enqueue_script( 'asinp-script-jquery-1-9-1', plugins_url($this->plugin_name).'/js/owl.carousel.js' , array('jquery-core'), '1.9.1', true );
		/*$time = strtotime(date('Y-m-d h:i:s'));
       wp_enqueue_script( 'asinp-script-jquery-1-9-2-'.$time, plugins_url($this->plugin_name).'/js/main-script.js' , array('jquery-core'), '1.9.1', true );
        wp_register_style( 'asinp-style', plugins_url( $this->plugin_name ) . '/css/owl.carousel.css', false, '1.0.0' );
        wp_enqueue_style( 'asinp-style' ); */   
    }
	public function asinp_activation(){
		
		/*delete_option('asinp_rnd_amazon_data');*/
		$amazon_urls = array();

		$args = array(
			'post_type' => 'post',
			'post_status'      => 'publish',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'posts_per_page'   => 100
		);
		
		$posts = get_posts($args);
		
		foreach ($posts as $key => $_p) {
			$return_res = $this->asinp_fetch_amazon_urls($_p->post_content);
			if( !empty($return_res) ) {
				$amazon_urls[] = $return_res;	
			}
			
		}
		
		$args = array(
			'posts_per_page'   => 100,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'post_type'        => 'page',
			'post_status'      => 'publish',
		);
		$pages = get_posts($args);
		foreach ($pages as $key => $_p) {
			$return_res = $this->asinp_fetch_amazon_urls($_p->post_content);
			if( !empty($return_res) ) {
				$amazon_urls[] = $return_res;	
			}
		}
		
		$asin_list = array();
		foreach ($amazon_urls as $key => $asin) {
			if( is_array($asin) ) {
				foreach ($asin as $_key => $_asin) {
					$asin_list[] = $_asin;
				}
			} else {
				$asin_list[] = $asin;
			}
		}
		$product_info = array();
		if( !empty($asin_list) ) {
			foreach( $asin_list as $key => $asin ) {
				$result_return = $this->asinp_fetch_product_info( $asin );
				if( !empty($result_return) ) {
					
					//$product_info[$asin] = $result_return;
					$post_exists = get_page_by_title( $old_data[$asin]['title'], ARRAY_A, 'carousel' );
					if( empty($post_exists) && $old_data[$asin]['title'] != "" ) {

						$post = array(
							'post_content' => $result_return['medium_page_url'] ,
							'post_title' => $result_return['title'],
							'post_type' => 'carousel',
							'post_status' => 'publish'
							);
						$new_post_id = wp_insert_post( $post, $wp_error );
	echo $new_post_id;
						$this->process_image($new_post_id, $result_return['medium_page_url'] );
						update_post_meta($new_post_id, 'amazon_affiliate_url', $result_return['url'] );
					}
				}
			}
		}
		
		/*$amazon_data = maybe_serialize( $product_info );
		
		update_option('asinp_rnd_amazon_data', $product_info );
		echo "Success!";*/
	}
	public function asinp_admin_menu() {
        add_menu_page( 'Amazon', 'Amazon', 'manage_options', 'asinp_amazon' , array( $this, 'asinp_setting_page' ), plugins_url( $this->plugin_name ).'/images/icon16X16.png' );
	}
	public function asinp_display(){
		ob_start();
		include "templates/shortcode.php";
		return ob_get_clean();
	}
	public function asinp_fetch_amazon_urls( $post_content = "" ) {
		
		if( $post_content == "" ) return; 
		$final_asin_array = array();
		$asin_array = array();
		/*Fetch all links from the text*/
		$href_regex = '/https?\:\/\/[^\" ]+/i';
		preg_match_all( $href_regex, $post_content, $matches );
		  
		/*Fetch Amazon ASIN Product link*/
		$asin_reg = '#(?:http://(?:www\.){0,1}amazon\.com(?:/.*){0,1}(?:/dp/|/gp/product/))(.*?)(?:/.*|$)#';
		foreach($matches[0] as $key=>$value){
			preg_match( $asin_reg, $value , $found); 
		    if( !empty($found) )$asin_array[] = $found;
		}
		
		/*Collecting Product ASIN*/
		foreach ($asin_array as $key => $asin) {
			$final_asin_array[] = $asin[1];
		}
		
		/*Return list of ASIN Found in the post content*/
		return $final_asin_array;
	}
	public function asinp_fetch_product_info( $asin = "" ){
		if( $asin == "" ) return; 
		$product_info = array();
		try {
		    $result = $this->getItemByAsin( $asin );
		    
		    $product_info['asin'] = $asin;
		    $info = (array) $result->Items->Item->ItemAttributes->Title;
		    $product_info['title'] =  $info[0];
		    $info = (array) $result->Items->Item->DetailPageURL;
		    $product_info['url'] = $info[0];
		    $info = (array) $result->Items->Item->MediumImage->URL;
			$product_info['medium_page_url'] = @$info[0];
			$info = (array) $result->Items->Item->MediumImage->Height;
			$product_info['image_height'] = @$info[0];
			$info = (array) $result->Items->Item->MediumImage->Width;
			$product_info['image_width'] = @$info[0];
			
			return $product_info;
		} catch(Exception $e) {
            //echo $e->getMessage();
            return;
        }
        sleep(1);
	}
	public function asinp_save_post( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
		
		if ( !current_user_can( 'edit_page', $post_id ) )
		    return;
		
		$post_content = get_post_field( 'post_content' , $post_id );
		$amazon_urls = $this->asinp_fetch_amazon_urls( $post_content );
		
		$asin_list = array();
		if( !empty($amazon_urls) ) {
			foreach ($amazon_urls as $key => $asin) {
				if( is_array($asin) ) {
					foreach ($asin as $_key => $_asin) {
						$asin_list[] = $_asin;
					}
				} else {
					$asin_list[] = $asin;
				}
			}
		}
		$product_info = array();
		$old_data = get_option('asinp_rnd_amazon_data');
		
		if( !empty($asin_list) ) {
			foreach( $asin_list as $key => $asin ) {
				$old_data[$asin] = $this->asinp_fetch_product_info( $asin );
				
				$post_exists = get_page_by_title( $old_data[$asin]['title'], ARRAY_A, 'carousel' ) ;
				//print_r( $post_exists ); die();
				if( empty( $post_exists ) && $old_data[$asin]['title'] != "" ) {
					$post = array(
						'post_content' => $old_data[$asin]['medium_page_url'] ,
						'post_title' => $old_data[$asin]['title'],
						'post_type' => 'carousel',
						'post_status' => 'publish'
						);
					$new_post_id = wp_insert_post( $post, $wp_error );
					$this->process_image($new_post_id, $old_data[$asin]['medium_page_url'] );
					update_post_meta($new_post_id, 'amazon_affiliate_url', $old_data[$asin]['url'] );				
				}

			}
			
		}

		
		//$amazon_data = serialize( $product_info );
		
		/*if( !empty( $old_data ) ) {
			
			//$amazon_data = maybe_serialize( $old_data );
			update_option('asinp_rnd_amazon_data', $old_data );
			
		}*/
		//die();
	}
	public function asinp_setting_page(){
		$data =   maybe_unserialize( get_option('asinp_rnd_amazon_data') );
		if( isset($_POST['aws_settings_save']) ) {
			if( $_POST['aws_public_key'] != "" && $_POST['aws_private_key'] != "" ) {
				update_option( 'asinp_aws_public_key', $_POST['aws_public_key'] );
				update_option( 'asinp_aws_private_key', $_POST['aws_private_key'] );
				//update_option( 'asinp_aws_associate_tag', $_POST['aws_associate_tag'] );
				
			}
		} else if( isset($_POST['aws_first_run']) ) {
			$this->asinp_activation();
		}
		include 'templates/settings.php';
	}
	
	public function process_image( $post_id = "", $image_url = "" ) {
        $upload_dir = wp_upload_dir();
		$image_data = file_get_contents($image_url);
		$filename = basename($image_url);
		if(wp_mkdir_p($upload_dir['path']))
		    $file = $upload_dir['path'] . '/' . $filename;
		else
		    $file = $upload_dir['basedir'] . '/' . $filename;
		file_put_contents($file, $image_data);

		$wp_filetype = wp_check_filetype($filename, null );
		$attachment = array(
		    'post_mime_type' => $wp_filetype['type'],
		    'post_title' => sanitize_file_name($filename),
		    'post_content' => '',
		    'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
		
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		set_post_thumbnail( $post_id, $attach_id );
    }
}
include "carousel.php";
$asin_product = new RND_Product_Caousel();
?>