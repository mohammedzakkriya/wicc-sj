<?php if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}

/**
 * WebPoint Functions.
 */

/* Core Functions */
require get_parent_theme_file_path( 'includes/functions.php' );

/* Customizer */
require get_parent_theme_file_path( 'includes/customizer.php' );

/* Setup */
require get_parent_theme_file_path( 'includes/setup.php' );

/* HEAD */
require get_parent_theme_file_path( 'includes/head.php' );

/* Header */
require get_parent_theme_file_path( 'includes/header.php' );

/* Menu */
require get_parent_theme_file_path( 'includes/menu.php' );

/* Ajax */
require get_parent_theme_file_path( 'includes/ajax.php' );

/* Template */
require get_parent_theme_file_path( 'includes/template.php' );

/* Loop */
require get_parent_theme_file_path( 'includes/posts.php' );

/* Home */
require get_parent_theme_file_path( 'includes/home.php' );

/* Single */
require get_parent_theme_file_path( 'includes/single.php' );

/* Taxonomy */
require get_parent_theme_file_path( 'includes/taxonomy.php' );

/* Date */
require get_parent_theme_file_path( 'includes/date.php' );

/* Archive */
require get_parent_theme_file_path( 'includes/archive.php' );

/* Search */
require get_parent_theme_file_path( 'includes/search.php' );

/* Error 404 */
require get_parent_theme_file_path( 'includes/404.php' );

/* Author */
require get_parent_theme_file_path( 'includes/author.php' );

/* Index */
require get_parent_theme_file_path( 'includes/index.php' );

/* Comments */
require get_parent_theme_file_path( 'includes/comments.php' );

/* Comment Form */
require get_parent_theme_file_path( 'includes/comment-form.php' );

/* Sidebar */
require get_parent_theme_file_path( 'includes/sidebar.php' );

/* Footer */
require get_parent_theme_file_path( 'includes/footer.php' );
