<?php

function add_theme_widgets() {
    $activate = array(
        'widget-top-slider' => array(
            'wg_porndoe_top_slider-0',
        ),
        'widget-area' => array(
            'wg_porndoe_home_listing-0',
            'wg_porndoe_home_listing-1',
            'wg_porndoe_home_listing-2',
            'wg_porndoe_home_listing-3',
        ),
        'widget-footer' => array(
            'wg_footer-0',
        )
    );
    $top_genres = get_terms(array(
        'taxonomy'   => 'ophim_genres',
        'hide_empty' => true,
        'number'     => 1,
        'orderby'    => 'count',
        'order'      => 'DESC',
    ));
    $recommended_genre = (!is_wp_error($top_genres) && !empty($top_genres)) ? $top_genres[0]->slug : 'all';
    $site_name = get_bloginfo('name');

    $footer_html = '<footer class="-section -footer">
    <section class="-holder -footer-holder">
        <div class="-footer-subscribe">
            <div class="-footer-group-title">Free Weekly Discounts</div>
            <div>Receive our weekly top videos and featured pornstars directly on the homepage experience at ' . esc_html($site_name) . '.</div>
        </div>
        <div class="-footer-group-about">
            <div>
                <button class="-footer-group-title" type="button" data-pd-accordion aria-expanded="false">
                    <div>Information</div>
                    <svg class="-footer-group-more" width="24" height="24" viewBox="0 0 24 24" data-active="false"><path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </button>
                <div class="-footer-group-panel" data-pd-accordion-panel data-active="false">
                    <a class="-footer-group-link" href="' . esc_url(home_url('/policy')) . '">Privacy policy</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/terms')) . '">Terms of service</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/dmca')) . '">Content removal</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/18-usc-2257')) . '">18 U.S.C. 2257</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/cookie-policy')) . '">Cookie Policy</a>
                </div>
            </div>
            <div>
                <button class="-footer-group-title" type="button" data-pd-accordion aria-expanded="false">
                    <div>Account</div>
                    <svg class="-footer-group-more" width="24" height="24" viewBox="0 0 24 24" data-active="false"><path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </button>
                <div class="-footer-group-panel" data-pd-accordion-panel data-active="false">
                    <a class="-footer-group-link" href="' . esc_url(home_url('/most-viewed')) . '">HD videos</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/pornstars')) . '">Pornstars</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/tags')) . '">Tags</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/categories')) . '">Categories</a>
                </div>
            </div>
            <div>
                <button class="-footer-group-title" type="button" data-pd-accordion aria-expanded="false">
                    <div>Partners</div>
                    <svg class="-footer-group-more" width="24" height="24" viewBox="0 0 24 24" data-active="false"><path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </button>
                <div class="-footer-group-panel" data-pd-accordion-panel data-active="false">
                    <a class="-footer-group-link" href="' . esc_url(home_url('/')) . '">Latest videos</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/most-viewed')) . '">Porn deals</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/categories')) . '">Recommended genres</a>
                </div>
            </div>
            <div>
                <button class="-footer-group-title" type="button" data-pd-accordion aria-expanded="false">
                    <div>Follow us</div>
                    <svg class="-footer-group-more" width="24" height="24" viewBox="0 0 24 24" data-active="false"><path fill="currentColor" d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/></svg>
                </button>
                <div class="-footer-group-panel" data-pd-accordion-panel data-active="false">
                    <a class="-footer-group-link" href="' . esc_url(home_url('/most-viewed')) . '">Trending now</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/pornstars')) . '">Top stars</a>
                    <a class="-footer-group-link" href="' . esc_url(home_url('/tags')) . '">Hot tags</a>
                </div>
            </div>
        </div>
    </section>
</footer>
<section class="-section">
    <section class="-holder footer-phrases">
        <h6 class="footer-phrases-title">Watch the best free HD Porn Videos</h6>
        <p class="footer-phrases-text">' . esc_html($site_name) . ' offers a fast browsing experience, easy navigation, and genre-first discovery for free adult video content.</p>
    </section>
    <section class="-footer-legal">
        <div class="-holder">
            <div class="-footer-legal-first"></div>
            <div class="-footer-legal-second">
                <span class="-footer-legal-left"><span>Best XXX movies</span> &copy; ' . esc_html(gmdate('Y')) . ' <a class="-color-white" href="' . esc_url(home_url('/')) . '">' . esc_html($site_name) . '</a>, All Rights Reserved.</span>
                <span class="-footer-legal-right">Last Edit: <time datetime="' . esc_attr(current_time('mysql')) . '">' . esc_html(date_i18n('l, F j, Y')) . '</time></span>
            </div>
        </div>
    </section>
</section>';

    update_option('widget_wg_footer', array(
        0 => array('footer' => $footer_html),
        '_multiwidget' => 1,
    ));
    update_option('widget_wg_porndoe_top_slider', array(
        0 => array(
            'label'      => 'Hot Porn Videos',
            'postnum'    => 8,
            'status'     => 'all',
            'orderby'    => 'view',
            'categories' => 'all',
            'genres'     => 'all',
            'regions'    => 'all',
            'years'      => 'all',
            'featured'   => '',
        ),
        '_multiwidget' => 1,
    ));
    update_option('widget_wg_porndoe_home_listing', array(
        // 0 => array(
        //     'title'           => 'New Exclusive Videos',
        //     'primary_label'   => 'Exclusive Videos',
        //     'primary_url'     => home_url('/'),
        //     'secondary_label' => 'Most Viewed',
        //     'secondary_url'   => home_url('/most-viewed'),
        //     'postnum'         => 6,
        //     'status'          => 'all',
        //     'orderby'         => 'new',
        //     'categories'      => 'all',
        //     'genres'          => 'all',
        //     'regions'         => 'all',
        //     'years'           => 'all',
        //     'featured'        => '',
        // ),
        // 1 => array(
        //     'title'           => 'Top Trending Pornstar Videos',
        //     'primary_label'   => 'Top Stars',
        //     'primary_url'     => home_url('/pornstars'),
        //     'secondary_label' => 'Most Viewed',
        //     'secondary_url'   => home_url('/most-viewed'),
        //     'postnum'         => 6,
        //     'status'          => 'all',
        //     'orderby'         => 'view',
        //     'categories'      => 'all',
        //     'genres'          => 'all',
        //     'regions'         => 'all',
        //     'years'           => 'all',
        //     'featured'        => '',
        // ),
        // 2 => array(
        //     'title'           => 'Recommended Category For You',
        //     'primary_label'   => 'Recommended',
        //     'primary_url'     => home_url('/categories'),
        //     'secondary_label' => 'Browse Categories',
        //     'secondary_url'   => home_url('/categories'),
        //     'postnum'         => 6,
        //     'status'          => 'all',
        //     'orderby'         => 'view',
        //     'categories'      => 'all',
        //     'genres'          => $recommended_genre,
        //     'regions'         => 'all',
        //     'years'           => 'all',
        //     'featured'        => '',
        // ),
        3 => array(
            'title'           => 'New Trending Porn Videos',
            'primary_label'   => 'Newest Videos',
            'primary_url'     => home_url('/'),
            'secondary_label' => 'Most Viewed',
            'secondary_url'   => home_url('/most-viewed'),
            'postnum'         => 24,
            'status'          => 'all',
            'orderby'         => 'new',
            'categories'      => 'all',
            'genres'          => 'all',
            'regions'         => 'all',
            'years'           => 'all',
            'featured'        => '',
        ),
        '_multiwidget' => 1,
    ));
    update_option('sidebars_widgets',  $activate);

}

add_action('after_switch_theme', 'add_theme_widgets', 10, 2);


add_filter('query_vars', function ($vars) {
    $vars[] = 'ophim_dmca';
    $vars[] = 'ophim_terms';
    $vars[] = 'ophim_policy';
    $vars[] = 'ophim_categories_page';
    $vars[] = 'ophim_tags_page';
    $vars[] = 'ophim_pornstars_page';
    $vars[] = 'ophim_most_viewed_page';
    $vars[] = 'ophim_cookie_policy';
    $vars[] = 'ophim_18_usc_2257';
    return $vars;
});

add_action('init', function () {
    if (is_admin()) {
        return;
    }

    if (!get_page_by_path('dmca', OBJECT, 'page')) {
        add_rewrite_rule('^dmca/?$', 'index.php?ophim_dmca=1', 'top');
    }
    if (!get_page_by_path('terms', OBJECT, 'page')) {
        add_rewrite_rule('^terms/?$', 'index.php?ophim_terms=1', 'top');
    }
    if (!get_page_by_path('policy', OBJECT, 'page')) {
        add_rewrite_rule('^policy/?$', 'index.php?ophim_policy=1', 'top');
    }
    if (!get_page_by_path('cookie-policy', OBJECT, 'page')) {
        add_rewrite_rule('^cookie-policy/?$', 'index.php?ophim_cookie_policy=1', 'top');
    }
    if (!get_page_by_path('18-usc-2257', OBJECT, 'page')) {
        add_rewrite_rule('^18-usc-2257/?$', 'index.php?ophim_18_usc_2257=1', 'top');
    }
    // Luon map "/categories" ve trang tong hop, tranh bi bat vao rule taxonomy categories/{slug}.
    add_rewrite_rule('^categories/?$', 'index.php?ophim_categories_page=1', 'top');
    add_rewrite_rule('^tags/?$', 'index.php?ophim_tags_page=1', 'top');
    add_rewrite_rule('^tags/page/([0-9]+)/?$', 'index.php?ophim_tags_page=1&paged=$matches[1]', 'top');
    add_rewrite_rule('^pornstars/?$', 'index.php?ophim_pornstars_page=1', 'top');
    add_rewrite_rule('^pornstars/page/([0-9]+)/?$', 'index.php?ophim_pornstars_page=1&paged=$matches[1]', 'top');
    add_rewrite_rule('^most-viewed/?$', 'index.php?ophim_most_viewed_page=1', 'top');

    if (!get_option('ophim_legal_rewrite_flushed')) {
        flush_rewrite_rules(false);
        update_option('ophim_legal_rewrite_flushed', 1);
    }
    $rules = get_option('rewrite_rules');
    if (
        !get_option('ophim_categories_rewrite_flushed')
        || empty($rules)
        || !isset($rules['^categories/?$'])
        || $rules['^categories/?$'] !== 'index.php?ophim_categories_page=1'
    ) {
        flush_rewrite_rules(false);
        update_option('ophim_categories_rewrite_flushed', 1);
    }
    if (
        !get_option('ophim_tags_rewrite_flushed')
        || empty($rules)
        || !isset($rules['^tags/?$'])
        || $rules['^tags/?$'] !== 'index.php?ophim_tags_page=1'
        || !isset($rules['^tags/page/([0-9]+)/?$'])
        || $rules['^tags/page/([0-9]+)/?$'] !== 'index.php?ophim_tags_page=1&paged=$matches[1]'
        || !isset($rules['^pornstars/?$'])
        || $rules['^pornstars/?$'] !== 'index.php?ophim_pornstars_page=1'
        || !isset($rules['^pornstars/page/([0-9]+)/?$'])
        || $rules['^pornstars/page/([0-9]+)/?$'] !== 'index.php?ophim_pornstars_page=1&paged=$matches[1]'
        || !isset($rules['^most-viewed/?$'])
        || $rules['^most-viewed/?$'] !== 'index.php?ophim_most_viewed_page=1'
    ) {
        flush_rewrite_rules(false);
        update_option('ophim_tags_rewrite_flushed', 1);
        update_option('ophim_pornstars_rewrite_flushed', 1);
        update_option('ophim_most_viewed_rewrite_flushed', 1);
    }
}, 1);

add_filter('template_include', function ($template) {
    $dir = get_stylesheet_directory();
    if ((int) get_query_var('ophim_dmca')) {
        $t = $dir . '/page-dmca.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_terms')) {
        $t = $dir . '/page-terms.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_policy')) {
        $t = $dir . '/page-policy.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_cookie_policy')) {
        $t = $dir . '/page-cookie-policy.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_categories_page')) {
        $t = $dir . '/page-categories.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_tags_page')) {
        $t = $dir . '/page-tags.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_pornstars_page')) {
        $t = $dir . '/page-pornstars.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_most_viewed_page')) {
        $t = $dir . '/page-most-viewed.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    if ((int) get_query_var('ophim_18_usc_2257')) {
        $t = $dir . '/page-18-usc-2257.php';
        if (file_exists($t)) {
            return $t;
        }
    }
    return $template;
});