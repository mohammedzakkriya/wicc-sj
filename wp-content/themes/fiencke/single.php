<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Florence IT
 */

get_header(); ?>

<div class="container">
     <div class="content-holder">    
        <section class="site-contentarea <?php if ( !is_active_sidebar( 'sidebar-2' ) ) { ?>sitefull<?php } ?>">
           <div class="contentbox">            
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', 'single' ); ?>
                    <?php the_post_navigation(); ?>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
                    ?>
                <?php endwhile; // end of the loop. ?>
                <div class="clear"></div>
            </div>          
         </section>       
        <?php get_sidebar();?>
        <div class="clear"></div>
    </div><!-- content-holder -->
</div><!-- container -->	
<?php get_footer(); ?>