<?php
$post_id = get_the_ID();
$permalink = get_permalink($post_id);
$title = get_the_title($post_id);
$thumb = op_get_poster_url();
$runtime = op_get_runtime();
$site_term = porndoe_get_video_site_term($post_id);
$site_link = $site_term ? get_term_link($site_term) : '';
if (is_wp_error($site_link)) {
    $site_link = '';
}
$actors = porndoe_get_video_actors($post_id, 2);
$views = porndoe_get_video_views($post_id);
$preview_enabled = get_theme_mod('ophim_hover_preview', true);
$preview_images = function_exists('op_get_preview_images') ? op_get_preview_images() : array();
$preview_attr = '';
if ($preview_enabled && count($preview_images) >= 1) {
    $preview_attr = ' data-preview-images="' . esc_attr(wp_json_encode($preview_images)) . '"';
}
?>
<div class="video-item js-hover-preview" data-video-item data-exclusive="false" <?php echo $preview_attr; ?> data-duration="<?php echo esc_attr($runtime ?: 'HD'); ?>" data-vr="false" data-hd="true" data-views="<?php echo esc_attr(porndoe_format_compact_number($views)); ?>">
    <div style="overflow: hidden; position: relative;">
        <div class="video-item-block">
            <img class="video-item-svg js-preview-img" style="aspect-ratio: 16/9;" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
        </div>
        <a class="video-item-link" target="_self" href="<?php echo esc_url($permalink); ?>" aria-label="<?php echo esc_attr($title); ?>"></a>
        <div class="video-item-stats">
            <span class="video-item-time"><?php echo esc_html($runtime ?: 'HD'); ?></span>
            <!-- <span class="video-item-hd">HD</span> -->
        </div>
        <div data-vi="bottom">
            <span data-vi="views"><?php echo esc_html(porndoe_format_compact_number($views)); ?></span>
        </div>
    </div>

    <a class="video-item-title" href="<?php echo esc_url($permalink); ?>" title="<?php echo esc_attr($title); ?>">
        <?php echo esc_html($title); ?>
    </a>

    <div class="video-item-bottom">

        <span class="video-item-gap"></span>

        <?php foreach ($actors as $index => $actor) : ?>
            <?php $actor_link = get_term_link($actor); ?>
            <?php if (is_wp_error($actor_link)) { continue; } ?>
            <?php if ($index > 0) : ?>
                <span class="video-item-spacer">&amp;</span>
            <?php endif; ?>
            <a class="video-item-actor" data-vi="actor-<?php echo (int) $index; ?>" href="<?php echo esc_url($actor_link); ?>" title="<?php echo esc_attr($actor->name); ?>">
                <?php echo esc_html($actor->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
