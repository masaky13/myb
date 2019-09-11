<div>
    <a href="<?php the_permalink(); ?>">
        <div class="post-image uk-margin-small"><?php //.post-image ?>
            <?php $icatch = wp_get_attachment_image_src( get_the_ID(), 'large'); ?>
            <?php if ( $icatch !== '' ): // サムネイルを持っているときの処理 ?>
                <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
            <?php else: // サムネイルを持っていないときの処理 ?>
                <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
            <?php endif; ?>
        </div>
        <div class="post-info uk-text-meta"><?php //.post-info ?>
            <h3 class="post-title">
                <?php if( wp_is_mobile() ) : ?>
                    <?php echo text_ellipsis( get_the_title(), 27 ); ?>
                <?php else: ?>
                    <?php echo text_ellipsis( get_the_title(), 32 ); ?>
                <?php endif; ?>
            </h3>
        </div>
    </a>
</div>
