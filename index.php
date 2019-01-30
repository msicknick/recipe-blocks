<?php

/*
 *  Plugin Name:  Recipe Blocks
 *  Description:  Easy to use blocks for posting recipes that include Details, Ingredients, Directions, and Source URL.
 *  Version:      1.1.0
 *  Author:       Magda Sicknick
 *  Author URI:   https://www.msicknick.com/
 *  License:      GPLv3
 *  License URI:  https://www.gnu.org/licenses/gpl-3.0.html
 *  Text Domain:  recipe-blocks
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Registers all block assets 
 * 
 */
function register_recipe_blocks() {

    if (!function_exists('register_block_type')) {
        // Gutenberg is not active.
        return;
    }

    wp_register_script(
            'recipe-blocks', plugins_url('block.js', __FILE__), array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore'), filemtime(plugin_dir_path(__FILE__) . 'block.js')
    );
    
    wp_enqueue_style(
            'recipe-blocks-google-fonts', '//fonts.googleapis.com/css?family=Alegreya+Sans+SC:300,400', array()
    );

    wp_register_style(
            'recipe-blocks-editor', plugins_url('editor.css', __FILE__), array('wp-edit-blocks'), filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );

    wp_register_style(
            'recipe-blocks', plugins_url('style.css', __FILE__), array(), filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    register_block_type('recipe-blocks/ingredients', array(
        'style' => 'recipe-blocks',
        'editor_style' => 'recipe-blocks-editor',
        'editor_script' => 'recipe-blocks',
    ));

    register_block_type('recipe-blocks/details', array(
        'style' => 'recipe-blocks',
        'editor_style' => 'recipe-blocks-editor',
        'editor_script' => 'recipe-blocks',
    ));

    register_block_type('recipe-blocks/directions', array(
        'style' => 'recipe-blocks',
        'editor_style' => 'recipe-blocks-editor',
        'editor_script' => 'recipe-blocks',
    ));

    register_block_type('recipe-blocks/source', array(
        'style' => 'recipe-blocks',
        'editor_style' => 'recipe-blocks-editor',
        'editor_script' => 'recipe-blocks',
    ));
}

add_action('init', 'register_recipe_blocks');

/**
 * Registers custom block category
 * 
 */
function register_recipe_block_category($categories, $post) {
    return array_merge(
            $categories, array(
        array(
            'slug' => 'recipe-blocks',
            'title' => __('Recipe Blocks', 'recipe-blocks'),
        ),
            )
    );
}

add_filter('block_categories', 'register_recipe_block_category', 10, 2);
