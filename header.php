<?php // Header Template ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="author" content="Farias Maiquita">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="site-wrap">
        <? if ( function_exists( 'hfe_header_enabled' ) && hfe_header_enabled() ) {
            hfe_render_header();
        } ?>
