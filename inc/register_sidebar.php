<?php

/*
* Tạo sidebar cho theme
*/

$arena = array('name' => __('Ophim Màn hình chính', 'ophim'), 'id' => 'widget-area',
    'description' => 'Hiển thị ở phim ở trang chủ',
    'class' => 'widget-area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',);
register_sidebar($arena);

$top_slider = array('name' => __('Home Top Slider', 'ophim'), 'id' => 'widget-top-slider',
    'description' => 'Hiển thị slider top ở đầu trang chủ',
    'class' => 'widget-top-slider',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',);
register_sidebar($top_slider);

$footer = array('name' => __('Ophim Footer', 'ophim'), 'id' => 'widget-footer',
    'description' => 'Hiển thị ở phim ở cuối trang',
    'class' => '',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',);
register_sidebar($footer);