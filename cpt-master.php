<?php
/**
 * Plugin Name: CPT Master
 * Plugin URI: http://domain.com/cpt-master/
 * Description: Hey there! I'm your new starter plugin.
 * Version: 1.0.0
 * Author: Matty
 * Author URI: http://domain.com/
 * Requires at least: 4.0.0
 * Tested up to: 4.0.0
 *
 * Text Domain: cpt-master
 * Domain Path: /languages/
 *
 * @package CPT_Master
 * @category Core
 * @author Matty
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Returns the main instance of CPT_Master to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object CPT_Master
 */
function CPT_Master() {
	return CPT_Master::instance();
} // End CPT_Master()

CPT_Master();

/**
 * Main CPT_Master Class
 *
 * @class CPT_Master
 * @version	1.0.0
 * @since 1.0.0
 * @package	CPT_Master
 * @author Matty
 */
final class CPT_Master {
	/**
	 * CPT_Master The single instance of CPT_Master.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	/**
	 * The plugin directory URL.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_url;

	/**
	 * The plugin directory path.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_path;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * The settings object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $settings;
	// Admin - End

	// Post Types - Start
	/**
	 * The post types we're registering.
	 * @var     array
	 * @access  public
	 * @since   1.0.0
	 */
	public $post_types = array();
	// Post Types - End
	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct () {
		$this->token 			= 'cpt-master';
		$this->plugin_url 		= plugin_dir_url( __FILE__ );
		$this->plugin_path 		= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.0';

		// Admin - Start
		require_once( 'classes/class-cpt-master-settings.php' );
			$this->settings = CPT_Master_Settings::instance();

		if ( is_admin() ) {
			require_once( 'classes/class-cpt-master-admin.php' );
			$this->admin = CPT_Master_Admin::instance();
		}
		// Admin - End

		// Post Types - Start
		require_once( 'classes/class-cpt-master-post-type.php' );
		require_once( 'classes/class-cpt-master-taxonomy.php' );

		// Register an example post type. To register other post types, duplicate this line.
		$this->post_types['cpt-master'] = new CPT_Master_Post_Type( 'cpt-master', __( 'CPT Master', 'cpt-master' ), __( 'CPT Masters', 'cpt-master' ), array( 'menu_icon' => 'dashicons-portfolio' ) );
		// Post Types - End
		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	} // End __construct()

	/**
	 * Main CPT_Master Instance
	 *
	 * Ensures only one instance of CPT_Master is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see CPT_Master()
	 * @return Main CPT_Master instance
	 */
	public static function instance () {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'cpt-master', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	} // End load_plugin_textdomain()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	} // End __clone()

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	} // End __wakeup()

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install () {
		$this->_log_version_number();
	} // End install()

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number () {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	} // End _log_version_number()
} // End Class
?>
