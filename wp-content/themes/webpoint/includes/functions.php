<?php /* Advanced Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_sanitize_var' ) ) {

	/**
	 * Sanitize a variable.
	 *
	 * @param string|int|float $value
	 * @param string $type
	 * @param mixed $default
	 * @return mixed
	 */
	function webpoint_sanitize_var( $value = null, $type = null, $default = false ) {

		/* Check value */
		if ( ! is_string( $value ) && ! is_numeric( $value ) ) {
			return $default;
		}

		/* Check type */
		if ( ! $type || ! is_string( $type ) ) {
			return $default;
		}

		/* Sanitize value by data type */
		if ( $type == 'integer' || $type == 'int' ) {
			$int_value = (int) $value;
			$string_value = trim( (string) $value );
			if ( strpos( $string_value, '.' ) !== false ) {
				$string_value = rtrim( rtrim( $string_value, '0' ), '.' );
			}
			$value = (string) $int_value === (string) $string_value ? $int_value : $default;
		} elseif ( $type == 'float' || $type == 'decimal' ) {
			$float_value = (float) $value;
			$string_value = trim( (string) $value );
			if ( strpos( $string_value, '.' ) !== false ) {
				$string_value = rtrim( rtrim( $string_value, '0' ), '.' );
			}
			$value = (string) $float_value === (string) $string_value ? $float_value : $default;
		} elseif ( $type == 'abs' ) {
			$abs_value = abs( $value );
			if ( is_int( $abs_value ) ) {
				$int_value = webpoint_sanitize_var( $value, 'integer', false );
				$value = (
					$int_value !== false
					&& $abs_value === abs( $int_value )
				) ? $abs_value : $default;
			} elseif ( is_float( $abs_value ) ) {
				$float_value = webpoint_sanitize_var( $value, 'float', false );
				$value = (
					$float_value !== false
					&& $abs_value === abs( $float_value )
				) ? $abs_value : $default;
			} else {
				$value = $default;
			}
		} elseif ( $type == 'absint' || $type == 'absinteger' ) {
			$value = webpoint_sanitize_var( $value, 'integer', false );
			$value = $value !== false ? abs( $value ) : $default;
		} elseif ( $type == 'absfloat' || $type == 'absdecimal' ) {
			$value = webpoint_sanitize_var( $value, 'float', false );
			$value = $value !== false ? abs( $value ) : $default;
		} elseif ( $type == 'term' ) {
			$value = (
				preg_match( '#^[a-z0-9_]+$#s', $value )
				&& webpoint_sanitize_var( substr( $value, 0, 1 ), 'integer', false ) === false
				&& substr( $value, -1, 1 ) !== '_'
			) ? (string) $value : $default;
		} elseif ( $type == 'slug' ) {
			$value = (
				preg_match( '#^[a-z0-9_-]+$#si', $value )
				&& substr( $value, 0, 1 ) !== '-'
				&& substr( $value, -1, 1 ) !== '-'
				&& strpos( $value, '--' ) === false
			) ? (string) $value : $default;
		} elseif ( $type == 'url' ) {
			$value = filter_var( $value, FILTER_VALIDATE_URL )
				? esc_url_raw( $value )
				: $default;
		} elseif ( $type == 'email' ) {
			$value = is_email( $value ) ? sanitize_email( $value ) : $default;
		} elseif ( $type == 'post' ) {
			$value = wp_unslash( $value );
			$value = balanceTags( $value, true );
			$value = wp_kses_post( $value );
		} elseif ( $type == 'comment' ) {
			$value = wp_unslash( $value );
			$value = balanceTags( $value, true );
			$value = wp_kses_data( $value );
		} elseif ( $type == 'html' ) {
			$value = wp_unslash( $value );
			$value = wp_kses_post( $value );
		} elseif ( $type == 'text' ) {
			$value = sanitize_text_field( $value );
		} elseif ( $type == 'string' ) {
			$value = (string) $value;
		} else {
			return $default;
		}

		/* Trim string values */
		if ( is_string( $value ) ) {
			$value = trim( $value );
		}

		/* Return sanitized data */
		return is_string( $value ) || is_numeric( $value ) ? $value : $default;

	} // webpoint_sanitize_var();

}


if ( ! function_exists( 'webpoint_check_var_range' ) ) {

	/**
	 * Check if a variable is in a given range.
	 *
	 * @param string|integer|float $var
	 * @param string $data_type
	 * @param integer|float $min
	 * @param integer|float $max
	 * @return bool
	 */
	function webpoint_check_var_range( $var = null, $data_type = null, $min = null, $max = null ) {

		/* Sanitize variable */
		$var = webpoint_sanitize_var( $var, $data_type, false );
		if ( $var === false ) {
			return false;
		}

		/* Check min and max values */
		if ( ! is_numeric( $min ) || ! is_numeric( $max ) ) {
			return false;
		}

		/* Set numeric data types */
		$numeric_data_types = array(
			'integer',
			'int',
			'float',
			'decimal',
			'abs',
			'absint',
			'absinteger',
			'absfloat',
			'absdecimal'
		);

		/* Set string data types */
		$string_data_types = array(
			'term',
			'slug',
			'email',
			'post',
			'comment',
			'html',
			'text',
			'url'
		);

		/* Check variable by data type */
		if ( in_array( $data_type, $string_data_types ) ) {
			$str_length = mb_strlen( $var, 'UTF-8' );
			if ( $str_length >= $min && $str_length <= $max ) {
				return true;
			} else {
				return false;
			}
		} elseif ( in_array( $data_type, $numeric_data_types ) ) {
			if ( $var >= $min && $var <= $max ) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

	} // webpoint_check_var_range();

}


if ( ! function_exists( 'webpoint_parse_string' ) ) {

	/**
	 * Parse string using separator and data type.
	 *
	 * @param string|number $string String to be parsed.
	 * @param string $sep Separator.
	 * @param string $type Data Type.
	 * @return array|false
	 */
	function webpoint_parse_string( $string = null, $sep = ',', $type = 'term' ) {

		/* Sanitize string */
		$string = webpoint_sanitize_var( $string, 'string', false );
		if ( $string === false ) {
			return false;
		}

		/* Sanitize separator */
		$sep = webpoint_sanitize_var( $sep, 'string', false );
		if ( $sep === false ) {
			return false;
		}

		/* Sanitize data type */
		$type = webpoint_sanitize_var( $type, 'term', false );
		if ( $type === false ) {
			return false;
		}

		/* Explode string using separator */
		$string = explode( $sep, $string );
		if ( ! is_array( $string ) ) {
			return false;
		}

		/* Remove any unwanted white spaces */
		$string = array_map( 'trim', $string );

		/* Init array */
		$array = array();

		/* Set values of array */
		foreach( $string as $value ) {

			/* Sanitize value */
			$value = webpoint_sanitize_var( $value, $type, false );
			if ( $value !== false ) {
				$array[] = $value;
			}

		}

		/* Return args */
		return ! empty( $array ) ? $array : false;

	} // webpoint_parse_string();

}


if ( ! function_exists( 'webpoint_sanitize_array' ) ) {

	/**
	 * Sanitize array values.
	 *
	 * @param array $raw_array
	 * @param string $data_type
	 * @return array
	 */
	function webpoint_sanitize_array( $raw_array = null, $data_type = null ) {

		/* Set empty array */
		$array = array();

		/* Check raw array data type */
		if ( ! is_array( $raw_array ) ) {
			return $array;
		}

		/* Sanitize raw array */
		foreach( $raw_array as $value ) {

			/* Sanitize value */
			$value = webpoint_sanitize_var( $value, $data_type, null );

			/* Save value to array */
			if ( ! is_null( $value ) ) {
				$array[] = $value;
			}

		}

		/* Return array */
		return $array;

	} // webpoint_sanitize_array();

}


if ( ! function_exists( 'webpoint_get_post_id' ) ) {

	/**
	 * Get the post ID depending on what was passed
	 *
	 * @param null|int|object $post
	 * @param bool $validate
	 * @return integer
	 */
	function webpoint_get_post_id( $post = null, $validate = false ) {

		/* If post is null */
		if ( is_null( $post ) ) {

			/* Check global post object */
			if (
				! isset( $GLOBALS['post'] )
				|| ! $GLOBALS['post'] instanceof WP_Post
				|| ! isset( $GLOBALS['post']->ID )
			) {
				return (int) 0;
			}

			/* Return sanitized post ID */
			return webpoint_sanitize_var( $GLOBALS['post']->ID, 'absint', 0 );

			/* If post is numeric */
		} elseif ( is_numeric( $post ) ) {

			/* Sanitize post ID */
			$post_id = webpoint_sanitize_var( $post, 'absint', 0 );

			/* Check post ID and validation status */
			if ( ! $post_id || ! (bool) $validate ) {
				return $post_id;
			}

			/* Get post by ID */
			$post = get_post( $post );

			/* Get post ID */
			$post_id = $post instanceof WP_Post && isset( $post->ID ) ? $post->ID : null;

			/* Return sanitized post ID */
			return webpoint_sanitize_var( $post_id, 'absint', 0 );

			/* If post is an instantiated object of a WP_Post */
		} elseif ( $post instanceof WP_Post ) {

			/* Get post ID */
			$post_id = isset( $post->ID ) ? $post->ID : null;

			/* Return sanitized post ID */
			return webpoint_sanitize_var( $post_id, 'absint', 0 );

		} else {
			return (int) 0;
		}

	} // webpoint_get_post_id();

}


if ( ! function_exists( 'webpoint_get_post_object' ) ) {

	/**
	 * Get the post object depending on what was passed.
	 *
	 * @param mixed $post
	 * @return object|bool false on failure
	 */
	function webpoint_get_post_object( $post = null ) {

		/* Get global post object */
		if ( is_null( $post ) ) {
			global $post;
		}

		/* Check post object */
		if ( $post instanceof WP_Post ) {
			return $post;
		}

		/* Get post ID */
		$post_id = webpoint_get_post_id( $post );
		if ( ! $post_id ) {
			return false;
		}

		/* Get post object by ID */
		$post_obj = get_post( $post_id );

		/* Return post object */
		return $post_obj instanceof WP_Post ? $post_obj : false;

	} // webpoint_get_post_object();

}


if ( ! function_exists( 'webpoint_get_term_id' ) ) {

	/**
	 * Get the term ID depending on what was passed.
	 *
	 * @param null|int|object $term
	 * @param bool $validate
	 * @return int
	 */
	function webpoint_get_term_id( $term = null, $validate = false ) {

		/* If term is null */
		if ( is_null( $term ) ) {

			/* Get global term object */
			$term = get_queried_object();

			/* Check global term object */
			if ( ! $term instanceof WP_Term || ! isset( $term->term_id ) ) {
				return (int) 0;
			}

			/* Return sanitized term ID */
			return webpoint_sanitize_var( $term->term_id, 'absint', 0 );

			/* If term is numeric */
		} elseif ( is_numeric( $term ) ) {

			/* Sanitize term ID */
			$term_id = webpoint_sanitize_var( $term, 'absint', 0 );

			/* Check term ID and validation status */
			if ( ! $term_id || ! (bool) $validate ) {
				return $term_id;
			}

			/* Get term object by ID */
			$term = get_term( $term );

			/* Get term ID */
			$term_id = $term instanceof WP_Term && isset( $term->term_id )
				? $term->term_id
				: null;

			/* Return sanitized term ID */
			return webpoint_sanitize_var( $term_id, 'absint', 0 );

			/* If term is an instantiated object of a WP_Term */
		} elseif ( $term instanceof WP_Term ) {

			/* Get term ID */
			$term_id = isset( $term->term_id ) ? $term->term_id : false;

			/* Return sanitized term ID */
			return webpoint_sanitize_var( $term_id, 'absint', 0 );

		} else {
			return (int) 0;
		}

	} // webpoint_get_term_id();

}


if ( ! function_exists( 'webpoint_get_term_object' ) ) {

	/**
	 * Get the term object depending on what was passed.
	 *
	 * @param mixed $term
	 * @return object|bool false on failure
	 */
	function webpoint_get_term_object( $term = null ) {

		/* Get global term object */
		if ( is_null( $term ) ) {
			$term = get_queried_object();
		}

		/* Check global term object */
		if ( $term instanceof WP_Term ) {
			return $term;
		}

		/* Get term ID */
		$term_id = webpoint_get_term_id( $term );
		if ( ! $term_id ) {
			return false;
		}

		/* Get term object by ID */
		$term = get_term( $term_id );

		/* Return term object */
		return $term instanceof WP_Term ? $term : false;

	} // webpoint_get_term_object();

}


if ( ! function_exists( 'webpoint_get_term_taxonomy' ) ) {

	/**
	 * Get the term taxonomy name.
	 *
	 * @param mixed $term
	 * @return string|bool false on failure
	 */
	function webpoint_get_term_taxonomy( $term = null ) {

		/* Get term object */
		$term = webpoint_get_term_object( $term );

		/* Return term taxonomy */
		return $term && isset( $term->taxonomy ) ? (string) $term->taxonomy : false;

	} // webpoint_get_term_taxonomy();

}


if ( ! function_exists( 'webpoint_get_image_data' ) ) {

	/**
	 * Gets data about an attachment, such as alt text and captions.
	 *
	 * @param int $image_id
	 * @param string $image_size
	 * @return array|false
	 */
	function webpoint_get_image_data( $image_id = 0, $image_size = 'thumbnail' ) {

		/* Sanitize image id */
		$image_id = webpoint_sanitize_var( $image_id, 'absint', 0 );

		/* Sanitize image size */
		$image_size = webpoint_sanitize_var( $image_size, 'term', 'thumbnail' );

		/* Get registered image sizes */
		$image_sizes = get_intermediate_image_sizes();

		/* Check image size */
		if ( ! in_array( $image_size, $image_sizes ) && $image_size != 'full' ) {
			return false;
		}

		/* Init image properties */
		$props = array(
			'title'   => '',
			'alt'     => '',
			'caption' => '',
			'url'     => '',
			'width'   => '',
			'height'  => ''
		);

		/* Get image object */
		$image = webpoint_get_post_object( $image_id );

		/* Set image properties */
		if ( $image && wp_attachment_is_image( $image ) ) {

			/* Get image title */
			$image_title = webpoint_sanitize_var( $image->post_title, 'text', false );
			if ( $image_title !== false ) {
				$props['title'] = esc_attr( $image_title );
			}

			/* Get image alt */
			$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			$image_alt = webpoint_sanitize_var( $image_alt, 'text', false );
			if ( $image_alt !== false ) {
				$props['alt'] = esc_attr( $image_alt );
			}

			/* Get image caption */
			$image_caption = webpoint_sanitize_var( $image->post_excerpt, 'text', false );
			if ( $image_caption !== false ) {
				$props['caption'] = esc_attr( $image_caption );
			}

			/* Get image url and size */
			$image_src = wp_get_attachment_image_src( $image_id, $image_size );
			if ( $image_src && is_array( $image_src ) && ! empty( $image_src ) ) {
				$props['url'] = esc_url( webpoint_sanitize_var( $image_src[0], 'url', '' ) );
				$props['width'] = esc_attr( webpoint_sanitize_var( $image_src[1], 'absint', '' ) );
				$props['height'] = esc_attr( webpoint_sanitize_var( $image_src[2], 'absint', '' ) );
			}

		} else {

			/* Get placeholder image path */
			$image_path = sprintf(
				'%1$s/assets/img/placeholder/%2$s.png',
				rtrim( get_template_directory(), '/' ),
				$image_size
			);

			/* Filter placeholder image path */
			$image_path = apply_filters(
				'webpoint_placeholder_image_path',
				$image_path,
				$image_size
			);

			/* Check placeholder image exists */
			if ( file_exists( $image_path ) ) {

				/* Get placeholder image source */
				$image_src = sprintf(
					'%1$s/assets/img/placeholder/%2$s.png',
					rtrim( get_template_directory_uri(), '/' ),
					$image_size
				);

				/* Filter placeholder image source */
				$image_src = apply_filters(
					'webpoint_placeholder_image_src',
					$image_src,
					$image_size
				);

				/* Get placeholder image width and height */
				list( $image_width, $image_height ) = getimagesize( $image_path );

				/* Set placeholder image title */
				$props['title'] = __( 'No image available', 'webpoint' );

				/* Set placeholder image alt */
				$props['alt'] = __( 'No image available', 'webpoint' );

				/* Set placeholder image caption */
				$props['caption'] = __( 'No image available', 'webpoint' );

				/* Set placeholder image url */
				$props['url'] = esc_url( $image_src );

				/* Set placeholder image width */
				$props['width'] = esc_attr( webpoint_sanitize_var( $image_width, 'absint', '' ) );

				/* Set placeholder image height */
				$props['height'] = esc_attr( webpoint_sanitize_var( $image_height, 'absint', '' ) );

			} else {
				return false;
			}

		}

		/* Filter image properties */
		$props = apply_filters( 'webpoint_image_data', $props, $image_id, $image_size );

		/* Return image properties */
		return $props;

	} // webpoint_get_image_data();

}


if ( ! function_exists( 'webpoint_get_current_url' ) ) {

	/**
	 * Get current page URL.
	 *
	 * @param bool $clean
	 * @return string|false
	 */
	function webpoint_get_current_url( $clean = true ) {

		/* Get https */
		$https = isset( $_SERVER['HTTPS'] ) ? $_SERVER['HTTPS'] : false;

		/* Get protocol */
		$protocol = ! empty( $https ) && $https != 'off' ? 'https' : 'http';

		/* Get and sanitize server name */
		$server_name = webpoint_sanitize_var( $_SERVER['SERVER_NAME'], 'string', false );
		if ( ! $server_name ) {
			return false;
		}

		/* Get and sanitize server URI */
		$server_uri = webpoint_sanitize_var( $_SERVER['REQUEST_URI'], 'string', '' );

		/* Set url */
		$url = sprintf( '%1$s://%2$s%3$s', $protocol, $server_name, $server_uri );

		/* Return url */
		return $clean ? esc_url( $url ) : $url;

	} // webpoint_get_current_url();

}


if ( ! function_exists( 'webpoint_get_user_role' ) ) {

	/**
	 * Get the user role
	 *
	 * @return string
	 */
	function webpoint_get_user_role() {

		global $current_user;

		/* Return current user role */
		if ( is_user_logged_in() ) {
			if ( is_super_admin() ) {
				return 'superadmin';
			} elseif ( user_can( $current_user, 'administrator' ) ) {
				return 'administrator';
			} elseif ( user_can( $current_user, 'editor' ) ) {
				return 'editor';
			} elseif ( user_can( $current_user, 'author' ) ) {
				return 'author';
			} elseif ( user_can( $current_user, 'contributor' ) ) {
				return 'contributor';
			} elseif ( user_can( $current_user, 'subscriber' ) ) {
				return 'subscriber';
			} else {
				return 'norole';
			}
		} else {
			return false;
		}

	} // webpoint_get_user_role();

}


if ( ! function_exists( 'webpoint_mb_ucfirst' ) ) {

	/**
	 * Set the first letter uppercase.
	 *
	 * @param string $string
	 * @return string
	 */
	function webpoint_mb_ucfirst( $string = '' ) {

		/* Sanitize string */
		$string = webpoint_sanitize_var( $string, 'string', false );
		if ( $string === false || $string === '' ) {
			return '';
		}

		/* Get string length */
		$strlen = mb_strlen( $string, 'UTF-8' );

		/* Get first char */
		$first_char = mb_substr( $string, 0, 1, 'UTF-8' );

		/* Get next chars */
		$then = mb_substr( $string, 1, $strlen - 1, 'UTF-8' );

		/* Return string with uppercase first char */
		return mb_strtoupper( $first_char, 'UTF-8' ) . $then;

	} // webpoint_mb_ucfirst();

}


if ( ! function_exists( 'webpoint_get_post_id_by_title' ) ) {

	/**
	 * Get post ID by title
	 *
	 * @param string $title
	 * @param string $post_type
	 * @return int|false
	 */
	function webpoint_get_post_id_by_title( $title = '', $post_type = 'post' ) {

		global $wpdb;

		/* Sanitize title data type */
		$title = (string) $title;
		if ( $title == '' ) {
			return false;
		}

		/* Sanitize post type */
		$post_type = webpoint_sanitize_var( $post_type, 'term', '' );
		if ( ! $post_type ) {
			return false;
		}

		/* SQL Query: get post ID by title */
		$post_id = $wpdb->get_var(
			$wpdb->prepare( "
				SELECT ID FROM $wpdb->posts
				WHERE post_type = %s
				AND post_title = %s
				ORDER BY ID ASC
			", $post_type, $title )
		);

		/* Return post ID */
		return (int) webpoint_get_post_id( $post_id );

	} // webpoint_get_post_id_by_title();

}


if ( ! function_exists( 'webpoint_get_post_by_title' ) ) {

	/**
	 * Get post object by title
	 *
	 * @param string $title
	 * @param string $post_type
	 * @param string|null $field
	 *
	 * @return object|false
	 */
	function webpoint_get_post_by_title( $title = '', $post_type = 'post', $field = null ) {

		/* Get post ID */
		$post_id = webpoint_get_post_id_by_title( $title, $post_type );

		/* Get post object */
		$post = webpoint_get_post_object( $post_id );

		/* Return post object */
		if ( is_null( $field ) ) {
			return $post;
		}

		/* Sanitize field */
		$field = webpoint_sanitize_var( $field, 'term', '' );
		if ( ! $field ) {
			return false;
		}

		/* Return post object property */
		return isset( $post->{$field} ) ? $post->{$field} : false;

	} // webpoint_get_post_by_title();

}


if ( ! function_exists( 'webpoint_get_post_id_by_meta' ) ) {

	/**
	 * Get post ID by post meta.
	 *
	 * @param string $meta_key
	 * @param string $meta_value
	 * @return integer
	 */
	function webpoint_get_post_id_by_meta( $meta_key = '', $meta_value = '' ) {

		global $wpdb;

		/* Sanitize meta key */
		$meta_key = (string) $meta_key;
		if ( ! $meta_key ) {
			return 0;
		}

		/* Sanitize meta value */
		$meta_value = (string) $meta_value;
		if ( ! $meta_value ) {
			return 0;
		}

		/* SQL Query: get post ID by meta */
		$post_id = $wpdb->get_var(
			$wpdb->prepare( "
				SELECT post_id FROM $wpdb->postmeta
				WHERE meta_key = %s
				AND meta_value = %s
				ORDER BY meta_id ASC
			", $meta_key, $meta_value )
		);

		/* Return post ID */
		return (int) webpoint_get_post_id( $post_id );

	} // webpoint_get_post_id_by_meta();

}


if ( ! function_exists( 'webpoint_get_theme_file_path' ) ) {

	/**
	 * Retrieves the path of a file in the theme.
	 *
	 * @param string $file File to return the path for in the template directory.
	 * @param bool $check Status to check for file existence.
	 * @return string|false The path of the file.
	 */
	function webpoint_get_theme_file_path( $file = '', $check = true ) {

		/* Sanitize file */
		$file = webpoint_sanitize_var( $file, 'string', '' );

		/* Remove first slash */
		$file = ltrim( $file, '/' );

		/* Check file */
		if ( ! $file ) {
			return false;
		}

		/* Set file path */
		$path = get_template_directory() . '/' . $file;

		/* Check file exists */
		if ( $check && ! file_exists( $path ) ) {
			return false;
		}

		/**
		 * Filters the path to a file in the theme.
		 *
		 * @param string $path The file path.
		 * @param string $file The requested file to search for.
		 */
		return apply_filters( 'webpoint_theme_file_path', $path, $file );

	} // webpoint_get_theme_file_path();

}


if ( ! function_exists( 'webpoint_include' ) ) {

	/**
	 * Includes a file.
	 *
	 * @param string $file The requested file to search for.
	 */
	function webpoint_include( $file = '' ) {

		/* Get file path */
		$path = webpoint_get_theme_file_path( $file, false );

		/**
		 * Filters the path to a file in the theme.
		 *
		 * @param string $path The file path.
		 * @param string $file The requested file to search for.
		 */
		$path = apply_filters( 'webpoint_include_file_path', $path, $file );

		/* Check file path */
		if ( ! $path ) {
			return;
		}

		/* Check file exists */
		if ( ! file_exists( $path ) ) {
			return;
		}

		/* Include the file */
		include_once( $path );

	} // webpoint_include();

}


if ( ! function_exists( 'webpoint_get_theme_mod' ) ) {

	/**
	 * Get the current theme modification value.
	 *
	 * @param string $name
	 * @param string $data_type
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	function webpoint_get_theme_mod( $name = null, $data_type = null, $default = false ) {

		/* Sanitize theme modification name */
		$name = webpoint_sanitize_var( $name, 'term', '' );
		if ( ! $name ) {
			return $default;
		}

		/* Get theme modification value */
		$mod = get_theme_mod( $name, $default );
		if ( $mod === $default ) {
			return $default;
		}

		/* Sanitize theme modification value */
		if ( ! is_null( $data_type ) ) {
			$mod = webpoint_sanitize_var( $mod, $data_type, $default );
		}

		/* Filter theme modification value */
		$mod = apply_filters(
			'webpoint_theme_mod',
			$mod,
			$name,
			$data_type,
			$default
		);

		/* Return theme modification value */
		return $mod;

	} // webpoint_get_theme_mod();

}


if ( ! function_exists( 'webpoint_get_theme_dir_name' ) ) {

    /**
     * Get WebPoint Theme Directory Name.
     *
     * @return string
     */
    function webpoint_get_theme_dir_name() {

        return apply_filters( 'webpoint_theme_dir_name', 'webpoint' );

    } // webpoint_get_theme_dir_name();

}


if ( ! function_exists( 'webpoint_get_theme_version' ) ) {

	/**
	 * Get the WebPoint theme version.
	 *
	 * @return string|false
	 */
	function webpoint_get_theme_version() {

		/* Get theme info */
		$theme = wp_get_theme( webpoint_get_theme_dir_name() );

		/* Check theme exists */
		if ( ! $theme->exists() ) {
			return false;
		}

		/* Get current theme version */
		$theme_version = $theme->get( 'Version' );
		if ( $theme_version === false ) {
			return false;
		}

		/* Sanitize theme version */
		$theme_version = webpoint_sanitize_var( $theme_version, 'string', false );

		/* Return theme version */
		return $theme_version;

	} // webpoint_get_theme_version();

}


if ( ! function_exists( 'webpoint_array_insert_after' ) ) {

    /**
     * Insert a value or key/value pair after a specific key in an array.
     * If key doesn't exist, value is appended to the end of the array.
     *
     * @param array $array
     * @param string $key
     * @param array $merge
     *
     * @return array
     */
    function webpoint_array_insert_after( $array = array(), $key = '', $merge = array() ) {

        /* Sanitize vars */
        $array = (array) $array;
        $key   = (string) $key;
        $merge = (array) $merge;

        /* Get array keys */
        $keys = array_keys( $array );

        /* Check key exists */
        $index = array_search( $key, $keys );

        /* Get key position */
        $pos = false === $index ? count( $array ) : $index + 1;

        /* Return merged arrays */
        return array_merge(
            array_slice( $array, 0, $pos ),
            $merge,
            array_slice( $array, $pos )
        );

    } // webpoint_array_insert_after();

}
