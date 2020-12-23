<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business_Point
 */

?>
<?php
/**
 * Hook - business_point_doctype.
 *
 * @hooked business_point_doctype_action - 10
 */
do_action( 'business_point_doctype' );
?>
<head>
<?php
/**
 * Hook - business_point_head.
 *
 * @hooked business_point_head_action - 10
 */
do_action( 'business_point_head' );

wp_head(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23664067-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23664067-1');
</script>

</head>

<body <?php body_class(); ?>>
<div id="pre-loader"></div>
<ul class="sidebar-quote" aria-hidden="false">
<li id="msidebar-quote-link" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-5616 pum-trigger" style="cursor: pointer;"><a href="#">Get A Free Quote</a></li>
</ul>
<div id="page" class="site">
    <?php
    /**
     * Hook - business_point_top_header.
     *
     * @hooked business_point_top_header_action - 10
     */
    do_action( 'business_point_top_header' );

    /**
    * Hook - winsone_before_header.
    *
    * @hooked business_point_before_header_action - 10
    */
    do_action( 'business_point_before_header' );

    /**
    * Hook - business_point_header.
    *
    * @hooked business_point_header_action - 10
    */
    do_action( 'business_point_header' );

    /**
    * Hook - business_point_after_header.
    *
    * @hooked business_point_after_header_action - 10
    */
    do_action( 'business_point_after_header' );

    /**
    * Hook - business_point_main_content.
    *
    * @hooked business_point_main_content_for_slider - 5
    * @hooked business_point_main_content_for_breadcrumb - 7
    * @hooked business_point_main_content_for_home_widgets - 9
    */
    do_action( 'business_point_main_content' );

    /**
    * Hook - business_point_before_content.
    *
    * @hooked business_point_before_content_action - 10
    */
    do_action( 'business_point_before_content' );