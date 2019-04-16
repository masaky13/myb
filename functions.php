<?php
// PHP Files
require_once('functions/init.php');

if( !is_admin() ) {
    /* Javascript
    * ------------------------------ */
    add_action('wp_enqueue_scripts', 'add_script');
    function register_script(){
        $thema_pass = get_template_directory_uri();
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery-cdn', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', false);
        wp_register_script( 'lazysizes', $thema_pass .'/js/lazysizes.min.js', array('jquery-cdn'), false, true );
        wp_register_script( 'lazysizes-unveilhooks', $thema_pass .'/js/ls.unveilhooks.min.js', array('jquery-cdn'), false, true );
        wp_register_script( 'slick', $thema_pass .'/js/slick.min.js', array('jquery-cdn'), false, true );
        wp_register_script( 'iscroll', $thema_pass .'/js/iscroll.js', array('jquery-cdn'), false, true );
        wp_register_script( 'drawer', $thema_pass .'/js/drawer.min.js', array('jquery-cdn'), false, true );
        wp_register_script( 'rellax', $thema_pass .'/js/rellax.min.js', array(), false, true );
        // wp_register_script( 'custom', $thema_pass .'/js/custom.js', array('jquery-cdn'), false, true );
        wp_enqueue_script( 'custom', $thema_pass.'/js/custom.js?'.filemtime( get_stylesheet_directory().'/js/custom.js'), array('jquery-cdn'));
    }
    function add_script() {
        register_script();
        wp_enqueue_script( 'jquery-cdn' );
        wp_enqueue_script( 'lazysizes' );
        wp_enqueue_script( 'lazysizes-unveilhooks' );
        wp_enqueue_script( 'slick' );
        wp_enqueue_script( 'rellax' );
        wp_enqueue_script( 'iscroll' );
        wp_enqueue_script( 'drawer' );
        wp_enqueue_script( 'custom' );
        // JSへ変数受け渡し
        $queried_object = get_queried_object();
        $term = '';
        $taxonomy = '';
        if( isset( $queried_object ) ) {
            $term = $queried_object->slug;
            $taxonomy = $queried_object->taxonomy;
        }
        $sitedata = array(
            'url' => home_url(),
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'term' => $term,
            'taxonomy' => $taxonomy
        );
        wp_localize_script( 'custom', 'sitedata', $sitedata );
    }
    // Javascript 遅延読み込み
    add_filter( 'clean_url', 'add_defer_to_enqueue_script', 11, 1 );
    function add_defer_to_enqueue_script( $url ) {
        if( FALSE === strpos( $url, '.js' ) ) return $url;
        if( strpos( $url, 'jquery.min.js' ) === true ) return $url;
        return "$url' defer charset='UTF-8";
    }
    /* Style
    * ------------------------------ */
    add_action('wp_enqueue_scripts', 'add_style');
    function add_style() {
        $thema_pass = get_stylesheet_directory_uri();
        wp_enqueue_style('normalize', $thema_pass. '/css/normalize.css', array(), false, 'all' );
        wp_enqueue_style('milligram', $thema_pass.'/css/milligram.min.css', array(), false, 'all');
        wp_enqueue_style('drawer', $thema_pass.'/css/drawer.min.css', array(), false, 'all');
        wp_enqueue_style('slick', $thema_pass.'/css/slick.css', array(), false, 'all');
        // wp_enqueue_style('ionicons', 'https://fonts.googleapis.com/icon?family=Material+Icons', array(), false, 'all');
        // wp_enqueue_style('style', $thema_pass.'/style.css', array(), false, 'all');
        wp_enqueue_style('style', $thema_pass.'/style.css', array(), filemtime( get_stylesheet_directory().'/style.css' ), 'all');
        // echo '<link rel="shortcut icon" type="image/x-icon" href="'.$thema_pass.'/images/favicon.ico" />'; //ファビコン
        // echo '<link rel="apple-touch-icon" sizes="192x192" href="'.$thema_pass.'/images/touchicon.png" />'; //タッチアイコン
    }
}

function head_meta_index() {
    if( is_home() && !is_paged() ) {
        $content = 'index,follow';
    } elseif( is_search() or is_404() ) {
        $content = 'noindex,follow';
    } elseif( !is_category() && is_archive() ) {
        $content = 'noindex,follow';
    } elseif( is_paged() ) {
        $content = 'noindex,follow';
    }
    if( !empty( $content ) ) {
        $meta = '<meta name="robots" content="'. $content .'">';
    }
    return $meta;
}

//スマートフォンを判別
function is_mobile(){
    $useragents = array(
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android.*Mobile', // 1.5+ Android *** Only mobile
        'Windows.*Phone', // *** Windows Phone
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

function ajax_loadpost() {
    $term = $_POST['term'];
    $paged = $_POST['paged'];
    if( !empty($term) ) {
        $args = array(
            'post_type' => 'post',
            'category_name' => $term,
            'paged' => $paged
        );
    } else {
        $args = array(
            'paged' => $paged,
            'orderby' => 'post_date',
            'order' => 'DESC',
            'post_type' => 'post'
        );
    }

    $the_query = new WP_Query($args);
    if ( $the_query->have_posts() ) :
        while ( $the_query->have_posts() ) : $the_query->the_post();
        ++$countpost;
        if( ( $count % 4 ) === 0 ) {
            echo '<div class="row">';
            $flg = 1;
        }
        ++$count;
        get_template_part( 'post_list' ); //投稿一覧読み込み
        if( ( $count % 4 ) === 0 ) {
            echo '</div>';
            $flg = 0;
        }
        if( $countpost == $get_post_num ) break;
    endwhile;
    else :
        echo '<p>記事がありません</p>';
    endif;
    if( $flg === 1 ) {
        echo '</div>';
    }
}
add_action('wp_ajax_ajax_loadpost', 'ajax_loadpost');
add_action('wp_ajax_nopriv_ajax_loadpost', 'ajax_loadpost');

// wp_nav_menu()のクラス変更
add_filter( 'nav_menu_css_class', 'nav_menu_add_class', 10, 2 );
function nav_menu_add_class( $classes, $item ) {
    $classes = array();
    $classes[] = 'column';
    if( $item->current == true ) {
        $classes[] = 'current';
    }
    return $classes;
}
