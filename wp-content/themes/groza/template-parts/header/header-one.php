<?php
	
	$grovzaHeaderPostId = '';
	$grovzaHeaderPostTitle = '';
	$grovzaHeaderPostDesc = '';

	if( '' != get_theme_mod('grovza_header_one_post') && 'select' != get_theme_mod('grovza_header_one_post') ){

		$grovzaHeaderPostId = get_theme_mod('grovza_header_one_post');

		if( ctype_alnum($grovzaHeaderPostId) ){

			$grovzaHeaderPost = get_post( $grovzaHeaderPostId );

			$grovzaHeaderPostTitle = $grovzaHeaderPost->post_title;
			$grovzaHeaderPostDesc = $grovzaHeaderPost->post_excerpt;
			$grovzaHeaderPostContent = $grovzaHeaderPost->post_content;
			$grovzaHeaderPostUrl = get_the_permalink($grovzaHeaderPostId);
			
			$grovzaHeaderPostThumbnail = get_the_post_thumbnail_url($grovzaHeaderPostId,'grovza-producttwo');

		}

	}			
	
	if( '' != $grovzaHeaderPostId ):

?>

<div class="header-one-container">

	<div class="header-one-image">
		
		<?php
		
			if( '' != $grovzaHeaderPostThumbnail ){
				
				echo '<img src="' . esc_url($grovzaHeaderPostThumbnail) . '">';
				
			}
		
		?>
		
	</div><!-- .header-one-image -->
	
	<div class="header-one-content">
		
		<h2><?php echo esc_html($grovzaHeaderPostTitle); ?></h2>
		<p>
			<?php 
					
				if( '' != $grovzaHeaderPostDesc ){
							
					echo esc_html($grovzaHeaderPostDesc);
							
				}else{
							
					echo esc_html($grovzaHeaderPostContent);
							
				}
					
			?>		
		</p>
		<?php if( '' != $grovzaHeaderPostUrl ): ?>
		<p>
			<a class="readMore" href="<?php echo esc_url($grovzaHeaderPostUrl); ?>"><?php _e('Read More', 'grovza') ?></a>
		</p>
		<?php endif; ?>
		
	</div><!-- .header-one-content -->
	
</div><!-- .header-one-container -->

<?php endif; ?>