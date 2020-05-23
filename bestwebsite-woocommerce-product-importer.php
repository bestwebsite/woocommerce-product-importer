<?php /*
    Plugin Name: Bestwebsite Woocommerce Product Importer
    Plugin URI:https://github.com/bestwebsite/bestwebsite-woocommerce-importer
    Description: Free CSV import utility for WooCommerce
    Version: 1.0
    Author: Bestwebsite
    Author URI: https://bestwebsite.com/
    Text Domain: bestwebsite-woocommerce-product-importer  
*/

    
    class Bestwebsite_Woocommerce_Product_Importer {
        
        public function __construct() {
            add_action( 'init', array( 'Bestwebsite_Woocommerce_Product_Importer', 'translations' ), 1 );
            add_action('admin_menu', array('Bestwebsite_Woocommerce_Product_Importer', 'admin_menu'));
            add_action('wp_ajax_bestwebsite-woocommerce-product-importer-ajax', array('Bestwebsite_Woocommerce_Product_Importer', 'render_ajax_action'));
        }

        public static function translations() {
            load_plugin_textdomain( 'bestwebsite-woocommerce-product-importer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }

        public static function admin_menu() {
            add_management_page( __( 'Woo Product Importer', 'bestwebsite-woocommerce-product-importer' ), __( 'Woo Product Importer', 'bestwebsite-woocommerce-product-importer' ), 'manage_options', 'bestwebsite-woocommerce-product-importer', array('Bestwebsite_Woocommerce_Product_Importer', 'render_admin_action'));
        }
        
        public static function render_admin_action() {
            $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'upload';
            require_once(plugin_dir_path(__FILE__).'bestwebsite-woocommerce-product-importer-common.php');
            require_once(plugin_dir_path(__FILE__)."bestwebsite-woocommerce-product-importer-{$action}.php");
        }
        
        public static function render_ajax_action() {
            require_once(plugin_dir_path(__FILE__)."bestwebsite-woocommerce-product-importer-ajax.php");
            die(); // this is required to return a proper result
        }
    }
    
    $Bestwebsite_Woocommerce_product_importer = new Bestwebsite_Woocommerce_Product_Importer();
