/*
 * Comment Validation
 */
jQuery(document).ready(function($) {
    jQuery('#product-infos #atTab a:first').tab('show');

    jQuery('#commentform').validate({
        rules: {
            author: {
                required: (jQuery(this).find('input[name="author"]').attr('aria-required') == 'true' ? true : false),
                minlength: 2
            },
            email: {
                required: (jQuery(this).find('input[name="email"]').attr('aria-required') == 'true' ? true : false),
                email: true
            },
            comment: {
                required: true,
            },
            product_rating: {
                required: true,
            }
        },

        messages: {
            author: product_vars.product_error_author,
            email: product_vars.product_error_email,
            comment: product_vars.product_error_comment,
            product_rating: product_vars.product_rating,
        }
    });

    //#comment-77
    var comment_hash = window.location.hash;
    console.log(comment_hash);
    if (comment_hash.indexOf("comment") >= 0) {
        var tab_comments = jQuery('#product-infos #atTab a[aria-controls="tab-comments"]');
        var comment = jQuery('#product-infos ' + comment_hash);
        tab_comments.tab('show');

        jQuery('html, body').animate({
            scrollTop: comment.offset().top - 100 + 'px'
        }, 1000, 'swing');
    }
});