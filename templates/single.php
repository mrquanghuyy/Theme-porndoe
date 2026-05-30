<?php
$actors_list = get_the_terms(get_the_ID(), 'ophim_actors');
$genres = get_the_terms(get_the_ID(), 'ophim_genres');
$categories = get_the_terms(get_the_ID(), 'ophim_categories');
$tags = get_the_terms(get_the_ID(), 'ophim_tags');
$first_episode = get_first_episode_info();
$primary_genre = (!empty($genres) && !is_wp_error($genres)) ? $genres[0] : null;
$primary_term = porndoe_get_video_site_term(get_the_ID());
$breadcrumb_term = $primary_genre ?: $primary_term;
$breadcrumb_term_link = $breadcrumb_term ? get_term_link($breadcrumb_term) : '';
$videos_link = get_post_type_archive_link('ophim') ?: home_url('/');
$site_name = get_bloginfo('name');

$render_term_links = function ($terms) {
    if (empty($terms) || is_wp_error($terms)) {
        return '';
    }

    $items = array();
    foreach ($terms as $term) {
        $link = get_term_link($term);
        if (is_wp_error($link)) {
            continue;
        }

        $items[] = sprintf('<a href="%s">%s</a>', esc_url($link), esc_html($term->name));
    }

    return implode(', ', $items);
};

$content_html = trim(apply_filters('the_content', get_the_content()));
$genres_links = $render_term_links($genres);
$actors_links = $render_term_links($actors_list);
$categories_links = $render_term_links($categories);
$tags_links = $render_term_links($tags);
$has_video_meta = $content_html || $genres_links || $actors_links || $categories_links || $tags_links;
$view_count = (int) op_get_post_view();
$like_count = (int) op_get_like_count();
$dislike_count = (int) op_get_dislike_count();
$submitted_ago = sprintf(
    '%s ago',
    human_time_diff(get_the_time('U'), current_time('timestamp'))
);
?>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/detail.css">
<section class="-section">
    <div class="-holder">
        <div class="crumbs-list" itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="crumbs-link" itemprop="item" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>">
                    <span itemprop="name"><?php echo esc_html($site_name); ?></span>
                </a>
                <meta itemprop="position" content="1">
            </span>
            <span>»</span>
            <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a class="crumbs-link" itemprop="item" href="<?php echo esc_url($videos_link); ?>" title="Videos">
                    <span itemprop="name">Videos</span>
                </a>
                <meta itemprop="position" content="2">
            </span>
            <?php if ($breadcrumb_term && !is_wp_error($breadcrumb_term_link)) : ?>
                <span>»</span>
                <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <a class="crumbs-link" itemprop="item" href="<?php echo esc_url($breadcrumb_term_link); ?>" title="<?php echo esc_attr($breadcrumb_term->name); ?>">
                        <span itemprop="name"><?php echo esc_html($breadcrumb_term->name); ?></span>
                    </a>
                    <meta itemprop="position" content="3">
                </span>
                <span>»</span>
                <span class="crumbs-name" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <meta itemprop="item" content="<?php echo esc_url(get_permalink()); ?>">
                    <span itemprop="name"><?php the_title(); ?></span>
                    <meta itemprop="position" content="4">
                </span>
            <?php else : ?>
                <span>»</span>
                <span class="crumbs-name" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                    <meta itemprop="item" content="<?php echo esc_url(get_permalink()); ?>">
                    <span itemprop="name"><?php the_title(); ?></span>
                    <meta itemprop="position" content="3">
                </span>
            <?php endif; ?>
        </div>
    </div>
</section>
<main class="-main">
    <section class="-section">
        <div class="-holder -flex">
            <div class="-grow">
                <h1 class="-heading-one"><?php the_title(); ?></h1>
            </div>
            <div class="-items-center">
                <span class="home-more-desktop"><?php echo esc_html(get_the_date('F j, Y')); ?></span>
            </div>
        </div>
    </section>

    <section class="-holder">
        <div class="player-row">
            <div class="player-left">
                <section class="player-section">
                    <div class="player-video" style="position:relative;width:100%;height:0;padding-bottom:56.25%;background:#000;overflow:hidden;">
                        <?php if ($first_episode) : ?>
                            <?php if (!empty($first_episode['link_m3u8'])) : ?>
                                <button style="display:none;" data-id="<?php echo esc_attr($first_episode['server_key']); ?>" data-link="<?php echo esc_attr($first_episode['link_m3u8']); ?>" data-type="m3u8" onclick="chooseStreamingServer(this)" class="pu-link player__cdn set-player-source">Server 1</button>
                            <?php elseif (!empty($first_episode['link_embed'])) : ?>
                                <button style="display:none;" data-id="<?php echo esc_attr($first_episode['server_key']); ?>" data-link="<?php echo esc_attr($first_episode['link_embed']); ?>" data-type="embed" onclick="chooseStreamingServer(this)" class="pu-link player__cdn set-player-source">Server 2</button>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="player-poster-abs" id="player-wrapper1"></div>
                    </div>
                </section>

                <section>
                    <div class="-box-shadow-bottom" style="padding: 10px">
                        <h1 class="-heading -heading-and-free-label"><?php the_title(); ?></h1>
                        <div class="vpa-holder">
                            <div class="vpa-stats">
                                <div class="-grid-inline -grid-gap vpa-stats-grid">
                                    <div><span data-pd-view-count><?php echo esc_html(number_format_i18n($view_count)); ?></span> Views</div>
                                    <div><span class="vpc-pipe"></span></div>
                                    <div><span data-pd-like-count><?php echo esc_html(number_format_i18n($like_count)); ?></span> Likes</div>
                                    <div><span class="vpc-pipe"></span></div>
                                    <div><?php echo esc_html($submitted_ago); ?></div>
                                </div>
                            </div>
                            <div class="vpa-actions">
                                <ul class="vpa-list">
                                    <li class="vpa-item">
                                        <a href="#like" class="vpa-button rate-like btn-like" data-id="<?php echo esc_attr(get_the_ID()); ?>" title="I like this video" aria-label="Like" aria-pressed="false">
                                            <svg height="22" width="22" viewBox="0 0 24 24">
                                                <path data-pd-vote-outline fill="currentColor" d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z"></path>
                                                <path data-pd-vote-check fill="green" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" style="display: none;"></path>
                                            </svg>
                                            <span>Like</span>
                                        </a>
                                    </li>
                                    <li class="vpa-item">
                                        <a href="#dislike" class="vpa-button rate-dislike btn-dislike" data-id="<?php echo esc_attr(get_the_ID()); ?>" title="I don't like this video" aria-label="Dislike" aria-pressed="false">
                                            <svg height="22" width="22" viewBox="0 0 24 24">
                                                <path data-pd-vote-outline fill="currentColor" d="M19,15H23V3H19M15,3H6C5.17,3 4.46,3.5 4.16,4.22L1.14,11.27C1.05,11.5 1,11.74 1,12V14A2,2 0 0,0 3,16H9.31L8.36,20.57C8.34,20.67 8.33,20.77 8.33,20.88C8.33,21.3 8.5,21.67 8.77,21.94L9.83,23L16.41,16.41C16.78,16.05 17,15.55 17,15V5C17,3.89 16.1,3 15,3Z"></path>
                                                <path data-pd-vote-check fill="red" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" style="display: none;"></path>
                                            </svg>
                                            <span>Dislike</span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php if ($has_video_meta) : ?>
                    <div class="-box-shadow-bottom video-meta-box" style="padding: 10px">
                        <?php if ($content_html) : ?>
                            <div class="video-meta-block">
                                <p class="vpp-title">Mô tả phim</p>
                                <div class="video-meta-description"><?php echo wp_kses_post($content_html); ?></div>
                            </div>
                        <?php endif; ?>

                        <dl class="video-meta-list">
                            <?php if ($genres_links) : ?>
                                <div class="video-meta-row">
                                    <dt class="video-meta-label">Genre:</dt>
                                    <dd class="video-meta-value"><?php echo $genres_links; ?></dd>
                                </div>
                            <?php endif; ?>

                            <?php if ($actors_links) : ?>
                                <div class="video-meta-row">
                                    <dt class="video-meta-label">Actor:</dt>
                                    <dd class="video-meta-value"><?php echo $actors_links; ?></dd>
                                </div>
                            <?php endif; ?>

                            <?php if ($categories_links) : ?>
                                <div class="video-meta-row">
                                    <dt class="video-meta-label">Thể loại:</dt>
                                    <dd class="video-meta-value"><?php echo $categories_links; ?></dd>
                                </div>
                            <?php endif; ?>

                            <?php if ($tags_links) : ?>
                                <div class="video-meta-row">
                                    <dt class="video-meta-label">Từ khóa:</dt>
                                    <dd class="video-meta-value video-meta-tags"><?php echo $tags_links; ?></dd>
                                </div>
                            <?php endif; ?>
                        </dl>
                    </div>
                    <?php endif; ?>

                    <div class="-box-shadow-bottom" style="padding: 10px">
                        <p class="vpp-title">Pornstars</p>

                        <div>
                            <?php if (!empty($actors_list) && !is_wp_error($actors_list)) : ?>
                                <?php foreach ($actors_list as $actor) : ?>
                                    <?php
                                    $actor_link = get_term_link($actor);
                                    if (is_wp_error($actor_link)) {
                                        continue;
                                    }

                                    $actor_avatar = get_term_meta($actor->term_id, 'actor_avatar', true);
                                    if (empty($actor_avatar)) {
                                        $actor_avatar = get_term_meta($actor->term_id, 'actor_image', true);
                                    }
                                    ?>
                                    <a class="movie-actor-item" href="<?php echo esc_url($actor_link); ?>" title="<?php echo esc_attr($actor->name); ?>">
                                        <svg class="movie-actor-avatar" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"<?php echo $actor_avatar ? ' style="background-image:url(' . esc_url($actor_avatar) . ')"' : ''; ?>></svg>
                                        <?php echo esc_html($actor->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section class="-section">
        <div class="-holder">
            <h2 class="-heading -heading-similar">Watch similar videos</h2>
        </div>
        <div class="-holder">
            <div class="videos-list">
                <?php
                $taxonomy = get_the_terms(get_the_ID(), 'ophim_genres');
                if (!empty($taxonomy) && !is_wp_error($taxonomy)) {
                    $category_ids = array();
                    foreach ($taxonomy as $individual_category) {
                        $category_ids[] = $individual_category->term_id;
                    }
                    $related_query = new WP_Query(array(
                        'post_type'      => 'ophim',
                        'post__not_in'   => array(get_the_ID()),
                        'posts_per_page' => 20,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'ophim_genres',
                                'field'    => 'term_id',
                                'terms'    => $category_ids,
                            ),
                        ),
                    ));
                    $rank = 0;
                    while ($related_query->have_posts()) {
                        $related_query->the_post();
                        ?>
                        <div data-fake-key="<?php echo (int) $rank; ?>">
                            <?php get_template_part('templates/section/section_thumb_item'); ?>
                        </div>
                        <?php
                        $rank++;
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php
add_action('wp_footer', function (){?>
    <script src="<?= get_template_directory_uri() ?>/assets/player/js/p2p-media-loader-core.min.js"></script>
    <script src="<?= get_template_directory_uri() ?>/assets/player/js/p2p-media-loader-hlsjs.min.js"></script>
    <?php op_jwpayer_js(); ?>
    <script>
        
        var episode_id = '<?= get_first_episode_info()['server_key'] ?>';
        const wrapper = document.getElementById('player-wrapper1');
        const vastAds = "<?= get_option('ophim_jwplayer_advertising_file') ?>";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            episode_id = id;

            Array.from(document.getElementsByClassName('pu-link')).forEach(server => {
                server.classList.remove('player__cdn--active');
            })
            el.classList.add('player__cdn--active');
            wrapper.style.display = 'block';

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "<?= get_option('ophim_jwplayer_license', 'ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=') ?>",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "<?= get_template_directory_uri() ?>/assets/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "<?= get_option('ophim_jwplayer_advertising_file') ?>",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: <?= get_option('ophim_jwplayer_advertising_skipoffset') ?:  5 ?>,
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "<?= get_option('ophim_jwplayer_license', 'ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=') ?>",
                    aspectratio: "16:9",
                    width: "100%",
                    image: "<?= op_get_poster_url() ?>",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "<?= get_option('ophim_jwplayer_logo_file') ?>",
                        link: "<?= get_option('ophim_jwplayer_logo_link') ?>",
                        position: "<?= get_option('ophim_jwplayer_logo_position') ?>",
                    },
                    advertising: {
                        tag: "<?= get_option('ophim_jwplayer_advertising_file') ?>",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: <?= get_option('ophim_jwplayer_advertising_skipoffset') ?:  5 ?>,
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue,
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '<?= get_first_episode_info()['server_key'] ?>';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('pu-link');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>
<?php }) ?>