<?php
/**
 * Menu chính: mục không con là <li><a>, mục có con là .dropdown + .dropdown-content/.dropdown-list (khớp CSS theme).
 */

if (!class_exists('TWF_Primary_Nav_Walker')) {

    class TWF_Primary_Nav_Walker extends Walker_Nav_Menu {

        /**
         * @param string $output
         */
        public function start_lvl(&$output, $depth = 0, $args = null) {
            if ($depth === 0) {
                $output .= '<div class="dropdown-content"><div class="dropdown-list">';
            }
        }

        /**
         * @param string $output
         */
        public function end_lvl(&$output, $depth = 0, $args = null) {
            if ($depth === 0) {
                $output .= '</div></div>';
            }
        }

        /**
         * @param string $output
         */
        public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $has_children = in_array('menu-item-has-children', $classes, true);

            if ($depth === 0) {
                $li_classes = array_merge(array('menu-item'), $classes);
                if ($has_children) {
                    $li_classes[] = 'dropdown';
                }
                $output .= '<li class="' . esc_attr(implode(' ', array_filter($li_classes))) . '">';
                $href = !empty($item->url) ? $item->url : '#';
                $link_class = $has_children ? ' class="dropdown-link"' : '';
                $title = apply_filters('nav_menu_item_title', $item->title, $item, $args, $depth);
                $output .= '<a href="' . esc_url($href) . '"' . $link_class . '>' . esc_html($title) . '</a>';
            } elseif ($depth === 1) {
                $title = apply_filters('nav_menu_item_title', $item->title, $item, $args, $depth);
                $output .= '<a href="' . esc_url($item->url) . '">' . esc_html($title) . '</a>';
            }
        }

        /**
         * @param string $output
         */
        public function end_el(&$output, $item, $depth = 0, $args = null) {
            if ($depth === 0) {
                $output .= '</li>';
            }
        }
    }
}
