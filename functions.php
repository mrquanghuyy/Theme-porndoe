<?php

define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . '/core');
define('WIDGET', THEME_URL . '/widget');
define('SIDEBARTEMPLADE', THEME_URL . '/templates/rightbar');
define('THEMETEMPLADE', THEME_URL . '/templates');


require_once(CORE . '/init.php');
require_once(THEME_URL . '/inc/demo.php');
require_once(THEME_URL . '/inc/register_sidebar.php');
require_once(THEME_URL . '/inc/ajax.php');
require_once(THEME_URL . '/inc/class-twf-primary-nav-walker.php');
require_once(THEME_URL . '/inc/front.php');
require_once(THEME_URL . '/inc/age-verify.php');
require_once(THEME_URL . '/inc/legal-pages.php');
// require_once(WIDGET . '/wg_ophim_categories.php');
require_once(WIDGET . '/wg_porndoe_top_slider.php');
require_once(WIDGET . '/wg_porndoe_home_listing.php');
require_once(WIDGET . '/wg_ophim_footer.php');
// Form header gửi ?q= — map sang s để WordPress nhận diện trang search
add_filter('request', function ($query_vars) {
    if (is_admin()) {
        return $query_vars;
    }

    // Frontend pagination của bạn dùng "?p=...&q=...".
    // WordPress lại hiểu query var "p" là ID bài viết, nên cần:
    // - map p -> paged để phân trang search hoạt động
    // - unset p để tránh WP hiểu nhầm là trang/POST theo ID
    if (
        isset($_GET['p']) &&
        is_numeric($_GET['p']) &&
        isset($_GET['q']) &&
        (string) $_GET['q'] !== ''
    ) {
        // "p" theo WP mặc định là post ID; frontend của bạn lại dùng "p" cho pagination trên trang search (?q=...).
        // Map sang "paged" để phân trang hoạt động đúng, đồng thời unset "p" để tránh WP hiểu nhầm.
        $query_vars['paged'] = max(1, (int) $_GET['p']);
        unset($query_vars['p']);
    }

    if (isset($_GET['q']) && (string) $_GET['q'] !== '') {
        $query_vars['s'] = sanitize_text_field(wp_unslash($_GET['q']));
    }
    return $query_vars;
});

function custom_pre_get_posts($query) {
    if (!is_admin() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'ophim'));
    }
}
add_action('pre_get_posts', 'custom_pre_get_posts');

function taxonomy_orderby_modified($query) {
    if (!is_admin() && $query->is_main_query() && is_tax()) {
        $query->set('orderby', 'modified');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'taxonomy_orderby_modified');

function flush_rules_on_activation() {
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'flush_rules_on_activation');
add_filter('query_vars', function($vars) {
    $vars[] = 'actors_list';
    return $vars;
});
add_action('init', function() {
    $slug = get_option('ophim_slug_actors') ?: 'actors';
    $slug = trim($slug, '/');
    add_rewrite_rule('^' . preg_quote($slug, '/') . '/?$', 'index.php?actors_list=1', 'top');
    add_rewrite_rule('^' . preg_quote($slug, '/') . '/page/([0-9]+)/?$', 'index.php?actors_list=1&paged=$matches[1]', 'top');
    add_rewrite_rule('^page/([0-9]+)/?$', 'index.php?paged=$matches[1]', 'top');
}, 1);

add_action('init', function() {
    if (is_admin() || get_option('ophim_paged_rewrite_flushed')) {
        return;
    }
    $rules = get_option('rewrite_rules');
    if (empty($rules) || !isset($rules['^page/([0-9]+)/?$']) || $rules['^page/([0-9]+)/?$'] !== 'index.php?paged=$matches[1]') {
        flush_rewrite_rules(false);
        update_option('ophim_paged_rewrite_flushed', 1);
    }
}, 99);
add_action('template_redirect', function() {
    if (!is_404()) {
        return;
    }
    $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $uri = preg_replace('#\?.*$#', '', $uri);
    $uri = untrailingslashit($uri);
    if (!preg_match('#^/page/([1-9][0-9]*)$#', $uri, $m)) {
        return;
    }
    $paged = (int) $m[1];
    global $wp_query;
    $wp_query->set('paged', $paged);
    $wp_query->set('post_type', array('post', 'ophim'));
    $wp_query->is_404 = false;
    $wp_query->is_home = true;
    $wp_query->is_archive = false;
    $wp_query->is_singular = false;
    status_header(200);
    nocache_headers();
    include get_stylesheet_directory() . '/index.php';
    exit;
}, 1);

add_filter('template_include', function($template) {
    if ((int) get_query_var('actors_list')) {
        $t = get_stylesheet_directory() . '/page-actors.php';
        if (file_exists($t)) return $t;
    }
    return $template;
});

add_filter('document_title_parts', function($title) {
    if (is_admin()) {
        return $title;
    }
    $uri = isset($_SERVER['REQUEST_URI']) ? preg_replace('#\?.*$#', '', $_SERVER['REQUEST_URI']) : '';
    $uri = trim(untrailingslashit($uri), '/');
    if (preg_match('#^page/([1-9][0-9]*)$#', $uri, $m)) {
        $title['title'] = get_bloginfo('name', 'display');
        $title['page'] = '';
        return $title;
    }
    if (is_home() && (int) get_query_var('paged') > 0) {
        $title['title'] = get_bloginfo('name', 'display');
        $title['page'] = '';
    }
    return $title;
}, 20);

add_filter('document_title', function($title) {
    if (is_admin()) {
        return $title;
    }
    $uri = isset($_SERVER['REQUEST_URI']) ? preg_replace('#\?.*$#', '', $_SERVER['REQUEST_URI']) : '';
    $uri = trim(untrailingslashit($uri), '/');
    if (preg_match('#^page/([1-9][0-9]*)$#', $uri, $m)) {
        return get_bloginfo('name', 'display');
    }
    return $title;
}, 20);

add_filter('pre_handle_404', function($preempt, $wp_query) {
    if ($preempt || !$wp_query->is_main_query()) {
        return $preempt;
    }
    $uri = isset($_SERVER['REQUEST_URI']) ? preg_replace('#\?.*$#', '', $_SERVER['REQUEST_URI']) : '';
    $uri = untrailingslashit($uri);
    if (!preg_match('#^/page/([1-9][0-9]*)$#', $uri, $m)) {
        return $preempt;
    }
    return true;
}, 1, 2);

// Logo fallback nếu site chưa gán custom logo.
if (!function_exists('porndoe_get_logo_url')) {
    function porndoe_get_logo_url() {
        $custom_logo_id = (int) get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (!empty($logo[0])) {
                return $logo[0];
            }
        }

        return get_template_directory_uri() . '/assets/images/porndoe-logo.png';
    }
}

// Lấy term nổi bật đầu tiên để hiển thị meta gọn cho card/listing.
if (!function_exists('porndoe_get_primary_term_name')) {
    function porndoe_get_primary_term_name($post_id = null) {
        $post_id = $post_id ?: get_the_ID();
        $taxonomies = array('ophim_categories', 'ophim_genres', 'ophim_tags');

        foreach ($taxonomies as $taxonomy) {
            $terms = get_the_terms($post_id, $taxonomy);
            if (!empty($terms) && !is_wp_error($terms)) {
                return $terms[0]->name;
            }
        }

        return __('Video', 'ophim');
    }
}

// Lấy nhanh danh sách term cho header/search modal.
if (!function_exists('porndoe_get_taxonomy_links')) {
    function porndoe_get_taxonomy_links($taxonomy, $limit = 8) {
        $terms = get_terms(array(
            'taxonomy'   => $taxonomy,
            'hide_empty' => true,
            'number'     => $limit,
            'orderby'    => 'count',
            'order'      => 'DESC',
        ));

        if (is_wp_error($terms) || empty($terms)) {
            return array();
        }

        $items = array();
        foreach ($terms as $term) {
            $link = get_term_link($term);
            if (is_wp_error($link)) {
                continue;
            }

            $items[] = array(
                'name'  => $term->name,
                'url'   => $link,
                'count' => (int) $term->count,
            );
        }

        return $items;
    }
}

if (!function_exists('porndoe_get_logo_markup')) {
    function porndoe_get_logo_markup() {
        $custom_logo_id = (int) get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
            if (!empty($logo[0])) {
                return sprintf(
                    '<img class="-h-logo-svg" src="%s" alt="%s">',
                    esc_url($logo[0]),
                    esc_attr(get_bloginfo('name'))
                );
            }
        }

        return <<<SVG
<svg class="-h-logo-svg" viewBox="0 0 354.28 57.49" aria-hidden="true" focusable="false">
    <path fill="currentColor" d="M0,1.79H21.45C33,1.79,41,7.15,41,19.52,41,32.25,34.18,37.83,22,37.83H14V55.7H0ZM14,26.53h2.36c5.08,0,10.09,0,10.09-6.58,0-6.79-4.65-6.87-10.09-6.87H14Z"/>
    <path fill="currentColor" d="M103.46,27.74c0,17.45-12.51,29.75-29.81,29.75S43.83,45.19,43.83,27.74C43.83,11.44,58.13,0,73.65,0S103.46,11.44,103.46,27.74Zm-45,.07c0,9.3,6.86,16.09,15.23,16.09s15.23-6.79,15.23-16.09c0-7.43-6.87-14.22-15.23-14.22S58.42,20.38,58.42,27.81Z"/>
    <path fill="currentColor" d="M154.08,55.7H136.64L123.41,35h-.15V55.7h-14V1.79H130.2c10.65,0,18.73,5.07,18.73,16.59,0,7.43-4.14,13.87-11.79,15.23ZM123.26,26h1.36c4.58,0,9.73-.86,9.73-6.73s-5.15-6.72-9.73-6.72h-1.36Z"/>
    <path fill="currentColor" d="M157.15,1.79h14l25.67,33H197v-33h14V55.7H197l-25.67-33h-.14v33h-14Z"/>
    <path fill="currentColor" d="M219.43,1.79h11.15c16.52,0,30.25,8.72,30.25,26.67,0,18.37-13.44,27.24-30.46,27.24H219.43Zm6.72,47.76h2.36c13.73,0,25.6-5.15,25.6-20.81s-11.87-20.8-25.6-20.8h-2.36Z"/>
    <path fill="currentColor" d="M319.53,28.74a28.25,28.25,0,0,1-56.49,0,28.25,28.25,0,0,1,56.49,0Zm-6.72,0c0-11.87-8.87-21.8-21.52-21.8s-21.53,9.93-21.53,21.8a21.53,21.53,0,1,0,43.05,0Z"/>
    <path fill="currentColor" d="M325.32,1.79h29V7.94H332V23h21.59v6.15H332V49.55h22.24V55.7h-29Z"/>
</svg>
SVG;
    }
}

if (!function_exists('porndoe_format_compact_number')) {
    function porndoe_format_compact_number($value) {
        $value = (float) $value;
        if ($value >= 1000000) {
            return round($value / 1000000, 1) . 'm';
        }
        if ($value >= 1000) {
            return round($value / 1000, 1) . 'k';
        }

        return (string) (int) $value;
    }
}

if (!function_exists('porndoe_get_video_site_term')) {
    function porndoe_get_video_site_term($post_id = null) {
        $post_id = $post_id ?: get_the_ID();
        foreach (array('ophim_categories', 'ophim_genres', 'ophim_tags') as $taxonomy) {
            $terms = get_the_terms($post_id, $taxonomy);
            if (!empty($terms) && !is_wp_error($terms)) {
                return $terms[0];
            }
        }

        return null;
    }
}

if (!function_exists('porndoe_get_video_actors')) {
    function porndoe_get_video_actors($post_id = null, $limit = 2) {
        $post_id = $post_id ?: get_the_ID();
        $actors = get_the_terms($post_id, 'ophim_actors');
        if (empty($actors) || is_wp_error($actors)) {
            return array();
        }

        return array_slice($actors, 0, max(1, (int) $limit));
    }
}

if (!function_exists('porndoe_get_video_views')) {
    function porndoe_get_video_views($post_id = null) {
        $post_id = $post_id ?: get_the_ID();
        return (int) get_post_meta($post_id, 'ophim_view', true);
    }
}

if (!function_exists('porndoe_render_pager')) {
    function porndoe_render_pager($current, $total, $url_builder) {
        $current = max(1, (int) $current);
        $total = max(1, (int) $total);

        if ($total <= 1 || !is_callable($url_builder)) {
            return;
        }

        if ($total <= 5) {
            $window_pages = range(1, $total);
        } elseif ($current <= 3) {
            $window_pages = range(1, 5);
        } elseif ($current >= ($total - 2)) {
            $window_pages = range($total - 4, $total);
        } else {
            $window_pages = range($current - 2, $current + 2);
        }

        $all_pages = $window_pages;

        if (!in_array(1, $all_pages, true)) {
            $all_pages[] = 1;
        }

        for ($page = 10; $page < $total; $page += 10) {
            if (!in_array($page, $all_pages, true)) {
                $all_pages[] = $page;
            }
        }

        if (!in_array($total, $all_pages, true)) {
            $all_pages[] = $total;
        }

        sort($all_pages, SORT_NUMERIC);
        ?>
        <div class="-holder -justify-center">
            <div class="pager">
                <?php
                $previous_page = null;
                foreach ($all_pages as $page) {
                    if ($previous_page !== null && ($page - $previous_page) > 1) {
                        ?>
                        <span class="pager-item pager-dots">...</span>
                        <?php
                    }

                    if ($page === $current) {
                        ?>
                        <span class="pager-item pager-active"><?php echo esc_html((string) $page); ?></span>
                        <?php
                    } else {
                        $classes = array('pager-item');
                        if (!in_array($page, $window_pages, true)) {
                            $classes[] = 'pager-skip';
                        }
                        ?>
                        <a class="<?php echo esc_attr(implode(' ', $classes)); ?>" href="<?php echo esc_url(call_user_func($url_builder, $page)); ?>">
                            <span><?php echo esc_html((string) $page); ?></span>
                        </a>
                        <?php
                    }

                    $previous_page = $page;
                }
                ?>
            </div>
        </div>
        <?php
    }
}