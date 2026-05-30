<?php
/**
 * Template Name: Danh sách Tags
 */
get_header();

$site_name = get_bloginfo('name');

$total_tags = wp_count_terms(array(
    'taxonomy'   => 'ophim_tags',
    'hide_empty' => true,
));
if (is_wp_error($total_tags)) {
    $total_tags = 0;
}

$tags = get_terms(array(
    'taxonomy'   => 'ophim_tags',
    'hide_empty' => true,
    'number'     => 0,
    'orderby'    => 'name',
    'order'      => 'ASC',
));

$grouped_tags = array();

if (!is_wp_error($tags) && !empty($tags)) {
    foreach ($tags as $tag) {
        $first_char = function_exists('mb_substr') ? mb_substr($tag->name, 0, 1, 'UTF-8') : substr($tag->name, 0, 1);
        $first_char = strtoupper(remove_accents((string) $first_char));
        $group_key = preg_match('/^[A-Z]$/', $first_char) ? $first_char : '0';

        if (!isset($grouped_tags[$group_key])) {
            $grouped_tags[$group_key] = array();
        }

        $grouped_tags[$group_key][] = $tag;
    }

    $ordered_groups = array();
    if (isset($grouped_tags['0'])) {
        $ordered_groups['0'] = $grouped_tags['0'];
        unset($grouped_tags['0']);
    }
    ksort($grouped_tags);
    $grouped_tags = $ordered_groups + $grouped_tags;
}
?>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/tax.css">
<main class="-main">
    <section class="-section -box-shadow-bottom">
        <div class="-holder">
            <h1 class="-heading-one -shadow-after">Most Popular Porn Tags</h1>
        </div>
    </section>

    <section class="-section">
        <div class="-holder -color-gray">
            <p><?php echo esc_html($site_name); ?> is a porn paradise for adults that features a wide range of incredible free sex videos and remarkable porn movies. Finding only the best XXX movies is never easy, however with our sorted adult niches, you can easily find only the best adult videos. Explore all the types of professional movies in our library, who knows, maybe you find out you're into some kinky fetishes you never knew existed.</p>        </div>
    </section>

    <section class="-section-header">
        <div class="-holder-section">
            <?php if (!empty($grouped_tags)) : ?>
                <?php foreach ($grouped_tags as $letter => $letter_tags) : ?>
                    <section class="-section">
                        <h2 class="-heading-two"><?php echo esc_html($letter); ?></h2>
                        <ul class="tags-list -box-shadow-top">
                            <?php foreach ($letter_tags as $tag) : ?>
                                <?php
                                $link = get_term_link($tag);
                                if (is_wp_error($link)) {
                                    continue;
                                }
                                ?>
                                <li class="tags-item">
                                    <a class="tags-link" href="<?php echo esc_url($link); ?>">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="-holder-section">
                    <?php esc_html_e('Hiện chưa có tag nào để hiển thị.', 'ophim'); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<section class="-section -box-shadow-bottom">
        <div class="-holder-section">
            <h6 class="-grow -shadow-after -heading-two">
                Best XXX Tags            </h6>
        </div>
    </section>
    <section class="-section">
    <div class="-holder-section">
        <div class="-less-section" data-active="false">
            <div class="-less-content">
                                                
                
                                    <?php
                                    $tags_seo = 'If you\'ve made it this far, it means you\'re into something darker and more tailored to a specific niche; we can definitely help. You will find here the best niched porn tags you can imagine. We update our lists weekly to make sure we can classify our content as cleanly as possible so you don\'t waste your time shuffling through literally thousands of free porn videos. From black pussy to live sex porn videos, you will find the oddest to the sexiest porn movies out there. Discover niched content bringing you the hottest eastern European girl in tights, sucking off a big juicy dick and stroking another with her feet. Maybe you\'re into new porn stars getting their first dick on camera with their tight fresh tits and dripping little pussies. How about picking up girls on the side of the road and paying them for a quick anal session before they g to work? Come on, we know if a van filled with hot porn stars would pull up you would walk right in and have a morning fuck session with these gorgeous vixens. They\'ll swallow that cock whole before you even get it out of your pants! And that\'s what the fantasy is all about, you being able to get yourself in these similar situations. Pornstars are no different from your every day girl, only difference is instead of avoiding to act on her sexual drive, pornstars go for it, they take it all, literally! Don\'t get fooled by all those other sites bringing you the run usual porn tags and categories. We actually take the time to search and investigate the type of porn you guys love and we accordingly classify them with these tags. Easily accessible, makes it simple for you to get to the videos you want. Filter some more once you get to the XXX movies you chose and explore the newest and most popular tagged porn videos. Nothing but full HD and 4K porn scenes can be found on our site, unless vintage is what you need. Not to worry, we\'ve got tons of that too. Search through the hundreds of more niched porn searches to find the best porn video for you, the one that will make you come back for more ultra realistic, cum dripping hardcore free porn videos, only on Porndoe.com.';
                                    $tags_seo = str_replace(
                                        array('Porndoe.com', 'PornDoe.com', 'porndoe.com', 'PornDoe', 'Porndoe'),
                                        $site_name,
                                        $tags_seo
                                    );
                                    ?>
                                    <p><?php echo esc_html($tags_seo); ?></p>                
            </div>
        </div>
        <div class="-less-actions" data-active="false">
            <button class="-less-button">
                <span>Show more</span>
                
            </button>
        </div>
    </div>
</section>
<?php
get_footer();
