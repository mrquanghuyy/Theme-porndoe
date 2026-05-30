<?php
/**
 * Template Name: Danh sách Categories
 */
get_header();

$sort = isset($_GET['sort']) ? sanitize_key(wp_unslash($_GET['sort'])) : 'popular';
$view = isset($_GET['view']) ? sanitize_key(wp_unslash($_GET['view'])) : 'grid';

if (!in_array($sort, array('popular', 'alpha', 'movies'), true)) {
    $sort = 'popular';
}

if (!in_array($view, array('grid', 'list'), true)) {
    $view = 'grid';
}

$categories_page_url = home_url('/categories/');
$site_name = get_bloginfo('name');
$default_thumb = get_stylesheet_directory_uri() . '/assets/images/avatar-default.webp';
$total_categories = wp_count_terms(array(
    'taxonomy'   => 'ophim_genres',
    'hide_empty' => true,
));

if (is_wp_error($total_categories)) {
    $total_categories = 0;
}

$popular_categories = get_terms(array(
    'taxonomy'   => 'ophim_genres',
    'hide_empty' => true,
    'number'     => 8,
    'orderby'    => 'count',
    'order'      => 'DESC',
));

$categories = get_terms(array(
    'taxonomy'   => 'ophim_genres',
    'hide_empty' => true,
    'orderby'    => $sort === 'alpha' ? 'name' : 'count',
    'order'      => $sort === 'alpha' ? 'ASC' : 'DESC',
));

if (is_wp_error($popular_categories)) {
    $popular_categories = array();
}

if (is_wp_error($categories)) {
    $categories = array();
}

$build_categories_url = function ($args = array()) use ($categories_page_url) {
    $args = array_filter($args, function ($value) {
        return $value !== null && $value !== '';
    });

    return add_query_arg($args, $categories_page_url);
};

$get_category_thumb = function ($category) use ($default_thumb) {
    $thumb = get_term_meta($category->term_id, 'genre_thumbnail', true);
    if (empty($thumb)) {
        $thumb = get_term_meta($category->term_id, 'ophim_genre_thumbnail', true);
    }
    if (empty($thumb)) {
        $thumb = $default_thumb;
    }

    return $thumb;
};

$sort_heading = 'Most popular';
if ($sort === 'alpha') {
    $sort_heading = 'Alphabetically';
} elseif ($sort === 'movies') {
    $sort_heading = 'Most Movies';
}
?>
<main class="-main">
    <section class="-section">
        <div class="-holder -flex">
            <div class="-grow">
                <h1 class="-heading-one">All Porn Categories</h1>
            </div>
            <div class="-items-center">
                <span class="home-more-desktop"><?php echo esc_html(number_format_i18n((int) $total_categories)); ?> categories</span>
            </div>
        </div>
    </section>

    <section class="-section home-inline-nav">
        <a href="<?php echo esc_url($build_categories_url(array('sort' => 'popular', 'view' => $view))); ?>" class="<?php echo $sort === 'popular' ? 'active' : ''; ?>">
            Most popular
        </a>
        <a href="<?php echo esc_url($build_categories_url(array('sort' => 'alpha', 'view' => $view))); ?>" class="<?php echo $sort === 'alpha' ? 'active' : ''; ?>">
            Alphabetically
        </a>
        <a href="<?php echo esc_url($build_categories_url(array('sort' => 'movies', 'view' => $view))); ?>" class="<?php echo $sort === 'movies' ? 'active' : ''; ?>">
            Most Movies
        </a>
    </section>

    <section class="-section home-inline-nav">
        <a href="<?php echo esc_url($build_categories_url(array('sort' => $sort, 'view' => 'grid'))); ?>" class="<?php echo $view === 'grid' ? 'active' : ''; ?>">
            Grid View
        </a>
        <a href="<?php echo esc_url($build_categories_url(array('sort' => $sort, 'view' => 'list'))); ?>" class="<?php echo $view === 'list' ? 'active' : ''; ?>">
            List View
        </a>
    </section>

    <?php if (!empty($popular_categories)) : ?>
        <section class="-section">
            <div class="-holder -flex">
                <div class="-grow">
                    <h2 class="-heading-one">Popular categories on <?php echo esc_html($site_name); ?></h2>
                </div>
            </div>
        </section>

        <section class="-section">
            <div class="-holder-section">
                <div class="-pc-scrollable" style="white-space:normal;padding-bottom:0;">
                    <div class="-pc-fake" style="white-space:normal;display:block;">
                        <?php foreach ($popular_categories as $category) : ?>
                            <?php
                            $link = get_term_link($category);
                            if (is_wp_error($link)) {
                                continue;
                            }
                            ?>
                            <a class="-pc-item" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($category->name); ?>" style="margin:0 10px 10px 0;">
                                <?php echo esc_html($category->name); ?> <?php echo esc_html(number_format_i18n((int) $category->count)); ?> Videos
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="-section">
        <div class="-holder -flex">
            <div class="-grow">
                <h2 class="-heading-one"><?php echo esc_html($sort_heading); ?></h2>
            </div>
        </div>
    </section>

    <section class="-section">
        <div class="-holder-section">
            <?php if (!empty($categories)) : ?>
                <?php if ($view === 'grid') : ?>
                    <div class="videos-list videos-list-large-thumbs">
                        <?php foreach ($categories as $category) : ?>
                            <?php
                            $link = get_term_link($category);
                            if (is_wp_error($link)) {
                                continue;
                            }
                            $thumb = $get_category_thumb($category);
                            ?>
                            <a class="-ctlc-item" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($category->name); ?>">
                                <div class="-ctlc-item-background">
                                    <svg class="-ctlc-item-svg" viewBox="0 0 640 360" data-webp="true" style="background-size:cover;background-image:url('<?php echo esc_url($thumb); ?>');"></svg>
                                </div>
                                <div class="-ctlc-item-shadow">&nbsp;</div>
                                <div class="-ctlc-item-heading">
                                    <?php echo esc_html($category->name); ?>
                                    <span class="-ctlc-item-under-heading"><?php echo esc_html(number_format_i18n((int) $category->count)); ?> Videos</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="-pc-scrollable" style="white-space:normal;padding-bottom:0;">
                        <div class="-pc-fake" style="white-space:normal;display:block;">
                            <?php foreach ($categories as $category) : ?>
                                <?php
                                $link = get_term_link($category);
                                if (is_wp_error($link)) {
                                    continue;
                                }
                                ?>
                                <a class="-pc-item" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($category->name); ?>" style="margin:0 10px 10px 0;">
                                    <?php echo esc_html($category->name); ?> <?php echo esc_html(number_format_i18n((int) $category->count)); ?> Videos
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div class="-holder-section">
                    <?php esc_html_e('Hiện chưa có category nào để hiển thị.', 'ophim'); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="-section -box-shadow-bottom">
        <div class="-holder-section" style="line-height:1.8;color:#d7d7d7;">
            <h2 class="-grow -shadow-after -heading-two">
                Best Free HD Porn Categories            
            </h2>            
            
        </div>
    </section>

    <section class="-section">
        <div class="-holder-section">
        <div class="-less-section" data-active="false">
            <div class="-less-content">
                <?php
                $categories_seo = 'Feel the need for something a little more special? PornDoe gives you the chance to explore all the HD and 4K porn you want, for free! Watch our free porn movies in all comfort! From sexy anal sex to favourite sex sessions and erotic porn videos, you can watch it all! Full HD porn videos develop along various free porn movies and offer you the best moments of the adult world! Treat your erection with our exclusive content, premium quality and impressive long list of categories that you can enjoy! Say yes to free porn movies! Here at Porndoe, we do our homework and research to find you the best free HD porn videos. Over time, we have established excellent contacts in the industry through the first legal platform for adult video broadcasting. We have hundreds of studios on board offering us freeporno movies every day. We publish between 150 and 300 movies a day to satisfy the hungry appetites, believe us, we tried to watch all these movies in a day and we ended up with broken wrists; we offer you more content that you can watch in one day in other words. We also aim to have the best and easiest navigation out there to find all these free porn movies that we offer, if you want a little more, feel free to try our own production site, Letsdoeit.com . We offer much more than just freeporno movies, we offer the best production in Europe and soon in the whole world. You can find some of our exclusive personal clips on Porndoe as well as PREMIUM CHANNELS, we have over 40 brands to choose from from lesbian to BDSM, so there you have all the variety to choose from. These Letsdoeit clips are also free porn movies that we offer on Porndoe, but for full clips you will have to go to Letsdoeit in order to get yourself an affordable membership for a porn buffet experience. How can you choose another site when you can find everything in one place here in Porndoe, it would be absurd to look elsewhere! Keep your eyes peeled for our daily free porn movie outings in the new version section on the homepage or browsing through our extensive list of exclusive categories and pornstars. Feel free to contact us if you have suggestions on how we can improve your experience on the site, our door is always open! And don\'t be shy to dig in the darkest categories we have to offer for your daily dose of freeporno, only on Porndoe.com!';
                $categories_seo = str_replace(
                    array('Porndoe.com', 'PornDoe.com', 'porndoe.com', 'PornDoe', 'Porndoe', 'Letsdoeit.com', 'Letsdoeit'),
                    $site_name,
                    $categories_seo
                );
                ?>
                <p><?php echo esc_html($categories_seo); ?></p>                
            </div>
        </div>
        </div>
    </section>
</main>

<?php
get_footer();
