<?php get_header(); ?>

<div class="inner">

<?php echo get_breadcrumb(); ?>
<div class="content" uk-grid>
<main class="uk-width-2-3@l">
    <article>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" class="post">
            <div class="post-image"><?php //.post-image ?>
                <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
                    <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                    <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                <?php else: // サムネイルを持っていないときの処理 ?>
                    <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                <?php endif; ?>
            </div>
            <div class="post-body uk-padding-small">
                <div class="post-header uk-margin-bottom">
                    <h1 class="post-title"><?php the_title(); ?></h1>

                    <div class="post-meta uk-text-meta uk-margin-small-bottom">
						<span class="post-date uk-margin-small-right" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( DATE_ISO8601 ) ); ?>"><?php the_time('Y/m/d'); ?></span>
						<?php echo get_post_category(); ?>
						<span class="post-pageviews uk-margin-small-right">ビュー：<?php echo get_post_meta( get_the_ID(), 'pageviews', true ); ?></span>
                        <?php echo share_post_sns(); ?>
					</div>
                    <?php echo get_post_author(); ?>
                </div>
                <div class="post-content">
                    <?php  the_content(); //Content ?>
                </div>
                <div class="post-footer">
                    <div class="container post-nav">
                        <?php
                        $prev_post = get_previous_post();
                        if ( !empty( $prev_post ) ): ?>
                            <div class="column previous-post icon-arrow-left">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php echo $prev_post->post_title; ?></a>
                            </div>
                        <?php endif;
                        $next_post = get_next_post();
                        if ( !empty( $next_post ) ): ?>
                            <div class="column next-post icon-arrow-right">
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php echo $next_post->post_title; ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; else: ?>
                <p>記事がありません</p>
            <?php endif; ?>
        </div>
    </article>
    <div class="post-side uk-padding-small">
        <div class="top-posts uk-margin-small-left uk-margin-small-right">
            <h2 class="sub-title">関連記事</h2>
        </div>
        <div class="post-list">
            <?php get_template_part( 'post_list_common' ); ?>
        </div>
    </div>
</main>
<aside class="uk-width-1-3@l">
    <?php get_sidebar(); ?>
</aside>
</div><?php //.content ?>

</div><?php //.inner ?>

<?php get_footer(); ?>
