<?php get_header(); ?>

<div class="inner">

<section class="top-view uk-padding-small">
    <?php get_template_part( 'post_list_top' ); ?>
</section><?php //.top-view ?>

<div class="content" uk-grid>
    <main class="uk-width-2-3@l">
        <section class="top-posts inner">
            <?php get_template_part( 'post_list' ); ?>
        </section><?php //.top-posts ?>
    </main>
    <aside class="uk-width-1-3@l">
        <?php get_sidebar(); ?>
    </aside>
</div><?php //.content ?>

</div>

<?php get_footer(); ?>
