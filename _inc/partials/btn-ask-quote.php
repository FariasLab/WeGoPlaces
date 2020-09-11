<?php // Partial - Ask for a Quote Button

// Using the Redux API
//echo Redux::get_option( 'OPT_NAME', 'FIELD_ID', 'DEFAULT_VALUE' );

// Using the global argment
//global $redux_demo; // Same as your opt_name
//echo $redux_demo['FIELD_ID'];

?>

<a href="#" class="btn-ask-quote btn-primary">
    <div class="inner-wrap">
        <span class="btn-text">Ask for a Quote</span>
        <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
    </div>
</a>
