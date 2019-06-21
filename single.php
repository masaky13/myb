<?php get_header(); ?>

<div class="content">
<main>
    <article>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" class="post">
            <div class="post-image"><?php //.post-image ?>
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ): // サムネイルを持っているときの処理 ?>
                        <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                        <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                    <?php else: // サムネイルを持っていないときの処理 ?>
                        <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                    <?php endif; ?>
                </a>
            </div>
            <div class="post-body inner">
                <div class="post-header">
                    <span class="post-date uk-text-meta" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( DATE_ISO8601 ) ); ?>"><?php the_time('Y/m/d'); ?></span>
                    <h1 class="post-title"><?php the_title(); ?></h1>
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
    <div class="post-side inner">
        <h2 class="sub-title">新着記事</h2>
    </div>
</main>
</div><?php //.content ?>

<?php get_footer(); ?>
