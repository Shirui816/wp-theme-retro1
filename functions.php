<?php

function retros_add_favicon() {
    echo '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/favicon.ico" />';
}
add_action( 'wp_head', 'retros_add_favicon' );

function retros_scripts() {

    wp_enqueue_style( 'retros-style', get_stylesheet_uri() );
    wp_enqueue_style( 'prism-css', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-coy.min.css' );
    

    wp_enqueue_script( 'prism-js', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js', array(), '1.29.0', true );
    wp_enqueue_script( 'prism-autoloader', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js', array('prism-js'), '1.29.0', true );
    wp_enqueue_script( 'mathjax', 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/4.0.0/tex-mml-chtml.min.js', array(), null, true );
	

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'retros-script', get_template_directory_uri() . '/js/script.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'retros_scripts' );

// MathJax 配置
function retros_mathjax_config() {
    ?>
    <script>
    window.MathJax = {
      tex: {
        inlineMath: [['$', '$'], ['\\(', '\\)']],
        displayMath: [['$$', '$$'], ['\\[', '\\]']]
      },
      chtml: {
        displayAlign: 'left',
        displayIndent: '2em'
      }
    };
    </script>
    <?php
}
add_action( 'wp_head', 'retros_mathjax_config', 1 );

function retros_menus() {
    register_nav_menus( array(
        'menu-1' => 'Main Menu',
        'menu-links' => 'Blogroll',
    ) );
}
add_action( 'init', 'retros_menus' );


add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );


add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output) {
    return str_replace('<a href=', '<a class="post-nav-link" href=', $output);
}

function retros_allow_comment_tags( $allowedtags ) {

    $allowedtags['pre'] = array(
        'class' => true,
    );

    $allowedtags['code'] = array(
        'class' => true,
    );
    return $allowedtags;
}
add_filter( 'wp_kses_allowed_html', 'retros_allow_comment_tags', 11 );

?>

