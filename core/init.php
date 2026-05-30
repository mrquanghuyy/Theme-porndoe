<?php

if (!function_exists('ophim_theme_setup')) {
    function ophim_theme_setup()
    {

        /*
         * Tự chèn RSS Feed links trong <head>
         */
        add_theme_support('automatic-feed-links');
        /*
         * Thêm chức năng title-tag để tự thêm <title>
         */
        add_theme_support('title-tag');
        add_theme_support('custom-logo');
        add_theme_support('post-thumbnails');

        /*
         * Tạo menu cho theme
         */
        register_nav_menu('primary-menu', __('Primary Menu', 'ophim'));

    }

    add_action('init', 'ophim_theme_setup');

}

// Cài đặt theme: bật/tắt ảnh preview khi hover vào item phim
add_action('customize_register', 'nqt_beegcom_customize_preview_hover');
function nqt_beegcom_customize_preview_hover($wp_customize)
{
    $wp_customize->add_section('ophim_preview_section', array(
        'title'    => __('Ảnh preview phim', 'ophim'),
        'priority' => 130,
    ));
    $wp_customize->add_setting('ophim_hover_preview', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('ophim_hover_preview', array(
        'label'   => __('Bật ảnh preview khi hover vào item phim', 'ophim'),
        'section' => 'ophim_preview_section',
        'type'    => 'checkbox',
    ));
}




function wp_get_menu_array($current_menu)
{
    $menu_name = $current_menu;
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $array_menu = wp_get_nav_menu_items($menu->term_id);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID'] = $m->ID;
            $menu[$m->ID]['title'] = $m->title;
            $menu[$m->ID]['url'] = $m->url;
            $menu[$m->ID]['children'] = array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID'] = $m->ID;
            $submenu[$m->ID]['title'] = $m->title;
            $submenu[$m->ID]['url'] = $m->url;
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
        }
    }
    return $menu;
}

function ophim_pagination1($custom_query = null) {
    global $wp_rewrite;
    $query_obj = $custom_query ? $custom_query : $GLOBALS['wp_query'];
    
    if ($query_obj->max_num_pages <= 1) return;
    
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args   = array();
    $url_parts    = explode('?', $pagenum_link);
    
    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }
    
    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';
    
    $format = $wp_rewrite->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
    
    $pages = paginate_links(array(
        'base'      => $pagenum_link,
        'format'    => $format,
        'current'   => max(1, $paged),
        'total'     => $query_obj->max_num_pages,
        'type'      => 'array',
        'prev_text' => '←',
        'next_text' => '→',
        'add_args'  => array_map('urlencode', $query_args),
    ));
    
    if (is_array($pages) && !empty($pages)) {
        echo '<nav class="paginator" aria-label="Page navigation">';
        
        foreach ($pages as $page) {
            $page = str_replace('page-numbers', 'paginator__item__link', $page);
            
            if (strpos($page, 'current') !== false) {
                $page = str_replace('page-link current', 'paginator__item__link', $page);
                echo '<div class="paginator__item paginator__item--active">' . $page . '</div>';
            }
            else if (strpos($page, 'dots') !== false) {
                echo '<div class="paginator__item"><span class="paginator__item__link" aria-hidden="true">...</span></div>';
            }
            else {
                echo '<div class="paginator__item">' . $page . '</div>';
            }
        }
        
        echo '</nav>';
    }
}

function op_get_genre_link($genre_slug) {
    $term = get_term_by('slug', $genre_slug, 'ophim_genres');
    
    if (!$term || is_wp_error($term)) {
        return '';
    }
    
    return get_term_link($term);
}

function ophim_pagination($custom_query = null)
{
    global $wp_query;
    $query_obj = $custom_query ?: $wp_query;

    if ($query_obj->max_num_pages <= 1) return;

    $total = (int) $query_obj->max_num_pages;

    // Hiện tại WP dùng query var "paged" cho pagination.
    // Frontend của bạn lại muốn link dạng "?p=...&q=...".
    // Vì vậy: đọc trang hiện tại từ "paged" (ưu tiên), còn link thì tạo theo "p".
    $current = (int) get_query_var('paged');
    if ($current < 1 && method_exists($query_obj, 'get')) {
        $current = (int) $query_obj->get('paged');
    }
    if ($current < 1 && isset($_GET['p'])) {
        $current = max(1, (int) $_GET['p']);
    }
    if ($current > $total) {
        $current = $total;
    }

    $q = '';
    if (isset($_GET['q']) && (string) $_GET['q'] !== '') {
        $q = sanitize_text_field(wp_unslash($_GET['q']));
    } elseif (isset($_GET['s']) && (string) $_GET['s'] !== '') {
        // Fallback: WP search dùng "s".
        $q = sanitize_text_field(wp_unslash($_GET['s']));
    } elseif (get_query_var('s')) {
        $q = sanitize_text_field((string) get_query_var('s'));
    }

    // Build query string cho mỗi trang.
    // Chỉ dùng "?p=...&q=..." khi đang là trang search theo tham số "q".
    $use_p = isset($_GET['q']) && (string) $_GET['q'] !== '';
    $build_url = function (int $p) use ($q, $use_p) {
        if ($use_p) {
            $args = array('p' => $p);
            if ($q !== '') {
                $args['q'] = $q;
            }
            return '?' . http_build_query($args, '', '&', PHP_QUERY_RFC3986);
        }

        // Ngữ cảnh khác: dùng query var chuẩn của WP.
        return get_pagenum_link($p);
    };

    // UI theo đúng mẫu bạn đưa.
    // Tối đa hiển thị 4 trang số đầu tiên trong khung.
    if ($total <= 4) {
        $start = 1;
        $end = $total;
    } else {
        // Tránh dài: hiển thị 4 trang liên tiếp quanh trang hiện tại.
        $start = max(1, min($total - 3, $current));
        $end = min($total, $start + 3);
    }

    echo '<div class="pagination-holder"><ul>';

    // Nút "prev" xuất hiện khi trang hiện tại khác 1.
    if ($current > 1) {
        $prev_p = max(1, $current - 1);
        $url_prev = $build_url($prev_p);
        echo '<li class="prev"><a href="' . esc_attr($url_prev) . '" rel="nofollow"></a></li>';
    }

    for ($i = $start; $i <= $end; $i++) {
        $li_class = ($i === $current) ? 'page-current' : 'page';
        $url = $build_url($i);
        echo '<li class="' . esc_attr($li_class) . '">';
        echo '<a href="' . esc_attr($url) . '" rel="nofollow">' . (int) $i . '</a>';
        echo '</li>';
    }

    // "last"
    $url_last = $build_url($total);
    echo '<li class="last"><a href="' . esc_attr($url_last) . '" rel="nofollow">last</a></li>';

    // "next" (anchor rỗng như mẫu)
    $next_p = min($total, $current + 1);
    $url_next = $build_url($next_p);
    echo '<li class="next"><a href="' . esc_attr($url_next) . '" rel="nofollow"></a></li>';

    echo '</ul></div>';
}

add_action('admin_enqueue_scripts', 'ophim_include_vung_admin_script');
function ophim_include_vung_admin_script()
{
    wp_enqueue_style('admin_vung', get_stylesheet_directory_uri() . '/admin/css/admin.css', false, '');
}