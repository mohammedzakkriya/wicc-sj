<?php /* Menu Functions */

if ( ! defined( 'ABSPATH' ) ) {
	exit; /* Exit if accessed directly */
}


if ( ! function_exists( 'webpoint_wp_nav_menu_args_cb' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'wp_nav_menu_args', 'webpoint_wp_nav_menu_args_cb' );

	/**
	 * Modify wp_nav_menu args.
     *
     * @param array $args
     * @return array
     */
	function webpoint_wp_nav_menu_args_cb( $args ) {

	    /* Set args */
		$args['link_before'] = '<span class="item-text">';
		$args['link_after'] = '</span>';

		/* Return args */
		return $args;

	} // webpoint_wp_nav_menu_args_cb();

}


if ( ! function_exists( 'webpoint_nav_menu_text_item' ) && ! function_exists( 'webpoint_nav_menu_text_item_html' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'wp_nav_menu', 'webpoint_nav_menu_text_item' );

	/**
	 * Replace empty links with text items in nav menus.
     *
     * @param string $nav_menu
     * @return string
	 */
	function webpoint_nav_menu_text_item( $nav_menu ) {

		/* Replace empty links */
		$nav_menu = preg_replace_callback(
			'#<a>(.*?)</a>#si',
			'webpoint_nav_menu_text_item_html',
			$nav_menu
		);

		/* Return nav menu HTML */
		return $nav_menu;

	} // webpoint_nav_menu_text_item();

    /**
     * Returns a nav menu text item HTML.
     *
     * @param array $matches
     * @return string
     */
    function webpoint_nav_menu_text_item_html( $matches = array() ) {

        /* Return text item */
        return sprintf(
            '<span class="item">%s</span>',
            isset( $matches[1] ) ? $matches[1] : ''
        );

    } // webpoint_nav_menu_text_item_html();

}


if ( ! function_exists( 'webpoint_fix_nav_menu_objects' ) && ! function_exists( 'webpoint_fix_nav_object' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'wp_nav_menu_objects', 'webpoint_fix_nav_menu_objects' );

	/**
	 * Remove not published items from nav menus.
     *
     * @param array $objects
     * @return array
	 */
	function webpoint_fix_nav_menu_objects( $objects ) {

        /* Get current user role */
		$user_role = webpoint_get_user_role();

        /* Return original menu for admins and editors */
		if ( $user_role && ( $user_role == 'superadmin' || $user_role == 'administrator' || $user_role == 'editor' ) ) {
			return $objects;
		}

        /* Remove not published items */
		if ( is_array( $objects ) && ! empty( $objects ) ) {
			$not_pub = array();
			foreach ( $objects as $obj_key => $object ) {
				if ( is_object( $object ) ) {
					if ( $object->type == 'post_type' ) {
						$status = get_post_status( $object->object_id );
						if ( $status != 'publish' ) {
							$not_pub[] = $object->ID;
							unset( $objects[$obj_key] );
						}
					}
				} else {
					continue;
				}
			}

			$objects = webpoint_fix_nav_object( $objects, $not_pub );
		}

		return $objects;

	} // webpoint_fix_nav_menu_objects

    /* Additional function */
	function webpoint_fix_nav_object( $objects, $not_pub = array() ) {

		if ( is_array( $objects ) && ! empty( $objects ) && ! empty( $not_pub ) ) {

			foreach ( $objects as $obj_key => $object ) {
				if ( is_object( $object ) ) {
					if ( in_array( $object->menu_item_parent, $not_pub ) ) {
						$temp_not_pub[] = $object->ID;
						unset( $objects[$obj_key] );
					}
				} else {
					continue;
				}
			}

			if ( ! empty( $temp_not_pub ) ) {
				$objects = webpoint_fix_nav_object( $objects, $temp_not_pub );
			}
		}

		return $objects;

	} // webpoint_fix_nav_object

}


if ( ! function_exists( 'webpoint_top_menu' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_top_menu', 40 );

	/**
	 * Display the Top Menu.
	 */
	function webpoint_top_menu() {

		/* Check top menu exists */
		if ( ! has_nav_menu( 'top_menu' ) ) {
			return;
		} ?>

        <div id="top-menu" class="clearfix">

            <?php wp_nav_menu( array(
				'theme_location' => 'top_menu',
				'menu' => '',
				'container' => '',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => 'menu clearfix',
				'menu_id' => 'top_menu',
				'echo' => true,
				'before' => '',
				'after' => '',
				'link_before' => '<span class="item-text">',
				'link_after' => '</span>',
				'depth' => 2
			) ); ?>

        </div><!-- #top-menu -->

	<?php } // webpoint_top_menu();

}


if ( ! function_exists( 'webpoint_user_menu' ) ) {

	/* Hook the function to an action. */
	add_action( 'webpoint_header', 'webpoint_user_menu', 70 );

	/**
	 * Display the User Menu.
	 */
	function webpoint_user_menu() {

		/* Check user menu exists */
		if ( ! has_nav_menu( 'user_menu' ) ) {
			return;
		} ?>

        <div id="user-menu" class="clearfix">

            <ul id="user_menu" class="menu clearfix">

                <li class="menu-item menu-item-has-children">

                    <?php $current_user = wp_get_current_user(); ?>

                    <?php if ( ! isset( $current_user->ID ) || ! $current_user->ID ) : ?>

                        <?php $login_url = esc_url( wp_login_url( esc_url ( webpoint_get_login_redirect_to_url() ) ) ); ?>

                        <span class="user" data-href="<?php echo $login_url; ?>">
							<i class="fa fa-user"></i>
                            <span class="user-name"><?php _e(
		                            'User profile',
		                            'webpoint'
	                            ); ?></span>
						</span><!-- .user -->

                        <ul class="sub-menu">

                            <li class="menu-item">
								<?php printf(
									'<span data-href="%1$s">%2$s</span>',
									$login_url,
									__( 'Sign in', 'webpoint' )
								); ?>
                            </li><!-- .menu-item -->

                            <?php if ( get_option( 'users_can_register' ) ) : ?>
	                            <?php printf(
		                            '<li class="menu-item"><span data-href="%1$s">%2$s</span></li>',
		                            esc_url( site_url( 'wp-login.php?action=register&redirect_to=' . esc_url ( webpoint_get_login_redirect_to_url() ) ) ),
		                            __( 'Sign up', 'webpoint' )
	                            ); ?>
                            <?php endif; ?>

                        </ul><!-- .sub-menu -->

					<?php else : ?>

						<?php $user_name = trim( $current_user->display_name ); ?>

                        <span class="user" data-href="<?php echo esc_url( get_edit_user_link() ); ?>">
                            <i class="fa fa-user"></i>
                            <span class="user-name"><?php echo esc_html( $user_name ); ?></span>
                        </span><!-- .user -->

						<?php wp_nav_menu( array(
							'theme_location' => 'user_menu',
							'menu' => '',
							'container' => '',
							'container_class' => '',
							'container_id' => '',
							'menu_class' => 'sub-menu',
							'menu_id' => 'usermenu',
							'echo' => true,
							'before' => '',
							'after' => '',
							'link_before' => '<span class="item-text">',
							'link_after' => '</span>',
							'depth' => 1
						) ); ?>

					<?php endif; ?>

                </li><!-- .menu-item .menu-item-has-children -->

            </ul><!-- #user_menu -->

        </div><!-- #user-menu -->

	<?php } // webpoint_user_menu();

}


if ( ! function_exists( 'webpoint_main_menu' ) ) {

	/* Hook the function to an action. */
    add_action( 'webpoint_header', 'webpoint_main_menu', 230 );

	/**
	 * Display Main Menu.
	 */
	function webpoint_main_menu() {

		/* Check main menu exists */
		if ( ! has_nav_menu( 'main_menu' ) ) {
			return;
		} ?>

        <div id="main-menu" class="clearfix">

            <?php wp_nav_menu( array(
				'theme_location' => 'main_menu',
				'menu' => '',
				'container' => '',
				'container_class' => '',
				'container_id' => '',
				'menu_class' => 'menu clearfix',
				'menu_id' => 'main_menu',
				'echo' => true,
				'before' => '',
				'after' => '',
				'link_before' => '<span class="item-text">',
				'link_after' => '</span>',
				'depth' => 2
			) ); ?>

        </div><!-- #main-menu -->

	<?php } // webpoint_main_menu();

}


if ( ! function_exists( 'webpoint_get_login_redirect_to_url' ) ) {

	/**
	 * Get the redirect url for the login menu.
	 *
	 * @return string
	 */
	function webpoint_get_login_redirect_to_url() {

		/* Get redirect url */
		$redirect_to = webpoint_get_current_url();

		/* Check WebPoint Login Plugin activation and page type */
		if ( ! class_exists( 'WebPoint_Login' ) || ! is_page() ) {
			return $redirect_to;
		}

		/* Set page slugs */
		$slugs = array(
			'login',
			'register',
			'password-lost',
			'password-reset'
		);

		/* Check the current page slug */
		foreach( $slugs as $slug ) {
			if ( is_page( $slug ) ) {
				$redirect_to = '';
			}
		}

		/* Return redirect url */
		return $redirect_to;

	} // webpoint_get_login_redirect_to_url();

}


if ( ! function_exists( 'webpoint_user_menu_logout_item' ) ) {

	/* Hook the function to a filter action. */
	add_filter( 'wp_nav_menu_items', 'webpoint_user_menu_logout_item', 10, 2 );

	/**
	 * Add logout item to user menu.
	 *
	 * @param string $items
	 * @param stdClass $args
	 * @return string
	 */
	function webpoint_user_menu_logout_item( $items, $args ) {

		/* Check menu */
		if ( $args->theme_location != 'user_menu' ) {
			return $items;
		}

		/* Add logout item */
		$items .= sprintf(
			'<li class="menu-item"><a href="%1$s"><span class="item-text">%2$s</span></a></li>',
			esc_url( wp_logout_url( esc_url( webpoint_get_current_url() ) ) ),
			__( 'Logout', 'webpoint' )
		);

		/* Return menu items */
		return $items;

	} // webpoint_user_menu_logout_item();

}
