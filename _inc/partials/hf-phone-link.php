<?php // Partial - Phone Link for the Site Header and Footer

global $WGP; ?>

<a href="tel:<?php echo str_replace(' ', '', $WGP['country_code'] . $WGP['phone_number']); ?>" class="hf-phone-link">
    <span class="country-code"><?php echo $WGP['country_code']; ?> </span><span class="phone-number"><?php echo $WGP['phone_number']; ?></span>
</a>