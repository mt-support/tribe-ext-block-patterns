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

		// the patterns require some placeholder content
		$youtube_placeholder = apply_filters( 'tribe_ext_block_patterns_youtube_placeholder' , 'https://www.youtube.com/watch?v=Gm3bQVANtVo' );
		$event_placeholder = apply_filters( 'tribe_ext_block_patterns_event_placeholder' , 'EVENT_ID' );

		$patterns = [];

		// Organizer & Venue columns block.
		$patterns['tec-block-patterns/organizer-venue-combo'] = [
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
		];

		// only add this pattern if they have Event Tickets
		if ( class_exists( 'Tribe__Tickets__Main' ) ) {
			// Advanced Ticket block.
			$patterns['tec-block-patterns/advanced-ticket-block'] = [
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
								[tribe_event_countdown id="' . $event_placeholder . '" complete="Hooray!"]
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
			];
		}

		// YouTube with events
		$patterns['tec-block-patterns/embedded-video-events'] = [
			'title'       => __( 'YouTube With Events', 'tribe-block-patterns' ),
			'description' => __( 'A YouTube video with three embedded events.', 'tribe-block-patterns' ),
			'content'     => '
				<!-- wp:group -->
				<div class="wp-block-group"><div class="wp-block-group__inner-container">

				<!-- wp:core-embed/youtube {"url":"' . $youtube_placeholder . '","type":"video","providerNameSlug":"youtube","className":"wp-embed-aspect-4-3 wp-has-aspect-ratio"} -->
				<figure class="wp-block-embed-youtube wp-block-embed is-type-video is-provider-youtube wp-embed-aspect-4-3 wp-has-aspect-ratio"><div class="wp-block-embed__wrapper">
				' . $youtube_placeholder . '
				</div></figure>
				<!-- /wp:core-embed/youtube -->

				<!-- wp:columns -->
					<div class="wp-block-columns">
					<!-- wp:column -->
						<div class="wp-block-column">
						<!-- wp:group {"style":{"color":{"background":"#f9f7f4"}}} -->
							<div class="wp-block-group has-background" style="background-color:#f9f7f4"><div class="wp-block-group__inner-container">
							<!-- wp:shortcode -->
							[tribe_event_inline id="' . $event_placeholder . '"]
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
							[tribe_event_inline id="' . $event_placeholder . '"]
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
							[tribe_event_inline id="' . $event_placeholder . '"]
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
		];

		// Sponsors block.
		$patterns['tec-block-patterns/sponsors'] = [
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

								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-rounded"} -->
								<div class="wp-block-image is-style-rounded"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->

								<!-- wp:heading {"align":"center","level":4} -->
								<h4 class="has-text-align-center"><a href="#sponsor1">Sponsor 1</a></h4>
								<!-- /wp:heading -->
								</div></div>
							<!-- /wp:group -->
							</div>
						<!-- /wp:column -->

						<!-- wp:column {"width":25} -->
							<div class="wp-block-column" style="flex-basis:25%">
							<!-- wp:group {"backgroundColor":"white"} -->
								<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-rounded"} -->
								<div class="wp-block-image is-style-rounded"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->

								<!-- wp:heading {"align":"center","level":4} -->
								<h4 class="has-text-align-center"><a href="#sponsor2">Sponsor 2</a></h4>
								<!-- /wp:heading -->
								</div></div>
							<!-- /wp:group -->
							</div>
						<!-- /wp:column -->

						<!-- wp:column {"width":25} -->
							<div class="wp-block-column" style="flex-basis:25%">
							<!-- wp:group {"backgroundColor":"white"} -->
								<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-rounded"} -->
								<div class="wp-block-image is-style-rounded"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->

								<!-- wp:heading {"align":"center","level":4} -->
								<h4 class="has-text-align-center"><a href="#sponsor2">Sponsor 3</a></h4>
								<!-- /wp:heading -->
								</div></div>
							<!-- /wp:group -->
							</div>
						<!-- /wp:column -->

						<!-- wp:column {"width":25} -->
							<div class="wp-block-column" style="flex-basis:25%">
							<!-- wp:group {"backgroundColor":"white"} -->
								<div class="wp-block-group has-white-background-color has-background"><div class="wp-block-group__inner-container">

								<!-- wp:image {"align":"center","width":64,"height":64,"sizeSlug":"large","className":"is-style-rounded"} -->
								<div class="wp-block-image is-style-rounded"><figure class="aligncenter size-large is-resized"><img src="https://s.w.org/images/core/5.5/don-quixote-03.jpg" alt="' . __( 'Pencil drawing of Don Quixote' ) . '" width="64" height="64"/></figure></div>
								<!-- /wp:image -->

								<!-- wp:heading {"align":"center","level":4} -->
								<h4 class="has-text-align-center"><a href="#sponsor2">Sponsor 4</a></h4>
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
		];

		// FAQ block.
		$patterns['tec-block-patterns/faq'] = [
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
							<div class="wp-block-group"><div class="wp-block-group__inner-container">
							<!-- wp:heading {"level":4} -->
							<h4>Where do I park?</h4>
							<!-- /wp:heading -->

							<!-- wp:paragraph -->
							<p>Give directions of where folks should park or stop on public transit if this is an in-person event.</p>
							<!-- /wp:paragraph -->
							</div></div>
						<!-- /wp:group -->

						<!-- wp:group -->
							<div class="wp-block-group"><div class="wp-block-group__inner-container">
							<!-- wp:heading {"level":4} -->
							<h4>How do I participate in this event?</h4>
							<!-- /wp:heading -->

							<!-- wp:paragraph -->
							<p>We’d love to talk! Please submit a contact form on our site. We’re happy to talk to more sponsors, volunteers, entertainment… you name it.</p>
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
							<h4>Will the event be recorded?</h4>
							<!-- /wp:heading -->

							<!-- wp:paragraph -->
							<p>Definitely! If you can’t make the live session, please sign up to receive updates when we share the recordings.</p>
							<!-- /wp:paragraph -->
							</div></div>
						<!-- /wp:group -->

						<!-- wp:group -->
							<div class="wp-block-group"><div class="wp-block-group__inner-container">
							<!-- wp:heading {"level":4} -->
							<h4>What can I bring?</h4>
							<!-- /wp:heading -->

							<!-- wp:paragraph -->
							<p>For example: Do bring: Water. Strollers. Blankets for sitting on the ground. Sunblock. Skateboard for the skate park area.
							Do not bring: Pets. Ice chests. Drones.</p>
							<!-- /wp:paragraph -->
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
		];

		$patterns = apply_filters( 'tribe_ext_block_patterns' , $patterns );

		foreach ( $patterns as $pattern => $definition ) {
			register_block_pattern( $pattern, $definition );
		}
	}
}