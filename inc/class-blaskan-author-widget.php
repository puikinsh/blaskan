<?php

class Blaskan_Author_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'blaskan_author_widget', // Base ID
			esc_html__( '[Blaskan] Author Widget', 'blaskan' ), // Name
			array( 'description' => esc_html__( 'A widget to show author info', 'blaskan' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 */
	public function widget( $args, $instance ) {

		if ( !isset($instance['author']) ) {
			return;
		}

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}

		if ( $instance['author'] ) {
			
			$user = get_userdata( $instance['author'] );

			if ( !is_wp_error( $user ) && $user ) {
				
				echo '<div class="user-info">';
				echo get_avatar( $user->ID, 75 );

				printf( '<a href="%1$s" title="%2$s" class="author-name" rel="author">%3$s</a>',
			        esc_url( get_author_posts_url( $user->ID ) ),
			        /* translators: %s: author's display name */
			        esc_attr( $user->display_name ),
			        wp_kses_post( $user->display_name )
			    );

			    echo '<p class="author-description">'.wp_kses_post( $user->description ).'</p>';

			}

			$social_menu = ! empty( $instance['social_menu'] ) ? wp_get_nav_menu_object( $instance['social_menu'] ) : false;

			if ( $social_menu ) {
				
				$social_menu_args = array(
					'fallback_cb' 		=> '',
					'menu'        		=> $social_menu,
					'menu_id'    		=> 'social-menu',
					'container_class'	=> 'author-social-menu',
	               	'link_before'  		=> '<span>',
	               	'link_after'   		=> '</span>'
				);

				wp_nav_menu( $social_menu_args );

			}

		}
		
		

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 */
	public function form( $instance ) {
		global $wp_customize;
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'About Author', 'blaskan' );
		$author = ! empty( $instance['author'] ) ? $instance['author'] : 0;
		$social_menu = ! empty( $instance['social_menu'] ) ? $instance['social_menu'] : 0;

		$menus = wp_get_nav_menus();

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'blaskan' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>"><?php esc_attr_e( 'Author:', 'blaskan' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'author' ) ); ?>">
				<option value="0"><?php _e( 'Select an user', 'blaskan' ); ?></option>
				<?php

					$users = get_users();
					foreach ( $users as $user ) {
						echo '<option value="'.esc_attr( $user->ID ).'" '.selected( $user->ID, $author, true ).'>'.esc_html( $user->display_name ).'</option>';
					}

				?>
			</select>
		</p>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.', 'blaskan' ), esc_attr( $url ) ); ?>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social_menu' ) ); ?>"><?php esc_attr_e( 'Social Menu:', 'blaskan' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'social_menu' ); ?>" name="<?php echo $this->get_field_name( 'social_menu' ); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;', 'blaskan' ); ?></option>
				<?php foreach ( $menus as $menu ) : ?>
					<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $social_menu, $menu->term_id ); ?>>
						<?php echo esc_html( $menu->name ); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['author'] ) ) {
			$instance['author'] = (int) $new_instance['author'];
		}
		if ( ! empty( $new_instance['social_menu'] ) ) {
			$instance['social_menu'] = (int) $new_instance['social_menu'];
		}
		return $instance;
	}

}

function blaskan_register_author_widget() {
    register_widget( 'Blaskan_Author_Widget' );
}
add_action( 'widgets_init', 'blaskan_register_author_widget' );