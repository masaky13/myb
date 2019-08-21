<?php
/**
* トップ
*/
?>
<div class="post-list-top">
<div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="center: true">
<div class="uk-slider-items uk-child-width-1@s">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="uk-panel">
        <a href="<?php the_permalink(); ?>">
            <div class="post-image"><?php //.post-image ?>
                <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
                    <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                <?php else: // サムネイルを持っていないときの処理 ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                <?php endif; ?>
            </div>
            <div class="post-info uk-position-center uk-text-center"><?php //.post-info ?>
                <h3 class="post-title uk-card-title uk-padding" uk-slider-parallax="x: 200,-200">
                    <?php if( wp_is_mobile() ) : ?>
                        <?php echo text_ellipsis( get_the_title(), 27 ); ?>
                    <?php else: ?>
                        <?php echo text_ellipsis( get_the_title(), 32 ); ?>
                    <?php endif; ?>
                </h3>
            </div>
        </a>
    </div>
<?php endwhile;
else: ?>
    <p>記事がありません</p>
<?php endif; ?>
</div>
<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
</div>
<ul class="uk-slider-nav uk-dotnav uk-flex-center uk-marging-small"></ul>
</div>
