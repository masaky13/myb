<!DOCTYPE HTML>
<!--[if IE 8]>
<html class="ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta charset="<?php bloginfo( 'charset' ); ?>" >
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
    <meta name="format-detection" content="telephone=no" >
    <link rel="alternate" type="application/rss+xml" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
	<title><?php bloginfo('name'); ?></title>
    <?php // echo head_meta_index(); ?>
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  <?php wp_head(); ?>
  <?php //echo get_option('analytics_tracking_code');?>
  <?php //echo get_option('webmaster_tool');?>
</head>

<body <?php body_class();?> itemschope="itemscope" itemtype="http://schema.org/WebPage">
<header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader" uk-sticky="show-on-up: true">
<div class="inner">
    <div class="uk-grid-medium" uk-grid>
      <h1 class="uk-width-1-4@m"><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      <div class="uk-width-expand@m"><?php echo get_global_navi(); ?></div>
    </div>
    <div class="none-pc sp-nav"><?php echo get_toggle_navi(); ?></div>
    <div class="none-pc sp-nav-search"><?php echo get_toggle_navisearch(); ?></div>
</div>
</header>
