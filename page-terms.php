<?php
/**
 * Template trang Terms of Service (slug: terms).
 */

get_header();

$site_name = get_bloginfo('name');
$site_url = home_url('/');
$contact_email = get_option('admin_email');
?>

<main class="-main">
    <section class="-section">
        <div class="-holder -holder-privacy -legal-page">
            <h1 class="-heading-one">Terms of Service</h1>
            <p><em>Last updated: <?php echo esc_html(date_i18n('F j, Y')); ?></em></p>

            <p>These Terms of Service ("Terms") govern your access to and use of <a class="anchor" href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_name); ?></a> (the "Site"). By using the Site, you agree to these Terms. If you do not agree, do not use the Site.</p>

            <h2 class="-heading">1. Eligibility</h2>
            <p>You must be at least 18 years old (or the age of majority in your jurisdiction) to use the Site. By accessing the Site, you represent that you meet this requirement and that viewing adult material is legal where you are located.</p>

            <h2 class="-heading">2. Nature of the Service</h2>
            <p><?php echo esc_html($site_name); ?> provides an online directory and discovery experience for adult video content. Unless expressly stated otherwise, we do not host video files on our servers. Content is indexed, linked, or embedded from third-party sources. We are not the producer of third-party content displayed through external links or players.</p>

            <h2 class="-heading">3. Acceptable Use</h2>
            <p>You agree not to:</p>
            <ul>
                <li>Use the Site for any unlawful purpose or in violation of applicable laws.</li>
                <li>Attempt to gain unauthorized access to the Site, its servers, or related systems.</li>
                <li>Scrape, crawl, or harvest data from the Site in a manner that disrupts normal operation.</li>
                <li>Upload, distribute, or promote illegal content, including content involving minors.</li>
                <li>Infringe intellectual property or privacy rights of others.</li>
                <li>Use automated tools to generate fraudulent traffic or manipulate rankings.</li>
            </ul>

            <h2 class="-heading">4. Intellectual Property</h2>
            <p>The Site design, branding, layout, and original materials are owned by or licensed to <?php echo esc_html($site_name); ?> and protected by applicable copyright and trademark laws. Third-party trademarks, logos, and media remain the property of their respective owners.</p>

            <h2 class="-heading">5. Third-Party Links and Content</h2>
            <p>The Site may contain links to third-party websites and services. We do not control and are not responsible for third-party content, policies, or practices. Your use of third-party sites is at your own risk and subject to their terms.</p>

            <h2 class="-heading">6. Disclaimer of Warranties</h2>
            <p>The Site is provided on an "as is" and "as available" basis without warranties of any kind, whether express or implied, including merchantability, fitness for a particular purpose, and non-infringement. We do not guarantee uninterrupted access, accuracy of metadata, or availability of any particular video or category.</p>

            <h2 class="-heading">7. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law, <?php echo esc_html($site_name); ?> and its operators shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising from your use of the Site, including loss of data, profits, or goodwill.</p>

            <h2 class="-heading">8. Indemnification</h2>
            <p>You agree to indemnify and hold harmless <?php echo esc_html($site_name); ?> from claims, damages, losses, and expenses (including reasonable legal fees) arising from your misuse of the Site or violation of these Terms.</p>

            <h2 class="-heading">9. Content Removal and Copyright</h2>
            <p>If you believe content accessible through the Site infringes your rights, follow the procedure on our <a class="anchor" href="<?php echo esc_url(home_url('/dmca')); ?>">Content Removal</a> page.</p>

            <h2 class="-heading">10. Privacy</h2>
            <p>Your use of the Site is also governed by our <a class="anchor" href="<?php echo esc_url(home_url('/policy')); ?>">Privacy Policy</a> and <a class="anchor" href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a>.</p>

            <h2 class="-heading">11. Changes to These Terms</h2>
            <p>We may revise these Terms at any time. Continued use of the Site after changes are posted constitutes acceptance of the updated Terms.</p>

            <h2 class="-heading">12. Termination</h2>
            <p>We may suspend or restrict access to the Site at any time, with or without notice, for conduct that we believe violates these Terms or harms the Site, users, or third parties.</p>

            <h2 class="-heading">13. Governing Law</h2>
            <p>These Terms are governed by applicable laws in the jurisdiction where the Site operator is established, without regard to conflict-of-law principles, except where mandatory consumer protections apply in your country.</p>

            <h2 class="-heading">14. Contact</h2>
            <p>For questions about these Terms, contact <a class="anchor" href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>.</p>
        </div>
    </section>
</main>

<?php
get_footer();
