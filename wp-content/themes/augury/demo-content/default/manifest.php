<?php if (!defined('FW')) die('Forbidden');
/**
 * @var string $uri Demo directory url
 */

$manifest = array();
$manifest['title'] = esc_html__('Default Demo', 'augury');
$manifest['screenshot'] = $uri . '/screenshot.png';
$manifest['preview_link'] = 'https://dtaugury.wpengine.com/';