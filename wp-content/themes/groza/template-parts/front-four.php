<div class="frontFourContainer">

	<div class="frontFourWelcomeContainer">
		
			<?php
			
				$grovzaWelcomePostFourTitle = '';
				$grovzaWelcomePostFourDesc = '';

				if( '' != get_theme_mod('grovza_four_welcome_post') && 'select' != get_theme_mod('grovza_four_welcome_post') ){

					$grovzaWelcomePostFourId = get_theme_mod('grovza_four_welcome_post');

					if( ctype_alnum($grovzaWelcomePostFourId) ){

						$grovzaWelcomePostFour = get_post( $grovzaWelcomePostFourId );

						$grovzaWelcomePostFourTitle = $grovzaWelcomePostFour->post_title;
						$grovzaWelcomePostFourDesc = $grovzaWelcomePostFour->post_excerpt;
						$grovzaWelcomePostFourContent = $grovzaWelcomePostFour->post_content;

					}

				}			
			
			?>
			
			<h1><?php echo esc_html($grovzaWelcomePostFourTitle); ?></h1>
			<div class="frontFourWelcomeContent">
				<p>
					<?php 
					
						if( '' != $grovzaWelcomePostFourDesc ){
							
							echo esc_html($grovzaWelcomePostFourDesc);
							
						}else{
							
							echo esc_html($grovzaWelcomePostFourContent);
							
						}
					
					?>
				</p>
			</div><!-- .frontFourWelcomeContent -->	
		
	</div><!-- .frontFourWelcomeContainer -->
	
	<div class="frontPageFourProductsContainer">
		
		<div class="frontPageFourProductContainer">
			
			<?php
			
				$grovzaFourProductOneTitle = '';
				$grovzaFourProductOneDesc = '';

				if( '' != get_theme_mod('grovza_four_product_post_one') && 'select' != get_theme_mod('grovza_four_product_post_one') ){

					$grovzaFourProductOneId = get_theme_mod('grovza_four_product_post_one');

					if( ctype_alnum($grovzaFourProductOneId) ){

						$grovzaFourProductOne = get_post( $grovzaFourProductOneId );

						$grovzaFourProductOneTitle = $grovzaFourProductOne->post_title;
						$grovzaFourProductOneDesc = $grovzaFourProductOne->post_excerpt;
						$grovzaFourProductOneContent = grovza_limitedstring($grovzaFourProductOne->post_content, 50);
						$grovzaFourProductOneLink = get_permalink($grovzaFourProductOneId);
						
						if( has_post_thumbnail( $grovzaFourProductOneId ) ){
							
							$grovzaFourProductOneImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaFourProductOneId ), 'grovza-productfour' );
							$grovzaFourProductOneImage = $grovzaFourProductOneImage[0];
							
						}else{
							
							$grovzaFourProductOneImage = get_template_directory_uri() . '/assets/images/frontitemimage.png';
							
						}

					}

				}			
			
			?>
			<div class="frontPageFourProductImage">
				<img src="<?php echo esc_url($grovzaFourProductOneImage); ?>" />
			</div><!-- .frontPageFourProductImage -->
			<h2><a href="<?php echo esc_url($grovzaFourProductOneLink); ?>"><?php echo esc_html($grovzaFourProductOneTitle); ?></a></h2>
			<div class="frontPageFourProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaFourProductOneDesc ){
							
							echo esc_html($grovzaFourProductOneDesc);
							
						}else{
							
							echo esc_html($grovzaFourProductOneContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontFourWelcomeContent -->			
			
		</div><!-- .frontPageFourProductContainer -->
		
		<div class="frontPageFourProductContainer">
			
			<?php
			
				$grovzaFourProductTwoTitle = '';
				$grovzaFourProductTwoDesc = '';

				if( '' != get_theme_mod('grovza_four_product_post_two') && 'select' != get_theme_mod('grovza_four_product_post_two') ){

					$grovzaFourProductTwoId = get_theme_mod('grovza_four_product_post_two');

					if( ctype_alnum($grovzaFourProductTwoId) ){

						$grovzaFourProductTwo = get_post( $grovzaFourProductTwoId );

						$grovzaFourProductTwoTitle = $grovzaFourProductTwo->post_title;
						$grovzaFourProductTwoDesc = $grovzaFourProductTwo->post_excerpt;
						$grovzaFourProductTwoContent = grovza_limitedstring($grovzaFourProductTwo->post_content, 50);
						$grovzaFourProductTwoLink = get_permalink($grovzaFourProductTwoId);
						
						if( has_post_thumbnail( $grovzaFourProductTwoId ) ){
							
							$grovzaFourProductTwoImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaFourProductTwoId ), 'grovza-productfour' );
							$grovzaFourProductTwoImage = $grovzaFourProductTwoImage[0];
							
						}else{
							
							$grovzaFourProductTwoImage = get_template_directory_uri() . '/assets/images/frontitemimage.png';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageFourProductImage">
				<img src="<?php echo esc_url($grovzaFourProductTwoImage); ?>" />
			</div><!-- .frontPageFourProductImage -->
			<h2><a href="<?php echo esc_url($grovzaFourProductTwoLink); ?>"><?php echo esc_html($grovzaFourProductTwoTitle); ?></a></h2>
			<div class="frontPageFourProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaFourProductTwoDesc ){
							
							echo esc_html($grovzaFourProductTwoDesc);
							
						}else{
							
							echo esc_html($grovzaFourProductTwoContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontFourWelcomeContent -->			
			
		</div><!-- .frontPageFourProductContainer -->
		
		<div class="frontPageFourProductContainer">
			
			<?php
			
				$grovzaFourProductThreeTitle = '';
				$grovzaFourProductThreeDesc = '';

				if( '' != get_theme_mod('grovza_four_product_post_three') && 'select' != get_theme_mod('grovza_four_product_post_three') ){

					$grovzaFourProductThreeId = get_theme_mod('grovza_four_product_post_three');

					if( ctype_alnum($grovzaFourProductThreeId) ){

						$grovzaFourProductThree = get_post( $grovzaFourProductThreeId );

						$grovzaFourProductThreeTitle = $grovzaFourProductThree->post_title;
						$grovzaFourProductThreeDesc = $grovzaFourProductThree->post_excerpt;
						$grovzaFourProductThreeContent = grovza_limitedstring($grovzaFourProductThree->post_content, 50);
						$grovzaFourProductThreeLink = get_permalink($grovzaFourProductThreeId);
						
						if( has_post_thumbnail( $grovzaFourProductThreeId ) ){
							
							$grovzaFourProductThreeImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaFourProductThreeId ), 'grovza-productfour' );
							$grovzaFourProductThreeImage = $grovzaFourProductThreeImage[0];
							
						}else{
							
							$grovzaFourProductThreeImage = get_template_directory_uri() . '/assets/images/frontitemimage.png';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageFourProductImage">
				<img src="<?php echo esc_url($grovzaFourProductThreeImage); ?>" />
			</div><!-- .frontPageFourProductImage -->
			<h2><a href="<?php echo esc_url($grovzaFourProductThreeLink); ?>"><?php echo esc_html($grovzaFourProductThreeTitle); ?></a></h2>
			<div class="frontPageFourProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaFourProductThreeDesc ){
							
							echo esc_html($grovzaFourProductThreeDesc);
							
						}else{
							
							echo esc_html($grovzaFourProductThreeContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontFourWelcomeContent -->			
			
		</div><!-- .frontPageFourProductContainer -->
		
		<div class="frontPageFourProductContainer">
			
			<?php
			
				$grovzaFourProductFourTitle = '';
				$grovzaFourProductFourDesc = '';

				if( '' != get_theme_mod('grovza_four_product_post_three') && 'select' != get_theme_mod('grovza_four_product_post_three') ){

					$grovzaFourProductFourId = get_theme_mod('grovza_four_product_post_three');

					if( ctype_alnum($grovzaFourProductFourId) ){

						$grovzaFourProductFour = get_post( $grovzaFourProductFourId );

						$grovzaFourProductFourTitle = $grovzaFourProductFour->post_title;
						$grovzaFourProductFourDesc = $grovzaFourProductFour->post_excerpt;
						$grovzaFourProductFourContent = grovza_limitedstring($grovzaFourProductFour->post_content, 50);
						$grovzaFourProductFourLink = get_permalink($grovzaFourProductFourId);
						
						if( has_post_thumbnail( $grovzaFourProductFourId ) ){
							
							$grovzaFourProductFourImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaFourProductFourId ), 'grovza-productfour' );
							$grovzaFourProductFourImage = $grovzaFourProductFourImage[0];
							
						}else{
							
							$grovzaFourProductFourImage = get_template_directory_uri() . '/assets/images/frontitemimage.png';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageFourProductImage">
				<img src="<?php echo esc_url($grovzaFourProductFourImage); ?>" />
			</div><!-- .frontPageFourProductImage -->
			<h2><a href="<?php echo esc_url($grovzaFourProductFourLink); ?>"><?php echo esc_html($grovzaFourProductFourTitle); ?></a></h2>
			<div class="frontPageFourProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaFourProductFourDesc ){
							
							echo esc_html($grovzaFourProductFourDesc);
							
						}else{
							
							echo esc_html($grovzaFourProductFourContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontFourWelcomeContent -->			
			
		</div><!-- .frontPageFourProductContainer -->
		
		<div class="frontPageFourProductContainer">
			
			<?php
			
				$grovzaFourProductFiveTitle = '';
				$grovzaFourProductFiveDesc = '';

				if( '' != get_theme_mod('grovza_four_product_post_three') && 'select' != get_theme_mod('grovza_four_product_post_three') ){

					$grovzaFourProductFiveId = get_theme_mod('grovza_four_product_post_three');

					if( ctype_alnum($grovzaFourProductFiveId) ){

						$grovzaFourProductFive = get_post( $grovzaFourProductFiveId );

						$grovzaFourProductFiveTitle = $grovzaFourProductFive->post_title;
						$grovzaFourProductFiveDesc = $grovzaFourProductFive->post_excerpt;
						$grovzaFourProductFiveContent = grovza_limitedstring($grovzaFourProductFive->post_content, 50);
						$grovzaFourProductFiveLink = get_permalink($grovzaFourProductFiveId);
						
						if( has_post_thumbnail( $grovzaFourProductFiveId ) ){
							
							$grovzaFourProductFiveImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaFourProductFiveId ), 'grovza-productfour' );
							$grovzaFourProductFiveImage = $grovzaFourProductFiveImage[0];
							
						}else{
							
							$grovzaFourProductFiveImage = get_template_directory_uri() . '/assets/images/frontitemimage.png';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageFourProductImage">
				<img src="<?php echo esc_url($grovzaFourProductFiveImage); ?>" />
			</div><!-- .frontPageFourProductImage -->
			<h2><a href="<?php echo esc_url($grovzaFourProductFiveLink); ?>"><?php echo esc_html($grovzaFourProductFiveTitle); ?></a></h2>
			<div class="frontPageFourProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaFourProductFiveDesc ){
							
							echo esc_html($grovzaFourProductFiveDesc);
							
						}else{
							
							echo esc_html($grovzaFourProductFiveContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontFourWelcomeContent -->			
			
		</div><!-- .frontPageFourProductContainer -->
		
		<div class="frontPageFourProductContainer">
			
			<?php
			
				$grovzaFourProductSixTitle = '';
				$grovzaFourProductSixDesc = '';

				if( '' != get_theme_mod('grovza_four_product_post_three') && 'select' != get_theme_mod('grovza_four_product_post_three') ){

					$grovzaFourProductSixId = get_theme_mod('grovza_four_product_post_three');

					if( ctype_alnum($grovzaFourProductSixId) ){

						$grovzaFourProductSix = get_post( $grovzaFourProductSixId );

						$grovzaFourProductSixTitle = $grovzaFourProductSix->post_title;
						$grovzaFourProductSixDesc = $grovzaFourProductSix->post_excerpt;
						$grovzaFourProductSixContent = grovza_limitedstring($grovzaFourProductSix->post_content, 50);
						$grovzaFourProductSixLink = get_permalink($grovzaFourProductSixId);
						
						if( has_post_thumbnail( $grovzaFourProductSixId ) ){
							
							$grovzaFourProductSixImage = wp_get_attachment_image_src( get_post_thumbnail_id( $grovzaFourProductSixId ), 'grovza-productfour' );
							$grovzaFourProductSixImage = $grovzaFourProductSixImage[0];
							
						}else{
							
							$grovzaFourProductSixImage = get_template_directory_uri() . '/assets/images/frontitemimage.png';
							
						}						

					}

				}			
			
			?>
			<div class="frontPageFourProductImage">
				<img src="<?php echo esc_url($grovzaFourProductSixImage); ?>" />
			</div><!-- .frontPageFourProductImage -->
			<h2><a href="<?php echo esc_url($grovzaFourProductSixLink); ?>"><?php echo esc_html($grovzaFourProductSixTitle); ?></a></h2>
			<div class="frontPageFourProductContent">
				
				<p>
					<?php 
					
						if( '' != $grovzaFourProductSixDesc ){
							
							echo esc_html($grovzaFourProductSixDesc);
							
						}else{
							
							echo esc_html($grovzaFourProductSixContent);
							
						}
					
					?>
				</p>
				
			</div><!-- .frontFourWelcomeContent -->			
			
		</div><!-- .frontPageFourProductContainer -->		
		
	</div><!-- .frontPageFourProductsContainer -->
	
</div><!-- .frontPageFourContainer -->