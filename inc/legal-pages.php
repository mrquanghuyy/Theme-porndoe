<?php
/**
 * Biến dùng chung cho các trang pháp lý (Privacy, Terms, DMCA, 2257, Cookie).
 */
function porndoe_legal_site_vars() {
    return array(
        'site_name'   => get_bloginfo('name'),
        'site_url'    => home_url('/'),
        'admin_email' => get_option('admin_email'),
        'year'        => (string) gmdate('Y'),
    );
}
