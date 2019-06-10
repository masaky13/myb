<?php get_header(); ?>

<div class="content">
    <section class="top-view uk-text-center">
        <p class="uk-tile uk-tile-default uk-padding-large"><?php bloginfo('name'); ?></p>
    </section><?php //.top-view ?>
    <section class="top-posts inner">
        <?php get_template_part( 'post_list' ); ?>
    </section><?php //.top-posts ?>
</div><?php //.content ?>

<?php get_footer(); ?>
