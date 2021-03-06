<?php
$excludes = array( 1 ); // 未分類ID

if( !is_admin() ) {
    /* Javascript
    * ------------------------------ */
    add_action('wp_enqueue_scripts', 'add_script');
    function register_script(){
        $thema_pass = get_stylesheet_directory_uri();
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery-cdn', '//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), '1.11.3', false);
        wp_register_script( 'lazysizes', $thema_pass .'/js/lazysizes.min.js', array('jquery-cdn'), false, true );
        wp_register_script( 'lazysizes-unveilhooks', $thema_pass .'/js/ls.unveilhooks.min.js', array('jquery-cdn'), false, true );
        wp_register_script( 'uikit', $thema_pass .'/js/uikit.min.js', array(), false, true );
        wp_register_script( 'uikit-icons', $thema_pass .'/js/uikit-icons.min.js', array(), false, true );
        wp_register_script( 'custom', $thema_pass .'/js/custom.js', array('jquery-cdn'), false, true );
        // wp_enqueue_script( 'custom', $thema_pass.'/js/custom.js?'.filemtime( get_stylesheet_directory().'/js/custom.js'), array('jquery-cdn'));
    }
    function add_script() {
        register_script();
        wp_enqueue_script( 'jquery-cdn' );
        wp_enqueue_script( 'lazysizes' );
        wp_enqueue_script( 'lazysizes-unveilhooks' );
        wp_enqueue_script( 'uikit' );
        wp_enqueue_script( 'uikit-icons' );
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
            'taxonomy' => $taxonomy,
            'paged' => get_query_var( 'paged' ),
            'template' => get_page_template()
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
        wp_enqueue_style('uikit', $thema_pass.'/css/uikit.min.css', array(), false, 'all');
//         wp_enqueue_style('style', $thema_pass.'/style.css', array(), false, 'all');
        wp_enqueue_style('style', $thema_pass.'/style.css', array(), filemtime( get_stylesheet_directory().'/style.css' ), 'all');
        // echo '<link rel="shortcut icon" type="image/x-icon" href="'.$thema_pass.'/images/favicon.ico" />'; //ファビコン
        // echo '<link rel="apple-touch-icon" sizes="192x192" href="'.$thema_pass.'/images/touchicon.png" />'; //タッチアイコン
    }
}

add_action( 'wp', 'set_post_pageviews' );
function set_post_pageviews() {
    if( is_single() ) {
        $post_id = get_the_ID();
        $count_key = 'pageviews';
        $count = get_post_meta( $post_id, $count_key, true );
        if ( $count === '' ) {
            $count = 1;
            delete_post_meta( $post_id, $count_key );
            add_post_meta( $post_id, $count_key, $count );
        } elseif( !is_user_logged_in() ) {
            ++$count;
            update_post_meta( $post_id, $count_key, $count );
        }
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

function get_global_navi() {
    $ht = '';
    if ( has_nav_menu( 'primary-menu' ) ) {
        $ht = '<nav class="uk-navbar uk-navbar-transparent none-sp" role="navigation" itemscope="itemscope" itemtype="http://scheme.org/SiteNavigationElement"><div class="uk-navbar-center">';
        $ht .= wp_nav_menu( array(
            'theme_location' => 'primary-menu',
            'container' => false,
            'menu_class' => 'uk-navbar-center uk-navbar-nav',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'echo' => false
        ) );
        $ht .= '</div></nav>';
    }
    return $ht;
}

function get_toggle_navi() {
    $ht = '';
    if ( has_nav_menu( 'primary-menu' ) ) {
        $ht .= '<a href="#offcanvas-slide" class="uk-button uk-button-small" uk-icon="menu" uk-toggle></a>';
        $ht .= '<div id="offcanvas-slide" uk-offcanvas="overlay: true">';
        $ht .= '<div class="uk-offcanvas-bar"><button class="uk-offcanvas-close" type="button" uk-close></button>';
        $ht .= wp_nav_menu( array(
                'theme_location' => 'primary-menu',
                'container' => false,
                'menu_class' => 'uk-nav uk-nav-default',
                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                'echo' => false
            ) );
        $ht .= '</div>';
        $ht .= '</div>';
    }
    return $ht;
}

function get_toggle_navisearch() {
    $ht = '';
    $ht .= '<a href="#offcanvas-flip" class="uk-button uk-button-small" uk-icon="search" uk-toggle></a>';
    $ht .= '<div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">';
    $ht .= '<div class="uk-offcanvas-bar"><button class="uk-offcanvas-close" type="button" uk-close></button>';
    $ht .= '<form role="search" method="get" id="searchform" class="searchform" action="'. home_url() .'">';
    $ht .= '<input type="text" value="" name="s" class="uk-input s" /><input type="submit" class="searchsubmit uk-button uk-button-default" value="検索" />';
    $ht .= '</form>';
    $ht .= '</div>';
    $ht .= '</div>';
    return $ht;
}

function get_footer_navi() {
    $ht = '';
    if ( has_nav_menu( 'primary-menu' ) ) {
        $ht .= wp_nav_menu( array(
            'theme_location' => 'primary-menu',
            'container' => false,
            'menu_class' => 'uk-flex uk-flex-center	uk-grid-small uk-text-center',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'echo' => false
        ) );
    }
    return $ht;
}

// パンくず
function get_breadcrumb() {
    global $post;
    $itemtype = 'http://data-vocabulary.org/Breadcrumb';
    // ポストタイプを取得
    $post_type = get_post_type( $post );

    $bc  = '<ol class="breadcrumb uk-padding-small clearfix">';
    $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.home_url().'" itemprop="url"><span itemprop="title">'.get_bloginfo('name').'</span></a></li>';

    if( is_home() ){
        // メインページ
        $bc .= '<li>最新記事一覧</li>';
    }elseif( is_search() ){
        // 検索結果ページ
        $bc .= '<li>「'.get_search_query().'」の検索結果</li>';
    }elseif( is_404() ){
        // 404ページ
        $bc .= '<li>ページが見つかりませんでした</li>';
    }elseif( is_date() ){
        // 日付別一覧ページ
        $bc .= '<li>';
        if( is_day() ){
            $bc .= get_query_var( 'year' ).'年 ';
            $bc .= get_query_var( 'monthnum' ).'月 ';
            $bc .= get_query_var( 'day' ).'日';
        }elseif( is_month() ){
            $bc .= get_query_var( 'year' ).'年 ';
            $bc .= get_query_var( 'monthnum' ).'月 ';
        }elseif( is_year() ){
            $bc .= get_query_var( 'year' ).'年 ';
        }
        $bc .= '</li>';
    }elseif( is_post_type_archive() ){
        // カスタムポストアーカイブ
        $bc .= '<li>'.post_type_archive_title('', false).'</li>';
    }elseif( is_category() ){
        // カテゴリーページ
        $cat = get_queried_object();
        if( $cat -> parent != 0 ){
            $ancs = array_reverse(get_ancestors( $cat->cat_ID, 'category' ));
            foreach( $ancs as $anc ){
                $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.get_category_link($anc).'" itemprop="url"><span itemprop="title">'.get_cat_name($anc).'</span></a></li>';
            }
        }
        $bc .= '<li>'.$cat->cat_name.'</li>';
    }elseif( is_tag() ){
        // タグページ
        $bc .= '<li>'.single_tag_title("",false).'</li>';
    }elseif( is_author() ){
        // 著者ページ
        $bc .= '<li>'.get_the_author_meta('display_name').'</li>';
    }elseif( is_attachment() ){
        // 添付ファイルページ
        if( $post->post_parent != 0 ){
            $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.get_permalink( $post->post_parent ).'" itemprop="url"><span itemprop="title">'.get_the_title( $post->post_parent ).'</span></a></li>';
        }
        $bc .= '<li>'.$post->post_title.'</li>';
    }elseif( is_singular('post') ){
        // 記事ページ
        $cats = get_the_category( $post->ID );
        global $excludes;
        foreach( (array)$cats as $ct ) {
            if( !in_array( $ct->cat_ID, $excludes ) ) {
                $cat = $ct;
            }
        }
        if( !empty($cat) ) {
            if( $cat->parent != 0 ){
                $ancs = array_reverse(get_ancestors( $cat->cat_ID, 'category' ));
                foreach( $ancs as $anc ){
                    $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.get_category_link( $anc ).'" itemprop="url"><span itemprop="title">'.get_cat_name($anc).'</span></a></li>';
                }
            }
            $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.get_category_link( $cat->cat_ID ).'" itemprop="url"><span itemprop="title">'.$cat->cat_name.'</span></a></li>';
        } else {
            $tags = get_the_tags();
            if( is_array($tags) ) {
                foreach( $tags as $tag ) {
                    $bc .= '<li itemscope="itemscope" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'.get_category_link( $tag->term_id ).'" itemprop="url"><span itemprop="title">'.$tag->name.'</span></a></li>';
                }
            } else {
                $bc .= '';
            }
        }
    }elseif( is_singular('page') ){
        // 固定ページ
        if( $post->post_parent != 0 ){
            $ancs = array_reverse( $post->ancestors );
            foreach( $ancs as $anc ){
                $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.get_permalink( $anc ).'" itemprop="url"><span itemprop="title">'.get_the_title($anc).'</span></a> /';
            }
        }
        $bc .= '<li>'.$post->post_title.'</li>';
    }elseif( is_singular( $post_type ) ){
        // カスタムポスト記事ページ
        $obj = get_post_type_object($post_type);

        if( $obj->has_archive == true ){
            $bc .= '<li itemscope="itemscope" itemtype="'.$itemtype.'"><a href="'.get_post_type_archive_link($post_type).'" itemprop="url"><span itemprop="title">'.get_post_type_object( $post_type )->label.'</span></a></li>';
        }
        $bc .= '<li>'.$post->post_title.'</li>';
    }else{
        // その他のページ
        $bc .= '<li>'.$post->post_title.'</li>';
    }

    $bc .= '</ol>';

    echo $bc;
}

// 記事一覧　タイトル
function get_archve_title() {
    $title = '';
    if( is_category() ) {
        $title = single_cat_title();
    } elseif( is_tag() ) {
        $title = single_tag_title();
    } elseif( is_tax() ) {
        $title = single_term_title();
    } elseif( is_day() ) {
        $title = get_the_time( 'Y年m月d日' );
    } elseif( is_month() ) {
        $title = get_the_time( 'Y年m月' );
    } elseif( is_year() ) {
        $title = get_the_time( 'Y年' );
    } elseif( is_author() ) {
        $author_id = get_the_author_meta( 'ID' );
        $title = '<img class="uk-border-circle uk-padding-small" width="120" height="120" src="'. get_user_avatar_img( $author_id ) .'">';
        $title .= esc_html( get_queried_object()->display_name );
    } elseif( isset( $_GET['paged'] ) && !empty( $_GET['paged'] ) ) {
        $title = 'Archive';
    }
    return $title;
}

function get_archve_meta() {
    $title_meta = '';
    if( is_author() ) {
        $title_meta = '<div class="uk-padding-small">';
        $title_meta .= '<p><span class="uk-margin-small-right">'. get_the_author_posts() .' 記事</span></p>';
        $author_descr = get_the_author_meta( 'description' );
        if( !empty( $author_descr ) ) {
            $title_meta .= '<div class="profile"><p>'. $author_descr .'</p></div>';
        }
        $title_meta .= '</div>';
    }
    return $title_meta;
}

function text_ellipsis( $text, $count ) {
    if ( mb_strlen ( strip_tags ( $text ), 'utf-8' ) > $count ){
        $text = mb_substr( str_replace( '&nbsp;', ' ', strip_tags( $text ) ), 0, $count ) . '...';
    }
    return $text;
}
// SNS TOPページ
function share_site_sns() {
    $ht = '';
    $url = home_url();
    $discript = rawurlencode( get_bloginfo( 'description' ) );
    $ht .= '<ul class="share-sns uk-flex uk-flex-center uk-grid-small uk-margin uk-text-center">';
    $ht .= '<li><a class="facebook" href="http://www.facebook.com/sharer.php?u='. $url .'&amp;t='. $discript .'" target="_blank" rel="nofollow" title="Facebookで共有" uk-icon="facebook"></a></li>';
    $ht .= '<li><a class="twitter" href="https://twitter.com/share?url='. $url .'&amp;text='. $discript .'" target="_blank" rel="nofollow" title="Twitterで共有" uk-icon="twitter"></a></li>';
    $ht .= '<li><a class="linelink" href="http://line.me/R/msg/text/?'. $discript .'%0D%0A'. $url .'" target="_blank" rel="nofollow">LINE</a></li>';
    // $ht .= '<li><a href="http://b.hatena.ne.jp/entry/'. $url .'" data-hatena-bookmark-title="'. $discript .'" target="_blank" rel="nofollow" title="このエントリーをはてなブックマークに追加" uk-icon="twitter"><img src="'.get_stylesheet_directory_uri().'/images/sns/hatenablog40.png" width="40" height="40" alt="このエントリーをはてなブックマークに追加"></a></li>';
    // $ht .= '<li><a href="http://line.me/R/msg/text/?'. $discript .'%0D%0A'. $url .'" target="_blank" rel="nofollow"><img src="'.get_stylesheet_directory_uri().'/images/sns/line80.png" width="40" height="40" alt="LINEで送る" uk-icon="twitter"></a></li>';
    $ht .= '</ul>';
    return $ht;
}

// SNS 記事ページ
function share_post_sns() {
    $ht = '';
    $url =  get_permalink();
    $discript = rawurlencode( get_the_title() );

    $ht .= '<ul class="share-sns uk-flex uk-flex-right uk-grid-small uk-text-center">';
    $ht .= '<li><a class="facebook" href="http://www.facebook.com/sharer.php?u='. $url .'&amp;t='. $discript .'" target="_blank" rel="nofollow" title="Facebookで共有" uk-icon="facebook"></a></li>';
    $ht .= '<li><a class="twitter" href="https://twitter.com/share?url='. $url .'&amp;text='. $discript .'" data-text='. $discript .' target="_blank" rel="nofollow" title="Twitterで共有" uk-icon="twitter"></a></li>';
    $ht .= '<li><a class="linelink" href="http://line.me/R/msg/text/?'. $discript .'%0D%0A'. $url .'" target="_blank" rel="nofollow">LINE</a></li>';
    $ht .= '</ul>';
    return $ht;
}

// categoryの取得
function get_post_category() {
    global $excludes;
    $ht = '';
    $categories = get_the_category();
    if( !empty( $categories ) ) {
        foreach( $categories as $category ) {
            if( !in_array( $category->cat_ID, $excludes ) ) {
                if( $category->parent != 0 ) {
                    $parent = get_term( $category->parent );
                    $ht .= '<span class="post-category text-meta '. $parent->slug .' uk-margin-small-left"><a href="'. get_category_link( $category->parent ) .'">'.  $parent->name .'</a></span>';
                }
                $ht .= '<span class="post-category text-meta '. $category->slug .' uk-margin-small-left"><a href="'. get_category_link( $category->cat_ID ) .'">'. $category->cat_name . '</a></span>';
            }
        }
    }
    return $ht;
}
// authorの取得
function get_post_author() {
    $html = '';
    if( is_single() || is_author() ) {
        $author_id = get_the_author_meta( 'ID' );
        $html = '';
        $html .= '<div class="post-author uk-card uk-card-default">';
        $html .= '<div class="uk-card-header uk-padding-small"><div class="uk-grid-small" uk-grid>';
        $html .= '<div class="uk-width-auto"><img class="uk-border-circle" width="50" height="50" src="'. get_user_avatar_img( $author_id ) .'"></div>';
        $html .= '<div class="uk-width-expand">';
        $html .= '<h2 class="uk-card-title"><a href="'. get_author_posts_url( $author_id ) .'">'. get_the_author_meta( 'nickname' ) .'</a></h2>';
        $html .= '<div class="uk-flex">';
        $html .= '<div class="uk-width-1-3"><span class="uk-text-meta uk-margin-small-right">記事数：'. get_the_author_posts() .'</span></div>';
        $html .= '<div class="uk-width-2-3 uk-text-right">';
        if( !empty( get_the_author_meta( 'twitter' ) ) ) {
            $html .= '<a href="https://twitter.com/'. get_the_author_meta( 'twitter' ) .'" target="_brank" uk-icon="twitter"></a>';
        }
        if( !empty( get_the_author_meta( 'instagram' ) ) ) {
            $html .= '<a href="https://www.instagram.com/'. get_the_author_meta( 'instagram' ) .'" target="_brank" uk-icon="isntagram"></a>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div></div>';
        $author_descr = get_the_author_meta( 'description' );
        if( !empty( $author_descr ) ) {
            $html .= '<div class="uk-text-center icon-arrow-down"><a href="" class="more-toggle" uk-toggle="target: #profile-more; animation: uk-animation-fade">MORE</a></div>';
            $html .= '<div id="profile-more" class="uk-card-body uk-padding-small" hidden><p class="profile uk-text-meta">'. $author_descr .'</p></div>';
        }
        $html .= '</div>';
        $html .= '';
    }
    return $html;
}
//ユーザーアバター取得
function get_user_avatar_img($userid){
	$tmp_img = get_avatar($userid);
	$search = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
	if(preg_match($search, $tmp_img, $url)){
		$author_img = $url[2];
		$author_img = str_replace('-96x96.png', '.png', $author_img);
		// $author_img = '<img src="'.$author_img.'">';
	}else{
		$author_img = get_avatar($userid);
	}
	return $author_img;
}

// tag・taxonomyの表示
function or_get_terms( $taxonomy ) {
    $terms = get_the_terms( $post->ID, $taxonomy );
    if( !empty( $terms ) ) {
        foreach( $terms as $term ) {
            $ht .= '<a href="'. get_category_link( $term->term_id ) .'" itemprop="url">'. $term->name .'</a>';
        }
    } else {
        return false;
    }
    return $ht;
}

