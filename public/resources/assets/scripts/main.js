// // import external dependencies
// import 'jquery';

// // Import everything from autoload
// import "./autoload/**/*"

jQuery(window).on('load', function () {
    jQuery(window).on('scroll', function () {
        if (jQuery(window).scrollTop() + jQuery(window).height() > jQuery(document).height() - 100) {
            jQuery('#akyCookiesGestion').addClass('active');
        } else {
            jQuery('#akyCookiesGestion').removeClass('active');
        }
    });
});
