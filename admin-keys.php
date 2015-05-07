<?php if (! defined('ABSPATH')) exit;
/*
Plugin Name: Admin Keys
Plugin URI: https://wordpress.org/plugins/admin-keys/
Description: Admin Keys provide intuitive admin keyboard shortcuts for accessibility and efficiency
Author: joesat, jhned
Version: 1.3.0
Author URI: https://profiles.wordpress.org/joesat/
License: GPL2
*/

class admin_keys
{
    const AK_NS = 'akeys_';
    const AK_VERSION = '1.3.0';
    const AK_SHORT_NAME = 'Admin Keys';
    const AK_FULL_NAME = 'Admin Keys';

    protected $tmpl_dir;

    /**
     * class constructor - sets up hooks
     *
     * @since 1.0.0
     */
    function __construct()
    {
        $this->tmpl_dir = dirname(__FILE__) . '/tmpl/';
        add_action( 'init', array( $this, 'init' ) );
        add_action( 'wp_head', array( $this, 'get_header' ) );

        if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
            add_action( 'admin_head', array( $this, 'get_header' ) );
            add_action( 'init', array( $this, 'set_help_tab' ) );
            add_action( 'admin_footer', array( $this, 'add_modal' ) );
            add_filter( 'admin_footer_text', array( $this, 'add_modal_link'), 999 );
        }
    }

    /**
     * queue javascript files
     *
     * @since 1.0.0
     */
    public function init()
    {
        // load js
        wp_enqueue_script( self::AK_NS . 'akjsmt', plugins_url( '/assets/js/mousetrap.min.js' , __FILE__ ), array(), self::AK_VERSION, true );
        wp_enqueue_script( self::AK_NS . 'akjsmtg', plugins_url( '/assets/js/mousetrap-global-bind.min.js' , __FILE__ ), array(), self::AK_VERSION, true );

        if ( ! is_admin() && is_user_logged_in() ) {
            // load js for public-facing pages
            //wp_enqueue_script( self::AK_NS . 'akjsp', plugins_url( '/assets/js/public.js', __FILE__ ), array(), self::AK_VERSION, true );
        }
        elseif ( is_admin() ) {
            // load admin utility
            wp_enqueue_script( self::AK_NS . 'akjsa', plugins_url( '/assets/js/admin.js', __FILE__ ), array(), self::AK_VERSION, true );
            wp_enqueue_style( self::AK_NS . 'akcssa', plugins_url( '/assets/css/admin.css', __FILE__ ), array(), self::AK_VERSION, 'screen' );
        }
    }

    /**
     * initialize javascript variable of the base WP install path
     *
     * @since 1.0.0
     */
    public function get_header ()
    {
        echo '<script type="text/javascript">var akSiteUrl = "' .  get_site_url() . '", akAdminUrl = "' . get_admin_url() . '";</script>';
    }

    /**
     * add admin menu - under settings
     *
     * @since 1.0.0
     *
     */
    function set_menu() {
        add_options_page( self::AK_SHORT_NAME . ' Options', self::AK_SHORT_NAME, 'manage_options', self::AK_NS, array( $this, 'set_options' ) );
    }

    /**
     * renders plugin form options/settings page
     *
     * @since 1.0
     *
     */
    function set_options() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }

        // include form
        require_once( $this->tmpl_dir . 'options.php' );
    }

    /**
     * renders plugin help tab
     *
     * @since 1.1
     *
     */
    function set_help_tab() {

    	require_once( $this->tmpl_dir . 'help-tab.php' );

    }

    /**
     * renders plugin help modal
     *
     * @since 1.1
     *
     */
    function add_modal() {

    	require_once( $this->tmpl_dir . 'modal-popup.php' );

    }

    /**
     * renders plugin help modal
     *
     * @since 1.1
     *
     */
    function add_modal_link($text) {

    	return $text . ' <a href="#TB_inline?width=600&height=550&inlineId=admin-keys-modal" id="admin-keys-modal-trigger" class="thickbox">Admin Shortcuts</a>';

    }


}

// instantiate the plugin
if ( ! defined( 'DOING_AJAX' ) ) {
    $admin_keys = new admin_keys();
}
