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
<a href="#" uk-totop uk-scroll></a>
<?php wp_footer(); ?>
</div>
</body>
</html>
