<?php get_header(); ?>
<div class="inner">
<?php echo get_breadcrumb(); ?>
<div class="content uk-margin-bottom">
<main>
<article>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" class="post page-photo">
        <div class="post-body uk-padding">
            <div class="post-image uk-margin-small-bottom uk-text-center"><?php //.post-image ?>
                <?php $icatch = wp_get_attachment_image_src( get_the_ID(), 'large'); ?>
                <?php if ( $icatch !== '' ): // サムネイルを持っているときの処理 ?>
                    <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                <?php else: // サムネイルを持っていないときの処理 ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                <?php endif; ?>
            </div>
            <div class="post-header uk-margin-bottom">
                <h1 class="post-title uk-text-center"><?php the_title(); ?></h1>
            </div>
            <div class="post-content">
                <?php  the_content(); //Content ?>
            </div>
            <div class="post-footer">
                <div class="post-meta uk-text-meta">
                    <?php echo share_post_sns(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; else: ?>
    <p>記事がありません</p>
<?php endif; ?>
</article>
</main>
</div><?php //.content ?>
</div><?php //.inner ?><?php get_footer(); ?>
