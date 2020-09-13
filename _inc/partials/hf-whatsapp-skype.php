<?php // Partial – Whatsapp and Skype links for the Site Header and Footer

global $WGP; ?>

<div class="hf-icons-wrap whatsapp-skype">
    <a href="<?php echo $WGP['whatsapp_link']; ?>" class="hf-icon-link" target="_blank">
        <svg><use xlink:href="#whatsapp-icon"></svg>
    </a>
    <a href="<?php echo $WGP['skype_link']; ?>" class="hf-icon-link" target="_blank">
        <svg><use xlink:href="#skype-icon"></svg>
    </a>
</div>