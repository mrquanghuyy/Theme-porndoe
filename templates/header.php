<?php
$pd_site_name = get_bloginfo('name');
$pd_search_placeholder = sprintf(__('Search on %s', 'ophim'), $pd_site_name);
$header_links = array();
$menu_locations = get_nav_menu_locations();
$primary_menu_id = isset($menu_locations['primary-menu']) ? (int) $menu_locations['primary-menu'] : 0;

if ($primary_menu_id) {
    $menu_items = wp_get_nav_menu_items($primary_menu_id);

    if (!empty($menu_items) && !is_wp_error($menu_items)) {
        foreach ($menu_items as $item) {
            if ((int) $item->menu_item_parent !== 0) {
                continue;
            }

            $header_links[] = array(
                'label'  => $item->title,
                'url'    => $item->url,
                'title'  => $item->attr_title ?: $item->title,
                'target' => $item->target,
                'rel'    => $item->xfn,
            );
        }
    }
}

if (empty($header_links)) {
    $header_links = array(
        array('label' => __('Newest Videos', 'ophim'), 'url' => home_url('/'), 'title' => __('Newest Videos', 'ophim'), 'target' => '', 'rel' => ''),
        array('label' => __('Most Viewed', 'ophim'), 'url' => home_url('/most-viewed'), 'title' => __('Most Viewed', 'ophim'), 'target' => '', 'rel' => ''),
        array('label' => __('Categories', 'ophim'), 'url' => home_url('/categories'), 'title' => __('Categories', 'ophim'), 'target' => '', 'rel' => ''),
        array('label' => __('Tags', 'ophim'), 'url' => home_url('/tags'), 'title' => __('Tags', 'ophim'), 'target' => '', 'rel' => ''),
        array('label' => __('Pornstars', 'ophim'), 'url' => home_url('/pornstars'), 'title' => __('Pornstars', 'ophim'), 'target' => '', 'rel' => ''),
    );
}

$pill_items = array_merge(
    porndoe_get_taxonomy_links('ophim_genres', 12),
    porndoe_get_taxonomy_links('ophim_actors', 8),
    porndoe_get_taxonomy_links('ophim_tags', 8)
);

$pill_items = array_values(array_reduce($pill_items, function ($carry, $item) {
    $key = md5(($item['name'] ?? '') . '|' . ($item['url'] ?? ''));
    if (!isset($carry[$key])) {
        $carry[$key] = $item;
    }
    return $carry;
}, array()));

$pill_items = array_slice($pill_items, 0, 24);
$mobile_genres = array_slice(porndoe_get_taxonomy_links('ophim_genres', 8), 0, 4);
$mobile_actors = array_slice(porndoe_get_taxonomy_links('ophim_actors', 8), 0, 4);
$mobile_video_links = array(
    array('name' => __('Latest Videos', 'ophim'), 'url' => home_url('/')),
    array('name' => __('Most Viewed', 'ophim'), 'url' => home_url('/most-viewed')),
    array('name' => __('Categories', 'ophim'), 'url' => home_url('/categories')),
    array('name' => __('Tags', 'ophim'), 'url' => home_url('/tags')),
);
$mobile_quick_links = array(
    array('name' => __('DMCA', 'ophim'), 'url' => home_url('/dmca')),
    array('name' => __('Terms of Service', 'ophim'), 'url' => home_url('/terms')),
    array('name' => __('Privacy Policy', 'ophim'), 'url' => home_url('/policy')),
    array('name' => __('Cookie Policy', 'ophim'), 'url' => home_url('/cookie-policy')),
);
?>
<div class="-h-ng-header-holder" data-scroll="up" data-pd-header>
    <div class="-h-ng-header">
        <div class="-h-box">
            <div class="-h-top">
                <ul class="-h-row">
                    <li class="-h-menu">
                        <button aria-label="Mobile menu" class="-h-button" data-roll="mobileLeftSidebar" data-pd-toggle="mobile-nav" type="button">
                            <svg height="48" viewBox="0 0 24 24" width="24">
                                <path fill="currentColor" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"></path>
                            </svg>
                        </button>
                    </li>

                    <li class="-h-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <?php echo porndoe_get_logo_markup(); ?>
                        </a>
                    </li>

                    <li class="-h-search">
                        <form class="-h-search-form" autocomplete="off" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                            <label class="-h-search-label" aria-label="<?php esc_attr_e('Search videos', 'ophim'); ?>">
                                <input class="-h-search-input" name="q" placeholder="<?php echo esc_attr($pd_search_placeholder); ?>" value="<?php echo isset($_GET['q']) ? esc_attr(wp_unslash($_GET['q'])) : ''; ?>">
                            </label>
                            <button type="submit" class="--h-search-button" aria-label="<?php esc_attr_e('Search videos', 'ophim'); ?>">
                                <svg height="24" viewBox="0 0 24 24" width="24">
                                    <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
                                </svg>
                            </button>
                        </form>
                    </li>

                    <li class="-h-others">
                        <a class="-h-games-link" href="<?php echo esc_url(home_url('/most-viewed')); ?>">
                            <span class="-h-upgrade-star">&#9892;</span>
                            Most Viewed
                        </a>
                    </li>

                    <li class="-h-magnum">
                        <button class="-h-push" type="button" data-pd-toggle="mobile-search" aria-label="<?php esc_attr_e('Open search', 'ophim'); ?>">
                            <svg height="24" viewBox="0 0 24 24" width="24">
                                <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
                            </svg>
                        </button>
                    </li>

                    
                </ul>
            </div>

            <div class="-h-mobile-search" hidden data-pd-panel="mobile-search">
                <div class="mobile-search-holder">
                    <div class="mobile-search-grid">
                        <form class="mobile-search-form" autocomplete="off" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                            <label style="display:flex" aria-label="<?php esc_attr_e('Search videos', 'ophim'); ?>">
                                <input class="mobile-search-input" name="q" placeholder="<?php echo esc_attr($pd_search_placeholder); ?>" value="<?php echo isset($_GET['q']) ? esc_attr(wp_unslash($_GET['q'])) : ''; ?>">
                            </label>
                            <div style="display:flex;align-items:center;justify-content:center">
                                <button type="reset" class="mobile-search-reset" aria-label="Reset" style="display:none;">
                                    <svg height="24" viewBox="0 0 24 24" width="24">
                                        <path fill="gray" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div style="display:flex;">
                                <button type="submit" class="mobile-search-submit" disabled>
                                    <svg height="24" viewBox="0 0 24 24" width="24">
                                        <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <button class="mobile-search-close" type="button" data-pd-close="mobile-search" aria-label="<?php esc_attr_e('Close search', 'ophim'); ?>" onclick="this.closest('[data-pd-panel]').hidden = true;">
                            <svg viewBox="0 0 24 24" width="24" height="24">
                                <path fill="currentColor" d="M12,2C17.53,2 22,6.47 22,12C22,17.53 17.53,22 12,22C6.47,22 2,17.53 2,12C2,6.47 6.47,2 12,2M15.59,7L12,10.59L8.41,7L7,8.41L10.59,12L7,15.59L8.41,17L12,13.41L15.59,17L17,15.59L13.41,12L17,8.41L15.59,7Z"></path>
                            </svg>
                        </button>
                    </div>

                    <style>
                        .mobile-search-holder {
                            position: relative;
                            padding: 8px 10px;
                        }
                        .mobile-search-grid {
                            display: grid;
                            grid-template-columns: auto 24px;
                            grid-gap: 10px;
                        }
                        .mobile-search-form {
                            display: grid;
                            grid-template-columns: auto 24px 40px;
                            grid-gap: 10px;
                            height: 32px;
                            background: rgb(40,40,40);
                            border-radius: 4px;
                        }
                        .mobile-search-submit {
                            border-radius: 3px;
                            background: none;
                            flex-grow: 1;
                            align-items: center;
                            justify-content: center;
                        }
                        .mobile-search-input {
                            flex-grow: 1;
                            color: inherit;
                            background: transparent;
                            text-indent: 10px;
                            font-size: 16px;
                        }
                        .mobile-search-close {
                            opacity: 0.7;
                        }
                    </style>
                </div>
            </div>
        </div>

        <div class="-h-bottom">
            <div class="-h-holder">
                <div class="header-nav-list">
                    <?php foreach ($header_links as $index => $item) : ?>
                        <?php $nav_class = ($index >= count($header_links) - 3) ? '' : 'header-nav-desktop'; ?>
                        <a class="header-nav-link <?php echo esc_attr($nav_class); ?>" href="<?php echo esc_url($item['url']); ?>" title="<?php echo esc_attr($item['title']); ?>"<?php echo !empty($item['target']) ? ' target="' . esc_attr($item['target']) . '"' : ''; ?><?php echo !empty($item['rel']) ? ' rel="' . esc_attr($item['rel']) . '"' : ''; ?>>
                        <?php echo esc_html($item['label']); ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="position:relative" hidden data-pd-panel="mobile-nav">
    <div class="-nav">
        <style>
            .-nav {
                position: fixed;
                z-index: 2003;
                left: 0;
                top: 0;
                right: auto;
                bottom: 0;
                width: 100%;
                background: rgba(0, 0, 0, .8);
                border-top: 2px solid #161617;
            }
            .-nav .-c {
                position: absolute;
                z-index: 10;
                left: 0;
                top: 0;
                right: auto;
                bottom: 0;
                width: 80%;
                min-width: 280px;
                background: #141414;
                overflow: auto;
                animation: -animMobileNav .3s linear 0s;
                scroll-behavior: smooth;
            }
            @-webkit-keyframes -animMobileNav {
                from { left: -100%; }
                to { left: 0; }
            }
            @keyframes -animMobileNav {
                from { left: -100%; }
                to { left: 0; }
            }
            .-nav .-fake {
                position: absolute;
                z-index: 5;
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                cursor: pointer;
            }
            .-nav-h1 {
                font-size: 15px;
                padding: 10px 20px;
                line-height: 18px;
                text-transform: uppercase;
                color: #f8f8f8;
                background: #000;
                border-bottom: rgba(255,255,255,0.1);
            }
            .-nav-list {
                padding: 10px 25px;
                display: grid;
                grid-template-columns: 1fr;
                align-items: center;
                grid-gap: 10px;
            }
            .-nav-list[data-active="false"] {
                display: none;
            }
            .-nav-list[data-active="true"] {
                padding-left: 34px;
                opacity: 0.65;
            }
            .-nav-item {
                display: grid;
                grid-template-columns: 24px auto 24px;
                grid-gap: 10px;
                align-items: center;
            }
            .-nav-list li.-hr {
                background: #ed1d24;
                height: 1px;
                margin: 3px 0;
                padding: 0;
            }
            .-nav-list li {
                padding: 3px 0;
            }
            .-nav-list span.-arrow {
                display: inline-flex;
                position: relative;
                width: 24px;
                height: 24px;
                justify-content: center;
                align-items: center;
            }
            .-nav-list span.-arrow:after {
                width: 0;
                height: 0;
                content: "";
                border-top: 7px solid #cacaca;
                border-right: 7px solid transparent;
                border-left: 7px solid transparent;
            }
            .-nav-list span.-arrow-full {
                width: 100%;
            }
            .-nav-sublist {
                padding: 3px 0 0;
            }
            .-nav-sublist[data-active="false"] {
                display: none;
            }
            .-arrow[data-active="true"] {
                -webkit-transform: scaleY(-1);
                -moz-transform: scaleY(-1);
                transform: scaleY(-1);
            }
            @media screen and (min-width: 1024px) {
                .-nav {
                    display: none !important;
                }
            }
            .-sidebar-icon {
                color: #d7d7d7;
                width: 24px;
                height: 24px;
                float: left;
                margin-right: 10px;
                text-align: center;
                font-size: 28px;
                line-height: 19px;
            }
        </style>
        <div class="-c">
            <div style="height:var(--header-top-height);background:var(--header-top-background);display:grid;grid-template-columns:auto 48px;align-items:center">
                <div class="sidebar-logo" style="padding-left:20px;">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
                        <?php echo porndoe_get_logo_markup(); ?>
                    </a>
                </div>
                <div class="sidebar-close">
                    <button type="button" data-pd-close="mobile-nav" aria-label="<?php esc_attr_e('Close menu', 'ophim'); ?>">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="-nav-h1">Main</div>
            <div class="-nav-list">
                <button class="-nav-item" type="button" data-pd-nav-trigger="mobile-videos">
                    <svg class="-sidebar-icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M17,10.5V7A1,1 0 0,0 16,6H4A1,1 0 0,0 3,7V17A1,1 0 0,0 4,18H16A1,1 0 0,0 17,17V13.5L21,17.5V6.5L17,10.5Z"></path>
                    </svg>
                    <span>Videos</span>
                    <span class="-arrow -arrow-full" data-active="false"></span>
                </button>
                <div class="-nav-list -nav-sublist" data-pd-nav-target="mobile-videos" data-active="false">
                    <?php foreach ($mobile_video_links as $item) : ?>
                        <a class="-nav-item" href="<?php echo esc_url($item['url']); ?>">
                            <svg class="-sidebar-icon" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                            </svg>
                            <span><?php echo esc_html($item['name']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <button class="-nav-item" type="button" data-pd-nav-trigger="mobile-categories">
                    <svg class="-sidebar-icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M16,20H20V16H16M16,14H20V10H16M10,8H14V4H10M16,8H20V4H16M10,14H14V10H10M4,14H8V10H4M4,20H8V16H4M10,20H14V16H10M4,8H8V4H4V8Z"></path>
                    </svg>
                    <span>Categories</span>
                    <span class="-arrow -arrow-full" data-active="false"></span>
                </button>
                <div class="-nav-list -nav-sublist" data-pd-nav-target="mobile-categories" data-active="false">
                    <a class="-nav-item" href="<?php echo esc_url(home_url('/categories')); ?>">
                        <svg class="-sidebar-icon" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                        </svg>
                        <span>All Categories</span>
                    </a>
                    <?php foreach ($mobile_genres as $item) : ?>
                        <a class="-nav-item" href="<?php echo esc_url($item['url']); ?>">
                            <svg class="-sidebar-icon" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12,2L1,21H23M12,6L19.53,19H4.47"></path>
                            </svg>
                            <span><?php echo esc_html($item['name']); ?></span>
                        </a>
                    <?php endforeach; ?>
                    <a class="-nav-item" href="<?php echo esc_url(home_url('/tags')); ?>">
                        <svg class="-sidebar-icon" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M21.41,11.58L12.41,2.58C12.05,2.22 11.55,2 11,2H4A2,2 0 0,0 2,4V11C2,11.55 2.22,12.05 2.59,12.41L11.59,21.41C11.95,21.77 12.45,22 13,22C13.55,22 14.05,21.78 14.41,21.41L21.41,14.41C21.78,14.05 22,13.55 22,13C22,12.45 21.77,11.94 21.41,11.58Z"></path>
                        </svg>
                        <span>Tags</span>
                    </a>
                </div>

                <button class="-nav-item" type="button" data-pd-nav-trigger="mobile-pornstars">
                    <svg class="-sidebar-icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M9,11.75A1.25,1.25 0 0,0 7.75,13A1.25,1.25 0 0,0 9,14.25A1.25,1.25 0 0,0 10.25,13A1.25,1.25 0 0,0 9,11.75M15,11.75A1.25,1.25 0 0,0 13.75,13A1.25,1.25 0 0,0 15,14.25A1.25,1.25 0 0,0 16.25,13A1.25,1.25 0 0,0 15,11.75M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20C7.59,20 4,16.41 4,12C4,11.71 4,11.42 4.05,11.14C6.41,10.09 8.28,8.16 9.26,5.77C11.07,8.33 14.05,10 17.42,10C18.2,10 18.95,9.91 19.67,9.74C19.88,10.45 20,11.21 20,12C20,16.41 16.41,20 12,20Z"></path>
                    </svg>
                    <span>Pornstars</span>
                    <span class="-arrow -arrow-full" data-active="false"></span>
                </button>
                <div class="-nav-list -nav-sublist" data-pd-nav-target="mobile-pornstars" data-active="false">
                    <a class="-nav-item" href="<?php echo esc_url(home_url('/pornstars')); ?>">
                        <svg class="-sidebar-icon" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"></path>
                        </svg>
                        <span>All Pornstars</span>
                    </a>
                    <?php foreach ($mobile_actors as $item) : ?>
                        <a class="-nav-item" href="<?php echo esc_url($item['url']); ?>">
                            <svg class="-sidebar-icon" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12,12A5,5 0 1,0 7,7A5,5 0 0,0 12,12M12,14C8.69,14 2,15.66 2,19V22H22V19C22,15.66 15.31,14 12,14Z"></path>
                            </svg>
                            <span><?php echo esc_html($item['name']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($header_links as $item) : ?>
                    <?php if (in_array($item['label'], array('Newest Videos', 'Most Viewed', 'Categories', 'Tags', 'Pornstars'), true)) { continue; } ?>
                    <a class="-nav-item" href="<?php echo esc_url($item['url']); ?>"<?php echo !empty($item['target']) ? ' target="' . esc_attr($item['target']) . '"' : ''; ?><?php echo !empty($item['rel']) ? ' rel="' . esc_attr($item['rel']) . '"' : ''; ?>>
                        <svg class="-sidebar-icon" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M4,6H20V8H4V6M4,11H20V13H4V11M4,16H20V18H4V16Z"></path>
                        </svg>
                        <span><?php echo esc_html($item['label']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="-nav-h1">Quick Links</div>
            <div class="-nav-list">
                <?php foreach ($mobile_quick_links as $item) : ?>
                    <a class="-nav-item" href="<?php echo esc_url($item['url']); ?>">
                        <svg class="-sidebar-icon" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M14,3V5H17.59L7.76,14.83L9.17,16.24L19,6.41V10H21V3M19,19H5V5H12V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19Z"></path>
                        </svg>
                        <span><?php echo esc_html($item['name']); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="-nav-h1">&nbsp;</div>
        </div>
        <div class="-fake" data-pd-close="mobile-nav"></div>
    </div>
</div>
<div class="-h-ticker">
    </div>
<?php if (!empty($pill_items)) : ?>
    <section class="-section">
        <div class="-holder-section">
            <div class="pills-carousel" data-pd-pills>
                <button class="-pc-btn -pc-left" type="button" aria-label="Previous" data-pd-pill-nav="-1">
                    <span class="-pc-arrow"></span>
                </button>
                <div class="-pc-scrollable">
                    <div class="-pc-fake">
                        <?php foreach ($pill_items as $item) : ?>
                            <a class="-pc-item" href="<?php echo esc_url($item['url']); ?>" title="<?php echo esc_attr($item['name']); ?>">
                                <?php echo esc_html($item['name']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="-pc-btn -pc-right" type="button" aria-label="Next" data-pd-pill-nav="1">
                    <span class="-pc-arrow"></span>
                </button>
            </div>
        </div>
    </section>
<?php endif; ?>