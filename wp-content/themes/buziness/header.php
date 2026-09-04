<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Buziness
 */
/**
* Hook - buziness_action_doctype.
*
* @hooked buziness_doctype -  10
*/
do_action( 'buziness_action_doctype' );
?>
<head>
<?php
/**
* Hook - buziness_action_head.
*
* @hooked buziness_head -  10
*/
do_action( 'buziness_action_head' );
?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>

<?php

/**
* Hook - buziness_action_before.
*
* @hooked buziness_page_start - 10
*/
do_action( 'buziness_action_before' );

/**
*
* @hooked buziness_header_start - 10
*/
do_action( 'buziness_action_before_header' );

/**
*
*@hooked buziness_site_branding - 10
*@hooked buziness_header_end - 15 
*/
do_action('buziness_action_header');

/**
*
* @hooked buziness_content_start - 10
*/
do_action( 'buziness_action_before_content' );

/**
 * Banner start
 * 
 * @hooked buziness_banner_header - 10
*/
do_action( 'buziness_banner_header' );  
