<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Florence IT
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div class="header <?php if( !is_front_page() && !is_home() ){ ?>pageheader<?php } ?>" <?php if( get_theme_mod('florence_it_hide_categorysec', '1') ) { echo 'style="position:relative;background-color:rgba(0,0,0,0.8);"'; } ?>>
        <div class="container">
            <div class="logo">
				<?php florence_it_the_custom_logo(); ?>
                <div class="site-branding-text">
                 <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></h1>
                <?php $description = get_bloginfo( 'description', 'display' );
                    if ( $description || is_customize_preview() ) : ?>
                    <span class="site-description"><?php echo $description; ?></span>
                <?php endif; ?> 
              </div><!-- .site-branding-text --> 
                    
            </div><!-- logo -->
            <div class="hdr_panelright">             
               <div class="toggle">
        <a class="toggleMenu" href="#"><?php _e('Menu','florence-it'); ?></a>
     </div><!-- toggle --> 
            <div class="hdrmenu">
              <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
            </div><!-- site-nav -->
            <div class="clear"></div>
          </div><!-- hdr_panelright -->  
           <div class="clear"></div>      
        </div><!-- container -->
  </div><!--.header -->
  
  
<?php if ( is_front_page() && !is_home() ) { ?>
<?php
$hidcatslide = get_theme_mod('florence_it_hide_categorysec', '1');
if( $hidcatslide == ''){
?>  
<section id="catsliderarea">
	 <div class="catwrapslider">
            <div class="owl-carousel">
              <?php if( get_theme_mod('florence_it_slidersection',false) ) { ?>
        		<?php $queryvar = new wp_query('cat='.esc_attr(get_theme_mod('florence_it_slidersection',true)));
						while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>
                         <div class="slidesection"> 
                          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?>
                              <h3><?php the_title(); ?></h3>
                           </a>                         
                         </div>
						<?php endwhile;
						wp_reset_postdata(); ?>
               <?php } ?>
            </div><!--end .carousel-->
	 </div><!--end .cat-2-col-->
<div class="clear"></div>
</section><!--end section slider with cats-->  
<?php } } ?>