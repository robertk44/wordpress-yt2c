jQuery(function() {
    jQuery('.rk-yt2c-ytvideo__accept-button').on('click', function (event) {
        let yt2c = jQuery(this).closest('.rk-yt2c-ytvideo');
        let placeholder = jQuery(this).closest('.rk-yt2c-ytvideo__placeholder');
        let video = yt2c.find('.rk-yt2c-ytvideo__video');
        let videourl = yt2c.data('video-embed');
        video.find('iframe').attr('src', videourl);
        placeholder.hide();
        video.show();
    });
});
