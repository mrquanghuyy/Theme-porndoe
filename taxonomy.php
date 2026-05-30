<?php
get_header();
global $wp_query;

$current_page = max(1, (int) get_query_var('paged'));
$total_pages = max(1, (int) $wp_query->max_num_pages);
$term_description = trim(wp_strip_all_tags(term_description()));
?>
<main class="-main">
    <section class="-section">
        <div class="-holder -flex">
            <div class="-grow">
                <h1 class="-heading-one"><?php single_term_title(); ?></h1>
            </div>
            <?php if ($term_description !== '') : ?>
                <div class="-items-center">
                    <span class="home-more-desktop"><?php echo esc_html($term_description); ?></span>
                </div>
            <?php endif; ?>
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
                    <?php esc_html_e('Chưa có nội dung trong mục này.', 'ophim'); ?>
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
