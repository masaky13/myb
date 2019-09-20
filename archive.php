<?php get_header(); ?>

<div class="inner">

<?php echo get_breadcrumb(); ?>
<div class="content" uk-grid>
<main class="uk-width-2-3@l">
    <article>
        <section class="article uk-margin">
            <h1><?php echo get_archve_title(); ?></h1>
            <?php echo get_archve_meta(); ?>
        </section>
        <?php get_template_part( 'post_list' ); ?>
    </article>
</main>
<aside class="uk-width-1-3@l">
    <?php get_sidebar(); ?>
</aside>
</div><?php //.content ?>

</div><?php //.inner ?>
<?php get_footer(); ?>
