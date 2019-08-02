<div class="front-three-container">

	<div class="front-three-services">
	
		<?php 
					
				$grovzaWelcomePostTitle = '';
				$grovzaWelcomePostDesc = '';
				
				if( '' != get_theme_mod('grovza_three_welcome_post') && 'select' != get_theme_mod('grovza_three_welcome_post') ){
					
					$grovzaWelcomePostId = get_theme_mod('grovza_three_welcome_post');
					
					if( ctype_alnum($grovzaWelcomePostId) ){

						$grovzaWelcomePost = get_post( $grovzaWelcomePostId );
					
						$grovzaWelcomePostTitle = $grovzaWelcomePost->post_title;
						$grovzaWelcomePostDesc = $grovzaWelcomePost->post_excerpt;
						$grovzaWelcomePostContent = $grovzaWelcomePost->post_content;
						
					}
					
				}
				
				
				
		?>
		<div class="frontpage-welcome-container">

			<h1><?php echo esc_html($grovzaWelcomePostTitle); ?></h1>
			<div>
			<?php 
					
				if( '' != $grovzaWelcomePostDesc ){
							
					echo esc_html($grovzaWelcomePostDesc);
							
				}else{
							
					echo esc_html($grovzaWelcomePostContent);
							
				}
					
			?>			
			</div>

		</div><!-- .frontpage-welcome-container -->

		
		<div class="bizthree-items">
		
			<?php
				
				if( '' != get_theme_mod('grovza_three_products_one') && 'select' != get_theme_mod('grovza_three_products_one') ):
				
				$grovzaProductOneTitle = '';
				$grovzaProductOneDesc = '';
				$grovzaProductOneUrl = '';
				$grovzaProductOneImage = '';			
				
				$grovzaProductOneId = get_theme_mod('grovza_three_products_one');
				
				if( ctype_alnum($grovzaProductOneId) ){

					$grovzaProductOne = get_post( $grovzaProductOneId );
				
					$grovzaProductOneTitle = $grovzaProductOne->post_title;
					$grovzaProductOneDesc = $grovzaProductOne->post_excerpt;
					$grovzaProductOneContent = grovza_limitedstring($grovzaProductOne->post_content, 150);
					$grovzaProductOneUrl = get_permalink( $grovzaProductOneId );
					
					if( has_post_thumbnail($grovzaProductOneId) ){
						$grovzaProductOneImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaProductOneId ), 'full' );
						$grovzaProductOneImage = $grovzaProductOneImage[0];
					}				
					
				}			
				
			?>
			<div class="bizthree-item">
			
				<div class="bizthree-image">
					
					<?php 

						if( '' != $grovzaProductOneImage ){
							echo '<a href="' . esc_url($grovzaProductOneUrl) . '"><img src="' . esc_url($grovzaProductOneImage) . '" /></a>';
						}else{
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/service.jpg" />';
						}
							
					?>				
					
				</div><!-- .bizthree-image -->
				
				<div class="bizthree-content">
				
					<h3><a href="<?php echo esc_url($grovzaProductOneUrl); ?>"><?php echo esc_html($grovzaProductOneTitle); ?></a></h3>
					<div>
					<?php 
					
						if( '' != $grovzaProductOneDesc ){
							
							echo esc_html($grovzaProductOneDesc);
							
						}else{
							
							echo esc_html($grovzaProductOneContent);
							
						}
					
					?>		
					</div>	
				
				</div><!-- .bizthree-content -->		
			
			</div><!-- .bizthree-item -->
			<?php endif; ?>
			
			<?php 
			
				if( '' != get_theme_mod('grovza_three_products_two') && 'select' != get_theme_mod('grovza_three_products_two') ):
				
				$grovzaProductTwoTitle = '';
				$grovzaProductTwoDesc = '';
				$grovzaProductTwoUrl = '';
				$grovzaProductTwoImage = '';			
				
				$grovzaProductTwoId = get_theme_mod('grovza_three_products_two');
				
				if( ctype_alnum($grovzaProductTwoId) ){

					$grovzaProductTwo = get_post( $grovzaProductTwoId );
				
					$grovzaProductTwoTitle = $grovzaProductTwo->post_title;
					$grovzaProductTwoDesc = $grovzaProductTwo->post_excerpt;
					$grovzaProductTwoContent = grovza_limitedstring($grovzaProductTwo->post_content, 150);
					$grovzaProductTwoUrl = get_permalink( $grovzaProductTwoId );
					
					if( has_post_thumbnail($grovzaProductTwoId) ){
						$grovzaProductTwoImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaProductTwoId ), 'full' );
						$grovzaProductTwoImage = $grovzaProductTwoImage[0];
					}				
					
				}			
				
			?>
			<div class="bizthree-item">
			
				<div class="bizthree-image">
					
					<?php 

						if( '' != $grovzaProductTwoImage ){
							echo '<a href="' . esc_url($grovzaProductTwoUrl) . '"><img src="' . esc_url($grovzaProductTwoImage) . '" /></a>';
						}else{
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/service.jpg" />';
						}
							
					?>				
					
				</div><!-- .bizthree-image -->
				
				<div class="bizthree-content">
				
					<h3><a href="<?php echo esc_url($grovzaProductTwoUrl); ?>"><?php echo esc_html($grovzaProductTwoTitle); ?></a></h3>
					<div>
					<?php 
					
						if( '' != $grovzaProductTwoDesc ){
							
							echo esc_html($grovzaProductTwoDesc);
							
						}else{
							
							echo esc_html($grovzaProductTwoContent);
							
						}
					
					?>		
					</div>	
				
				</div><!-- .bizthree-content -->		
			
			</div><!-- .bizthree-item -->
			<?php endif; ?>

			<?php 
			
				if( '' != get_theme_mod('grovza_three_products_three') && 'select' != get_theme_mod('grovza_three_products_three') ):
				
				$grovzaProductThreeTitle = '';
				$grovzaProductThreeDesc = '';
				$grovzaProductThreeUrl = '';
				$grovzaProductThreeImage = '';			
				
				$grovzaProductThreeId = get_theme_mod('grovza_three_products_three');
				
				if( ctype_alnum($grovzaProductThreeId) ){

					$grovzaProductThree = get_post( $grovzaProductThreeId );
				
					$grovzaProductThreeTitle = $grovzaProductThree->post_title;
					$grovzaProductThreeDesc = $grovzaProductThree->post_excerpt;
					$grovzaProductThreeContent = grovza_limitedstring($grovzaProductThree->post_content, 150);
					$grovzaProductThreeUrl = get_permalink( $grovzaProductThreeId );
					
					if( has_post_thumbnail($grovzaProductThreeId) ){
						$grovzaProductThreeImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaProductThreeId ), 'full' );
						$grovzaProductThreeImage = $grovzaProductThreeImage[0];
					}				
					
				}			
				
			?>
			<div class="bizthree-item">
			
				<div class="bizthree-image">
					
					<?php 

						if( '' != $grovzaProductThreeImage ){
							echo '<a href="' . esc_url($grovzaProductThreeUrl) . '"><img src="' . esc_url($grovzaProductThreeImage) . '" /></a>';
						}else{
							echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/service.jpg" />';
						}
							
					?>				
					
				</div><!-- .bizthree-image -->
				
				<div class="bizthree-content">
				
					<h3><a href="<?php echo esc_url($grovzaProductThreeUrl); ?>"><?php echo esc_html($grovzaProductThreeTitle); ?></a></h3>
					<div>
					<?php 
					
						if( '' != $grovzaProductThreeDesc ){
							
							echo esc_html($grovzaProductThreeDesc);
							
						}else{
							
							echo esc_html($grovzaProductThreeContent);
							
						}
					
					?>		
					</div>	
				
				</div><!-- .bizthree-content -->		
			
			</div><!-- .bizthree-item -->
			<?php endif; ?>		
		
		</div><!-- .bizthree-items -->
	
	</div><!-- .front-three-services -->
	
	<div class="front-three-portfolio">
	
		<h3><?php echo __( 'Portfolio', 'grovza' ); ?></h3>
		
		<div class="front-three-portfolio-content">
		
			<?php
				
				if( '' != get_theme_mod('grovza_three_portfolio_one') && 'select' != get_theme_mod('grovza_three_portfolio_one') ):
				
				$grovzaPortfolioOneTitle = '';
				$grovzaPortfolioOneImage = '';			
				
				$grovzaPortfolioOneId = get_theme_mod('grovza_three_portfolio_one');
				
				if( ctype_alnum($grovzaPortfolioOneId) ){

					$grovzaProductOne = get_post( $grovzaPortfolioOneId );
				
					$grovzaPortfolioOneTitle = $grovzaProductOne->post_title;
					$grovzaPortfolioOneUrl = get_permalink( $grovzaProductOneId );
					
					if( has_post_thumbnail($grovzaPortfolioOneId) ){
						$grovzaPortfolioOneImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaPortfolioOneId ), 'full' );
						$grovzaPortfolioOneImage = $grovzaPortfolioOneImage[0];
					}				
					
				}			
				
			?>

			<div class="front-three-portfolio-item">
			
				<?php
					
					if( '' != $grovzaPortfolioOneImage ){
						
						echo '<img src="' . esc_url( $grovzaPortfolioOneImage ) . '" />';
						
					}else{
						
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/service.jpg" />';
						
					}
					
				?>
				<p><?php echo esc_html($grovzaPortfolioOneTitle); ?></p>
			
			</div><!-- .front-three-portfolio-item -->
			
			<?php endif; ?>	
			
			<?php
				
				if( '' != get_theme_mod('grovza_three_portfolio_two') && 'select' != get_theme_mod('grovza_three_portfolio_two') ):
				
				$grovzaPortfolioTwoTitle = '';
				$grovzaPortfolioTwoImage = '';			
				
				$grovzaPortfolioTwoId = get_theme_mod('grovza_three_portfolio_two');
				
				if( ctype_alnum($grovzaPortfolioTwoId) ){

					$grovzaProductTwo = get_post( $grovzaPortfolioTwoId );
				
					$grovzaPortfolioTwoTitle = $grovzaProductTwo->post_title;
					$grovzaPortfolioTwoUrl = get_permalink( $grovzaProductTwoId );
					
					if( has_post_thumbnail($grovzaPortfolioTwoId) ){
						$grovzaPortfolioTwoImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaPortfolioTwoId ), 'full' );
						$grovzaPortfolioTwoImage = $grovzaPortfolioTwoImage[0];
					}				
					
				}			
				
			?>

			<div class="front-three-portfolio-item">
			
				<?php
					
					if( '' != $grovzaPortfolioTwoImage ){
						
						echo '<img src="' . esc_url( $grovzaPortfolioTwoImage ) . '" />';
						
					}else{
						
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/service.jpg" />';
						
					}
					
				?>
				<p><?php echo esc_html($grovzaPortfolioTwoTitle); ?></p>
			
			</div><!-- .front-three-portfolio-item -->
			
			<?php endif; ?>	

			<?php
				
				if( '' != get_theme_mod('grovza_three_portfolio_three') && 'select' != get_theme_mod('grovza_three_portfolio_three') ):
				
				$grovzaPortfolioThreeTitle = '';
				$grovzaPortfolioThreeImage = '';			
				
				$grovzaPortfolioThreeId = get_theme_mod('grovza_three_portfolio_three');
				
				if( ctype_alnum($grovzaPortfolioThreeId) ){

					$grovzaProductThree = get_post( $grovzaPortfolioThreeId );
				
					$grovzaPortfolioThreeTitle = $grovzaProductThree->post_title;
					$grovzaPortfolioThreeUrl = get_permalink( $grovzaProductThreeId );
					
					if( has_post_thumbnail($grovzaPortfolioThreeId) ){
						$grovzaPortfolioThreeImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaPortfolioThreeId ), 'full' );
						$grovzaPortfolioThreeImage = $grovzaPortfolioThreeImage[0];
					}				
					
				}			
				
			?>

			<div class="front-three-portfolio-item">
			
				<?php
					
					if( '' != $grovzaPortfolioThreeImage ){
						
						echo '<img src="' . esc_url( $grovzaPortfolioThreeImage ) . '" />';
						
					}else{
						
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/service.jpg" />';
						
					}
					
				?>
				<p><?php echo esc_html($grovzaPortfolioThreeTitle); ?></p>
			
			</div><!-- .front-three-portfolio-item -->
			
			<?php endif; ?>				
		
		</div><!-- .front-three-portfolio-content -->
	
	</div><!-- .front-three-portfolio -->

</div><!-- .front-three-container -->