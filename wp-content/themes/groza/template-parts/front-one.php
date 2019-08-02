<div class="frontPageContainer">
	
	<div class="frontPageServices">
		
		<div class="frontPageWelcome">
		
			<?php
			
				$grovzaWelcomePostTitle = '';
				$grovzaWelcomePostDesc = '';

				if( '' != get_theme_mod('grovza_welcome_post') && 'select' != get_theme_mod('grovza_welcome_post') ){

					$grovzaWelcomePostId = get_theme_mod('grovza_welcome_post');

					if( ctype_alnum($grovzaWelcomePostId) ){

						$grovzaWelcomePost = get_post( $grovzaWelcomePostId );

						$grovzaWelcomePostTitle = $grovzaWelcomePost->post_title;
						$grovzaWelcomePostDesc = $grovzaWelcomePost->post_excerpt;
						$grovzaWelcomePostContent = $grovzaWelcomePost->post_content;

					}

				}			
			
			?>
			
			<h1><?php echo esc_html($grovzaWelcomePostTitle); ?></h1>
			<div class="frontWelcomeContent">
				<p>
					<?php 
					
						if( '' != $grovzaWelcomePostDesc ){
							
							echo esc_html($grovzaWelcomePostDesc);
							
						}else{
							
							echo esc_html($grovzaWelcomePostContent);
							
						}
					
					?>
				</p>
			</div><!-- .frontWelcomeContent -->			
			
		</div><!-- .frontPageWelcome -->
		
		<div class="frontPageServiceItems">
			
			<?php

				$grovza_left_cat = '';

				if(get_theme_mod('grovza_services_cat')){
					$grovza_left_cat = get_theme_mod('grovza_services_cat');
					$grovza_left_cat_num = -1;
				}else{
					$grovza_left_cat = 0;
					$grovza_left_cat_num = 5;
				}		

				$grovza_left_args = array(
				   // Change these category SLUGS to suit your use.
				   'ignore_sticky_posts' => 1,
				   'post_type' => array('post'),
				   'posts_per_page'=> $grovza_left_cat_num,
				   'cat' => $grovza_left_cat
				);

				$grovza_left = new WP_Query($grovza_left_args);		

				if ( $grovza_left->have_posts() ) : while ( $grovza_left->have_posts() ) : $grovza_left->the_post();
   			?> 			
			<div class="frontPageServiceItem">
				
				<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('grovza-home-posts');
						}else{
							echo '<img src="' . esc_url( esc_url( get_template_directory_uri() ) ) . '/assets/images/frontitemimage.png" />';
						}						
				?>
				<?php the_title( '<h3><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' ); ?>
				<p>
					<?php  
						
						//$frontPostExcerpt = '';
						//$frontPostExcerpt = get_the_excerpt();
					
						if( has_excerpt() ){
							echo esc_html(get_the_excerpt());
						}else{
							echo esc_html(grovza_limitedstring(get_the_content(), 50));
						}
					
					?>
				</p>				
				
			</div><!-- .frontPageServiceItem -->
			<?php endwhile; wp_reset_postdata(); endif;?>
			
		</div><!-- .frontPageServiceItems -->
		
	</div><!-- .frontPageServices -->
	
	<div class="frontPagePortfolio">
		
		<h1><?php _e('Portfolio', 'grovza'); ?></h1>
		
		<div class="frontPagePortfolioItems">
			
			<?php

				$grovza_portfolio_cat = '';

				if(get_theme_mod('grovza_portfolio_cat')){
					$grovza_portfolio_cat = get_theme_mod('grovza_portfolio_cat');
					$grovza_portfolio_cat_num = -1;
				}else{
					$grovza_portfolio_cat = 0;
					$grovza_portfolio_cat_num = 5;
				}		

				$grovza_portfolio_args = array(
				   // Change these category SLUGS to suit your use.
				   'ignore_sticky_posts' => 1,
				   'post_type' => array('post'),
				   'posts_per_page'=> $grovza_portfolio_cat_num,
				   'cat' => $grovza_portfolio_cat
				);

				$grovza_portfolio = new WP_Query($grovza_portfolio_args);		

				if ( $grovza_portfolio->have_posts() ) : while ( $grovza_portfolio->have_posts() ) : $grovza_portfolio->the_post();
   			?>			
			<div class="frontPagePortfolioItem">
				
				<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}else{
							echo '<img src="' . esc_url( esc_url( get_template_directory_uri() ) ) . '/assets/images/service.jpg" />';
						}						
				?>
				<?php the_title( '<h3>', '</h3>' ); ?>				
				
			</div><!-- .frontPagePortfolioItem -->
			<?php endwhile; wp_reset_postdata(); endif;?>
			
		</div><!-- .frontPagePortfolioItems -->
		
	</div><!-- .frontPagePortfolio -->
	
	<div class="frontPageNews">
		
			<h1><?php _e('News', 'grovza'); ?></h1>
			
			<?php

				$grovza_right_cat = '';

				if(get_theme_mod('grovza_news_cat')){
					$grovza_right_cat = get_theme_mod('grovza_news_cat');
				}else{
					$grovza_right_cat = 0;
				}		

				$grovza_right_args = array(
				   // Change these category SLUGS to suit your use.
				   'ignore_sticky_posts' => 1,
				   'post_type' => array('post'),
				   'posts_per_page'=> 4,
				   'cat' => $grovza_right_cat
				);

				$grovza_right = new WP_Query($grovza_right_args);		

				if ( $grovza_right->have_posts() ) : while ( $grovza_right->have_posts() ) : $grovza_right->the_post();
   			?> 			
			<div class="frontNewsItem">
				
				<?php the_title( '<h3>', '</h3>' ); ?>
				<p>
					<?php  
						
						//$frontPostExcerpt = '';
						//$frontPostExcerpt = get_the_excerpt();
					
						if( has_excerpt() ){
							echo esc_html(get_the_excerpt());
						}else{
							echo esc_html(grovza_limitedstring(get_the_content(), 100));
						}
					
					?>				
				</p>
				<p class="readmore"><a href="<?php echo esc_url(get_the_permalink()); ?>">Read More</a></p>
				
			</div><!-- .frontNewsItem -->
			<?php endwhile; wp_reset_postdata(); endif;?>			
		
	</div><!-- .frontPageNews -->	
	
</div><!-- .frontPageContainer -->	