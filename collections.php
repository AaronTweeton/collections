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
function collections_setup_post_type() {
    register_post_type('collection', ['public' => true]);
}
add_action('init', 'collections_setup_post_type');

/**
 * Activation hook.
 */
function collections_activate() {
    collections_setup_post_type();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'collections_activate');

/**
 * Deactivation hook.
 */
function collections_deactivate() {
    unregister_post_type('collection');
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'collections_deactivate');
