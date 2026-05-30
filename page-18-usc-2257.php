<?php

get_header();

$site_name = get_bloginfo('name');
$site_url = home_url('/');
$contact_email = get_option('admin_email');
?>
<main class="-main">
    <section class="-section">
        <div class="-holder -legal-page">
            <h1 class="-heading">18 U.S.C. §2257 Compliance Statement</h1>
            <p><em>Last updated: <?php echo esc_html(date_i18n('F j, Y')); ?></em></p>

            <p><?php echo esc_html($site_name); ?> is not involved in the hiring, contracting for, managing, or otherwise arranging for the participation of any performers shown in visual content appearing on <?php echo esc_html($site_name); ?> and its websites, unless clearly stated otherwise. <?php echo esc_html($site_name); ?> is not the primary producer (as that term is defined in 18 U.S.C. §2257 or 28 C.F.R. §75.1) of visual content provided through the Site unless clearly stated otherwise.</p>

            <p><?php echo esc_html($site_name); ?> has been informed and believes that performers, models, and other persons that appear in any visual depiction of actual sexually explicit conduct (as defined in 18 U.S.C. §2257) appearing or otherwise provided through third-party sources linked from <?php echo esc_html($site_name); ?> were over the age of eighteen years at the time of the creation of those depictions. Other pictures, graphics, videos, or visual content that are exempt from 18 U.S.C. §2257 and 28 C.F.R. §75.1 et seq. are provided as permitted because they do not consist of content subject to those laws and regulations.</p>

            <p>Visual content produced for, provided by, and explicitly displayed under the <?php echo esc_html($site_name); ?> brand, where applicable, is intended to comply with United States Code, Title 18, Section 2257. All models, actors, actresses, and other persons who appear in any visual depiction of actual sexually explicit conduct on pages operated directly by <?php echo esc_html($site_name); ?> were over the age of eighteen years at the time such depictions were created and appear exclusively in roles depicting them as adults.</p>

            <p>The custodian of records for content for which <?php echo esc_html($site_name); ?> is the primary producer, if any, may be reached through the contact information published on the Site. For questions pertaining to content accessed through <?php echo esc_html($site_name); ?>, please contact: <a class="anchor" href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>.</p>

            <p>For third-party hosted material, records required under 18 U.S.C. §2257 are maintained by the respective producer or uploader of that content, not by <?php echo esc_html($site_name); ?>.</p>
        </div>
    </section>
</main>
<?php
get_footer();
