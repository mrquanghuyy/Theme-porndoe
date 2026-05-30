<?php
get_header();
global $wp_query;

$current_page = max(1, (int) get_query_var('paged'));
$total_pages = max(1, (int) $wp_query->max_num_pages);
?>
<main class="-main">
    <section class="-section">
        <div class="-holder -flex">
            <div class="-grow">
                <h1 class="-heading-one">Search Results</h1>
            </div>
            <div class="-items-center">
                <span class="home-more-desktop"><?php echo esc_html(number_format_i18n((int) $wp_query->found_posts)); ?> results</span>
            </div>
        </div>
    </section>

    <section class="-section">
        <div class="-holder-section">
            <?php if (have_posts()) : ?>
                <div class="videos-list">
                    <?php
                    $rank = 0;
                    while (have_posts()) {
                        the_post();
                        ?>
                        <div data-fake-key="<?php echo (int) $rank; ?>">
                            <?php include THEMETEMPLADE . '/section/section_thumb_item.php'; ?>
                        </div>
                        <?php
                        $rank++;
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            <?php else : ?>
                <div class="-holder-section">
                    <?php esc_html_e('No videos matched your search.', 'ophim'); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($total_pages > 1) : ?>
        <section class="-section">
            <?php porndoe_render_pager($current_page, $total_pages, function ($page) {
                return get_pagenum_link($page);
            }); ?>
        </section>
    <?php endif; ?>
</main>
<?php
get_footer();
?>
