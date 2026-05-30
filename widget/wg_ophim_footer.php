<?php
class WG_oPhim_Footer extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'wg_footer', // Base ID
            __( 'Ophim Footer', 'ophim' ), // Name
            array( 'description' => __( 'Mẫu footer', 'ophim' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract($args);
        ob_start();
        $footer = $instance['footer'] ?? '';
        if ($footer !== '') {
            $footer = preg_replace(
                '#<div class="-footer-paper-holder">.*?</div>\s*#s',
                '',
                $footer,
                1
            );
        }
        echo $footer;
        echo $after_widget;
        $html = ob_get_contents();
        ob_end_clean();
        echo $html;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    function form($instance)
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title' 	=> '',
            'slug' 	=> '#',
            'postnum' 	=> 5,
            'style'		=> '1',
            'status'		=> 'all',
            'orderby'		=> 'new',
            'categories'		=> 'all',
            'actors'		=> 'all',
            'directors'		=> 'all',
            'genres'		=> 'all',
            'regions'		=> 'all',
            'years'		=> 'all',
        ) );
        extract($instance);

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('footer'); ?>"><?php _e('Footer', 'ophim') ?></label>
            <br />
            <textarea class="widefat" rows="10" id="<?php echo $this->get_field_id('footer'); ?>" name="<?php echo $this->get_field_name('footer'); ?>"  ><?php if(isset($instance['footer']) && $instance['footer']){ echo $instance['footer'];}else{ ?>  <footer class="bg-surface-variant mt-12 py-12">
	<div class="container mx-auto px-4">
		<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
			<div>
				<a href="<?= esc_url(home_url('/')) ?>" class="inline-flex items-center"><img src="<?= esc_url(get_template_directory_uri() . '/assets/images/porndoe-logo.png') ?>" alt="<?= esc_attr(get_bloginfo('name')) ?>" style="max-height:40px"></a>
				<p class="xmf-footer-copy">Watch and browse the latest videos on <?= esc_html(get_bloginfo('name')) ?>.</p>
			</div>
			<div>
				<h4 class="text-on-surface font-semibold mb-4">Browse</h4>
				<ul class="space-y-2 text-sm text-on-surface-variant">
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/')) ?>">Latest Videos</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/categories')) ?>">Categories</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/tags')) ?>">Tags</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/pornstars')) ?>">Stars</a></li>
				</ul>
			</div>
			<div>
				<h4 class="text-on-surface font-semibold mb-4">Legal</h4>
				<ul class="space-y-2 text-sm text-on-surface-variant">
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/dmca')) ?>">DMCA</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/terms')) ?>">Terms of Service</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/policy')) ?>">Privacy Policy</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/cookie-policy')) ?>">Cookie Policy</a></li>
					<li><a class="hover:text-primary" href="<?= esc_url(home_url('/18-usc-2257')) ?>">18 U.S.C 2257</a></li>
				</ul>
			</div>
			<div>
                <p class="text-xs text-on-surface-variant opacity-70 mb-2">
                    All models appearing on this website are 18 years or older.
                </p>
                <p class="text-xs text-on-surface-variant opacity-70 mb-2">
                    This site does not store any files on its server. All contents are provided by non-affiliated third
                    parties. We are just a search engine for such content.
                </p>
                <p class="text-xs text-on-surface-variant opacity-70">
                    We are not responsible for the accuracy, compliance, copyright, legality, decency, or any other
                    aspect of the content of linked sites.
                </p>
            </div>
		</div>
		<div class="border-t border-outline/20 mt-8 pt-8 text-center text-xs text-on-surface-variant">Copyright &copy; <?= esc_html(gmdate('Y')) ?> <?= esc_html(get_bloginfo('name')) ?>. All rights reserved.</div>
	</div>
</footer><?php } ?></textarea>
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['footer'] = $new_instance['footer'];
        return $instance;
    }

}
function register_new_widget_Footer() {
    register_widget( 'WG_oPhim_Footer' );
}
add_action( 'widgets_init', 'register_new_widget_Footer' );
