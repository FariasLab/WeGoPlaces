<?php // Partial – Instagram and Facebook links for the Site Header and Footer

global $WGP; ?>

<div class="hf-icons-wrap instagram-facebook">
    <a href="<?php echo $WGP['instagram_link']; ?>" class="hf-icon-link" target="_blank">
        <svg><use xlink:href="#instagram-icon"></svg>
    </a>
    <a href="<?php echo $WGP['facebook_link']; ?>" class="hf-icon-link" target="_blank">
        <svg><use xlink:href="#facebook-icon"></svg>
    </a>
</div>
