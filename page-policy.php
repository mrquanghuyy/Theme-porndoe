<?php
/**
 * Template trang Privacy Policy (slug: policy).
 */

get_header();

$site_name = get_bloginfo('name');
$site_url = home_url('/');
$contact_email = get_option('admin_email');
?>

<main class="-main">
    <section class="-section">
        <div class="-holder -holder-privacy -legal-page">
            <h1 class="-heading-one">Privacy Policy</h1>
            <p><em>Last updated: <?php echo esc_html(date_i18n('F j, Y')); ?></em></p>

            <p>This Privacy Policy describes how <strong><?php echo esc_html($site_name); ?></strong> ("we," "us," or "our") collects, uses, and shares information when you visit <a class="anchor" href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_name); ?></a> (the "Site").</p>

            <h2 class="-heading">1. Information We Collect</h2>
            <p>We may collect limited information when you use the Site, including:</p>
            <ul>
                <li>Technical data such as IP address, browser type, device type, operating system, and referring URLs.</li>
                <li>Usage data such as pages viewed, links clicked, search queries, and approximate location derived from IP address.</li>
                <li>Cookie and similar tracking data as described in our <a class="anchor" href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a>.</li>
                <li>Information you voluntarily provide when contacting us (for example, your email address and message content).</li>
            </ul>

            <h2 class="-heading">2. How We Use Information</h2>
            <p>We use collected information to:</p>
            <ul>
                <li>Operate, maintain, and improve the Site.</li>
                <li>Understand how visitors browse and discover content.</li>
                <li>Protect the Site against abuse, fraud, and security threats.</li>
                <li>Respond to support, legal, and content-removal requests.</li>
                <li>Display advertising and measure campaign performance where applicable.</li>
            </ul>

            <h2 class="-heading">3. Third-Party Content and Links</h2>
            <p><?php echo esc_html($site_name); ?> functions as a directory and discovery platform. Many videos and pages link to third-party websites. We do not control those sites and are not responsible for their privacy practices. We encourage you to review the privacy policies of any third-party site you visit.</p>

            <h2 class="-heading">4. Cookies and Analytics</h2>
            <p>We use cookies and similar technologies for essential functionality, preferences, analytics, and advertising. You can learn more and manage your choices in our <a class="anchor" href="<?php echo esc_url(home_url('/cookie-policy')); ?>">Cookie Policy</a>.</p>

            <h2 class="-heading">5. Sharing of Information</h2>
            <p>We may share information with:</p>
            <ul>
                <li>Service providers that help us host, secure, analyze, or operate the Site.</li>
                <li>Advertising and analytics partners, subject to their own policies.</li>
                <li>Law enforcement or regulators when required by law or to protect rights, safety, and security.</li>
            </ul>
            <p>We do not sell personal information in a manner that would constitute a "sale" under applicable privacy laws where such laws apply, except as permitted for advertising-related disclosures described in our Cookie Policy.</p>

            <h2 class="-heading">6. Data Retention</h2>
            <p>We retain information only as long as necessary for the purposes described in this policy, unless a longer retention period is required or permitted by law.</p>

            <h2 class="-heading">7. Your Rights and Choices</h2>
            <p>Depending on your location, you may have rights to access, correct, delete, or restrict certain processing of your personal information. You may also opt out of certain cookies through your browser settings or the resources listed in our Cookie Policy.</p>
            <p>To make a privacy-related request, contact us at <a class="anchor" href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>.</p>

            <h2 class="-heading">8. Age Restriction</h2>
            <p>The Site is intended only for adults 18 years of age or older (or the age of majority in your jurisdiction). We do not knowingly collect personal information from minors.</p>

            <h2 class="-heading">9. International Visitors</h2>
            <p>If you access the Site from outside your country of residence, your information may be processed in countries that may have different data protection laws than your own.</p>

            <h2 class="-heading">10. Changes to This Policy</h2>
            <p>We may update this Privacy Policy from time to time. Changes will be posted on this page with an updated "Last updated" date.</p>

            <h2 class="-heading">11. Contact</h2>
            <p>Questions about this Privacy Policy may be sent to <a class="anchor" href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>.</p>
        </div>
    </section>
</main>

<?php
get_footer();
