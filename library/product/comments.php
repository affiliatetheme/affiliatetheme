<?php
/*
 * Kommentare Template
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	helper
 */

$i=0;
function at_product_comments_template($comment, $args, $depth) {
    global $i;
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    ?>

    <?php if($i!=0 && $depth==1) : echo '<hr class="clearfix">'; endif; ?>

<div <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
    <div class="media">
        <div class="media-left">
            <?php echo get_avatar( get_comment_author_email(), 48 ); ?>
        </div>
        <div class="media-body">
            <p class="media-heading">
                <?php if(get_comment_author_url()!=""){ ?> <a href="<?php comment_author_url(); ?>" target="_blank" rel="nofollow"><?php comment_author(); ?></a> <?php } else { comment_author();  } ?>
                <?php printf( __('<small class="pull-right">%1$s um %2$s</small>'), get_comment_date(),  get_comment_time()) ?>
            </p>

            <?php if ($comment->comment_approved == '0') : ?>
                <small class="text-muted comment-awaiting-moderation"><?php _e('Dein Kommentar wartet auf Freischaltung.', 'affiliatetheme') ?></small>
            <?php endif; ?>

            <?php
            $rating = get_comment_meta( $comment->comment_ID, 'product_rating', true );
            if($rating) {
                ?>
                <div class="product-rating pull-right">
                    <?php echo at_get_star_rating($rating); ?>
                </div>
            <?php
            }
            ?>

            <?php comment_text() ?>

            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>
    </div>
    <?php
    $i++;
}

add_action('comment_post', 'at_save_product_comment_meta_data');
function at_save_product_comment_meta_data( $comment_id ) {
    if (isset($_POST['product_rating'])) {
        $rating_price = wp_filter_nohtml_kses($_POST['product_rating']);
        add_comment_meta($comment_id, 'product_rating', $rating_price);
    }
}

add_action( 'add_meta_boxes_comment', 'at_product_comment_add_meta_box' );
function at_product_comment_add_meta_box() {
    global $comment;
    $post = $comment->comment_post_ID;
    if(get_post_type($post) != 'product') {
        return;
    }

    $product_single_show_user_rating = get_field('product_single_show_user_rating', 'option');
    if($product_single_show_user_rating != '1') {
        return;
    }

    add_meta_box( 'title', __( 'Bewertung', 'affiliatetheme-backend' ), 'at_product_extend_comment_meta_box', 'comment', 'normal', 'high' );
}

function at_product_extend_comment_meta_box ( $comment ) {
    $product_rating = get_comment_meta( $comment->comment_ID, 'product_rating', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    if($product_rating) {
        ?>
        <p>
            <label for="product_rating"><?php _e( 'Bewertung' ); ?></label>
            <?php echo at_get_star_rating($product_rating); ?>
        </p>
        <?php
    }
}

add_action('comment_form_logged_in_after', 'at_product_comment_fields');
function at_product_comment_fields() {
    $product_single_show_user_rating = get_field('product_single_show_user_rating', 'option');
    if($product_single_show_user_rating != '1') {
        return;
    }

    if(get_post_type() != 'product') {
        return;
    }
    ?>
    <div class="row">
        <div class="form-group col-sm-12">
            <label class="control-label"><?php _e('Bewertung *', 'affiliatetheme'); ?></label>
            <div class="comment-respond-rating">
                <span class="rating">
                    <input type="radio" class="rating-input" id="product_rating-5" value="5" name="product_rating"/>
                    <label for="product_rating-5" class="rating-star"></label>
                    <input type="radio" class="rating-input" id="product_rating-4" value="4" name="product_rating"/>
                    <label for="product_rating-4" class="rating-star"></label>
                    <input type="radio" class="rating-input" id="product_rating-3" value="3" name="product_rating"/>
                    <label for="product_rating-3" class="rating-star"></label>
                    <input type="radio" class="rating-input" id="product_rating-2" value="2" name="product_rating"/>
                    <label for="product_rating-2" class="rating-star"></label>
                    <input type="radio" class="rating-input" id="product_rating-1" value="1" name="product_rating"/>
                    <label for="product_rating-1" class="rating-star"></label>
                </span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-12">
            <label for="comment" class="control-label"><?php echo __( 'Kommentar', 'affiliatetheme' ); ?></label>
            <textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true"></textarea>
        </div>
    </div>
    <?php
}

add_filter( 'preprocess_comment', 'at_product_verify_rating_data' );
function at_product_verify_rating_data( $commentdata ) {
    if(is_admin()) {
        return $commentdata;
    }

    if($commentdata['comment_parent']) {
        return $commentdata;
    }

    $post_id = $commentdata['comment_post_ID'];
    if(get_post_type($post_id) != 'product') {
        return $commentdata;
    }

    $product_single_show_user_rating = get_field('product_single_show_user_rating', 'option');
    if($product_single_show_user_rating != '1') {
        return $commentdata;
    }

    $error = '';

    if ( ! isset( $_POST['product_rating'] ) )
        {$error .=  __( 'Bitte bewerte dieses Produkt<br>', 'affiliatetheme' );}

    if($error) {
        wp_die($error);
    }

    return $commentdata;
}

add_action('comment_post', 'at_product_process_comment_submit', 99, 3);
function at_product_process_comment_submit( $comment_ID, $comment_approved, $commentdata ) {
    $post_id = $commentdata['comment_post_ID'];
    if(get_post_type($post_id) != 'product') {
        return;
    }

    $product_single_show_user_rating = get_field('product_single_show_user_rating', 'option');
    if($product_single_show_user_rating != '1') {
        return;
    }

    if (isset($_POST['product_rating']) && 1 === $comment_approved) {
        $product_rating = $_POST['product_rating'];
        $c_product_rating = get_post_meta($post_id, 'product_rating', true);
        $c_product_rating_raw = (int) get_post_meta($post_id, 'product_rating_raw', true);
        $c_product_rating_cnt = (int) get_post_meta($post_id, 'product_rating_cnt', true);

        if($c_product_rating_raw == 0 && $c_product_rating > 0) {
            $c_product_rating_raw = $c_product_rating;
        }

        if($c_product_rating_cnt >= 1) {
            $new_product_rating = (($c_product_rating_raw * $c_product_rating_cnt) + $product_rating) / ($c_product_rating_cnt + 1);
        } else {
            $new_product_rating = $product_rating;
        }

        $new_product_rating_cnt = intval($c_product_rating_cnt) + 1;

        update_post_meta($post_id, 'product_rating', round($new_product_rating * 2) / 2);
        update_post_meta($post_id, 'product_rating_raw', $new_product_rating);
        update_post_meta($post_id, 'product_rating_cnt', $new_product_rating_cnt);
    }
}

add_action('transition_comment_status', 'at_product_process_comment_status', 10, 3);
function at_product_process_comment_status( $new_status, $old_status, $comment ) {
    $post_id = $comment->comment_post_ID;
    if(get_post_type($post_id) != 'product') {
        return;
    }

    $product_single_show_user_rating = get_field('product_single_show_user_rating', 'option');
    if($product_single_show_user_rating != '1') {
        return;
    }

    if($old_status == $new_status) {
        return;
    }

    $product_rating = get_comment_meta($comment->comment_ID, 'product_rating', true);

    if ($product_rating && 'approved' == $new_status ) {
        $c_product_rating = get_post_meta($post_id, 'product_rating', true);
        $c_product_rating_raw = get_post_meta($post_id, 'product_rating_raw', true);
        $c_product_rating_cnt = get_post_meta($post_id, 'product_rating_cnt', true);

        if($c_product_rating_raw == 0 && $c_product_rating > 0) {
            $c_product_rating_raw = $c_product_rating;
        }

        if($c_product_rating_cnt >= 1) {
            $new_product_rating = (($c_product_rating_raw * $c_product_rating_cnt) + $product_rating) / ($c_product_rating_cnt + 1);
        } else {
            $new_product_rating = $product_rating;
        }

        $new_product_rating_cnt = intval($c_product_rating_cnt) + 1;

        update_post_meta($post_id, 'product_rating', round($new_product_rating * 2) / 2);
        update_post_meta($post_id, 'product_rating_raw', $new_product_rating);
        update_post_meta($post_id, 'product_rating_cnt', $new_product_rating_cnt);
    }

    if ($product_rating && 'approved' !== $new_status ) {
        $c_product_rating = get_post_meta($post_id, 'product_rating', true);
        $c_product_rating_raw = get_post_meta($post_id, 'product_rating_raw', true);
        $c_product_rating_cnt = get_post_meta($post_id, 'product_rating_cnt', true);

        if($c_product_rating_raw == 0 && $c_product_rating > 0) {
            $c_product_rating_raw = $c_product_rating;
        }

        if($c_product_rating_cnt >= 1) {
            $new_product_rating = (($c_product_rating_raw * $c_product_rating_cnt) - $product_rating) / ($c_product_rating_cnt - 1);
            $new_product_rating_cnt = intval($c_product_rating_cnt) - 1;
        } else {
            $new_product_rating_cnt = 0;
            $new_product_rating = 0;
        }

        update_post_meta($post_id, 'product_rating', round($new_product_rating * 2) / 2);
        update_post_meta($post_id, 'product_rating_raw', $new_product_rating);
        update_post_meta($post_id, 'product_rating_cnt', $new_product_rating_cnt);
    }
}

add_action('delete_comment', 'at_product_process_comment_delete', 99, 1);
function at_product_process_comment_delete($comment_id) {
    $commentdata = get_comment($comment_id);

    $post_id = $commentdata->comment_post_ID;
    if(get_post_type($post_id) != 'product') {
        return;
    }

    $product_single_show_user_rating = get_field('product_single_show_user_rating', 'option');
    if($product_single_show_user_rating != '1') {
        return;
    }

    $product_rating = get_comment_meta($comment_id, 'product_rating', true);

    if($product_rating) {
        $c_product_rating = get_post_meta($post_id, 'product_rating_raw', true);
        $c_product_rating_cnt = get_post_meta($post_id, 'product_rating_cnt', true);

        if($c_product_rating_cnt >= 1) {
            $new_product_rating = (($c_product_rating * $c_product_rating_cnt) - $product_rating) / ($c_product_rating_cnt - 1);
            $new_product_rating_cnt = intval($c_product_rating_cnt) - 1;
        } else {
            $new_product_rating_cnt = 0;
            $new_product_rating = 0;
        }

        update_post_meta($post_id, 'product_rating', round($new_product_rating * 2) / 2);
        update_post_meta($post_id, 'product_rating_raw', $new_product_rating);
        update_post_meta($post_id, 'product_rating_cnt', $new_product_rating_cnt);
    }
}
?>