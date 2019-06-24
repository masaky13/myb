<?php get_header(); ?>

<div class="content">
<main>
    <article>
        <section class="topview c-cover">
            <div class="inner">
                <h1 class="title"><?php echo get_archve_title(); ?></h1>
                <span> (<?php echo $wp_query->found_posts; ?>)</span>
            </div><?php //.inner ?>
        </section>
        <?php get_template_part( 'post_list' ); ?>
    </article><?php //.inner ?>
</main>
</div><?php //.content ?>

<?php get_footer(); ?>
