<?php 

//ADD SCRIPTS
function distorse_covid_counter_add_scripts (){
	//ADD CSS
	wp_enqueue_style ( 'distorse-covid-main-style',  plugins_url('css/style.css', __FILE__) );	
}
	
add_action ( 'wp_enqueue_scripts', 'distorse_covid_counter_add_scripts' );
	