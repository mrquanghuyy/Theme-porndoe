<?php
get_header();

$per_page = 35;
$paged = max(1, (int) get_query_var('paged'));

$total_actors = wp_count_terms(array(
    'taxonomy'   => 'ophim_actors',
    'hide_empty' => true,
));
if (is_wp_error($total_actors)) {
    $total_actors = 0;
}
$total_pages = max(1, (int) ceil($total_actors / $per_page));
$paged = min($paged, $total_pages);
$offset = ($paged - 1) * $per_page;

$actors = get_terms(array(
    'taxonomy'   => 'ophim_actors',
    'hide_empty' => true,
    'number'     => $per_page,
    'offset'     => $offset,
    'orderby'    => 'count',
    'order'      => 'DESC',
));
$default_avatar = get_stylesheet_directory_uri() . '/assets/images/avatar-default.webp';
?>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/actor.css?v=1">
<main class="-main">
    <section class="-section">
        <div class="-holder -relative">
            <div class="actors-list-header">
                <div class="actors-list-header-left">
                    <h1 class="-heading">Most famous Pornstars</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="-section">
        <div class="-holder -color-gray">
            <p>Hello, fans of beautiful women with the best tastes in the world! Here we present you the hottest babes the porn industry has ever seen! Slim, curvy, blondes, redheads, brunettes, teens, or MILFs, every one of these stunning beauties will delight you with their hot XXX sessions! So, feel free and check out this vast collection of top female porn stars to know the true meaning of lustful fuck fests!</p>        </div>
    </section>

    <section class="-section">
        <div class="-holder">
            <?php if (!is_wp_error($actors) && !empty($actors)) : ?>
                <div class="actors-list" data-one-two-rows="false">
                    <?php foreach ($actors as $index => $actor) : ?>
                        <?php
                        $avatar = get_term_meta($actor->term_id, 'actor_avatar', true);
                        if (empty($avatar)) {
                            $avatar = get_term_meta($actor->term_id, 'actor_image', true);
                        }
                        if (empty($avatar)) {
                            $avatar = $default_avatar;
                        }
                        $link = get_term_link($actor);
                        if (is_wp_error($link)) {
                            continue;
                        }
                        ?>
                        <div class="actors-list-item">
                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($actor->name); ?>" target="_self">
                                <span class="">
                                    <svg width="100%" viewBox="0 0 100 100" data-webp="true" style="background-size: cover; background-image: url('<?php echo esc_url($avatar); ?>');">
                                        <rect width="100%" height="100%" fill="none"></rect>
                                    </svg>
                                    <span class="actors-list-star">★</span>
                                </span>
                                <span><?php echo esc_html($actor->name); ?></span>
                            </a>
                            <div class="actors-list-item-footer">
                                <span class="-grow"><?php echo esc_html(number_format_i18n((int) $actor->count)); ?> videos</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="-holder-section">
                    <?php esc_html_e('Hiện chưa có diễn viên nào để hiển thị.', 'ophim'); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($total_pages > 1) : ?>
        <section class="-section">
            <?php porndoe_render_pager($paged, $total_pages, function ($page) {
                return $page === 1 ? home_url('/pornstars/') : home_url('/pornstars/page/' . $page . '/');
            }); ?>
        </section>
    <?php endif; ?>
</main>
<?php
get_footer();
