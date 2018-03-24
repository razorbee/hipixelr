<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Elements_Settings' ) ) {

	/**
	 * Define Jet_Elements_Settings class
	 */
	class Jet_Elements_Settings {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		public $key      = 'jet-elements-settings';
		public $builder  = null;
		public $settings = null;

		/**
		 * Init page
		 */
		public function init() {

			$this->init_builder();

			add_action( 'admin_menu', array( $this, 'register_page' ), 99 );
			add_action( 'init', array( $this, 'save' ), 40 );
			add_action( 'admin_notices', array( $this, 'saved_notice' ) );

		}

		/**
		 * Initialize page builder module if reqired
		 *
		 * @return [type] [description]
		 */
		public function init_builder() {

			if ( isset( $_REQUEST['page'] ) && $this->key === $_REQUEST['page'] ) {
				$this->builder = jet_elements()->get_core()->init_module( 'cherry-interface-builder', array() );
			}

		}

		/**
		 * Show saved notice
		 *
		 * @return bool
		 */
		public function saved_notice() {

			if ( ! isset( $_GET['settings-saved'] ) ) {
				return false;
			}

			$message = esc_html__( 'Settings saved', 'jet-elements' );

			printf( '<div class="notice notice-success is-dismissible"><p>%s</p></div>', $message );

			return true;

		}

		/**
		 * Save settings
		 *
		 * @return void
		 */
		public function save() {

			if ( ! isset( $_REQUEST['page'] ) || $this->key !== $_REQUEST['page'] ) {
				return;
			}

			if ( ! isset( $_REQUEST['action'] ) || 'save-settings' !== $_REQUEST['action'] ) {
				return;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$current = get_option( $this->key, array() );
			$data    = $_REQUEST;

			unset( $data['action'] );

			foreach ( $data as $key => $value ) {
				$current[ $key ] = is_array( $value ) ? $value : esc_attr( $value );
			}

			update_option( $this->key, $current );

			$redirect = add_query_arg(
				array( 'dialog-saved' => true ),
				$this->get_settings_page_link()
			);

			wp_redirect( $redirect );
			die();

		}

		/**
		 * Return settings page URL
		 *
		 * @return string
		 */
		public function get_settings_page_link() {

			return add_query_arg(
				array(
					'page' => $this->key,
				),
				esc_url( admin_url( 'admin.php' ) )
			);

		}

		public function get( $setting, $default = false ) {

			if ( null === $this->settings ) {
				$this->settings = get_option( $this->key, array() );
			}

			return isset( $this->settings[ $setting ] ) ? $this->settings[ $setting ] : $default;

		}

		/**
		 * Register add/edit page
		 *
		 * @return void
		 */
		public function register_page() {

			add_submenu_page(
				'elementor',
				esc_html__( 'Jet Elements Settings', 'jet-elements' ),
				esc_html__( 'Jet Elements Settings', 'jet-elements' ),
				'manage_options',
				$this->key,
				array( $this, 'render_page' )
			);

		}

		/**
		 * Render settings page
		 *
		 * @return void
		 */
		public function render_page() {

			$this->builder->register_section(
				array(
					'jet_elements_settings' => array(
						'type'   => 'section',
						'scroll' => false,
						'title'  => esc_html__( 'Jet Elements Settings', 'jet-elements' ),
					),
				)
			);

			$this->builder->register_form(
				array(
					'jet_elements_settings_form' => array(
						'type'   => 'form',
						'parent' => 'jet_elements_settings',
						'action' => add_query_arg(
							array( 'page' => $this->key, 'action' => 'save-settings' ),
							esc_url( admin_url( 'admin.php' ) )
						),
					),
				)
			);

			$this->builder->register_settings(
				array(
					'settings_top' => array(
						'type'   => 'settings',
						'parent' => 'jet_elements_settings_form',
					),
					'settings_bottom' => array(
						'type'   => 'settings',
						'parent' => 'jet_elements_settings_form',
					),
				)
			);

			$this->builder->register_control(
				array(
					'api_key' => array(
						'type'        => 'text',
						'id'          => 'api_key',
						'name'        => 'api_key',
						'parent'      => 'settings_top',
						'value'       => $this->get( 'api_key' ),
						'title'       => esc_html__( 'API Key:', 'jet-elements' ),
						'placeholder' => esc_html__( 'API key', 'jet-elements' ),
						'description' => sprintf(
							esc_html__( 'Create own API key here %s', 'tm_builder' ),
							make_clickable( 'https://developers.google.com/maps/documentation/javascript/get-api-key' )
						)
					),
					'disable_api_js' => array(
						'type'        => 'checkbox',
						'id'          => 'disable_api_js',
						'name'        => 'disable_api_js',
						'parent'      => 'settings_top',
						'value'       => $this->get( 'disable_api_js' ),
						'options'     => array( 'disable' => esc_html__( 'Disable', 'jet-elements' ), ),
						'title'       => esc_html__( 'Disable Maps API JS file:', 'jet-elements' ),
						'description' => esc_html__( 'Disable Google Maps API JS file, if it already included by another plugin or theme', 'jet-elements' ),
					),
					'svg_uploads' => array(
						'type'        => 'select',
						'id'          => 'svg_uploads',
						'name'        => 'svg_uploads',
						'parent'      => 'settings_top',
						'value'       => $this->get( 'svg_uploads', 'enabled' ),
						'options'     => array(
							'enabled'  => esc_html__( 'Enabled', 'jet-elements' ),
							'disabled' => esc_html__( 'Disabled', 'jet-elements' ),
						),
						'title'       => esc_html__( 'SVG images upload status:', 'jet-elements' ),
						'description' => esc_html__( 'Enable or disable SVG images uploading', 'jet-elements' ),
					),
				)
			);

			$this->builder->register_html(
				array(
					'save_button' => array(
						'type'   => 'html',
						'parent' => 'settings_bottom',
						'class'  => 'cherry-control dialog-save',
						'html'   => '<button type="submit" class="button button-primary">' . esc_html__( 'Save', 'jet-elements' ) . '</button>',
					),
				)
			);

			echo '<div class="jet-elements-settings-page">';
				$this->builder->render();
			echo '</div>';

		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of Jet_Elements_Settings
 *
 * @return object
 */
function jet_elements_settings() {
	return Jet_Elements_Settings::get_instance();
}

jet_elements_settings()->init();
