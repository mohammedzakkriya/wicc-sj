<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Florence IT
 */

get_header(); ?>

<div class="container">
     <div class="content-holder">     
        <section class="site-contentarea">
         <div class="contentbox">           
				<?php if ( have_posts() ) : ?>
                    <header>
                        <h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'florence-it' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'search' ); ?>
                    <?php endwhile; ?>
                    <?php 
					// Previous/next post navigation.
					the_posts_pagination( array(
						'mid_size' => 2,
						'prev_text' => __( 'Back', 'florence-it' ),
						'next_text' => __( 'Next', 'florence-it' ),
						'screen_reader_text' => __( 'Posts navigation', 'florence-it' )
					) ); 
					?>
                <?php else : ?>
                    <?php get_template_part( 'no-results', 'search' ); ?>
                <?php endif; ?>          
            </div>
        </section>      
       <?php get_sidebar();?>       
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- container -->

<?php get_footer(); ?>