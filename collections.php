<?php
/*
 * Plugin Name:       Collections
 * Description:       Manage collections of historical archives, for either family or community. 
 * Version:           0.1.0
 * Requires at least: 6.1
 * Requires PHP:      8.0
 * Author:            Aaron Tweeton
 * Author URI:        https://aarontweeton.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       collections
 * Domain Path:       /languages
 */

/*
Collections is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Collections is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Collections. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

/**
 * Set up collection custom post type.
 */
// Register Custom Post Type
function collections_setup_post_type() {

    $labels = array(
        'name'                  => _x('Items', 'Post Type General Name', 'collections'),
        'singular_name'         => _x('Item', 'Post Type Singular Name', 'collections'),
        'menu_name'             => __('Items', 'collections'),
        'name_admin_bar'        => __('Item', 'collections'),
        'archives'              => __('Item Archives', 'collections'),
        'attributes'            => __('Item Attributes', 'collections'),
        'parent_item_colon'     => __('Parent Item:', 'collections'),
        'all_items'             => __('All Items', 'collections'),
        'add_new_item'          => __('Add New Item', 'collections'),
        'add_new'               => __('Add New', 'collections'),
        'new_item'              => __('New Item', 'collections'),
        'edit_item'             => __('Edit Item', 'collections'),
        'update_item'           => __('Update Item', 'collections'),
        'view_item'             => __('View Item', 'collections'),
        'view_items'            => __('View Items', 'collections'),
        'search_items'          => __('Search Item', 'collections'),
        'not_found'             => __('Not found', 'collections'),
        'not_found_in_trash'    => __('Not found in Trash', 'collections'),
        'featured_image'        => __('Featured Image', 'collections'),
        'set_featured_image'    => __('Set featured image', 'collections'),
        'remove_featured_image' => __('Remove featured image', 'collections'),
        'use_featured_image'    => __('Use as featured image', 'collections'),
        'insert_into_item'      => __('Insert into item', 'collections'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'collections'),
        'items_list'            => __('Items list', 'collections'),
        'items_list_navigation' => __('Items list navigation', 'collections'),
        'filter_items_list'     => __('Filter items list', 'collections'),
    );
    $args = array(
        'label'                 => __('Item', 'collections'),
        'description'           => __('Item within a collection.', 'collections'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        'taxonomies'            => array('collection'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-media-default',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
    );
    register_post_type('item', $args);
}
add_action('init', 'collections_setup_post_type', 0);

/**
 * Set up custom taxonomies.
 */
// Register Custom Taxonomy
function collections_setup_taxonomy() {

    $labels = array(
        'name'                       => _x('Collections', 'Taxonomy General Name', 'collections'),
        'singular_name'              => _x('Collection', 'Taxonomy Singular Name', 'collections'),
        'menu_name'                  => __('Collection', 'collections'),
        'all_items'                  => __('All Collections', 'collections'),
        'parent_item'                => __('Parent Collection', 'collections'),
        'parent_item_colon'          => __('Parent Collection:', 'collections'),
        'new_item_name'              => __('New Collection Name', 'collections'),
        'add_new_item'               => __('Add New Collection', 'collections'),
        'edit_item'                  => __('Edit Collection', 'collections'),
        'update_item'                => __('Update Collection', 'collections'),
        'view_item'                  => __('View Collection', 'collections'),
        'separate_items_with_commas' => __('Separate collections with commas', 'collections'),
        'add_or_remove_items'        => __('Add or remove collections', 'collections'),
        'choose_from_most_used'      => __('Choose from the most used', 'collections'),
        'popular_items'              => __('Popular Collections', 'collections'),
        'search_items'               => __('Search Collections', 'collections'),
        'not_found'                  => __('Not Found', 'collections'),
        'no_terms'                   => __('No collections', 'collections'),
        'items_list'                 => __('Collections list', 'collections'),
        'items_list_navigation'      => __('Collections list navigation', 'collections'),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'show_in_rest'               => true,
    );
    register_taxonomy('collection', array('item'), $args);
}
add_action('init', 'collections_setup_taxonomy', 0);

/**
 * Activation hook.
 */
function collections_activate() {
    collections_setup_taxonomy();
    collections_setup_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'collections_activate');

/**
 * Deactivation hook.
 */
function collections_deactivate() {
    unregister_post_type('item');
    unregister_taxonomy('collection');
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'collections_deactivate');
