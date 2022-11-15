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
    $replacement_type = 'iframe';
    // html template
    if ($replacement_type == 'link') {
        $template = '<div class="rk-yt2c-ytvideo">
            <div class="rk-yt2c-ytvideo__overlay"></div>
            <div class="rk-yt2c-ytvideo__content" data-video-id="$3" data-video-url="$1"></div>
            <a href="$1" target="_blank" class="button">Video auf YouTube öffnen (neues Fenster/Tab)</a>
            </div>';
    }
    if ($replacement_type == 'iframe') {
        $template = '<div class="rk-yt2c-ytvideo" data-video-id="$3"
                data-video-url="$1" data-video-embed="https://www.youtube-nocookie.com/embed/$3">
                <div class="rk-yt2c-ytvideo__container">
                    <div class="rk-yt2c-ytvideo__placeholder">
                        <button class="rk-yt2c-ytvideo__accept-button"><span class="rk-yt2c-ytvideo__play-icon">&#9654;</span>Abspielen</button>
                        <div class="rk-yt2c-ytvideo__disclaimer">
                            <p><b>Hinweis:</b> Dieses eingebettete Video wird von YouTube bereitgestellt.<br>Beim Abspielen wird eine Verbindung zu den Servern von YouTube hergestellt.
                            Dabei wird YouTube mitgeteilt, welche Seiten Sie besuchen. Wenn Sie in Ihrem YouTube-Account eingeloggt sind, kann YouTube Ihr Surfverhalten Ihnen persönlich zuzuordnen.
                            Dies verhindern Sie, indem Sie sich vorher aus Ihrem YouTube-Account ausloggen.</p>
                            <p>Wird ein YouTube-Video gestartet, setzt der Anbieter Cookies ein, die Hinweise über das Nutzerverhalten sammeln.</p>
                            <p>YouTube legt auch in weiteren Cookies nicht-personenbezogene Nutzungsinformationen ab.
                            Möchten Sie dies verhindern, so müssen Sie das Speichern von Cookies im Browser blockieren.</p>
                            <p>Weitere Informationen zum Datenschutz bei YouTube finden Sie in der Datenschutzerklärung des Anbieters unter: <a href="https://www.google.de/intl/de/policies/privacy/" rel="noopener" target="_blank">https://www.google.de/intl/de/policies/privacy/</a></p>
                        </div>
                    </div>
                    <div class="rk-yt2c-ytvideo__video">
                        <iframe width="100%" height="100%" src=""
                            frameborder="0" allow="accelerometer;
                            encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>';
    }
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

add_action('wp_enqueue_scripts', 'rk_yt2c_enqueue_scripts');
function rk_yt2c_enqueue_scripts()
{
    wp_register_style('rk-yt2c-style', plugins_url('/css/yt2c.css', __FILE__), [], '0.4');
    wp_enqueue_style('rk-yt2c-style');
    wp_enqueue_script('rk-yt2c-script', plugins_url('/js/yt2c.js', __FILE__), ['jquery'], '0.4');
}
