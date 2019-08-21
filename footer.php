<footer class="uk-padding">
    <div class="inner">
        <a href="#" uk-totop uk-scroll></a>
        <div class="footer-menu uk-margin uk-text-meta"><?php echo get_footer_navi(); ?></div>
        <div class="footer-info">
            <p class="uk-text-center"><a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/meyabi-logo.png" alt="<?php bloginfo('name'); ?>" width=150 /></a></p>
        </div>
        <small class="copy">Copyright&copy;<?php bloginfo( 'name' ); ?>,<?php echo date( 'Y' ); ?>All Rights Reserved.</small>
    </div>
</footer>
<?php wp_footer(); ?>
</div>
</body>
</html>
