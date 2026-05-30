<?php

get_header();

$site_name = get_bloginfo('name');
$site_url = home_url('/');
$contact_email = get_option('admin_email');
?>

<main class="-main">
    <section class="-section">
        <div class="-holder -legal-page">
            <h1 class="-heading">Cookie Policy</h1>
            <p><em>Last updated: <?php echo esc_html(date_i18n('F j, Y')); ?></em></p>

            <p>This Cookie Policy explains how <strong><?php echo esc_html($site_name); ?></strong> ("we," "us," or "our") uses cookies and similar tracking technologies when you visit <a class="anchor" href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_name); ?></a>.</p>

            <h2 class="-heading">1. What Are Cookies?</h2>
            <p>Cookies are small text files placed on your device (computer, tablet, or mobile phone) when you visit a website. They help websites function, remember preferences, and understand how visitors use a site.</p>

            <h2 class="-heading">2. How We Use Cookies</h2>
            <p>Because <?php echo esc_html($site_name); ?> operates as a directory linking to third-party adult content, we use cookies for essential purposes such as:</p>
            <ul>
                <li><strong>Site functionality and security:</strong> enabling basic features, maintaining sessions, and protecting against abuse.</li>
                <li><strong>Preferences:</strong> remembering settings such as language or content filters where available.</li>
                <li><strong>Analytics (aggregated):</strong> understanding which pages are visited most to improve navigation and performance.</li>
                <li><strong>Advertising:</strong> supporting the free operation of the Site through ad networks that may use cookies to deliver and measure ads.</li>
            </ul>

            <h2 class="-heading">3. Types of Cookies We Use</h2>
            <ul>
                <li><strong>Essential/Necessary cookies:</strong> required for the Site to work; cannot be switched off in our systems.</li>
                <li><strong>Performance/Analytics cookies:</strong> help us count visits and traffic sources.</li>
                <li><strong>Functional/Preference cookies:</strong> enable enhanced features and personalization.</li>
                <li><strong>Targeting/Advertising cookies:</strong> set by advertising partners to build interest profiles and show relevant ads on other sites.</li>
            </ul>

            <h2 class="-heading">4. Third-Party Cookies</h2>
            <p>Third-party providers (analytics and advertising networks) may place cookies on your device. We do not control those cookies; their use is governed by the respective third parties' policies. See also our <a class="anchor" href="<?php echo esc_url(home_url('/policy')); ?>">Privacy Policy</a>.</p>

            <h2 class="-heading">5. Your Cookie Choices</h2>
            <p>You may accept or reject non-essential cookies through your browser settings. Blocking essential cookies may affect Site functionality.</p>
            <p>To opt out of personalized advertising from many networks, visit:</p>
            <ul>
                <li><a class="anchor" href="http://www.youronlinechoices.com/" target="_blank" rel="noopener noreferrer">Your Online Choices</a></li>
                <li><a class="anchor" href="http://optout.networkadvertising.org/" target="_blank" rel="noopener noreferrer">Network Advertising Initiative (NAI) Opt-Out</a></li>
                <li><a class="anchor" href="http://optout.aboutads.info/" target="_blank" rel="noopener noreferrer">Digital Advertising Alliance (DAA) Opt-Out</a></li>
            </ul>

            <h2 class="-heading">6. Changes to This Policy</h2>
            <p>We may update this Cookie Policy from time to time. Changes will be posted on this page with an updated "Last updated" date.</p>

            <h2 class="-heading">7. Contact Us</h2>
            <p>Questions about our use of cookies: <a class="anchor" href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a>.</p>
        </div>
    </section>
</main>

<?php
get_footer();
