<?php
/**
 * Plugin Name: Covid 19 Live Updates
 * Description: Display COVID19 live updates.
 * Version: 1.0.0
 * Author: berezitski
 * Author URI: https://distorse.com
 * License: GPL-2.0
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Copyright © 2020 Involve, All Rights Reserved.
 */

if ( ! defined( 'ABSPATH' ) ) {

	exit;

}

//LOAD SCRIPTS
require_once(plugin_dir_path(__FILE__) . '/includes/scripts.php');
require_once(plugin_dir_path(__FILE__) . '/includes/distorse-counter.php');


//REGISTER WIDGETS
function register_distorse_covid_counter(){
	register_widget('Distorse_Counter_Widget');
}

add_action( 'widgets_init', 'register_distorse_covid_counter' );