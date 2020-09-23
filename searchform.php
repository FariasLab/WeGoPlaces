<?php // Search Form Template

global $WGP; ?>

<form class="search-form wgp-form" role="search" method="get" action="<?php echo home_url(); ?>">
    <label class="form-label">
        <span class="label-text"><?php echo $WGP['search_form_text']; ?></span>
        <input class="form-field" type="text" value="" name="s" autocomplete="off">
    </label>
</form>