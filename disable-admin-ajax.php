<?php
/*
Plugin Name: Disable Admin-AJAX
Plugin URI: https://www.littlebizzy.com/plugins/disable-admin-ajax
Description: Completely disables frontend access to admin-ajax.php regardless of Heartbeat settings, to avoid unwanted AJAX calls and vastly improve performance.
Version: 1.0.0
Author: LittleBizzy
Author URI: https://www.littlebizzy.com
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Prefix: DSADAX
*/

// Plugin namespace
namespace LittleBizzy\DisableAdminAJAX;

// Block direct calls
if (!function_exists('add_action'))
	die;

// Plugin constants
const FILE = __FILE__;
const PREFIX = 'dsadax';
const VERSION = '1.0.0';

// Check AJAX context and server var
if (!defined('DOING_AJAX') || empty($_SERVER['HTTP_REFERER']))
	return;

// Load main class
require_once dirname(FILE).'/disable-ajax-check.php';
DisableAJAXCheck::instance();