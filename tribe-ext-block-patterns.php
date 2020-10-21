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
		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
			return;
		}

		register_block_pattern_category(
			'events',
			array( 'label' => _x( 'Events', 'Block pattern category', 'tribe-block-patterns' ) )
		);
	}

	/**
	 * Register Block Patterns
	 */
	public function tribe_register_block_patterns() {

		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
			return;
		}

		$patterns = [
			// Organizer & Venue columns block.
			'tec-block-patterns/organizer-venue-combo' => [
				'title'       => __( 'Organizer & Venue Combo', 'tribe-block-patterns' ),
				'description' => __( 'Organizer and venue details side-by-side.', 'tribe-block-patterns' ),
				'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
						<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
						<!-- wp:columns -->
							<div class="wp-block-columns">
							<!-- wp:column {"width":33.33} -->
							<div class="wp-block-column" style="flex-basis:33.33%">

							<!-- wp:paragraph -->
							<p></p>
							<!-- /wp:paragraph -->

							<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
								<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
								<!-- wp:tribe/event-organizer /-->

								<!-- wp:paragraph -->
								<p></p>
								<!-- /wp:paragraph -->
								</div></div>
							<!-- /wp:group --></div>
							<!-- /wp:column -->

							<!-- wp:column {"width":66.66} -->
							<div class="wp-block-column" style="flex-basis:66.66%">
							<!-- wp:paragraph -->
							<p> </p>
							<!-- /wp:paragraph -->

							<!-- wp:group {"backgroundColor":"white"} -->
								<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

								<!-- wp:tribe/event-venue /-->

								<!-- wp:paragraph -->
								<p></p>
								<!-- /wp:paragraph -->
								</div></div>
							<!-- /wp:group --></div>
							<!-- /wp:column --></div>
						<!-- /wp:columns -->

						<!-- wp:paragraph -->
						<p></p>
						<!-- /wp:paragraph --></div></div>
					<!-- /wp:group -->
					',
				'categories'  => [ 'events' ],
			],

			// Advanced Ticket block.
			'tec-block-patterns/advanced-ticket-block' => [
				'title'       => __( 'Advanced Ticket Block', 'tribe-block-patterns' ),
				'description' => __( 'A call to action with a ticket form and countdown to the event.', 'tribe-block-patterns' ),
				'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
						<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
						<!-- wp:columns -->
							<div class="wp-block-columns">

							<!-- wp:column -->
								<div class="wp-block-column">
								<!-- wp:heading {"level":3} -->
								<h3>Register Today</h3>
								<!-- /wp:heading -->

								<!-- wp:shortcode -->
								[tribe_event_countdown id="EVENT-ID" complete="Hooray!"]
								<!-- /wp:shortcode -->

								<!-- wp:paragraph -->
								<p>Add some text for a super snazzy call to action for folks to purchase tickets.</p>
								<!-- /wp:paragraph -->

								<!-- wp:tribe/event-links /-->
								</div>
							<!-- /wp:column -->

							<!-- wp:column -->
								<div class="wp-block-column">
								<!-- wp:tribe/tickets -->
								<div class="wp-block-tribe-tickets">
								<!-- wp:tribe/tickets-item -->
								<div class="wp-block-tribe-tickets-item"></div>
								<!-- /wp:tribe/tickets-item --></div>
								<!-- /wp:tribe/tickets -->
								</div>
							<!-- /wp:column -->
							</div>
						<!-- /wp:columns -->
						</div></div>
					<!-- /wp:group -->
				',
				'categories'  => [ 'events' ],
			],

			// YouTube with events
			'tec-block-patterns/embedded-video-events' => [
				'title'       => __( 'YouTube With Events', 'tribe-block-patterns' ),
				'description' => __( 'A YouTube video with three embedded events.', 'tribe-block-patterns' ),
				'content'     => '
					<!-- wp:group -->
					<div class="wp-block-group"><div class="wp-block-group__inner-container">

					<!-- wp:core-embed/youtube {"url":"https://www.youtube.com/watch?v=Gm3bQVANtVo","type":"video","providerNameSlug":"youtube","className":"wp-embed-aspect-4-3 wp-has-aspect-ratio"} -->
					<figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-4-3 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
					https://www.youtube.com/watch?v=Gm3bQVANtVo
					</div></figure>
					<!-- /wp:core-embed/youtube -->

					<!-- wp:columns -->
						<div class="wp-block-columns">
						<!-- wp:column -->
							<div class="wp-block-column">
							<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
								<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
								<!-- wp:shortcode -->
								[tribe_event_inline id="EVENT-ID"]
								{title:linked}
								{start_date}
								{start_time}
								[/tribe_event_inline]
								<!-- /wp:shortcode -->
								</div></div>
							<!-- /wp:group -->
							</div>
						<!-- /wp:column -->

						<!-- wp:column -->
							<div class="wp-block-column">
							<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
								<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
								<!-- wp:shortcode -->
								[tribe_event_inline id="EVENT-ID"]
								{title:linked}
								{start_date}
								{start_time}
								[/tribe_event_inline]
								<!-- /wp:shortcode -->
								</div></div>
							<!-- /wp:group -->
							</div>
						<!-- /wp:column -->

						<!-- wp:column -->
							<div class="wp-block-column">
							<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
								<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
								<!-- wp:shortcode -->
								[tribe_event_inline id="EVENT-ID"]
								{title:linked}
								{start_date}
								{start_time}
								[/tribe_event_inline]
								<!-- /wp:shortcode -->
								</div></div>
							<!-- /wp:group -->

							<!-- wp:paragraph -->
							<p></p>
							<!-- /wp:paragraph -->
							</div>
						<!-- /wp:column -->
						</div>
					<!-- /wp:columns -->

					<!-- wp:paragraph -->
					<p></p>
					<!-- /wp:paragraph -->
					</div></div>
					<!-- /wp:group -->
				',
				'categories'  => [ 'events' ],
			],

			// Sponsors block.
			'tec-block-patterns/sponsors' => [
				'title'       => __( 'Sponsors', 'tribe-block-patterns' ),
				'description' => __( 'A group of images and links to list sponsors.', 'tribe-block-patterns' ),
				'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
						<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
						<!-- wp:heading {"align":"center","level":3} -->
						<h3 class="has-text-align-center">Thanks to our sponsors</h3>
						<!-- /wp:heading -->

						<!-- wp:paragraph {"align":"center"} -->
						<p class="has-text-align-center">A really short blurb. Add and remove columns as needed.</p>
						<!-- /wp:paragraph -->

						<!-- wp:columns -->
							<div class="wp-block-columns">
							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","id":5583,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large"><a href="https://theeventscalendar.com"><img src="http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png" alt="" class="wp-image-5583"/></a></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="https://theeventscalendar.com">The Events Calendar</a></h4>
									<!-- /wp:heading -->
									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->

							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","id":5583,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large"><a href="https://theeventscalendar.com"><img src="http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png" alt="" class="wp-image-5583"/></a></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="https://theeventscalendar.com">The Events Calendar</a></h4>
									<!-- /wp:heading -->
									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->

							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container"><!-- wp:image {"align":"center","id":5583,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large"><a href="https://theeventscalendar.com"><img src="http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png" alt="" class="wp-image-5583"/></a></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="https://theeventscalendar.com">The Events Calendar</a></h4>
									<!-- /wp:heading -->
									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->

							<!-- wp:column {"width":25} -->
								<div class="wp-block-column" style="flex-basis:25%">
								<!-- wp:group {"backgroundColor":"white"} -->
									<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

									<!-- wp:image {"align":"center","id":5583,"sizeSlug":"large","className":"is-style-default"} -->
									<div class="wp-block-image is-style-default"><figure class="aligncenter size-large"><a href="https://theeventscalendar.com"><img src="http://tec-demo.local/wp-content/uploads/2020/10/the-events-calendar.png" alt="" class="wp-image-5583"/></a></figure></div>
									<!-- /wp:image -->

									<!-- wp:heading {"align":"center","level":4} -->
									<h4 class="has-text-align-center"><a href="https://theeventscalendar.com">The Events Calendar</a></h4>
									<!-- /wp:heading -->

									</div></div>
								<!-- /wp:group -->
								</div>
							<!-- /wp:column -->
							</div>
						<!-- /wp:columns -->
						</div></div>
					<!-- /wp:group -->
				',
				'categories'  => [ 'events' ],
			],

			// FAQ block.
			'tec-block-patterns/faq' => [
				'title'       => __( 'FAQ', 'tribe-block-patterns' ),
				'description' => __( 'Columns for commonly asked questions.', 'tribe-block-patterns' ),
				'content'     => '
					<!-- wp:group {"style":{"color":{"background":"#f9f7f4","text":"#746a59"}}} -->
					<div class="wp-block-group has-text-color has-background" style="background-color:#f9f7f4;color:#746a59"><div class="wp-block-group__inner-container">

					<!-- wp:heading {"level":3} -->
					<h3>Frequently Asked Questions</h3>
					<!-- /wp:heading -->

					<!-- wp:columns -->
						<div class="wp-block-columns">
						<!-- wp:column -->
							<div class="wp-block-column">
							<!-- wp:group -->
								<div class="wp-block-group"><div class="wp-block-group__inner-container"><!-- wp:heading {"level":4} -->
								<h4>Question 1</h4>
								<!-- /wp:heading -->

								<!-- wp:paragraph -->
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>
								<!-- /wp:paragraph -->
								</div></div>
								<!-- /wp:group -->

								<!-- wp:group -->
								<div class="wp-block-group"><div class="wp-block-group__inner-container">
								<!-- wp:heading {"level":4} -->
								<h4>Question 2</h4>
								<!-- /wp:heading -->

								<!-- wp:paragraph -->
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>
								<!-- /wp:paragraph -->
								</div></div>
							<!-- /wp:group -->
							</div>
						<!-- /wp:column -->

						<!-- wp:column -->
							<div class="wp-block-column">
							<!-- wp:group -->
								<div class="wp-block-group"><div class="wp-block-group__inner-container">
								<!-- wp:heading {"level":4} -->
								<h4>Question 3</h4>
								<!-- /wp:heading -->

								<!-- wp:paragraph -->
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>
								<!-- /wp:paragraph -->
								</div></div>
							<!-- /wp:group -->

							<!-- wp:group -->
								<div class="wp-block-group"><div class="wp-block-group__inner-container">
								<!-- wp:heading {"level":4} -->
								<h4>Question 4</h4>
								<!-- /wp:heading -->

								<!-- wp:paragraph -->
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi lacus, hendrerit non odio id, venenatis bibendum dolor.</p>
								<!-- /wp:paragraph -->
								</div></div>
							<!-- /wp:group -->

							<!-- wp:paragraph -->
							<p></p>
							<!-- /wp:paragraph -->
							</div>
						<!-- /wp:column -->
						</div>
					<!-- /wp:columns -->
					</div></div>
					<!-- /wp:group -->
				',
				'categories'  => [ 'events' ],
			],
		];

		$patterns = apply_filters( 'tribe_ext_block_patterns' , $patterns );

		foreach ( $patterns as $pattern => $definition ) {
			register_block_pattern( $pattern, $definition );
		}
	}
}