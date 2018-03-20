<?php

// Subpackage namespace
namespace LittleBizzy\DisableAdminAJAX;

/**
 * Core class
 *
 * @package WordPress
 * @subpackage Disable Admin-AJAX
 */
final class DisableAJAXCheck {



	// Properties
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Single class instance
	 */
	private static $instance;



	// Initialization
	// ---------------------------------------------------------------------------------------------------



	/**
	 * Create or retrieve instance
	 */
	public static function instance() {

		// Check instance
		if (!isset(self::$instance))
			self::$instance = new self;

		// Done
		return self::$instance;
	}



	/**
	 * Constructor
	 */
	private function __construct() {

		// Decompose referer
		$parts = @parse_url($_SERVER['HTTP_REFERER']);
		if (empty($parts) || !is_array($parts) || empty($parts['host']) || empty($parts['path']))
			return;

		// Local domain
		$local = @parse_url(home_url('/'));
		if (empty($local) || !is_array($local) || empty($local['host']))
			return;

		// Extract domains
		$refererDomain = ('www.' == substr($parts['host'], 0, 4))? substr($parts['host'], 4) : $parts['host'];
		$localDomain   = ('www.' == substr($local['host'], 0, 4))? substr($local['host'], 4) : $local['host'];

		// Exit for different domains
		if ($refererDomain != $localDomain)
			return;

		// Avoid WP admin referer calls
		if (false !== stripos($parts['path'], '/wp-admin/'))
			return;
error_log('disable...');
error_log(print_r($parts, true));
		// This is the end
		wp_die('0', 400);
	}



}