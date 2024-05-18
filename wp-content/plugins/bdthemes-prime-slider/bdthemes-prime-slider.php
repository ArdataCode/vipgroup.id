<?php

/**
 * Plugin Name: Prime Slider (Premium)
 * Plugin URI: https://primeslider.pro/
 * Description: Prime Slider is a packed of elementor widget that gives you some awesome header and slider combination for your website.
 * Version: 3.5.3
 * Update URI: https://api.freemius.com
 * Author: BdThemes
 * Author URI: https://bdthemes.com/
 * Secret Key: 83a5bb0e2ad5164690bc7a42ae592cf5
 * Text Domain: bdthemes-prime-slider
 * Domain Path: /languages
 * License: GPL3
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.11.1
 *
 * @fs_premium_only /assets/vendor/js/gsap.min.js, /assets/vendor/js/SplitText.min.js, /assets/vendor/js/charming.min.js, /assets/vendor/js/anime.min.js, /assets/vendor/js/splitting.min.js, /assets/vendor/js/mThumbnailScroller.min.js, /assets/js/modules/ps-general.js, /assets/js/modules/ps-general.min.js, /assets/js/modules/ps-blog.js, /assets/js/modules/ps-blog.min.js, /assets/js/modules/ps-isolate.js, /assets/js/modules/ps-isolate.min.js, /modules/avatar/, /assets/css/ps-avatar.css, /assets/css/ps-avatar.rtl.css, /assets/js/modules/ps-avatar.js, /assets/js/modules/ps-avatar.min.js, /modules/remote-arrows/, /assets/css/ps-remote-arrows.css, /assets/css/ps-remote-arrows.rtl.css, /assets/js/modules/ps-remote-arrows.js, /assets/js/modules/ps-remote-arrows.min.js, /modules/remote-fraction/, /assets/css/ps-remote-fraction.css, /assets/css/ps-remote-fraction.rtl.css, /assets/js/modules/ps-remote-fraction.js, /assets/js/modules/ps-remote-fraction.min.js, /modules/remote-pagination/, /assets/css/ps-remote-pagination.css, /assets/css/ps-remote-pagination.rtl.css, /assets/js/modules/ps-remote-pagination.js, /assets/js/modules/ps-remote-pagination.min.js, /modules/remote-thumbs/, /assets/css/ps-remote-thumbs.css, /assets/css/ps-remote-thumbs.rtl.css, /assets/js/modules/ps-remote-thumbs.js, /assets/js/modules/ps-remote-thumbs.min.js, /modules/wooexpand/, /assets/css/ps-wooexpand.css, /assets/css/ps-wooexpand.rtl.css, /assets/js/modules/ps-wooexpand.js, /assets/js/modules/ps-wooexpand.min.js, /modules/custom/, /assets/css/ps-custom.css, /assets/css/ps-custom.rtl.css, /modules/woostand/, /assets/css/ps-woostand.css, /assets/css/ps-woostand.rtl.css, /modules/event-calendar/, /assets/css/ps-event-calendar.css, /assets/css/ps-event-calendar.rtl.css, /assets/js/modules/ps-event-calendar.js, /assets/js/modules/ps-event-calendar.min.js, /modules/fluent/, /assets/css/ps-fluent.css, /assets/css/ps-fluent.rtl.css, /assets/js/modules/ps-fluent.js, /assets/js/modules/ps-fluent.min.js, /modules/flexure/, /assets/css/ps-flexure.css, /assets/css/ps-flexure.rtl.css, /assets/js/modules/ps-flexure.js, /assets/js/modules/ps-flexure.min.js, /modules/monster/, /assets/css/ps-monster.css, /assets/css/ps-monster.rtl.css, /assets/js/modules/ps-monster.js, /assets/js/modules/ps-monster.min.js, /modules/marble/, /assets/css/ps-marble.css, /assets/css/ps-marble.rtl.css, /assets/js/modules/ps-marble.js, /assets/js/modules/ps-marble.min.js, /modules/knily/, /assets/css/ps-knily.css, /assets/css/ps-knily.rtl.css, /assets/js/modules/ps-knily.js, /assets/js/modules/ps-knily.min.js, /modules/astoria/, /assets/css/ps-astoria.css, /assets/css/ps-astoria.rtl.css, /assets/js/modules/ps-astoria.js, /assets/js/modules/ps-astoria.min.js, /modules/crossroad/, /assets/css/ps-crossroad.css, /assets/css/ps-crossroad.rtl.css, /assets/js/modules/ps-crossroad.js, /assets/js/modules/ps-crossroad.min.js, /modules/prism/, /assets/css/ps-prism.css, /assets/css/ps-prism.rtl.css, /assets/js/modules/ps-prism.js, /assets/js/modules/ps-prism.min.js, /modules/reveal/, /assets/css/ps-reveal.css, /assets/css/ps-reveal.rtl.css, /assets/js/modules/ps-reveal.js, /assets/js/modules/ps-reveal.min.js, /modules/fortune/, /assets/css/ps-fortune.css, /assets/css/ps-fortune.rtl.css, /assets/js/modules/ps-fortune.js, /assets/js/modules/ps-fortune.min.js, /modules/paranoia/, /assets/css/ps-paranoia.css, /assets/css/ps-paranoia.rtl.css, /assets/js/modules/ps-paranoia.js, /assets/js/modules/ps-paranoia.min.js, /modules/pieces/, /assets/css/ps-pieces.css, /assets/css/ps-pieces.rtl.css, /assets/js/modules/ps-pieces.js, /assets/js/modules/ps-pieces.min.js, /modules/escape/, /assets/css/ps-escape.css, /assets/css/ps-escape.rtl.css, /assets/js/modules/ps-escape.js, /assets/js/modules/ps-escape.min.js, /modules/coddle/, /assets/css/ps-coddle.css, /assets/css/ps-coddle.rtl.css, /assets/js/modules/ps-coddle.js, /assets/js/modules/ps-coddle.min.js, /modules/woohotspot/, /assets/css/ps-woohotspot.css, /assets/css/ps-woohotspot.rtl.css, /assets/js/modules/ps-woohotspot.js, /assets/js/modules/ps-woohotspot.min.js
 */

if ( function_exists( 'bdt_ps' ) ) {
    bdt_ps()->set_basename( true, __FILE__ );
} else {
    
    if ( !function_exists( 'bdt_ps' ) ) {
        // Create a helper function for easy SDK access.
        function bdt_ps()
        {
            global  $bdt_ps ;
            
            if ( !isset( $bdt_ps ) ) {
				
				class bdtpsFsNull {
					public function is__premium_only() {
						return true;
					}
					public function is_plan() {
						return 'agency';
					}
				}
				$bdt_ps = new bdtpsFsNull();
            }
            
            return $bdt_ps;
        }
        
        // Init Freemius.
        bdt_ps();
        // Signal that SDK was initiated.
        do_action( 'bdt_ps_loaded' );
    }
    
    // Some pre define value for easy use
    define( 'BDTPS_VER', '3.5.3' );
    define( 'BDTPS__FILE__', __FILE__ );
    // Helper function here
    include dirname( __FILE__ ) . '/includes/helper.php';
    include dirname( __FILE__ ) . '/includes/utils.php';
    /**
     * Plugin load here correctly
     * Also loaded the language file from here
     */
    function prime_slider_load_plugin()
    {
        load_plugin_textdomain( 'bdthemes-prime-slider', false, basename( dirname( __FILE__ ) ) . '/languages' );
        
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', 'prime_slider_fail_load' );
            return;
        }
        
        // Filters for developer
        require BDTPS_PATH . 'includes/prime-slider-filters.php';
        // Prime Slider widget and assets loader
        require BDTPS_PATH . 'loader.php';
        // Notice class
        require BDTPS_ADMIN_PATH . 'admin-notice.php';
    }
    
    add_action( 'plugins_loaded', 'prime_slider_load_plugin' );
    /**
     * Check Elementor installed and activated correctly
     */
    function prime_slider_fail_load()
    {
        $screen = get_current_screen();
        if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
            return;
        }
        $plugin = 'elementor/elementor.php';
        
        if ( _is_elementor_installed() ) {
            if ( !current_user_can( 'activate_plugins' ) ) {
                return;
            }
            $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
            $admin_message = '<p>' . esc_html__( 'Ops! Prime Slider not working because you need to activate the Elementor plugin first.', 'bdthemes-prime-slider' ) . '</p>';
            $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'bdthemes-prime-slider' ) ) . '</p>';
        } else {
            if ( !current_user_can( 'install_plugins' ) ) {
                return;
            }
            $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
            $admin_message = '<p>' . esc_html__( 'Ops! Prime Slider not working because you need to install the Elementor plugin', 'bdthemes-prime-slider' ) . '</p>';
            $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'bdthemes-prime-slider' ) ) . '</p>';
        }
        
        echo  '<div class="error">' . $admin_message . '</div>' ;
    }
    
    /**
     * Check the elementor installed or not
     */
    if ( !function_exists( '_is_elementor_installed' ) ) {
        function _is_elementor_installed()
        {
            $file_path = 'elementor/elementor.php';
            $installed_plugins = get_plugins();
            return isset( $installed_plugins[$file_path] );
        }
    
    }
}
/* Anti-Leecher Identifier */
/* Credited By BABIATO-FORUM */
