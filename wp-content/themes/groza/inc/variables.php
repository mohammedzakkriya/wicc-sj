<?php

$grovzaPostsPagesArray = array(
	'select' => __('Select a post/page', 'grovza'),
);

$grovzaPostsPagesArgs = array(
	
	// Change these category SLUGS to suit your use.
	'ignore_sticky_posts' => 1,
	'post_type' => array('post', 'page'),
	'orderby' => 'date',
	'posts_per_page' => -1,
	'post_status' => 'publish',
	
);
$grovzaPostsPagesQuery = new WP_Query( $grovzaPostsPagesArgs );
	
if ( $grovzaPostsPagesQuery->have_posts() ) :
							
	while ( $grovzaPostsPagesQuery->have_posts() ) : $grovzaPostsPagesQuery->the_post();
			
		$grovzaPostsPagesId = get_the_ID();
		if(get_the_title() != ''){
				$grovzaPostsPagesTitle = get_the_title();
		}else{
				$grovzaPostsPagesTitle = get_the_ID();
		}
		$grovzaPostsPagesArray[$grovzaPostsPagesId] = $grovzaPostsPagesTitle;
	   
	endwhile; wp_reset_postdata();
							
endif;

$grovzaYesNo = array(
	'select' => __('Select', 'grovza'),
	'yes' => __('Yes', 'grovza'),
	'no' => __('No', 'grovza'),
);

$grovzaSliderType = array(
	'select' => __('Select', 'grovza'),
	'header' => __('WP Custom Header', 'grovza'),
	'header-one' => __('grovza Header', 'grovza'),
);

$grovzaServiceLayouts = array(
	'select' => __('Select', 'grovza'),
	'one' => __('One', 'grovza'),
	'two' => __('Two', 'grovza'),
);

$grovzaAvailableCats = array( 'select' => __('Select', 'grovza') );

$grovza_categories_raw = get_categories( array( 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 0, ) );

foreach( $grovza_categories_raw as $category ){
	
	$grovzaAvailableCats[$category->term_id] = $category->name;
	
}

$grovzaBusinessLayoutType = array( 
	'select' => __('Select', 'grovza'), 
	'one' => __('One', 'grovza'), 
	'two' => __('Two', 'grovza'),
	'three' => __('Three', 'grovza'),
	'four' => __('Four', 'grovza'),
);
