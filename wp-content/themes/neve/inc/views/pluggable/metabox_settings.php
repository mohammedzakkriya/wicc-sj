<?php
/**
 * Handles post meta for metabox.
 *
 * @package Neve\Views\Pluggable
 */

namespace Neve\Views\Pluggable;

/**
 * Class Metabox_Settings
 *
 * @package Neve\Views\Pluggable
 */
class Metabox_Settings {
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'neve_sidebar_position', array( $this, 'filter_sidebar_position' ) );
		add_filter( 'neve_container_class_filter', array( $this, 'filter_container_class' ), 100 );

		add_filter( 'neve_filter_toggle_content_parts', array( $this, 'filter_components_toggle' ), 100, 2 );
		add_action( 'wp_enqueue_scripts', array( $this, 'content_width' ), 999 );
	}

	/**
	 * Add content width.
	 */
	public function content_width() {
		$post_id = $this->get_post_id();
		if ( $post_id === false ) {
			return;
		}

		$content_width_status = get_post_meta( $post_id, 'neve_meta_enable_content_width', true );

		if ( $content_width_status !== 'on' ) {
			return;
		}

		$meta_value = get_post_meta( $post_id, 'neve_meta_content_width', true );

		if ( empty( $meta_value ) ) {
			return;
		}

		$sidebar_width = 100 - absint( $meta_value );

		$style = '@media(min-width: 960px) {
			#content.neve-main > .container > .row > .col { max-width: ' . absint( $meta_value ) . '%; } 
			.neve-main .nv-sidebar-wrap, .neve-main .nv-sidebar-wrap.shop-sidebar { max-width: ' . absint( $sidebar_width ) . '%; }
		}';

		wp_add_inline_style( 'neve-style', $style );
	}

	/**
	 * Filter components that will be shown.
	 *
	 * @param bool   $status  the status of the component.
	 * @param string $context context of the filter.
	 *
	 * @return bool
	 */
	public function filter_components_toggle( $status, $context ) {
		if ( ! is_single() && ! is_page() ) {
			return $status;
		}

		$post_id = $this->get_post_id();

		if ( $post_id === false ) {
			return $status;
		}

		$context_mapping = array(
			'header'         => 'neve_meta_disable_header',
			'title'          => 'neve_meta_disable_title',
			'featured-image' => 'neve_meta_disable_featured_image',
			'footer'         => 'neve_meta_disable_footer',
		);

		/* If context isn't valid, bail. */
		if ( ! array_key_exists( $context, $context_mapping ) ) {
			return $status;
		}

		$meta_value = get_post_meta( $post_id, $context_mapping[ $context ], true );

		if ( empty( $meta_value ) ) {
			return $status;
		}

		if ( $meta_value === 'on' ) {
			return false;
		}

		return true;
	}

	/**
	 * Change sidebar position based on meta.
	 *
	 * @param string $position sidebar position coming from filter.
	 *
	 * @return mixed
	 */
	public function filter_sidebar_position( $position ) {
		if ( ! is_single() && ! is_page() && ( class_exists( 'WooCommerce' ) && ! is_shop() ) ) {
			return $position;
		}

		$post_id = $this->get_post_id();

		if ( $post_id === false ) {
			return $position;
		}

		$meta_value = get_post_meta( $post_id, 'neve_meta_sidebar', true );
		if ( empty( $meta_value ) ) {
			return $position;
		}

		return $meta_value;
	}

	/**
	 * Filter the container class based on meta.
	 *
	 * @param string $class container class.
	 *
	 * @return string
	 */
	public function filter_container_class( $class ) {

		// Don't filter on blog.
		if ( ! is_single() && ! is_page() ) {
			return $class;
		}

		$post_id = $this->get_post_id();

		if ( $post_id === false ) {
			return $class;
		}

		$meta_value = get_post_meta( $post_id, 'neve_meta_container', true );

		if ( empty( $meta_value ) ) {
			return $class;
		}

		if ( $meta_value === 'contained' ) {
			return 'container';
		} elseif ( $meta_value === 'full-width' ) {
			return 'container-fluid';
		} else {
			return $class;
		}
	}

	/**
	 * Get the post id.
	 *
	 * @return bool|string
	 */
	private function get_post_id() {
		if ( is_home() ) {
			return false;
		}

		global $post;
		if ( empty( $post ) ) {
			return false;
		}

		$post_id = apply_filters( 'neve_post_meta_filters_post_id', $post->ID );

		if ( ! isset( $post_id ) ) {
			return false;
		}

		return $post_id;
	}
}
