<!DOCTYPE html>
<html <?php language_attributes(); ?> class="pc">
<head>
    <meta name="viewport" content="initial-scale=1.0, width=device-width">
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmgp.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
    <script>
        var url = '<?= get_template_directory_uri() ?>';
        var siteUrl = '<?= esc_url( home_url( '/' ) ); ?>';
        var ajaxUrl = '<?= esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
        var twfSearchNonce = '<?= esc_js( wp_create_nonce( 'twf_search_suggestions' ) ); ?>';
    </script>
    <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri() ?>/assets/css/porndoe.css?v=3" />
    <link rel="stylesheet" type="text/css" href="<?= get_template_directory_uri() ?>/assets/css/legal.css?v=1" />
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/jquery.min.js?v=1"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/main.js?v=4"></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/porndoe.js?v=3" defer></script>
    <script type="text/javascript" src="<?= get_template_directory_uri() ?>/assets/js/lazysizes.min.js?v=1" async></script>

</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php include_once THEME_URL.'/templates/header.php' ?>
