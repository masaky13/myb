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
<header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
  <h1><?php bloginfo('name'); ?></h1>
</header>
