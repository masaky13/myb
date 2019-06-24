<div class="side-inner" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">

<div class="side-widget-area">
    <?php
        if( dynamic_sidebar('sidebar') ):
            dynamic_sidebar();
        endif;
    ?>
</div>
<div class="side-section">
    <h4 class="side-title">新着記事</h4>
    <div class="post-list">
        <?php get_template_part( 'post_list_common' ); ?>
    </div>
</div>

</div><!-- /side -->
