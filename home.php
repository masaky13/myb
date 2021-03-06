<?php get_header(); ?>

<div class="inner">

<section class="top-view uk-margin-bottom">
    <?php get_template_part( 'post_list_top' ); ?>
</section><?php //.top-view ?>

<div class="content" uk-grid>
<main class="uk-width-2-3@l">
	<section class="top-posts">
		<h2 class="uk-padding-small uk-text-center h2design">新着</h2>
        <?php get_template_part( 'post_list' ); ?>
    </section>
</main>
<aside class="uk-width-1-3@l">
    <?php get_sidebar(); ?>
</aside>
</div><?php //.content ?>

</div>

<?php get_footer(); ?>
