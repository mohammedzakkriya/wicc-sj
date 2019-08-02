<?php
/**
* Plugin Main Class
*/
class Image_Hover_Gallery
{
    
    function __construct(){
        add_action( 'admin_enqueue_scripts', array($this, 'loading_scripts_admin'));
        add_shortcode( 'ih-gallery', array($this, 'render_gallery_shortcode') );
        add_shortcode( 'ih-category', array($this, 'render_category_shortcode') );
        add_action( 'init', array($this, 'wcp_register_hover_gallery') );
        add_action( 'add_meta_boxes', array($this, 'image_hover_data_box') );
        add_action( 'wp_enqueue_scripts', array($this, 'loading_front_scripts') );
        add_action( 'save_post', array($this, 'saving_image_hover_gallery') );

        add_filter('manage_ih_gallery_posts_columns', array($this, 'ih_gallery_column_head'));
        add_action('manage_ih_gallery_posts_custom_column', array($this, 'ih_gallery_column_content'), 10, 2);

        add_filter('manage_edit-ih_gallery_cat_columns', array($this, 'ih_gallery_cat_column_head'));
        add_action('manage_ih_gallery_cat_custom_column', array($this, 'ih_gallery_cat_column_content'), 10, 3);

        add_action( 'admin_menu', array( $this, 'ih_gallery_admin_menu' ) );
        add_action( 'plugins_loaded', array($this, 'wcp_load_plugin_textdomain' ) );
    }

    function wcp_load_plugin_textdomain(){
        load_plugin_textdomain( 'ich-effects', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
    }    

    /**
    * Registers a new post type
    * @uses $wp_post_types Inserts new post type object into the list
    *
    * @param string  Post type key, must not exceed 20 characters
    * @param array|string  See optional args description above.
    * @return object|WP_Error the registered post type object, or an error object
    */
    function wcp_register_hover_gallery() {
    
        $custom_labels = array(
            'name'                => __( 'Image Caption Hover Effects', 'ich-effects' ),
            'singular_name'       => __( 'ICH Effect', 'ich-effects' ),
            'add_new'             => _x( 'Add New Effect', 'ich-effects', 'ich-effects' ),
            'add_new_item'        => __( 'Add New Effect', 'ich-effects' ),
            'edit_item'           => __( 'Edit Effect', 'ich-effects' ),
            'new_item'            => __( 'New Effect', 'ich-effects' ),
            'view_item'           => __( 'View ICH Effect', 'ich-effects' ),
            'search_items'        => __( 'Search ICH Effects', 'ich-effects' ),
            'not_found'           => __( 'No Image Caption Hover Effects found', 'ich-effects' ),
            'not_found_in_trash'  => __( 'No Image Caption Hover Effects found in Trash', 'ich-effects' ),
            'parent_item_colon'   => __( 'Parent ICH Effect:', 'ich-effects' ),
            'menu_name'           => __( 'ICH Effects', 'ich-effects' ),
        );
    
        $anim_args = array(
            'labels'              => $custom_labels,
            'hierarchical'        => false,
            'description'         => 'Image Caption Hover Effects',
            'taxonomies'          => array('ih_gallery_cat'),
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => null,
            'menu_icon'           => null,
            'show_in_nav_menus'   => false,
            'publicly_queryable'  => true,
            'exclude_from_search' => true,
            'has_archive'         => false,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite'             => true,
            'capability_type'     => 'post',
            'supports'            => array(
                'title'
                )
        );
    
        register_post_type( 'ih_gallery', $anim_args );
        /**
         * Create a taxonomy
         *
         * @uses  Inserts new taxonomy object into the list
         * @uses  Adds query vars
         *
         * @param string  Name of taxonomy object
         * @param array|string  Name of the object type for the taxonomy object.
         * @param array|string  Taxonomy arguments
         * @return null|WP_Error WP_Error if errors, otherwise null.
         */
        
        $tax_labels = array(
            'name'                    => _x( 'Image Caption Hover Categories', 'ICH Categories', 'ich-effects' ),
            'singular_name'            => _x( 'ICH Category', 'ICH Category', 'ich-effects' ),
            'search_items'            => __( 'Search ICH Categories', 'ich-effects' ),
            'popular_items'            => __( 'Popular ICH Categories', 'ich-effects' ),
            'all_items'                => __( 'All ICH Categories', 'ich-effects' ),
            'parent_item'            => __( 'Parent ICH Category', 'ich-effects' ),
            'parent_item_colon'        => __( 'Parent ICH Category', 'ich-effects' ),
            'edit_item'                => __( 'Edit ICH Category', 'ich-effects' ),
            'update_item'            => __( 'Update ICH Category', 'ich-effects' ),
            'add_new_item'            => __( 'Add New ICH Category', 'ich-effects' ),
            'new_item_name'            => __( 'New ICH Category Name', 'ich-effects' ),
            'add_or_remove_items'    => __( 'Add or remove ICH Categories', 'ich-effects' ),
            'choose_from_most_used'    => __( 'Choose from most used ich-effects', 'ich-effects' ),
            'menu_name'                => __( 'ICH Categories', 'ich-effects' ),
        );
    
        $tax_args = array(
            'labels'            => $tax_labels,
            'public'            => false,
            'show_in_nav_menus' => true,
            'show_admin_column' => false,
            'hierarchical'      => true,
            'show_tagcloud'     => true,
            'show_ui'           => true,
            'query_var'         => true,
            'rewrite'           => true,
            'query_var'         => true,
        );
    
        register_taxonomy( 'ih_gallery_cat', array( 'ih_gallery' ), $tax_args );
    }
    

    function loading_scripts_admin($check){
        global $post;
        if ( $check == 'post-new.php' || $check == 'post.php' || 'edit.php') {
            if (isset($post->post_type) && 'ih_gallery' === $post->post_type) {
                wp_enqueue_style( 'wp-color-picker' );
                wp_enqueue_media();
                wp_enqueue_script( 'ih-gallery-admin', plugin_dir_url( __FILE__ ). '/js/admin.js', array('jquery', 'wp-color-picker', 'jquery-ui-sortable', 'jquery-ui-accordion'));
                wp_enqueue_style( 'jquery-ui-theme', plugin_dir_url( __FILE__ ). '/css/jquery-ui.theme.min.css');
            }
        }
    }

    function loading_front_scripts(){

    }

    function render_gallery_shortcode($atts){

        wp_enqueue_style( 'simple-grid', plugin_dir_url( __FILE__ ). 'css/simplegrid.css');
        wp_enqueue_style( 'ih-gallery-css', plugin_dir_url( __FILE__ ). 'css/ih-gallery.css');
        wp_enqueue_script( 'ih-gallery-script', plugin_dir_url( __FILE__ ). 'js/script.js', array('jquery'));
        
        ob_start();
            include 'temp/render_shortcode.php';
        return ob_get_clean();

    }

    function render_category_shortcode($atts){

        wp_enqueue_style( 'simple-grid', plugin_dir_url( __FILE__ ). 'css/simplegrid.css');
        wp_enqueue_style( 'ih-gallery-css', plugin_dir_url( __FILE__ ). 'css/ih-gallery.css');
        wp_enqueue_style( 'prettyphoto-css', plugin_dir_url( __FILE__ ). 'css/prettyPhoto.css');
        wp_enqueue_script( 'jquery-prettyphoto', plugin_dir_url( __FILE__ ). 'js/jquery.prettyPhoto.js', array('jquery'));
        wp_enqueue_script( 'ih-gallery-script', plugin_dir_url( __FILE__ ). 'js/script.js', array('jquery'));

        $render_cat_args = array(
            'post_type' => 'ih_gallery',
            'tax_query' => array(
                array(
                    'taxonomy' => 'ih_gallery_cat',
                    'field'    => 'term_id',
                    'terms'    => array($atts['id']),
                ),
            ),
        );
        $ih_query = new WP_Query( $render_cat_args );
        ob_start(); 

        // The Loop
        if ( $ih_query->have_posts() ) {
            while ( $ih_query->have_posts() ) {
                $ih_query->the_post();
                $ih_gallery_id = get_the_id();
                include 'temp/render_shortcode_category.php';
            }
        } else {
            echo 'Please attach ICH Galleries to this Category.';
        }
        /* Restore original Post Data */
        wp_reset_postdata();

        return ob_get_clean();
    }

    function image_hover_data_box() {
        add_meta_box( 'wcp_gallery_options', 'Settings', array($this, 'ih_metabox_contents'), 'ih_gallery');
        add_meta_box( 'wcp_gallery_shortcode', 'Shortcode', array($this, 'ih_metabox_shortcode_display'), 'ih_gallery', 'side');
        add_meta_box( 'wcp_gallery_colorpicker', 'Color Picker', array($this, 'ih_metabox_colorpicker_display'), 'ih_gallery', 'side');
    }

    function ih_metabox_shortcode_display(){
        global $post;
        if (isset($post->ID)) {
            echo '<p style="text-align:center;">[ih-gallery id="'.$post->ID.'"]</p>';
            echo '<br>';
            echo '<a style="width: 100%; text-align:center;" class="button button-primary button-hero" href="http://codecanyon.net/item/image-caption-hover-effects/13851806?ref=Rameez_Iqbal">';
            echo __( 'Unlock Pro Features', 'ich-effects' );
            echo '</a>';
        } else {
            echo 'Please Save settings to see shortcode';
        }
    }

    function ih_metabox_colorpicker_display(){
        echo '<input type="text" class="colorpicker">';
    }

    /* Prints the box content */
    function ih_metabox_contents() {
        // Use nonce for verification
        wp_nonce_field( plugin_basename( __FILE__ ), 'wcp_gallery_nonce' );
        include 'render_box_contents.php';
    }

    function saving_image_hover_gallery( $post_id ) {
        // verify if this is an auto save routine. 
        // If it is our form has not been submitted, so we dont want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
            return;

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( !isset( $_POST['wcp_gallery_nonce'] ) )
            return;

        if ( !wp_verify_nonce( $_POST['wcp_gallery_nonce'], plugin_basename( __FILE__ ) ) )
            return;

        // OK, we're authenticated: we need to find and save the data

        $wcp_settings = $_POST['wcpop'];

        update_post_meta($post_id,'wcpop',$wcp_settings);
    }

    function ih_gallery_column_head($defaults){
        $defaults['ih_gallery_col'] = 'Shortcode';
        return $defaults;       
    }

    function ih_gallery_cat_column_head($defaults){
        $defaults['ih_gallery_cat_col'] = 'Shortcode';
        return $defaults;
    }

    function ih_gallery_column_content($column_name, $gallery_id){
        if ($column_name == 'ih_gallery_col') {
            echo '[ih-gallery id="'.$gallery_id.'"]';
        }
    }

    function ih_gallery_cat_column_content($no, $column_name, $gallery_id){
        if ($column_name == 'ih_gallery_cat_col') {
            echo '[ih-category id="'.$gallery_id.'"]';
        }
    }


    function ih_gallery_admin_menu(){
        add_submenu_page( 'edit.php?post_type=ih_gallery', 'Documentation', 'Documentation', 'manage_options', 'ih_gallery_docs', array($this, 'rander_doc_page') );
    }
    function rander_doc_page(){
        include 'temp/doc_page.php';
    }
}
?>