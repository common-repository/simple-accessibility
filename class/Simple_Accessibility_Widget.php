<?php
if(!defined('ABSPATH'))  die('You are not allowed to call this page directly.');
/**
 * Simple Accessibility Widget
 *
 * @author Sven Wegner <programmierung@web-mv.de>
 */
class Simple_Accessibility_Widget extends WP_Widget
{
    /**
     * Konstruktor
     */
    public function __construct() 
    {
        parent::__construct('simple_accessibility_widget', __('Simple Accessibility', WEBMV_SA_ADMIN_TEXTDOMAIN));
    }
    /**
     * Widget Formular
     * @param array $instance
     */
    public function form($instance) 
    {
        $defaults = array(
            'title' => ''
        );
        
        $instance = wp_parse_args((array)$instance, $defaults);
        $title = $instance['title'];
        
        printf('<p><label for="%s">%s</label><input class="widefat" id="%s" name="%s" type="text" value="%s" /></p>', $this->get_field_id('title'), __('Titel', RESADS_ADMIN_TEXTDOMAIN), $this->get_field_id('title'), $this->get_field_name('title'), esc_attr($title));
    }
    /**
     * Bearbeitet die Widget Daten
     * @param array $new_instance
     * @param array $old_instance
     * @return array
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        
        $instance['title'] = $new_instance['title'];
        
        return $instance;
    }
    /**
     * Widget Darstellung
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) 
    {
        extract($args);
        
        $title = apply_filters('widget_title', $instance['title']);
        
        print $before_widget;
        
        if(trim($title) != '')
        {
            print $before_title . $title . $after_title;
        }
        
        print '<div class="webmv-sa-widget">';
        
        print Simple_Accessibility::get_menu_template();
        
        print '</div>';
        
        print $after_widget;
    }
}
?>