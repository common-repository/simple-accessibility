/**
 * Moegliche Css Klassen
 * @type Array
 */
var webmv_sa_css_types = ['webmv-sa-color-black-white','webmv-sa-color-contrast'];
/**
 * Setzt die Body Klasse je nachdem, welche Farbe gewuenscht ist.
 */
jQuery(document).ready(function() 
{
    jQuery('.webmv-sa').click(function() 
    {
        var class_string = jQuery(this).attr('class');
        var classes = class_string.split(' ');
        var count_classes = classes.length;

        if(count_classes > 1)
        {
            for(i=0; i < count_classes; i++)
            {
                if(classes[i].indexOf('webmv-sa-color') !== -1)
                {
                    var color = classes[i];
                    jQuery('body').removeClass(webmv_sa_css_types.join(' ')).addClass(color);
                    setCookie('webmv_sa_color', color, 30);
                    return;
                }
            }
            
            jQuery('body').removeClass(webmv_sa_css_types.join(' '));
            setCookie('webmv_sa_color', '', 0);
        }
        else
        {
            jQuery('body').removeClass(webmv_sa_css_types.join(' '));
            setCookie('webmv_sa_color', '', 0);
        }
    });
});
/**
 * Prueft ob ein Cookie gesetzt ist und passt dann die Body Klasse an
 */
jQuery(document).ready(function()
{
    var color = getCookie('webmv_sa_color');
    if(color != "")
    {
        jQuery('body').removeClass(webmv_sa_css_types.join(' ')).addClass(color);
    }
});
/**
 * Setzt einen Cookie
 * @param {string} cname
 * @param {string} cvalue
 * @param {int} exdays
 * @returns {undefined}
 */
function setCookie(cname, cvalue, exdays) 
{
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires + ";path=/";
} 
/**
 * Gibt einen Cookie wieder
 * @param {string} cname
 * @returns {String}
 */
function getCookie(cname) 
{
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) 
    {
        var c = ca[i];
        while (c.charAt(0)==' ') 
        {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) 
        {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}
/**
 * Baut den Layer
 */
if(typeof webmv_sa_options !== 'undefined' && typeof webmv_sa_options.layer !== 'undefined' && typeof webmv_sa_options.layer_html !== 'undefined')
{
    var layer = webmv_sa_options.layer;
    var layer_html = webmv_sa_options.layer_html;
    if(layer == 1)
    {
         jQuery('<div>')
                .html(layer_html)
                .addClass('webmv_sa_layer_div')
                .prependTo('body');
    }
}