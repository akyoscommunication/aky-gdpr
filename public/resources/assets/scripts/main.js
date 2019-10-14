// // import external dependencies
// import 'jquery';

// // Import everything from autoload
// import "./autoload/**/*"

jQuery(window).load(function () {
    jQuery(window).on('scroll', function () {
        if (jQuery(window).scrollTop() + jQuery(window).height() == jQuery(document).height()) {
            jQuery('#akyCookiesGestion').addClass('active');
        } else {
            jQuery('#akyCookiesGestion').removeClass('active');
        }
    });
});
