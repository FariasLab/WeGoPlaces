<?php // Partial - Fixed Footer

global $WGP; ?>

<div class="wgp-fixed-footer">
    <?php get_template_part('_inc/partials/btn-ask-quote'); ?>
    <section class="consent-section">
        <p class="consent-wrap inner-wrap">
            <a href="#" class="btn-close-consent">
                <svg class="close-icon"><use xlink:href="#close-icon"></svg>
            </a>
            <span class="consent-text"><?php echo $WGP['cookie_consent_text']; ?></span>
            <a href="#" class="btn-ok-consent">OK</a>
        </p>
    </section>
</div>
