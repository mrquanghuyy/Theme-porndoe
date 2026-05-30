<section class="xmf-section mb-12">
    <div class="flex items-center justify-between gap-3 mb-6 border-b border-outline/20">
        <h2 class="text-2xl md:text-3xl font-bold py-3 text-on-surface">
            <?php echo esc_html($title); ?>
        </h2>
        <?php if (!empty($slug) && $slug !== '#') : ?>
            <a class="px-4 py-2 border border-outline rounded-full text-sm font-medium flex items-center text-on-surface hover:text-primary transition-colors" href="<?php echo esc_url($slug); ?>">
                <?php esc_html_e('View all', 'ophim'); ?>
            </a>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php while ($query->have_posts()) : $query->the_post(); ?>
            <?php get_template_part('templates/section/section_thumb_item'); ?>
        <?php endwhile; ?>
    </div>
</section>