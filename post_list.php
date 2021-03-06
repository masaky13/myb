<?php
/**
* トップやアーカイブ一覧
*/
?>
<div class="post-list">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="uk-card uk-card-default uk-margin uk-padding-small">
        <div class="post-image uk-margin-small-bottom"><?php //.post-image ?>
            <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
                    <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                <?php else: // サムネイルを持っていないときの処理 ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                <?php endif; ?>
            </a>
        </div>
        <div class="post-info"><?php //.post-info ?>
            <h3 class="post-title uk-margin-small"><a href="<?php the_permalink(); ?>">
                <?php if( wp_is_mobile() ) : ?>
                    <?php echo text_ellipsis( get_the_title(), 26 ); ?>
                <?php else: ?>
                    <?php echo text_ellipsis( get_the_title(), 32 ); ?>
                <?php endif; ?>
            </a></h3>
            <span class="post-date text-meta text-meta-barline" itemprop="datePublished" datetime="<?php the_time('Y/m'); ?>"><?php the_time('Y/m'); ?></span>
            <span class="post-categories text-meta"><?php echo get_post_category(); ?></span>
        </div>
    </div>
<?php endwhile;
else: ?>
    <p>記事がありません</p>
<?php endif; ?>
</div>
