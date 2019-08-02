<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Florence IT
 */
?>
<div id="footer-wrapper">
    	<div class="container">
            <p><?php bloginfo('name'); ?>. <?php _e('All Rights Reserved', 'florence-it');?></p>           
            <p><a href="<?php echo esc_url( __( 'http://zylothemes.com/', 'florence-it' ) ); ?>"><?php printf( __( 'Theme by %s', 'florence-it' ), 'Zylo Themes' ); ?></a></p>
          
        </div><!--end .container-->
    </div>
<?php wp_footer(); ?>
</body>
</html>