<?php // Search Form Template

global $WGP; ?>

<form class="search-form" role="search" method="get" action="<?php echo home_url(); ?>">
    <label class="search-label">
        <span class="label-text"><?php echo $WGP['search_form_text']; ?></span>
        <input class="search-input" type="text" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off">
    </label>
</form>