<?php

namespace WP_Rocket\Engine\Preload\Controller;

use WP_Rocket\Engine\Preload\Database\Queries\Cache;

/**
 * Controller to load initial sitemap tasks.
 */
class LoadInitialSitemap {

	/**
	 * Queue group.
	 *
	 * @var Queue
	 */
	protected $queue;

	/**
	 * DB query.
	 *
	 * @var Cache
	 */
	protected $query;

	/**
	 * Homepage crawler.
	 *
	 * @var CrawlHomepage
	 */
	protected $crawl_homepage;

	/**
	 * Instantiate the class.
	 *
	 * @param Queue         $queue Queue group.
	 * @param Cache         $query DB query.
	 * @param CrawlHomepage $crawl_homepage Homepage crawler.
	 */
	public function __construct( Queue $queue, $query, CrawlHomepage $crawl_homepage ) {
		$this->queue          = $queue;
		$this->query          = $query;
		$this->crawl_homepage = $crawl_homepage;
	}

	/**
	 * Load the initial sitemap to the queue.
	 */
	public function load_initial_sitemap() {

		/**
		 * Filter custom preload URL.
		 *
		 * @param array Array of custom preload URL
		 */
		$urls    = apply_filters( 'rocket_preload_load_custom_urls', [] );
		$urls [] = home_url();
		$urls    = array_filter( $urls );

		foreach ( $urls as $url ) {
			$this->query->create_or_nothing(
				[
					'url' => $url,
				]
			);
			$this->queue->add_job_preload_job_preload_url_async( $url );
		}

		/**
		 * Filter sitemaps URL.
		 *
		 * @param array Array of sitemaps URL
		 */
		$sitemaps = apply_filters( 'rocket_sitemap_preload_list', [] );
		if ( count( $sitemaps ) > 0 ) {
			$this->add_task_to_queue( $sitemaps );
			return;
		}

		$sitemap = $this->load_wordpress_sitemap();

		if ( ! $sitemap ) {
			$this->add_homepage_urls();
			return;
		}

		$this->add_task_to_queue( [ $sitemap ] );
	}

	/**
	 * Add homepage urls to the preload.
	 *
	 * @return void
	 */
	protected function add_homepage_urls() {
		$urls = $this->crawl_homepage->crawl();

		if ( ! $urls ) {
			return;
		}
		foreach ( $urls as $url ) {
			$this->query->create_or_nothing(
				[
					'url' => $url,
				]
			);
		}
	}

	/**
	 * Add initial sitemap tasks.
	 *
	 * @param array $sitemaps sitemap used for creating tasks.
	 */
	protected function add_task_to_queue( array $sitemaps ) {
		set_transient( 'wpr_preload_running', true );

		foreach ( $sitemaps as $sitemap ) {
			$this->queue->add_job_preload_job_parse_sitemap_async( $sitemap );
		}
		$this->queue->add_job_preload_job_check_finished_async();
	}

	/**
	 * Load default WordPress sitemap.
	 *
	 * @return false|string
	 */
	protected function load_wordpress_sitemap() {
		$sitemaps = wp_sitemaps_get_server();

		if ( ! $sitemaps ) {
			return false;
		}

		return $sitemaps->index->get_index_url();
	}

	/**
	 * Cancel the preloading.
	 *
	 * @return void
	 */
	public function cancel_preload() {
		$this->queue->cancel_pending_jobs();
		$this->query->revert_in_progress();
	}
}
