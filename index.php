<?php
get_header();
$current_paged = max(1, (int) get_query_var('paged'));
?>
<main class="-main">
    <?php if ( $current_paged === 1 && is_active_sidebar('widget-top-slider') ) {
        dynamic_sidebar( 'widget-top-slider' );
    } ?>
    <?php if ( is_active_sidebar('widget-area') ) {
        dynamic_sidebar( 'widget-area' );
    } ?>
</main>
<?php
get_footer();
?>