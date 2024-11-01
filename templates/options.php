<?php if(!defined('ABSPATH'))  die('You are not allowed to call this page directly.'); ?>
<div class="wrap" id="webmv-sa-einstellungen">   
    <h2><?php _e('Simple Accessibility', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></h2>
    <hr />
    <h3><?php _e('So funktioniert es', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></h3>
    <div>
        <p><?php _e('Mit mindestens einer dieser Methoden kannst Du "Simple Accessibility" in deine Webseite einfügen:', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></p>
        <ol>
            <li><?php _e('Gehe in "Widgets" und platziere das Widget "Simple Accessiblity" in deine Sidebar', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></li>
            <li>
                <?php _e('Füge diesen Code an eine beliebige Stelle in dein Wordpress Theme ein:', WEBMV_SA_ADMIN_TEXTDOMAIN); ?>
<pre>
if(class_exists('Simple_Accessiblity')) {
    echo Simple_Accessibility::get_menu_template(); 
}
</pre>
            </li>
            <li><?php _e('Füge den Shortcode "[simple_accessibility]" in einen Beitrag ein', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></li>
            <li><?php _e('Aktiviere die "Layer" Option', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></li>
        </ol>
    </div>
    <hr />
    <h3><?php _e('Einstellungen', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></h3>
    <div>
        <form method="post" action="options.php">
            <?php settings_fields( 'webmv_sa_options' ); ?>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php _e('Layer', WEBMV_SA_ADMIN_TEXTDOMAIN); ?></th>
                        <td><?php printf('<input type="checkbox" name="webmv_sa_plugin_options[layer]" value="1" %s />', (isset($options['layer']) && $options['layer'] == 1) ? 'checked="checked"' : ''); ?></td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
</div>