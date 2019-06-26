<?php get_header(); ?>

<div class="inner">

<section class="top-view uk-margin-bottom uk-padding-small">
    <?php get_template_part( 'post_list_top' ); ?>
</section><?php //.top-view ?>

<div class="content" uk-grid>
<main class="uk-width-2-3@l">
    <section class="top-posts uk-padding-small">
        <h2>新着記事</h2>
    </section>
    <?php get_template_part( 'post_list' ); ?>
</main>
<aside class="uk-width-1-3@l">
    <?php get_sidebar(); ?>
</aside>
</div><?php //.content ?>

</div>

<?php get_footer(); ?>
