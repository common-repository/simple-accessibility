<?php
if(!defined('ABSPATH'))  die('You are not allowed to call this page directly.');
/**
 * Main Simple Accessibility Class
 * 
 * @author Sven Wegner <programmierung@web-mv.de>
 */
if(!class_exists('Simple_Accessibility'))
{
    class Simple_Accessibility 
    {
        /**
         * Konstruktor
         */
        public function __construct() 
        {
            if(is_admin())
            {
                add_action('admin_menu', array(&$this, 'admin_menu'));
                
                add_action('admin_init', array(&$this, 'admin_init'));
                
                add_filter("plugin_action_links_" . WEBMV_SA_PLUGIN_FILE, array(&$this, 'plugin_links'));
            }
            else
            {           
                add_action('init', array(&$this, 'add_scripts'));
            }
            
            add_action('plugins_loaded', array(&$this, 'load_textdomain'));
            
            add_shortcode('simple_accessibility', array(&$this, 'add_shortcode'));   
            
            add_action('widgets_init', array(&$this, 'register_widget'));
        }
        /**
         * Plugin deaktivieren
         */
        public static function activate()
        {
            add_option('webmv_sa_plugin_options', array());
        }
        /**
         * Plugin deaktivieren
         */
        public static function deactivate()
        {
            // do nothing but be here to do anything anytime
        }
        /**
         * Deinstallieren
         */
        public static function uninstall()
        {
            delete_option('webmv_sa_plugin_options');
        }
        /**
         * Upgrade
         */
        public function upgrade()
        {
            // do nothing but be here to do anything anytime
        }
        /**
         * Admin Init
         */
        public function admin_init()
        {
            register_setting('webmv_sa_options', 'webmv_sa_plugin_options', array(&$this, 'validate_options'));
        }
        /**
         * Fueft die Scripts hinzu
         */
        public function add_scripts()
        {
            wp_enqueue_script('webmv_sa', WEBMV_SA_JS_DIR . '/simple-accessibility.js', array('jquery'), false, 'true');
            
            $options = get_option('webmv_sa_plugin_options');
            
            if(isset($options['layer']))
                wp_localize_script('webmv_sa', 'webmv_sa_options', array('layer' => $options['layer'], 'layer_html' => Simple_Accessibility::get_menu_template()));
            
            wp_enqueue_style('webmv_sa', WEBMV_SA_CSS_DIR . '/simple-accessibility.css');
            
            wp_enqueue_style('webmv_sa_font', WEBMV_SA_CSS_DIR . '/font-awesome.css');
        }
        /**
         * Fuegt das Admin Menu hinzu
         */
        public function admin_menu() 
        {
            if(current_user_can(WEBMV_SA_PERMISSION_ROLE))
            {
                add_options_page(__('Simple Accessibility Einstellungen', WEBMV_SA_ADMIN_TEXTDOMAIN), __('Simple Accessibility', WEBMV_SA_ADMIN_TEXTDOMAIN), 'manage_options', 'simple-accessibility', array(&$this, 'add_option_page'));
            }
        }
        /**
         * Fuegt die Optionen-Seite ein
         */
        public function add_option_page()
        {
            $options = get_option('webmv_sa_plugin_options');
            
            if(file_exists(WEBMV_SA_TEMPLATE_DIR . '/options.php'))
                require_once WEBMV_SA_TEMPLATE_DIR . '/options.php';
        }
        /**
         * Ueberprueft die Optionen
         */
        public function validate_options($input)
        {
            return $input;
        }
        /**
         * Gibt das Menu Template wieder
         */
        public static function get_menu_template()
        {
            $return = '<ul class="webmv_sa_ul">
                        <li class="webmv_sa_li"><a class="webmv-sa webmv-sa-color-black-white"><span class="fa fa-tint"></span><span class="webmv-sa-link">' . __('Schwarz-Weiß', WEBMV_SA_ADMIN_TEXTDOMAIN) . '</span></a></li>
                        <li class="webmv_sa_li"><a class="webmv-sa webmv-sa-color-contrast"><span class="fa fa-adjust"></span><span class="webmv-sa-link">' . __('Kontrast', WEBMV_SA_ADMIN_TEXTDOMAIN) . '</span></a></li>
                        <li class="webmv_sa_li"><a class="webmv-sa"><span class="fa fa-repeat"></span><span class="webmv-sa-link">' . __('Zurückstellen', WEBMV_SA_ADMIN_TEXTDOMAIN) . '</span></a></li>
                        <li class="webmv_sa_li"><a><span class="fa fa-plus-circle"></span><span class="webmv-sa-link">' . __('Drücke Strg +', WEBMV_SA_ADMIN_TEXTDOMAIN) . '</span></a></li>
                        <li class="webmv_sa_li"><a><span class="fa fa-minus-circle"></span><span class="webmv-sa-link">' . __('Drücke Strg -', WEBMV_SA_ADMIN_TEXTDOMAIN) . '</span></a></li>
                        </ul>';
            
            return $return;
        }
        /**
         * Shortcode hinzufuegen
         * @return string
         */
        public function add_shortcode()
        {
            return Simple_Accessibility::get_menu_template();
        }
        /**
         * Registriert das Widget
         * @return string
         */
        public function register_widget()
        {
            if(file_exists(WEBMV_SA_CLASS_DIR . '/Simple_Accessibility_Widget.php'))
            {
                require_once WEBMV_SA_CLASS_DIR . '/Simple_Accessibility_Widget.php';
                return register_widget('Simple_Accessibility_Widget');
            }
        }
        /**
         * Setzt die Plugin Admin Links
         * @param array $links
         * @return array
         */
        public function plugin_links($links)
        {
            $settings_link = array(sprintf('<a href="options-general.php?page=%s">%s</a>', WEBMV_SA_PLUGIN_NAME, __('Einstellungen & Hilfe', WEBMV_SA_ADMIN_TEXTDOMAIN))); 
            return array_merge($links, $settings_link);
        }
        /**
         * Lädt die Language Datei
         */
        public function load_textdomain()
        {
            load_plugin_textdomain(WEBMV_SA_ADMIN_TEXTDOMAIN, false, WEBMV_SA_PLUGIN_NAME . '/lang/');
        }
    }
}
?>
