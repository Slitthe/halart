<?php

// Load stylesheets
function load_stylesheets()
{


    wp_register_style('fontello', get_template_directory_uri() . '/fonts/fontello-embedded.css', array(), 1, 'all');
    wp_enqueue_style('fontello');

    wp_register_style('fancybox', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), 1, 'all');
    wp_enqueue_style('fancybox');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), 1, 'all');
    wp_enqueue_style('main');
}

add_action('wp_enqueue_scripts', 'load_stylesheets');


// Load scripts
function addjs()
{

    wp_register_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.min.js', array(), 1, 1);
    wp_enqueue_script('fancybox');

    wp_register_script('main', get_template_directory_uri() . '/js/main.js', array(), 1, 1);
    wp_enqueue_script('main');

    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-custom.js', array(), 1, 0);
    wp_enqueue_script('modernizr');
}

add_action('wp_enqueue_scripts', 'addjs');

// Theme support
add_theme_support('post-thumbnails');


if (function_exists('acf_add_options_page')) {

    /* Setari pagini */
    acf_add_options_page(array(
        'page_title'     => 'Setari pentru fiecare tip de pagina din site',
        'menu_title'    => 'Setari pagini',
        'menu_slug'    => 'page-settings',
    ));



    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina de "Despre Noi"',
        'menu_title'    => 'Pagina "Despre Noi"',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina de "Contact"',
        'menu_title'    => 'Pagina "Contact"',
        'parent_slug'    => 'page-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina de "Stiri"',
        'menu_title'    => 'Pagina "Stiri"',
        'parent_slug'    => 'page-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de paginile de "Stire"',
        'menu_title'    => 'Paginile "Stire"',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de paginile de "Atelier"',
        'menu_title'    => 'Paginile "Atelier"',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina de "Ateliere"',
        'menu_title'    => 'Pagina "Ateliere"',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina de "Evenimente"',
        'menu_title'    => 'Pagina "Evenimente"',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de paginile de "Eveniment"',
        'menu_title'    => 'Paginile "Eveniment"',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina principala(Home)',
        'menu_title'    => 'Pagina Principala (Home)',
        'parent_slug'    => 'page-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de pagina 404',
        'menu_title'    => 'Pagina 404',
        'parent_slug'    => 'page-settings',
    ));









    /* Setari interne */
    acf_add_options_page(array(
        'page_title'     => 'Nu schimba astea',
        'menu_title'    => 'Setari interne site',
        'menu_slug'     => 'site-settings',
    ));

    acf_add_options_page(array(
        'page_title'     => 'Setari legate partea de aspect a site-ului, in principal legate de culori',
        'menu_title'    => 'Setari stilistice',
        'menu_slug'    => 'style-settings',
	));
	
	acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce se aplica la mai multe pagini',
        'menu_title'    => 'Setari stilistice generale',
        'parent_slug'    => 'style-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Culori butoane',
        'menu_title'    => 'Culori butoane',
        'parent_slug'    => 'style-settings',
    ));

	acf_add_options_page(array(
        'page_title'     => 'Setari generale',
        'menu_title'    => 'Setari generale',
        'menu_slug'    => 'general-settings',
    ));
    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de meniul de sus (header-ul)',
        'menu_title'    => 'Meniul de sus',
        'parent_slug'    => 'general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'     => 'Setari ce tin de meniul de jos (footer-ul)',
        'menu_title'    => 'Meniul de jos',
        'parent_slug'    => 'general-settings',
    ));
}
