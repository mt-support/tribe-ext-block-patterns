<?php
/**
 * Plugin Name:       The Events Calendar Extension: Block Patterns
 * Plugin URI:        https://theeventscalendar.com/extensions/block-patterns/
 * Description:       A collection of block patterns for displaying event content.
 * Version:           1.0.0
 * Extension Class:   Tribe__Extension__Block_Patterns
 * GitHub Plugin URI: https://github.com/mt-support/block-patterns
 * Author:            Modern Tribe, Inc.
 * Author URI:        http://m.tri.be/1971
 * License:           GPL version 3 or any later version
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       tribe-ext-block-patterns
 *
 *     This plugin is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     any later version.
 *
 *     This plugin is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *     GNU General Public License for more details.
 */

// Do not load directly.
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Do not load unless Tribe Common is fully loaded.
if ( ! class_exists( 'Tribe__Extension' ) ) {
	return;
}

class Tribe__Extension__Block_Patterns extends Tribe__Extension {

	/**
	 * Setup the Extension's properties.
	 *
	 */
	public function construct() {
		$this->add_required_plugin( 'Tribe__Events__Main', '5.0.0' );
		$this->set_url( 'https://theeventscalendar.com/extensions/block-patterns/' );
	}

	/**
	 * Extension initialization and hooks.
	 */
	public function init() {
		add_action( 'init', array( $this, 'tribe_register_block_categories' ) );
		add_action( 'init', array( $this, 'tribe_register_block_patterns' ) );
	}

	/**
	 * Register Event Block Pattern Category
	 */
	public function tribe_register_block_categories() {
		if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

			register_block_pattern_category(
				'events',
				array( 'label' => _x( 'Events', 'Block pattern category', 'tribe' ) )
			);
		}
	}

	/**
	 * Register Block Patterns
	 */
	public function tribe_register_block_patterns() {
		
		if ( class_exists( 'WP_Block_Patterns_Registry' ) ) {

			// Organizer & Venue Combo
			register_block_pattern(
				'tec-block-patterns/organizer-venue-combo',
				array(
					'title'       => __( 'Organizer & Venue Combo', 'tribe-block-patterns' ),
					'description' => _x( 'Organizer and venue details side-by-side.', 'tribe' ),
					'content'     => "<!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"width\":33.33} -->\n<div class=\"wp-block-column\" style=\"flex-basis:33.33%\"><!-- wp:paragraph -->\n<p> </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:tribe/event-organizer {\"organizer\":315} /-->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":66.66} -->\n<div class=\"wp-block-column\" style=\"flex-basis:66.66%\"><!-- wp:paragraph -->\n<p> </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:group {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:tribe/event-venue /-->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group -->",
					'categories'  => array( 'events' ),
				)
			);

			// Call to Action
			register_block_pattern(
				'tec-block-patterns/advanced-ticket-block',
				array(
					'title'       => __( 'Advanced Ticket Block', 'tribe-block-patterns' ),
					'description' => _x( 'A call to action with a ticket form and countdown to the event..', 'tribe' ),
					'content'     => "<!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:heading {\"level\":3} -->\n<h3>Register Today</h3>\n<!-- /wp:heading -->\n\n<!-- wp:shortcode -->\n[tribe_event_countdown id=\"5588\" complete=\"Hooray!\"]\n<!-- /wp:shortcode -->\n\n<!-- wp:paragraph -->\n<p>Add some text for a super snazzy call to action for folks to purchase tickets.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:tribe/event-links /--></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:tribe/tickets -->\n<div class=\"wp-block-tribe-tickets\"><!-- wp:tribe/tickets-item -->\n<div class=\"wp-block-tribe-tickets-item\"></div>\n<!-- /wp:tribe/tickets-item --></div>\n<!-- /wp:tribe/tickets --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:group -->",
					'categories'  => array( 'events' ),
				)
			);

			// Call to Action
			register_block_pattern(
				'tec-block-patterns/embedded-video-events',
				array(
					'title'       => __( 'YouTube With Events', 'tribe-block-patterns' ),
					'description' => _x( 'A YouTube video with three embedded events.', 'tribe' ),
					'content'     => "<!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:core-embed/youtube {\"url\":\"https://www.youtube.com/watch?v=Gm3bQVANtVo\",\"type\":\"video\",\"providerNameSlug\":\"youtube\",\"className\":\"wp-embed-aspect-4-3 wp-has-aspect-ratio\"} -->\n<figure class=\"wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-4-3 wp-has-aspect-ratio\"><div class=\"wp-block-embed__wrapper\">\nhttps://www.youtube.com/watch?v=Gm3bQVANtVo\n</div></figure>\n<!-- /wp:core-embed/youtube -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:shortcode -->\n[tribe_event_inline id=\"4167\"]\n{title:linked}\n{start_date}\n{start_time}\n[/tribe_event_inline]\n<!-- /wp:shortcode --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:shortcode -->\n[tribe_event_inline id=\"4167\"]\n{title:linked}\n{start_date}\n{start_time}\n[/tribe_event_inline]\n<!-- /wp:shortcode --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:shortcode -->\n[tribe_event_inline id=\"4167\"]\n{title:linked}\n{start_date}\n{start_time}\n[/tribe_event_inline]\n<!-- /wp:shortcode --></div></div>\n<!-- /wp:group -->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns -->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group -->",
					'categories'  => array( 'events' ),
				)
			);
		}

		// Sponsors
		register_block_pattern(
			'tec-block-patterns/sponsors',
			array(
				'title'       => __( 'Sponsors', 'tribe-block-patterns' ),
				'description' => _x( 'A group of images and links to list sponsors.', 'tribe' ),
				'content'     => "<!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\"}}} -->\n<div class=\"wp-block-group has-background\" style=\"background-color:#f9f7f4\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"align\":\"center\",\"level\":3} -->\n<h3 class=\"has-text-align-center\">Thanks to our sponsors</h3>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\"} -->\n<p class=\"has-text-align-center\">A really short blurb. Add and remove columns as needed.</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column {\"width\":25} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"><!-- wp:group {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5583,\"sizeSlug\":\"large\",\"className\":\"is-style-default\"} -->\n<div class=\"wp-block-image is-style-default\"><figure class=\"aligncenter size-large\"><a href=\"https://theeventscalendar.com\"><img src=\"http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png\" alt=\"\" class=\"wp-image-5583\"/></a></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"align\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\"><a href=\"https://theeventscalendar.com\">The Events Calendar</a></h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":25} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"><!-- wp:group {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5583,\"sizeSlug\":\"large\",\"className\":\"is-style-default\"} -->\n<div class=\"wp-block-image is-style-default\"><figure class=\"aligncenter size-large\"><a href=\"https://theeventscalendar.com\"><img src=\"http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png\" alt=\"\" class=\"wp-image-5583\"/></a></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"align\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\"><a href=\"https://theeventscalendar.com\">The Events Calendar</a></h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":25} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"><!-- wp:group {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5583,\"sizeSlug\":\"large\",\"className\":\"is-style-default\"} -->\n<div class=\"wp-block-image is-style-default\"><figure class=\"aligncenter size-large\"><a href=\"https://theeventscalendar.com\"><img src=\"http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png\" alt=\"\" class=\"wp-image-5583\"/></a></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"align\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\"><a href=\"https://theeventscalendar.com\">The Events Calendar</a></h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"width\":25} -->\n<div class=\"wp-block-column\" style=\"flex-basis:25%\"><!-- wp:group {\"backgroundColor\":\"white\"} -->\n<div class=\"wp-block-group has-white-background-color has-background\"><div class=\"wp-block-group__inner-container\"><!-- wp:image {\"align\":\"center\",\"id\":5583,\"sizeSlug\":\"large\",\"className\":\"is-style-default\"} -->\n<div class=\"wp-block-image is-style-default\"><figure class=\"aligncenter size-large\"><a href=\"https://theeventscalendar.com\"><img src=\"http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png\" alt=\"\" class=\"wp-image-5583\"/></a></figure></div>\n<!-- /wp:image -->\n\n<!-- wp:heading {\"align\":\"center\",\"level\":4} -->\n<h4 class=\"has-text-align-center\"><a href=\"https://theeventscalendar.com\">The Events Calendar</a></h4>\n<!-- /wp:heading --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:group -->",
				'categories'  => array( 'events' ),
			)
		);

		// FAQ
		register_block_pattern(
			'tec-block-patterns/faq',
			array(
				'title'       => __( 'FAQ', 'tribe-block-patterns' ),
				'description' => _x( 'Columns for commonly asked questions.', 'tribe' ),
				'content'     => "<!-- wp:group {\"style\":{\"color\":{\"background\":\"#f9f7f4\",\"text\":\"#746a59\"}}} -->\n<div class=\"wp-block-group has-text-color has-background\" style=\"background-color:#f9f7f4;color:#746a59\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":3} -->\n<h3>Frequently Asked Questions</h3>\n<!-- /wp:heading -->\n\n<!-- wp:columns -->\n<div class=\"wp-block-columns\"><!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":4} -->\n<h4>Question 1</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group -->\n\n<!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":4} -->\n<h4>Question 2</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group --></div>\n<!-- /wp:column -->\n\n<!-- wp:column -->\n<div class=\"wp-block-column\"><!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":4} -->\n<h4>Question 3</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group -->\n\n<!-- wp:group -->\n<div class=\"wp-block-group\"><div class=\"wp-block-group__inner-container\"><!-- wp:heading {\"level\":4} -->\n<h4>Question 4</h4>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:group -->\n\n<!-- wp:paragraph -->\n<p></p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:group -->",
				'categories'  => array( 'events' ),
			)
		);
	}

} // end if class_exists check