<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) die( '-1' );

define( 'UNICASE_VC_PLUGIN_FILE_PATH', plugin_dir_path( __FILE__ ) );

// Shortcodes
require_once UNICASE_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_unicase_banner.php';
require_once UNICASE_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_unicase_blog_carousel.php';
require_once UNICASE_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_unicase_brands_carousel.php';
require_once UNICASE_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_unicase_product_tabs.php';
require_once UNICASE_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_unicase_product_tabs_carousel.php';
require_once UNICASE_VC_PLUGIN_FILE_PATH . 'include/shortcodes/shortcode_unicase_products_carousel.php';

if( ! class_exists( 'Unicase_VCExtensions' ) ) {
    class Unicase_VCExtensions {

        /**
         * List of paths.
         *
         * @var array
         */
        private $paths = array();

        function __construct() {

            $dir = UNICASE_VC_PLUGIN_FILE_PATH;

            $this->setPaths( Array(
                'APP_ROOT' => $dir,
                'WP_ROOT' => preg_replace( '/$\//', '', ABSPATH ),
                'APP_DIR' => plugin_basename( $dir ),
                'CONFIG_DIR' => $dir . '/config',
                'ASSETS_DIR' => $dir . '/assets',
                'ASSETS_DIR_NAME' => 'assets',
            ) );

            // We safely integrate with VC with this hook
            add_action( 'init', array( $this, 'integrateWithVC' ) );
        }

        public function integrateWithVC() {

            // Check if Visual Composer is installed
            if ( ! defined( 'WPB_VC_VERSION' ) ) {
                // Display notice that Visual Compser is required
                return;
            }

            require_once  $this->path( 'CONFIG_DIR', 'map.php');
        }

        /**
         * Setter for paths
         *
         * @since  4.2
         * @access protected
         * @param $paths
         */
        protected function setPaths( $paths ) {
            $this->paths = $paths;
        }

        /**
         * Gets absolute path for file/directory in filesystem.
         *
         * @since  4.2
         * @access public
         * @param $name        - name of path dir
         * @param string $file - file name or directory inside path
         * @return string
         */
        public function path( $name, $file = '' ) {
            return $this->paths[$name] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );
        }
    }
}

// Finally initialize code
new Unicase_VCExtensions();