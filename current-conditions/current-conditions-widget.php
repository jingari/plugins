<?php

function current_conditions_sc() {


ob_start();
the_widget( 'CurrentConditions' ); 
$contents = ob_get_clean();
echo $contents;

//	return $content;
}


add_shortcode('current_conditions', 'current_conditions_sc');


class CurrentConditions extends WP_Widget
{
	function CurrentConditions() {
		$widget_ops = array('classname' => 'current-conditions', 'description' => __( "Shows current conditions") );
		$this->WP_Widget('current-conditions', __('Current Conditions Widget'), $widget_ops);
	}

		
    function widget($args, $instance) {
		extract($args);
		global $post;
		$options = get_option( 'current_conditions_settings' );
		$current_conditions_json = $options['current_conditions_json'];
		$isactive = $options['current_conditions_activate'];
		$sponsor = $options['current_conditions_sponsor'];
		$trails = $options['current_conditions_trails'];
		$lifts = $options['current_conditions_lifts'];
		$tubing = $options['current_conditions_tubing'];
		$terrain = $options['current_conditions_terrain'];
		$tubing_summer = $options['current_conditions_tubing_summer'];
		$terrain_summer = $options['current_conditions_terrain_summer'];
		$slopeside_summer = $options['current_conditions_slopeside_summer'];

		$json_string = wp_remote_fopen($current_conditions_json);
		if($json_string == ''){echo "NADA";}
		$parsed_json = json_decode($json_string);
		$location = $parsed_json->{'location'}->{'city'}; 
		$temp_f = $parsed_json->{'current_observation'}->{'temp_f'}; 
		
		$weatherCond = $parsed_json->{'current_observation'}->{'weather'}; 
		$icon = $parsed_json->{'current_observation'}->{'icon'}; 
		
		echo $before_widget.$before_title."Current Conditions".$after_title."<ul class='weather-cond'>";
		echo "<li id='weather'>"."<p style='background:url(http://icons.wxug.com/i/c/g/".$icon.".gif) no-repeat'class='weathercond'><span>".$temp_f."&deg;F</span><br />".$weatherCond."</p></li>";
		
		if($trails != '')echo "<li id='trails'><span>".$trails."</span> trails</li>";
		if($lifts != '')echo "<li id='lifts'><span>".$lifts."</span> lifts</li>";
		if($tubing != '')echo "<li id='tubing'><span>".$tubing."</span> tubing lanes</li>";
		if($terrain != '')echo "<li id='terrain'><span>".$terrain."</span> terrain park features</li>";
		
		if($tubing_summer != '')echo "<li id='tubing' class='summer'>Tubing: <span>".$tubing_summer."</span></li>";
		if($terrain_summer != '')echo "<li id='terrain' class='summer'>Terrain Park: <span>".$terrain_summer."</span></li>";
		if($slopeside_summer != '')echo "<li id='slopeside' class='summer'>Slopeside Bar &amp; Grill: <span>".$slopeside_summer."</span></li>";
		
		if($sponsor != '')echo"<li id='sponsor'><a href='". site_url()."/mountain-info/snow-report/'><button>View full report</button></a><p>Provided by</p><img src='".$sponsor."' /></li>";
		echo "</ul>".$after_widget;
		
		
		
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		return $instance;
	}

	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'trails' => '','lifts' => '','tubing' => '','terrain' => '', 'sponsor' => '' ));
	?>
		<p>This widget will display based on Current Condition settings</p>
		
		<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("CurrentConditions");'));

/**
 * Display section based navigation
 * 
 * Arguments include: 'show_all' (boolean), 'exclude' (comma delimited list of page IDs),
 * 'show_on_home' (boolean), 'show_empty' (boolean), sort_by (any valid page sort string),
 * 'a_heading' (boolean), 'before_widget' (string), 'after_widget' (strong)
 *
 * @param array|string $args Optional. Override default arguments.
 * @param NULL deprecated - so pre 2.0 implementations don't break site 
 * @return string HTML content, if not displaying.
 */

function current_conditions($args='',$deprecated=NULL) {
	$options = get_option( 'current_conditions_settings' );
	$current_conditions_json = $options['current_conditions_json'];
	$isactive = $options['current_conditions_activate'];
	
	if ( !is_null($deprecated) ) {
		echo 'The section navigation has been upgrade from 1.x to 2.0; this template needs to be updated to reflect major changes to the plug-in.';
		return false;
	}
	$args = wp_parse_args($args, array(
		'trails' => '', 
		'lifts' => '', 
		'tubing' => '', 
		'terrain' => '',
		'tubing_summer' => '', 
		'terrain_summer' => '', 
		'slopeside_summer' => '',
		'sponsor' => '',  
		'before_widget'=>'<div>',
		'after_widget'=>'</div>', 
		'before_title'=>'<h3 class="widget-title">', 
		'after_title'=>'</h3>', 
	)); //defaults
	if($isactive == 1){
		the_widget('CurrentConditions',$args,array('before_widget'=>$args['before_widget'],'after_widget'=>$args['after_widget'],'before_title'=>$args['before_title'],'after_title'=>$args['after_title']));
	}
}


function currentconditions_add_scripts() {
	wp_enqueue_style( 'cc-css', CURRENTCONDITIONS__PLUGIN_DIR.'css/custom.css' );
	wp_enqueue_script(
		'cc-js',
		CURRENTCONDITIONS__PLUGIN_DIR.'js/custom.js',
		array('jquery')
	);
	

}
add_action( 'wp_enqueue_scripts', 'currentconditions_add_scripts' );
?>