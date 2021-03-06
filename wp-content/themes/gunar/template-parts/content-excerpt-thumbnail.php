<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quna
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-tumbnail-wrapper">
		<?php quna_post_thumbnail(); ?>
	</div><!-- .entry-tumbnail-wrapper -->

	<div class="entry-summary-wrapper">

		<header class="entry-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;

			if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php
					quna_posted_on();
					quna_posted_by();
					?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<div class="more-link-wrapper">
			<a class="button more-link" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php esc_html_e('Read more', 'quna'); ?></a>
		</div>

		<footer class="entry-footer">
			<?php // quna_entry_footer(); ?>
		</footer><!-- .entry-footer -->

	</div><!-- .entry-summary-wrapper -->
	<div class="clearfix"></div>
</article><!-- #post-<?php the_ID(); ?> -->
