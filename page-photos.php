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
        <div id="post-<?php the_ID(); ?>" class="post">
            <div class="post-body uk-padding-small">
                <div class="post-header uk-margin-bottom">
                    <h1 class="post-title uk-text-center"><?php the_title(); ?></h1>
                    <div class="post-meta uk-text-meta uk-margin-small-bottom">
                    </div>
                </div>
                <div class="post-content">
                    <?php  the_content(); //Content ?>
                    <?php
                    $args = array(
                        'post_type' => 'attachment',
                        'post_status' => 'inherit'
                    );
                    $top_query = new WP_Query( $args );                    ?>
                    <div class="photo-list uk-child-width-1-3@m" uk-grid="masonry: true">
                        <?php if ( $top_query->have_posts() ) : while ( $top_query->have_posts() ) : $top_query->the_post(); ?>
                            <div>
                                <a href="<?php the_permalink(); ?>">
                                    <div class="post-image"><?php //.post-image ?>
                                        <?php $icatch = wp_get_attachment_image_src( get_the_ID(), 'large'); ?>
                                        <?php if ( $icatch !== '' ): // サムネイルを持っているときの処理 ?>
                                            <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                                            <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                                        <?php else: // サムネイルを持っていないときの処理 ?>
                                            <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                                        <?php endif; ?>
                                    </div>
                                    <div class="post-info uk-position-center uk-text-center"><?php //.post-info ?>
                                        <h3 class="post-title uk-card-title uk-padding">
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
                        <?php endif;
                        wp_reset_postdata(); ?>
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
</div><?php //.inner ?>
<?php get_footer(); ?>
