(function($) {
    // toggle top admin bar
    Mousetrap.bindGlobal('esc', function() {
        if (1 === $('#wpadminbar').length) {
            $('#wpadminbar').slideToggle('fast');
        }
    });
    
    // go to admin page
    Mousetrap.bindGlobal('alt+x', function() {
        var wpAdmin = '';
        if (1 === $('#wp-admin-bar-dashboard a').length) {
            wpAdmin = $('#wp-admin-bar-dashboard a').attr('href');
        }
        else {
            // might not work with plugins that hide the admin page, this is our best guess for now
            wpAdmin = akSiteUrl + '/wp-admin';
        }
        if (wpAdmin) window.location.replace(wpAdmin);
    });
    
    // admin-wide add new Post
    Mousetrap.bind('shift+n', function() {
        window.location.replace(akAdminUrl + 'post-new.php');
    });
    
})(jQuery);