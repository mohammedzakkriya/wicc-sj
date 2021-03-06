<?php $showAboutus = mise_options('_onepage_section_aboutus', ''); ?>
<?php if ($showAboutus == 1) : ?>
	<?php
		$aboutusSectionID = mise_options('_onepage_id_aboutus', 'aboutus');
		$aboutusTitle = mise_options('_onepage_title_aboutus', __('About Us', 'mise'));
		$aboutusSubTitle = mise_options('_onepage_subtitle_aboutus', __('Who We Are', 'mise'));
		$aboutusPageBox = mise_options('_onepage_choosepage_aboutus');
		$aboutusButtonText = mise_options('_onepage_textbutton_aboutus', __('More Information', 'mise'));
		$aboutusButtonLink = mise_options('_onepage_linkbutton_aboutus', '#');
	?>
<section class="mise_aboutus <?php echo has_post_thumbnail($aboutusPageBox) ? 'withImage' : 'noImage' ?>" id="<?php echo esc_attr($aboutusSectionID); ?>">
	<div class="mise_aboutus_color"></div>
	<div class="mise_action_aboutus">
		<?php if($aboutusTitle || is_customize_preview()): ?>
			<h2 class="misee_main_text"><?php echo esc_html($aboutusTitle); ?></h2>
		<?php endif; ?>
		<?php if($aboutusSubTitle || is_customize_preview()): ?>
			<p class="mise_subtitle"><?php echo esc_html($aboutusSubTitle); ?></p>
		<?php endif; ?>
		<div class="aboutus_columns">
			<div class="one aboutus_columns_three">
				<div class="aboutInner">
					<?php if($aboutusPageBox) : ?>
					<h3><?php echo get_the_title(intval($aboutusPageBox)); ?></h3>
					<?php
						$args = array(
						  'p'         => intval($aboutusPageBox),
						  'post_type' => 'page'
						);
						$query = new WP_Query( $args );
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								?>
								<article id="post-<?php the_ID(); ?>" <?php post_class( 'mise-aboutus' ); ?> >
									<?php
									the_content(
										sprintf(
											/* translators: %s: Name of current post */
											__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mise' ),
											get_the_title()
										)
									);
									?>
								</article>
								<?php
							endwhile;
						endif;
						wp_reset_postdata();
					?>
					<?php endif; ?>
					<?php if($aboutusButtonText || is_customize_preview()): ?>
						<div class="miseButton aboutus"><a href="<?php echo esc_url($aboutusButtonLink); ?>"><?php echo esc_html($aboutusButtonText); ?></a></div>
					<?php endif; ?>
				</div>
			</div>
			<?php if ('' != get_the_post_thumbnail($aboutusPageBox)) : ?>
				<div class="two aboutus_columns_three">
					<div class="aboutInnerImage">
						<?php echo get_the_post_thumbnail(intval($aboutusPageBox), 'large'); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>