<footer>
    <div class="inner">
        <?php //フッターメニュー
        $defaults = array(
            'theme_location'  => 'secondary-menu',
            'container'       => 'div',
            'container_class' => 'footermenubox clearfix ',
            'menu_class'      => 'footermenust',
            'depth'           => 1,
        );
        wp_nav_menu( $defaults );
        ?>
        <div class="footer-info">
            <p><?php bloginfo('name'); ?></p>
        </div>
        <small class="copy">Copyright&copy;<?php bloginfo( 'name' ); ?>,<?php echo date( 'Y' ); ?>All Rights Reserved.</small>
    </div>
</footer>
<!-- ページトップへ戻る -->
<div id="page-top"><a href="#wrapper"></a></div>
<!-- ページトップへ戻る　終わり -->
<?php wp_footer(); ?>
</body>
</html>
