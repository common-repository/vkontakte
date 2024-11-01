<?php
/**
 * Plugin Name: VKontakte
 * Description: The plugin adds a wide range of VKontakte functionality to your site.
 * Version: 3.2.0
 * Requires at least: 4.6
 * Requires PHP: 5.3
 * Author: Yaroslav Bogutsky
 * License: GPL v2 or later
 * Text Domain: vkontakte
 * Domain Path: /i18n
 *
 * @package Vkontakte
 */

if ( ! defined( 'VKONTAKTE_PLUGIN_FILE' ) ) {
	define( 'VKONTAKTE_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'Vkontakte', false ) ) {
	require_once __DIR__ . '/includes/class-vkontakte.php';
}

Vkontakte::instance();
