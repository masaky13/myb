<?php get_header(); ?>

<?php //get_template_part( 'tmp-firstposts' ); ?>
<div class="content clearfix"><!-- content -->
    <section class="firstview"><!-- Top first view -->
        <div class="firstview_con view_1 rellax" data-rellax-speed="-7">
            <div class="inner"><!-- content_inner -->
                <h2><a href="#home-about"><?php bloginfo('name'); ?></a></h2>
                <p>A free lancer of web design and deveropment</p>
            </div><!-- /#contentInner -->
        </div>
    </section><!-- /Top first view -->

    <section id="home-about" class="about"><!-- about -->
        <div class="container none-edge">
            <div class="row">
                <div class="column about-image">
                    <img class="objectfit lazyload" data-src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-about.jpg" alt="アバウト画像">
                </div>
                <div class="column">
                    <div class="title">
                        <h2>About</h2>
                        <p>個人事業主様・フリーランサー様・企画等、のWeb制作やオリジナルホームページの制作を行っております。</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /about -->

    <section class="service lazyload" data-bg="<?php echo get_stylesheet_directory_uri(); ?>/images/md-bg.png"><!-- service -->
        <div class="inner"><!-- content_inner -->
            <h2>Service</h2>
            <div class="container">
                <div class="row">
                    <div class="column skills_item_1 rellax" data-rellax-speed="1">
                        <h3>1</h3>
                    </div>
                    <div class="column skills_item_2 rellax" data-rellax-speed="2">
                        <h3>2</h3>
                    </div>
                    <div class="column skills_item_3 rellax" data-rellax-speed="3">
                        <h3>3</h3>
                    </div>
                </div>
            </div>
        </div><!-- /#contentInner -->
    </section><!-- /service -->

    <?php get_template_part( 'tp-contact' ); //menu ?>
    </!--></div><!-- /#content -->
    <?php get_footer(); ?>
