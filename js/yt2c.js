jQuery(function() {
    // check if user already agreed to loading YouTube videos
    let rk_yt2c_accepted = localStorage.getItem('rk-yt2c-accepted');
    if (rk_yt2c_accepted == 'true') {
        jQuery('.rk-yt2c-ytvideo__show-always').prop('checked', true);
        jQuery('.rk-yt2c-ytvideo').each(function (i) {
            yt2cEnableYoutubeVideo(jQuery(this));
        });
    }
    jQuery('.rk-yt2c-ytvideo__accept-button').on('click', function (event) {
        let yt2c = jQuery(this).closest('.rk-yt2c-ytvideo');
        let remember = yt2c.find('.rk-yt2c-ytvideo__remember').is(':checked');
        if (remember) {
            localStorage.setItem('rk-yt2c-accepted', 'true');
            jQuery('.rk-yt2c-ytvideo__show-always').prop('checked', true);
        }
        yt2cEnableYoutubeVideo(yt2c);
    });
    jQuery('.rk-yt2c-ytvideo__show-always').on('change', function (event) {
        if (jQuery(this).is(':checked')) {
            localStorage.setItem('rk-yt2c-accepted', 'true');
        } else {
            localStorage.removeItem('rk-yt2c-accepted');
        }
    });
});

function yt2cEnableYoutubeVideo(yt2c) {
    let video = yt2c.find('.rk-yt2c-ytvideo__video');
    let videourl = yt2c.data('video-embed');
    video.find('iframe').attr('src', videourl);
    yt2c.toggleClass('rk-yt2c-ytvideo--enabled');
}
