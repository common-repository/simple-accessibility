<?php
/**
 * Plugin Name: Simple Accessibility
 * Plugin URI: 
 * Description: Make your website accessibility with just a few clicks.
 * Version: 1.0.3
 * Author: Sven Wegner by web-mv.de
 * Author URI: http://www.web-mv.de
 */

if(!defined('ABSPATH'))
    die(__('Something went wrong.'));

if(!defined('WEBMV_SA_VERSION_KEY'))
    define('WEBMV_SA_VERSION_KEY', 'webmv_sa_version');

if(!defined('WEBMV_SA_VERSION_NUM'))
    define('WEBMV_SA_VERSION_NUM', '1.0.1');

if(!defined('WEBMV_SA_PLUGIN_NAME'))
    define('WEBMV_SA_PLUGIN_NAME', trim(dirname(plugin_basename (__FILE__))));

if(!defined('WEBMV_SA_PLUGIN_DIR'))
    define('WEBMV_SA_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . WEBMV_SA_PLUGIN_NAME . '/');

if(!defined('WEBMV_SA_PLUGIN_FILE'))
    define('WEBMV_SA_PLUGIN_FILE', plugin_basename(__FILE__));

if(!defined('WEBMV_SA_PLUGIN_URL'))
    define('WEBMV_SA_PLUGIN_URL', WP_PLUGIN_URL . '/' . WEBMV_SA_PLUGIN_NAME . '/');

if(!defined('WEBMV_SA_CLASS_DIR'))
    define('WEBMV_SA_CLASS_DIR', WEBMV_SA_PLUGIN_DIR . 'class');

if(!defined('WEBMV_SA_TEMPLATE_DIR'))
    define('WEBMV_SA_TEMPLATE_DIR', WEBMV_SA_PLUGIN_DIR . '/templates');

if(!defined('WEBMV_SA_JS_DIR'))
    define('WEBMV_SA_JS_DIR', WEBMV_SA_PLUGIN_URL . 'js');

if(!defined('WEBMV_SA_CSS_DIR'))
    define('WEBMV_SA_CSS_DIR', WEBMV_SA_PLUGIN_URL . 'css');

if(!defined('WEBMV_SA_IMG_DIR'))
    define('WEBMV_SA_IMG_DIR', WEBMV_SA_PLUGIN_DIR . 'img');

if(!defined('WEBMV_SA_ADMIN_TEXTDOMAIN'))
    define('WEBMV_SA_ADMIN_TEXTDOMAIN', 'webmv_sa');

if(!defined('WEBMV_SA_PERMISSION_ROLE'))
    define('WEBMV_SA_PERMISSION_ROLE', 'administrator');

require_once WEBMV_SA_CLASS_DIR . '/Simple_Accessibility.php';

if(class_exists('Simple_Accessibility'))
{
    /** Installation */
    register_activation_hook(__FILE__, array('Simple_Accessibility', 'activate'));
    register_deactivation_hook(__FILE__, array('Simple_Accessibility', 'deactivate'));
    register_uninstall_hook(__FILE__, array('Simple_Accessibility', 'uninstall'));
    
    /** Instance */
    $Simple_Accessibility = new Simple_Accessibility();
    
    /** Upgrade */
    $Simple_Accessibility->upgrade();
}
?>