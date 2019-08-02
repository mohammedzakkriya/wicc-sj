<?php
/**
 * @package Florence IT
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
  <header class="entry-header">
    <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
  </header> <!-- .entry-header -->
  <div class="postmeta">
      <div class="category-area">
        <?php the_category(); ?>
      </div>
    <div class="post-date"><?php the_date(); ?></div>  
    <div class="post-comment"><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
    <div class="clear"></div>
  </div> <!-- postmeta -->
 
  <div class="entry-content">
    <?php the_content(); ?>
    <?php
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'florence-it' ),
            'after'  => '</div>',
        ) );
        ?>
    <div class="clear"></div>    
    <div class="postmeta-tag">      
      <div class="post-tags">
        <?php the_tags(); ?>
      </div>
      <div class="clear"></div>
    </div><!-- postmeta --> 
  </div><!-- .entry-content -->
  
  <footer class="entry-meta">
    <?php edit_post_link( __( 'Edit', 'florence-it' ), '<span class="edit-link">', '</span>' ); ?>
  </footer><!-- .entry-meta --> 
  
</article>