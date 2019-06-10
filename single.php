<?php get_header(); ?>

<div class="content">
<main>
    <article>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>">
            <div class="post-header inner" data-rellax-speed="-2">
                <h1><?php the_title(); ?></h1>
                <p><time itemprop="datePublished" datetime="<?php echo esc_attr( get_the_date( DATE_ISO8601 ) ); ?>"><?php the_time('Y.m.d'); ?></time></p>
                <a href="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'large')[0]; ?>" target="_blank"><?php the_post_thumbnail(); ?></a>
            </div>
            <?php  the_content(); //Content ?>
            <?php endwhile; else: ?>
                <p>險倅ｺ九′縺ゅｊ縺ｾ縺帙ｓ</p>
            <?php endif; ?>
        </div>
    </article>

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
</main>
</div><?php //.content ?>

<?php get_footer(); ?>
