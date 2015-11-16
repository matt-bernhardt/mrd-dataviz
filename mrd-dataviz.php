<?php
/**
 * Plugin Name: MRD DataViz
 * Plugin URI: https://github.com/matt-bernhardt/mrd-dataviz
 * Description: A post type plugin for data visualizations
 * Version: 0.1
 * Author: Matt Bernhardt
 * Author URI: https://github.com/matt-bernhardt
 * License: GPL2
 *
 * @package MRD DataViz
 * @author Matt Bernhardt
 * @link https://github.com/matt-bernhardt/mrd-dataviz
 */

/**
 * MRD DataViz is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * MRD DataViz is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MRD DataViz. If not, see
 * https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
 */

/**
 * Custom post type function
 */
function custom_posttypes() {
	$labels = array(
		'name' => 'Visualizations',
		'singular_name' => 'Visualization',
		'menu_name' => 'Visualizations',
		'name_admin_bar' => 'Visualization',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Visualization',
		'new_item' => 'New Visualization',
		'edit_item' => 'Edit Visualization',
		'view_item' => 'View Visualization',
		'all_items' => 'All Visualizations',
		'search_items' => 'Search Visualizations',
		'parent_item_colon' => 'Parent Visualizations:',
		'not_found' => 'No visualizations found.',
		'not_found_in_trash' => 'No visualizations found in Trash.',
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-chart-area',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'visualizations' ),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies' => array( 'category', 'post_tag' ),
	);
	register_post_type( 'dataviz', $args );

}
add_action( 'init', 'custom_posttypes' );

/**
 * Flush rewrites on activation
 */
function custom_posttypes_flush() {
	// First, we "add" the custom post type via the above function (custom_posttypes).
	// Note: "add" is written with quotes, as custom post types don't get added to the database,
	// They are only referenced in the post_type column with a post entry when you
	// add a post of this type.
	// Don't get me started on Wordpress' data model.
	custom_posttypes();

	// ATTENTION: This is *only* done during plugin activation.
	// You should never do this on every page load.
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'custom_posttypes_flush' );


