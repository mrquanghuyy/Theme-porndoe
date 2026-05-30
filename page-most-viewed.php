<?php
get_header();

$query = new WP_Query(array(
    'post_type'           => 'ophim',
    'post_status'         => 'publish',
    'posts_per_page'      => 100,
    'ignore_sticky_posts' => true,
    'meta_key'            => 'ophim_view',
    'orderby'             => 'meta_value_num',
    'order'               => 'DESC',
));
?>
<main class="-main">
    <section class="-section">
        <div class="-holder -flex">
            <div class="-grow">
                <h1 class="-heading-one">
                    <a href="<?php echo esc_url(home_url('/most-viewed')); ?>" title="Most Viewed Videos">
                        Most Viewed Videos
                    </a>
                </h1>
            </div>
            <div class="-items-center">
                <a class="home-more-desktop" href="<?php echo esc_url(home_url('/')); ?>">
                    Latest Videos
                </a>
            </div>
        </div>
    </section>

    <section class="-section home-inline-nav">
        <a href="<?php echo esc_url(home_url('/')); ?>">Newest Videos</a>
        <a href="<?php echo esc_url(home_url('/most-viewed')); ?>" class="active">Most Viewed</a>
    </section>

    <section class="-section">
        <div class="-holder-section">
            <div class="videos-list">
                <?php
                $rank = 0;
                while ($query->have_posts()) {
                    $query->the_post();
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
        </div>
    </section>
</main>

<?php
get_footer();
