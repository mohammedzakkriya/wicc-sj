<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Florence IT
 */

get_header(); ?>

	<div class="container">
      <div class="content-holder">      
    		 <section class="site-contentarea <?php if ( !is_active_sidebar( 'sidebar-2' ) ) { ?>sitefull<?php } ?>"> 
                <div class="contentbox">
            		<?php while( have_posts() ) : the_post(); ?>                               
						<?php get_template_part( 'content', 'page' ); ?>
                        <?php
                            //If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || '0' != get_comments_number() )
                                comments_template();
                            ?>                               
                    <?php endwhile; ?>   
                  <div class="clear"></div>          
               </div>
            </section><!-- section-->
   
     <?php get_sidebar();?>      
    <div class="clear"></div>
    </div><!-- .content-holder --> 
 </div><!-- .container --> 
<?php get_footer(); ?>