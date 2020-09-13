<?php // Partial - Ask for a Quote Button

global $WGP; ?>

<a href="<?php echo get_page_link($WGP['quote_page_id']); ?>" class="btn-ask-quote btn-primary">
    <div class="inner-wrap">
        <span class="btn-text"><?php echo $WGP['quote_btn_text']; ?></span>
        <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
    </div>
</a>
