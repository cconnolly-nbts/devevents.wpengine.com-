<?php

namespace WPE;

class Site_Preview {

	/**
	 * The instance of this class.
	 *
	 * @var Site_Preview
	 */
	protected static $instance = null;

	/**
	 * Our custom page name.
	 *
	 * @var string
	 */
	private $pagename = 'wpe-migration-preview';

	/**
	 * Get the instance of this class.
	 *
	 * @return Site_Preview The instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * Adds the class method(s) to the appropriate WordPress hooks.
	 */
	protected function __construct() {
		add_filter( 'template_include', array( $this, 'preview_template' ) );
		add_filter( 'the_posts', array( $this, 'the_posts' ), 10, 2 );
	}

	/**
	 * Determine whether to return our custom preview template.
	 *
	 * @param string $template The path of the template to include.
	 *
	 * @return string The full path to the template file.
	 */
	public function preview_template( $template ) {

		// Determine the page name
		$pagename = get_query_var( 'pagename' );

		// If the page name is ours, return our custom template, but only if the page isn't found.
		if ( $this->pagename == $pagename ) {
			$template = dirname( WPE_PLUGIN_BASE ) . '/wpengine-common/views/wpe-migration-preview-template.php';
		}

		return $template;
	}

	/**
	 * Check for our custom query and add our post to the posts array.
	 *
	 * This is done to prevent WP->handle_404() from sending a 404 header, forcing it instead to send a 200 header.
	 *
	 * @param array    $posts    The array of found posts.
	 * @param WP_Query $wp_query The WP_Query object (passed by reference).
	 *
	 * @return array The array of posts.
	 */
	public function the_posts( $posts, &$wp_query ) {
		if ( empty( $posts ) && $this->pagename == $wp_query->query_vars['pagename'] ) {
			$posts = array( $this->pagename );
		}

		return $posts;
	}
}
