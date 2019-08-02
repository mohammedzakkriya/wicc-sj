<?php
/**
 * The template for displaying search results pages.
 *
 */

 get_header(); ?>

<div id="main-content-wrapper">

	<div id="main-content-full">

		<div id="infoTxt">
			<?php 
				/* translators: %s: search query */
				printf( esc_html__( 'You searched for "%s". Here are the results:', 'allingrid' ),
						get_search_query() );
			?>
		</div><!-- #infoTxt -->

	<?php if ( have_posts() ) : ?>

			<div class="grid">
			<?php
				// starts the loop
				while ( have_posts() ) :

					the_post();

					/*
					 * Include the post format-specific template for the content.
					 */
					get_template_part( 'template-parts/content' );

				endwhile;
			?>
			</div>
	<?php
				the_posts_pagination( array(
		                        'prev_next' => '',
		                    ) );
	 
		 else :

				// if no content is loaded, show the 'no found' template
				get_template_part( 'template-parts/content', 'none' );
			
		  endif;
	?>

	</div><!-- #main-content -->

	

</div><!-- #main-content-wrapper -->

<?php get_footer(); ?>