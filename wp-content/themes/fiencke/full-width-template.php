<?php
/**
 * The Template Name: Full Width
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
    		 <section class="site-contentarea sitefull">                
           <?php if( have_posts() ) :
            while( have_posts() ) : the_post(); ?>
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
            <div class="entry-content">
                <?php the_content(); ?>
                <?php
					wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'florence-it' ),
					'after'  => '</div>',
					) );
				?>
                <?php
                    //If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                    ?>
            </div><!-- entry-content -->
            <?php endwhile; else : endif; ?>
            </section><!-- section-->   
    </div><!-- .pagewraps --> 
 </div><!-- .container --> 
<?php get_footer(); ?>