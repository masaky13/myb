<?php get_header(); ?>
<div class="inner">
<?php echo get_breadcrumb(); ?>
<div class="content uk-margin-bottom">
<main>
<article>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" class="post">
        <div class="post-body uk-padding-small">
            <div class="post-header uk-margin-bottom">
                <h1 class="post-title uk-text-center"><?php the_title(); ?></h1>
                <div>
                    <div class="post-content">
                        <?php  the_content(); //Content ?>
                    </div>
                    <div class="post-footer">
                        <div class="post-meta uk-text-meta uk-margin-small-bottom">
                            <?php echo share_post_sns(); ?>
                        </div>
                        <div class="container post-nav">
                            <?php
                            $prev_post = get_previous_post();
                            if ( !empty( $prev_post ) ): ?>
                            <div class="column previous-post icon-arrow-left">
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>"><?php echo $prev_post->post_title; ?></a>
                            </div>
                        <?php endif;
                        $next_post = get_next_post();
                        if ( !empty( $next_post ) ):
                            ?>
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
</main>
</div><?php //.content ?>
</div><?php //.inner ?><?php get_footer(); ?>
