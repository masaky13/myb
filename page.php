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
                </div>
                <div class="post-footer">
                </div>
            </div>
            <?php endwhile; else: ?>
                <p>記事がありません</p>
            <?php endif; ?>
        </div>
    </article>
</main>
</div><?php //.content ?>

</div><?php //.inner ?>
<?php get_footer(); ?>
