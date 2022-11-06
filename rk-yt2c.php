<?php
/**
 * Plugin Name:     YouTube 2-Click-Solution
 * Description:     GDPR conform solution to embed YouTube Videos
 * Version:         0.3
 * Author:          Robert Krampe
 * Author URI:      https://github.com/robertk44
 * Text Domain:     rk-yt2c
 * Domain Path:     /languages
 */

defined('ABSPATH') or die('');

define('COMBY_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('COMBY_PLUGIN_URL', plugin_dir_url(__FILE__));

// Plugin Activation Hook
register_activation_hook(__FILE__, 'rk_yt2c_activate');
function rk_yt2c_activate()
{
}

// init plugin
add_action('plugins_loaded', 'rk_yt2c_init');
function rk_yt2c_init()
{
    // load language files
    // load_plugin_textdomain('rk_yt2c', false, basename(dirname(__FILE__)) . '/languages');
}

function rk_yt2c_the_content($content)
{
    // html template
    $template = '<div class="rk-yt2c-ytvideo">
        <div class="rk-yt2c-ytvideo__overlay"></div>
        <div class="rk-yt2c-ytvideo__content" data-video-id="$3" data-video-url="$1"></div>
        <a href="$1" target="_blank" class="button">Video auf YouTube öffnen (neues Fenster/Tab)</a>
        </div>';
    // search for youtube links
    $content = preg_replace('/<tt class="rk-yt2c-url">(https?\:\/\/(www.)?youtube.com\/watch\?v\=([A-z0-9-_]+).*)<\/tt>/i', $template, $content);

    return $content;
}
add_filter('the_content', 'rk_yt2c_the_content');

add_filter('embed_oembed_html', 'rk_yt2c_process_oembed_html', 99, 4);
function rk_yt2c_process_oembed_html($cached_html, $url, $attr, $post_id)
{
    // disable YouTube embed and return URL only instead, enclosed by a <tt> tag, which we can look for to replace in the_content and to disable wptexturize() for this url
    if (false !== strpos($url, "youtube.com") || false !== strpos($url, "youtu.be")) {
        return '<tt class="rk-yt2c-url">' . $url . '</tt>';
    }

    return $cached_html;
}
