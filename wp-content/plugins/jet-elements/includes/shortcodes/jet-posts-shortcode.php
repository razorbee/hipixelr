<?php
/**
 * Posts shortcode class
 */
class Jet_Posts_Shortcode extends Jet_Elements_Shortcode_Base {

	/**
	 * Shortocde tag
	 *
	 * @return string
	 */
	public function get_tag() {
		return 'jet-posts';
	}

	/**
	 * Shortocde attributes
	 *
	 * @return array
	 */
	public function get_atts() {

		$columns = jet_elements_tools()->get_select_range( 6 );

		return apply_filters( 'jet-elements/shortcodes/jet-posts/atts', array(
			'number' => array(
				'type'       => 'number',
				'label'      => esc_html__( 'Posts Number', 'jet-elements' ),
				'default'    => 3,
				'min'        => -1,
				'max'        => 30,
				'step'       => 1,
			),
			'columns' => array(
				'type'       => 'select',
				'responsive' => true,
				'label'      => esc_html__( 'Columns', 'jet-elements' ),
				'default'    => 3,
				'options'    => $columns,
			),
			'columns_tablet' => array(
				'default' => 2,
			),
			'columns_mobile' => array(
				'default' => 1,
			),
			'equal_height_cols' => array(
				'label'        => esc_html__( 'Equal Columns Height', 'jet-elements' ),
				'type'         => 'switcher',
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'true',
				'default'      => '',
			),
			'post_type'   => array(
				'type'       => 'select',
				'label'      => esc_html__( 'Post Type', 'jet-elements' ),
				'default'    => 'post',
				'options'    => jet_elements_tools()->get_post_types(),
			),
			'posts_query' => array(
				'type'       => 'select',
				'label'      => esc_html__( 'Query posts by', 'jet-elements' ),
				'default'    => 'latest',
				'options'    => array(
					'latest'   => esc_html__( 'Latest Posts', 'jet-elements' ),
					'category' => esc_html__( 'From Category', 'jet-elements' ),
					'ids'      => esc_html__( 'By Specific IDs', 'jet-elements' ),
				),
				'condition' => array(
					'post_type' => array( 'post' ),
				),
			),
			'post_ids' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Set comma seprated IDs list (10, 22, 19 etc.)', 'jet-elements' ),
				'default'   => '',
				'condition' => array(
					'posts_query' => array( 'ids' ),
					'post_type'   => array( 'post' ),
				),
			),
			'post_cat' => array(
				'type'       => 'select2',
				'label'      => esc_html__( 'Category', 'jet-elements' ),
				'default'    => '',
				'multiple'   => true,
				'options'    => jet_elements_tools()->get_categories(),
				'condition' => array(
					'posts_query' => array( 'category' ),
					'post_type'   => array( 'post' ),
				),
			),
			'show_title' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Title', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),

			'title_trimmed' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Title Word Trim', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => array(
					'show_title' => 'yes',
				),
			),

			'title_length' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Title Length', 'jet-elements' ),
				'default'   => 5,
				'min'       => 1,
				'max'       => 50,
				'step'      => 1,
				'condition' => array(
					'title_trimmed' => 'yes',
				),
			),

			'title_trimmed_ending_text' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Title Trimmed Ending', 'jet-elements' ),
				'default'   => '...',
				'condition' => array(
					'title_trimmed' => 'yes',
				),
			),

			'show_image' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Featured Image', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
			'show_image_as' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Show Featured Image As', 'jet-elements' ),
				'default'     => 'image',
				'label_block' => true,
				'options'     => array(
					'image'      => esc_html__( 'Simple Image', 'jet-elements' ),
					'background' => esc_html__( 'Box Background', 'jet-elements' ),
				),
				'condition' => array(
					'show_image' => array( 'yes' ),
				),
			),
			'bg_size' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Background Image Size', 'jet-elements' ),
				'label_block' => true,
				'default'     => 'cover',
				'options'     => array(
					'cover'   => esc_html__( 'Cover', 'jet-elements' ),
					'contain' => esc_html__( 'Contain', 'jet-elements' ),
				),
				'condition'   => array(
					'show_image'    => array( 'yes' ),
					'show_image_as' => array( 'background' ),
				),
			),
			'bg_position' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Background Image Position', 'jet-elements' ),
				'label_block' => true,
				'default'     => 'center center',
				'options'     => array(
					'center center' => esc_html__( 'Center Center', 'Background Control', 'jet-elements' ),
					'center left'   => esc_html__( 'Center Left', 'Background Control', 'jet-elements' ),
					'center right'  => esc_html__( 'Center Right', 'Background Control', 'jet-elements' ),
					'top center'    => esc_html__( 'Top Center', 'Background Control', 'jet-elements' ),
					'top left'      => esc_html__( 'Top Left', 'Background Control', 'jet-elements' ),
					'top right'     => esc_html__( 'Top Right', 'Background Control', 'jet-elements' ),
					'bottom center' => esc_html__( 'Bottom Center', 'Background Control', 'jet-elements' ),
					'bottom left'   => esc_html__( 'Bottom Left', 'Background Control', 'jet-elements' ),
					'bottom right'  => esc_html__( 'Bottom Right', 'Background Control', 'jet-elements' ),
				),
				'condition'   => array(
					'show_image'    => array( 'yes' ),
					'show_image_as' => array( 'background' ),
				),
			),
			'thumb_size' => array(
				'type'       => 'select',
				'label'      => esc_html__( 'Featured Image Size', 'jet-elements' ),
				'default'    => 'post-thumbnail',
				'options'    => jet_elements_tools()->get_image_sizes(),
				'condition' => array(
					'show_image'    => array( 'yes' ),
					'show_image_as' => array( 'image' ),
				),
			),
			'show_excerpt' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Excerpt', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
			'excerpt_length' => array(
				'type'       => 'number',
				'label'      => esc_html__( 'Excerpt Length', 'jet-elements' ),
				'default'    => 20,
				'min'        => 1,
				'max'        => 300,
				'step'       => 1,
				'condition' => array(
					'show_excerpt' => array( 'yes' ),
				),
			),
			'show_meta' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Meta', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
			'show_author' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Author', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => array(
					'show_meta' => array( 'yes' ),
				),
			),
			'show_date' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Date', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => array(
					'show_meta' => array( 'yes' ),
				),
			),
			'show_comments' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Posts Comments', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => array(
					'show_meta' => array( 'yes' ),
				),
			),
			'show_more' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Show Read More Button', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
			'more_text' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Read More Button Text', 'jet-elements' ),
				'default'   => esc_html__( 'Read More', 'jet-elements' ),
				'condition' => array(
					'show_more' => array( 'yes' ),
				),
			),
			'more_icon' => array(
				'type'      => 'icon',
				'label'     => esc_html__( 'Read More Button Icon', 'jet-elements' ),
				'condition' => array(
					'show_more' => array( 'yes' ),
				),
			),
			'columns_gap' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Add gap between columns', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
			'rows_gap' => array(
				'type'         => 'switcher',
				'label'        => esc_html__( 'Add gap between rows', 'jet-elements' ),
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			),
		) );

	}

	/**
	 * Query posts by attributes
	 *
	 * @return object
	 */
	public function query() {

		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $this->get_attr( 'number' ) ),
		);

		$post_type = $this->get_attr( 'post_type' );

		if ( ! $post_type ) {
			$post_type = 'post';
		}

		$query_args['post_type'] = $post_type;

		if ( 'post' === $post_type ) {
			switch ( $this->get_attr( 'posts_query' ) ) {

				case 'category':

					if ( '' !== $this->get_attr( 'post_cat' ) ) {
						$query_args['category__in'] = explode( ',', $this->get_attr( 'post_cat' ) );
					}

					break;

				case 'ids':

					if ( '' !== $this->get_attr( 'post_ids' ) ) {
						$query_args['post__in'] = explode(
							',',
							str_replace( ' ', '', $this->get_attr( 'post_ids' ) )
						);
					}
					break;
			}
		}

		return new WP_Query( $query_args );
	}

	/**
	 * Posts shortocde function
	 *
	 * @param  array  $atts Attributes array.
	 * @return string
	 */
	public function _shortcode( $content = null ) {

		$query = $this->query();

		if ( ! $query->have_posts() ) {
			$not_found = $this->get_template( 'not-found' );
		}

		$loop_start = $this->get_template( 'loop-start' );
		$loop_item  = $this->get_template( 'loop-item' );
		$loop_end   = $this->get_template( 'loop-end' );

		global $post;

		ob_start();

		/**
		 * Hook before loop start template included
		 */
		do_action( 'jet-elements/shortcodes/jet-posts/loop-start' );

		include $loop_start;

		while ( $query->have_posts() ) {

			$query->the_post();
			$post = $query->post;

			setup_postdata( $post );

			/**
			 * Hook before loop item template included
			 */
			do_action( 'jet-elements/shortcodes/jet-posts/loop-item-start' );

			include $loop_item;

			/**
			 * Hook after loop item template included
			 */
			do_action( 'jet-elements/shortcodes/jet-posts/loop-item-end' );

		}

		include $loop_end;

		/**
		 * Hook after loop end template included
		 */
		do_action( 'jet-elements/shortcodes/jet-posts/loop-end' );

		wp_reset_postdata();

		return ob_get_clean();

	}

	/**
	 * Add box backgroud image
	 */
	public function add_box_bg() {

		if ( 'yes' !== $this->get_attr( 'show_image' ) ) {
			return;
		}

		if ( 'background' !== $this->get_attr( 'show_image_as' ) ) {
			return;
		}

		if ( ! has_post_thumbnail() ) {
			return;
		}

		$thumb_id  = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_url( $thumb_id, 'full' );

		printf(
			' style="background-image: url(\'%1$s\');background-repeat:no-repeat;background-size: %2$s;background-position: %3$s;"',
			$thumb_url,
			$this->get_attr( 'bg_size' ),
			$this->get_attr( 'bg_position' )
		);

	}

}
