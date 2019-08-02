<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Florence IT
 */

get_header(); ?>

<div class="container">
  <div class="content-holder">
    <section class="site-contentarea" id="sitemain">
      <header class="page-header">
        <h1 class="entry-title"><?php _e( '404 Not Found', 'florence-it' ); ?></h1>
      </header>    
      <div class="page-content">
        <p><?php _e( 'Looks like you have taken a wrong turn. Dont worry... it happens to the best of us.', 'florence-it' ); ?></p>
      </div>    
    </section>
    <div class="clear"></div>
  </div>
</div>
<?php get_footer(); ?>