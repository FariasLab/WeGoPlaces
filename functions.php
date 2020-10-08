<?php // Theme Functions

// Imports & Misc Required Files

use Elementor\Plugin as EP;

require_once get_template_directory() . '/_inc/classes/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/_inc/partials/redux-config.php';
require_once get_template_directory() . '/_inc/partials/controls-helper.php';


// Require Custom Elementor Widgets
add_action( 'elementor/widgets/widgets_registered', function() {
    require_once( get_template_directory() . '/_inc/widgets/elementor/site-header.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/site-footer.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-training.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-translation.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-testimonials.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-clients.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-blog.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/about-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/about-summary.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/about-team.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/courses-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/courses-details.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/translation-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/translation-details.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/clients-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/clients-testimonials.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/blog-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/blog-posts.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/contact-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/contact-form.php' );
});


// Register Required Plugins
add_action( 'tgmpa_register', function () {
    tgmpa([
        [
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'required'  => true
        ], [
            'name'      => 'Elementor – Header, Footer & Blocks Template',
            'slug'      => 'header-footer-elementor',
            'required'  => true
        ], [
            'name'      => 'Redux – Gutenberg Blocks Library & Framework',
            'slug'      => 'redux-framework',
            'required'  => true
        ]
    ], [
        'id'           => 'wgp',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => false,
        'is_automatic' => false,
        'message'      => ''
    ]);
});


// Theme Support
add_action( 'after_setup_theme', function() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'header-footer-elementor' );

    add_theme_support( 'post-thumbnails' );
    add_image_size( 'wgp_685x384', 685, 384, true ); // post thumbs
    add_image_size( 'wgp_200x200', 200, 200, false ); // client logos 2x
    add_image_size( 'wgp_160x160', 160, 160, true ); // avatar 2x

    add_theme_support(
        'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ]
    );
});


// Categories for Custom Elementor Widgets
add_action( 'elementor/init', function() {
    EP::$instance->elements_manager->add_category('wgp_header_footer', ['title' => __( 'WGP Header & Footer', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_home_page', ['title' => __( 'WGP Home Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_about_page', ['title' => __( 'WGP About Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_courses_page', ['title' => __( 'WGP Courses Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_translation_page', ['title' => __( 'WGP Translation Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_clients_page', ['title' => __( 'WGP Clients Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_blog_page', ['title' => __( 'WGP Blog Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_contact_page', ['title' => __( 'WGP Contact Page', 'wgp' )]);
});


// Icon CSS for Custom Elementor Widgets
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'wgp-widget-icons', get_template_directory_uri() . '/_inc/assets/admin/widgets-icon.css', [], $theme_version );
});


// Prevent Elementor from loading Google Fonts
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );


// Prevent Elementor form loading Font Awesome
add_action( 'elementor/frontend/after_register_styles', function() {
    foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
        wp_deregister_style( 'elementor-icons-fa-' . $style );
    }
}, 20 );


// Enqueue CSS
add_action( 'wp_enqueue_scripts', function () {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'wgp-style', get_stylesheet_uri(), [], $theme_version );
});


// Enqueue JS
add_action( 'elementor/frontend/before_enqueue_scripts', function() {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_register_script('wgp-script', get_template_directory_uri() . '/_inc/assets/js/script.js', [], $theme_version, true);

    wp_localize_script('wgp-script', 'contactFormAdmin', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('contact_form')
    ]);

    wp_enqueue_script('wgp-script');
}, 20 );


// AJAX Contact Form Submission
add_action('wp_ajax_contact_form', 'contact_form_submission');
add_action('wp_ajax_nopriv_contact_form', 'contact_form_submission');
function contact_form_submission() {
    check_ajax_referer('contact_form', 'nonce');
    global $WGP;
    $fields_with_errors = [];

    foreach (['name', 'email', 'message'] as $field)
        if (empty($_POST[$field]) || ($field == 'email' && !filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)))
            $fields_with_errors[] = $field;

    if (count($fields_with_errors) > 0)
        wp_send_json_error(['fieldsWithErrors' => $fields_with_errors], 400);

    $email_message = '';
    foreach (['name', 'company', 'email', 'phone', 'message'] as $field)
        if (!empty($_POST[$field]))
            $email_message .= ucfirst($field) . ": {$_POST[$field]}<br><br>";

    add_filter( 'wp_mail_content_type', 'html_content_type' );
    $sent_successfully = wp_mail($WGP['contact_form_recipient'], "Message from {$_POST['name']}", $email_message);
    remove_filter( 'wp_mail_content_type', 'html_content_type' );

    if ($sent_successfully) wp_send_json_success();

    wp_send_json_error(null, 400);
}

function html_content_type(){
    return "text/html";
}


// Navigation Menus
add_action( 'init', function () {
    register_nav_menus([
        'header' => __('Header Menu', 'wgp'),
        'footer' => __('Footer Menu', 'wgp'),
        'lang_switcher' => __('Language Switcher Menu', 'wgp')
    ]);
});


// Icon System SVG Symbols
add_action('wp_body_open', function () {
    get_template_part('_inc/partials/icon-svg-symbols');
});


// Limit Excerpt Length to 22 Words
add_filter( 'excerpt_length', function () {
    return 22;
}, 999 );


// Change Default Excerpt Ellipsis
add_filter('excerpt_more', function () {
    return '...';
});


// Track Post Views
function wgp_set_post_views($post_id) {
    $count_key = 'wgp_post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}
add_action( 'wp_head', function ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;
    }
    wgp_set_post_views($post_id);
});


//Exclude pages from WordPress Search
add_filter('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
});