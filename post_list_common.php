<?php
/**
* サイドバー等
*/
?>
<?php
    $args = array( 'post_type' => 'post', 'post_count' => 10 );
    $the_query = new WP_Query( $args );
?>
<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="uk-flex uk-card uk-card-default uk-margin-small">
        <div class="post-image uk-width-1-4 uk-cover-container uk-margin-small uk-margin-small-top uk-margin-small-left"><?php //.post-image ?>
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
                    <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                <?php else: // サムネイルを持っていないときの処理 ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                <?php endif; ?>
            </a>
        </div>
        <div class="post-info uk-width-expand uk-margin-small uk-margin-small-left uk-margin-small-right"><?php //.post-info ?>
            <h3 class="post-title"><a href="<?php the_permalink(); ?>">
                <?php if( wp_is_mobile() ) : ?>
                    <?php echo text_ellipsis( get_the_title(), 21 ); ?>
                <?php else: ?>
                    <?php echo text_ellipsis( get_the_title(), 32 ); ?>
                <?php endif; ?>
            </a></h3>
            <span class="post-date uk-text-meta" itemprop="datePublished" datetime="<?php the_time('Y/m'); ?>"><?php the_time('Y/m'); ?></span>
        </div>
    </div>
<?php endwhile;
        wp_reset_postdata();
else: ?>
    <p>記事がありません</p>
<?php endif; ?>