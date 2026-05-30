<?php
/**
 * Template trang Content Removal / DMCA (slug: dmca).
 */

get_header();

$site_name = get_bloginfo('name');
$site_url = home_url('/');
$contact_email = get_option('admin_email');
?>

<main class="-main">
    <section class="-section">
        <div class="-holder -legal-page">
            <h1 class="-heading">Content Removal</h1>
            <p><em>Last updated: <?php echo esc_html(date_i18n('F j, Y')); ?></em></p>

            <p><?php echo esc_html($site_name); ?> respects intellectual property rights and responds to valid notices of alleged infringement. Because the Site primarily indexes and links to third-party adult content, removal requests should include enough detail for us to locate the material on <a class="anchor" href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_name); ?></a>.</p>

            <h2 class="-heading">1. Who May Submit a Request</h2>
            <p>Copyright owners, authorized agents, performers with valid privacy claims where applicable by law, or other parties with a legitimate legal basis may submit a removal request.</p>

            <h2 class="-heading">2. Information Required</h2>
            <p>Please include all of the following in your notice:</p>
            <ul>
                <li>Your full legal name and contact email address.</li>
                <li>Identification of the copyrighted work or protected material you claim has been infringed.</li>
                <li>The exact URL(s) on <?php echo esc_html($site_name); ?> where the material appears.</li>
                <li>A statement that you have a good-faith belief the use is not authorized by the rights holder.</li>
                <li>A statement, under penalty of perjury, that the information in your notice is accurate and that you are authorized to act on behalf of the rights holder.</li>
                <li>Your physical or electronic signature.</li>
            </ul>

            <h2 class="-heading">3. How to Send a Notice</h2>
            <p>Send your complete notice to:</p>
            <p><a class="anchor" href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></p>
            <p>Subject line: <strong>Content Removal Request – <?php echo esc_html($site_name); ?></strong></p>

            <h2 class="-heading">4. What Happens Next</h2>
            <p>After we receive a complete and valid notice, we will review it promptly. If appropriate, we may disable access to the referenced page(s) on <?php echo esc_html($site_name); ?>, remove listings, or take other reasonable steps. Because content may also exist on third-party hosts, you may need to contact those providers separately.</p>

            <h2 class="-heading">5. Counter-Notification</h2>
            <p>If you believe content was removed in error, you may submit a counter-notification including:</p>
            <ul>
                <li>Your contact information and signature.</li>
                <li>Identification of the material removed and its former location on the Site.</li>
                <li>A statement under penalty of perjury that you have a good-faith belief the material was removed as a result of mistake or misidentification.</li>
                <li>Consent to jurisdiction of the appropriate courts if required by applicable law.</li>
            </ul>

            <h2 class="-heading">6. Repeat Infringers</h2>
            <p>Where applicable, we may terminate or restrict access for users or upload sources that are subject to repeated valid infringement notices.</p>

            <h2 class="-heading">7. Misuse of This Process</h2>
            <p>Submitting false or bad-faith claims may expose you to legal liability. Please ensure your request is accurate and legally sufficient before sending it.</p>

            <h2 class="-heading">8. Related Policies</h2>
            <p>See also our <a class="anchor" href="<?php echo esc_url(home_url('/terms')); ?>">Terms of Service</a>, <a class="anchor" href="<?php echo esc_url(home_url('/policy')); ?>">Privacy Policy</a>, and <a class="anchor" href="<?php echo esc_url(home_url('/18-usc-2257')); ?>">18 U.S.C. §2257 Compliance Statement</a>.</p>
        </div>
    </section>
</main>

<?php
get_footer();
