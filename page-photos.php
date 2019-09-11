<?php
/*
Template Name: Photos
*/
?>
<?php get_header(); ?>
<div class="inner">
<?php echo get_breadcrumb(); ?>
<div class="content uk-margin-bottom">
<main>
    <article>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" class="post photo-page">
            <div class="post-body uk-padding-small">
                <div class="post-header uk-margin-bottom">
                    <h1 class="post-title uk-text-center"><?php the_title(); ?></h1>
                    <div class="post-meta uk-text-meta uk-margin-small-bottom">
                        <?php echo share_post_sns(); ?>
                    </div>
                </div>
                <div class="post-content">
                    <?php  the_content(); //Content ?>
                    <?php
                        $args = array(
                            'post_type' => 'attachment',
                            'post_status' => 'inherit'
                        );
                        $top_query = new WP_Query( $args );
                    ?>
                    <?php if ( $top_query->have_posts() ) : ?>
                        <div class="photo-list uk-grid-small uk-child-width-1-3@m uk-margin" uk-grid="masonry: true">
                            <?php
                                while ( $top_query->have_posts() ) : $top_query->the_post();
                                    get_template_part( 'photo_list' );
                                endwhile;
                            ?>
                        </div>
                        <?php if( $top_query->post_count !== (int) $top_query->found_posts ) { ?>
                            <p id="post-list-more" class="uk-text-meta uk-text-center">More</p>
                        <?php } ?>
                        <p class="post-list-nav uk-text-meta uk-text-center">
                            <span id="post-count"><?php echo $top_query->post_count; ?></span> /
                            <span id="found-posts"><?php echo $top_query->found_posts; ?></span>
                        </p>
                    <?php else: ?>
                        <p>記事がありません</p>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php endwhile; else: ?>
        <p>記事がありません</p>
    <?php endif; ?>
    </article>
</main>
</div><?php //.content ?>
</div><?php //.inner ?>
<?php get_footer(); ?>
