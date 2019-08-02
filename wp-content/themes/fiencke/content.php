<?php
/**
 * @package Florence IT
 */
?>
 <div class="lists_cats">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">  
          <?php if (has_post_thumbnail() ){ ?>
			<div class="catThumb">
             <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		   <?php }  ?>            
        </header><!-- .entry-header -->  
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary contentCAT">
        	<h5><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
            <?php if ( 'post' == get_post_type() ) : ?>
                <div class="postmeta">                	
                    <div class="post-date"><?php the_date(); ?></div><!-- post-date -->
                    <div class="post-comment"><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>                  
                </div><!-- postmeta -->
            <?php endif; ?>
           	<?php the_excerpt(); ?>
            <span class="read-more"><a href="<?php the_permalink(); ?>"><?php _e('Read More &rarr;','florence-it'); ?></a></span>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'florence-it' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'florence-it' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
        <div class="clear"></div>
    </article><!-- #post-## -->
</div><!-- blog-post-repeat -->