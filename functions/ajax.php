<?php
// require_once( home_url( 'wp-load.php' ) );

add_action('wp_ajax_ajax_loadpost', 'ajax_loadpost');
add_action('wp_ajax_nopriv_ajax_loadpost', 'ajax_loadpost');
function ajax_loadpost() {
    $term = $_POST['term'];
    $paged = $_POST['paged'];
    $template = $_POST['template'];
    if( !empty( $term ) ) {
        $args = array(
            'post_type' => 'post',
            'category_name' => $term,
            'paged' => $paged
        );
    } elseif( strpos( $template, 'photos' ) ) {
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'paged' => $paged
        );
    } else {
        $args = array(
            'post_type' => 'post',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'paged' => $paged
        );
    }

    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();
            get_template_part( 'photo_list' );
        endwhile;
    else :
        echo '<p>記事がありません</p>';
    endif;
}
