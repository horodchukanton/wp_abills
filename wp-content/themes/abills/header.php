<?php
/**
 * The theme header
 *
 * @package bootstrap-basic
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <!--wordpress head-->
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 8]>
<p class="ancient-browser-alert">You are using an <strong>outdated</strong> browser. Please <a
  href="http://browsehappy.com/" target="_blank">upgrade your browser</a>.</p>
<![endif]-->

<div class="row main-navigation">
  <div class="col-md-8 col-md-offset-2">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target=".navbar-primary-collapse">
          <span class="sr-only"><?php _e('Toggle navigation', 'bootstrap-basic'); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_attr(get_bloginfo('name', 'display')); ?></a>
      </div>

      <div class="collapse navbar-collapse navbar-primary-collapse">
        <?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new BootstrapBasicMyWalkerNavMenu())); ?>
        <div class="pull-right"><?php dynamic_sidebar('navbar-right'); ?></div>
      </div><!--.navbar-collapse-->
    </nav>
  </div>
</div><!--.main-navigation-->

<div class="container page-container">
  <?php do_action('before'); ?>
  <header role="banner">

    <div class="row row-with-vspace site-branding">
      <div class="col-md-12 page-header-top-right">
        <div class="sr-only">
          <a href="#content"
             title="<?php esc_attr_e('Skip to content', 'bootstrap-basic'); ?>"><?php _e('Skip to content', 'bootstrap-basic'); ?></a>
        </div>
        <?php if (is_active_sidebar('header-right')) { ?>
          <div class="row">
            <?php dynamic_sidebar('header-right'); ?>
          </div>
          <div class="clearfix"></div>
        <?php } // endif; ?>
      </div>
    </div><!--.site-branding-->


    <div class="row no-col-padding" id='contacts_row'>
      <?php include 'contacts_row.php' ?>
    </div>



  </header>

  <div id="content" class="row row-with-vspace site-content">

    <!-- Function for BANER -->
    <div class="row banner-row">
      <?php
      abills_gallery();
      ?>
    </div>



