<div class="frontTwoContainer">

	<div class="frontTwoWelcomeContainer">
		
			<?php
			
				$grovzaWelcomePostTitle = '';
				$grovzaWelcomePostDesc = '';

				if( '' != get_theme_mod('grovza_two_welcome_post') && 'select' != get_theme_mod('grovza_two_welcome_post') ){

					$grovzaWelcomePostId = get_theme_mod('grovza_two_welcome_post');

					if( ctype_alnum($grovzaWelcomePostId) ){

						$grovzaWelcomePost = get_post( $grovzaWelcomePostId );

						$grovzaWelcomePostTitle = $grovzaWelcomePost->post_title;
						$grovzaWelcomePostDesc = $grovzaWelcomePost->post_excerpt;
						$grovzaWelcomePostContent = $grovzaWelcomePost->post_content;

					}

				}			
			
			?>
			
			<h1><?php echo esc_html($grovzaWelcomePostTitle); ?></h1>
			<div class="frontTwoWelcomeContent">
				<p>
					<?php 
					
						if( '' != $grovzaWelcomePostDesc ){
							
							echo esc_html($grovzaWelcomePostDesc);
							
						}else{
							
							echo esc_html($grovzaWelcomePostContent);
							
						}
					
					?>
				</p>
			</div><!-- .frontTwoWelcomeContent -->	
		
	</div><!-- .frontTwoWelcomeContainer -->
	
	<div class="frontPageTwoProductsContainer">
		
		<div class="frontPageTwoProductContainer">
			
			<?php
			
				$grovzaProductOneTitle = '';
				$grovzaProductOneDesc = '';

				if( '' != get_theme_mod('grovza_two_product_post_one') && 'select' != get_theme_mod('grovza_two_product_post_one') ){

					$grovzaProductOneId = get_theme_mod('grovza_two_product_post_one');

					if( ctype_alnum($grovzaProductOneId) ){

						$grovzaProductOne = get_post( $grovzaProductOneId );

						$grovzaProductOneTitle = $grovzaProductOne->post_title;
						$grovzaProductOneDesc = $grovzaProductOne->post_excerpt;
						$grovzaProductOneContent = grovza_limitedstring($grovzaProductOne->post_content, 150);
						$grovzaProductOneLink = get_permalink($grovzaProductOneId);
						
						if( has_post_thumbnail( $grovzaProductOneId ) ){
							
							$grovzaProductOneImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaProductOneId ), 'grovza-producttwo' );
							$grovzaProductOneImage = $grovzaProductOneImage[0];
							
						}else{
							
							$grovzaProductOneImage = get_template_directory_uri() . '/assets/images/service.jpg';
							
						}

					}

				}			
			
			?>
			<div class="frontPageTwoProductImage">
				<img src="<?php echo esc_url($grovzaProductOneImage); ?>" />
			</div><!-- .frontPageTwoProductImage -->
			<h2><a href="<?php echo esc_url($grovzaProductOneLink); ?>"><?php echo esc_html($grovzaProductOneTitle); ?></a></h2>
			<div class="frontPageTwoProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaProductOneDesc ){
							
							echo esc_html($grovzaProductOneDesc);
							
						}else{
							
							echo esc_html($grovzaProductOneContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontTwoWelcomeContent -->			
			
		</div><!-- .frontPageTwoProductContainer -->
		
		<div class="frontPageTwoProductContainer">
			
			<?php
			
				$grovzaProductTwoTitle = '';
				$grovzaProductTwoDesc = '';

				if( '' != get_theme_mod('grovza_two_product_post_two') && 'select' != get_theme_mod('grovza_two_product_post_two') ){

					$grovzaProductTwoId = get_theme_mod('grovza_two_product_post_two');

					if( ctype_alnum($grovzaProductTwoId) ){

						$grovzaProductTwo = get_post( $grovzaProductTwoId );

						$grovzaProductTwoTitle = $grovzaProductTwo->post_title;
						$grovzaProductTwoDesc = $grovzaProductTwo->post_excerpt;
						$grovzaProductTwoContent = grovza_limitedstring($grovzaProductTwo->post_content, 150);
						$grovzaProductTwoLink = get_permalink($grovzaProductTwoId);
						
						if( has_post_thumbnail( $grovzaProductTwoId ) ){
							
							$grovzaProductTwoImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaProductTwoId ), 'grovza-producttwo' );
							$grovzaProductTwoImage = $grovzaProductTwoImage[0];
							
						}else{
							
							$grovzaProductTwoImage = get_template_directory_uri() . '/assets/images/service.jpg';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageTwoProductImage">
				<img src="<?php echo esc_url($grovzaProductTwoImage); ?>" />
			</div><!-- .frontPageTwoProductImage -->
			<h2><a href="<?php echo esc_url($grovzaProductTwoLink); ?>"><?php echo esc_html($grovzaProductTwoTitle); ?></a></h2>
			<div class="frontPageTwoProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaProductTwoDesc ){
							
							echo esc_html($grovzaProductTwoDesc);
							
						}else{
							
							echo esc_html($grovzaProductTwoContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontTwoWelcomeContent -->			
			
		</div><!-- .frontPageTwoProductContainer -->
		
		<div class="frontPageTwoProductContainer">
			
			<?php
			
				$grovzaProductThreeTitle = '';
				$grovzaProductThreeDesc = '';

				if( '' != get_theme_mod('grovza_two_product_post_three') && 'select' != get_theme_mod('grovza_two_product_post_three') ){

					$grovzaProductThreeId = get_theme_mod('grovza_two_product_post_three');

					if( ctype_alnum($grovzaProductThreeId) ){

						$grovzaProductThree = get_post( $grovzaProductThreeId );

						$grovzaProductThreeTitle = $grovzaProductThree->post_title;
						$grovzaProductThreeDesc = $grovzaProductThree->post_excerpt;
						$grovzaProductThreeContent = grovza_limitedstring($grovzaProductThree->post_content, 150);
						$grovzaProductThreeLink = get_permalink($grovzaProductThreeId);
						
						if( has_post_thumbnail( $grovzaProductThreeId ) ){
							
							$grovzaProductThreeImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaProductThreeId ), 'grovza-producttwo' );
							$grovzaProductThreeImage = $grovzaProductThreeImage[0];
							
						}else{
							
							$grovzaProductThreeImage = get_template_directory_uri() . '/assets/images/service.jpg';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageTwoProductImage">
				<img src="<?php echo esc_url($grovzaProductThreeImage); ?>" />
			</div><!-- .frontPageTwoProductImage -->
			<h2><a href="<?php echo esc_url($grovzaProductThreeLink); ?>"><?php echo esc_html($grovzaProductThreeTitle); ?></a></h2>
			<div class="frontPageTwoProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaProductThreeDesc ){
							
							echo esc_html($grovzaProductThreeDesc);
							
						}else{
							
							echo esc_html($grovzaProductThreeContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontTwoWelcomeContent -->			
			
		</div><!-- .frontPageTwoProductContainer -->		
		
	</div><!-- .frontPageTwoProductsContainer -->
	
</div><!-- .frontPageTwoContainer -->