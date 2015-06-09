<?php
add_action( 'admin_menu', 'current_conditions_add_admin_menu' );
add_action( 'admin_init', 'current_conditions_settings_init' );


function current_conditions_add_admin_menu(  ) { 

	add_submenu_page( 'tools.php', 'Current Conditions', 'Current Conditions', 'manage_options', 'current_conditions', 'current_conditions_options_page' );

}


function current_conditions_settings_init(  ) { 

	register_setting( 'pluginPage', 'current_conditions_settings' );

	add_settings_section(
		'current_conditions_pluginPage_section', 
		__( 'Settings for Current Conditions', 'current_conditions' ), 
		'current_conditions_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'current_conditions_json', 
		__( 'Enter JSON url', 'current_conditions' ), 
		'current_conditions_json_render', 
		'pluginPage', 
		'current_conditions_pluginPage_section' 
	);

	add_settings_field( 
		'current_conditions_activate', 
		__( 'Activate Current Conditions', 'current_conditions' ), 
		'current_conditions_activate_render', 
		'pluginPage', 
		'current_conditions_pluginPage_section' 
	);

	add_settings_field( 
		'current_conditions_sponsor', 
		__( 'Sponsor Current Conditions', 'current_conditions' ), 
		'current_conditions_sponsor_render', 
		'pluginPage', 
		'current_conditions_pluginPage_section' 
	);


	add_settings_section(
		'current_conditions_winter_pluginPage_section', 
		__( 'Winter Settings for Current Conditions', 'current_conditions' ), 
		'current_conditions_settings_section_callback', 
		'pluginPage'
	);
	add_settings_field( 
		'current_conditions_trails', 
		__( 'Trails Open', 'current_conditions' ), 
		'current_conditions_trails_render', 
		'pluginPage', 
		'current_conditions_winter_pluginPage_section' 
	);
	add_settings_field( 
		'current_conditions_lifts', 
		__( 'Lifts Operating', 'current_conditions' ), 
		'current_conditions_lifts_render', 
		'pluginPage', 
		'current_conditions_winter_pluginPage_section' 
	);
	add_settings_field( 
		'current_conditions_tubing', 
		__( 'Tubing Open', 'current_conditions' ), 
		'current_conditions_tubing_render', 
		'pluginPage', 
		'current_conditions_winter_pluginPage_section' 
	);
	add_settings_field( 
		'current_conditions_terrain', 
		__( 'Terrain Open', 'current_conditions' ), 
		'current_conditions_terrain_render', 
		'pluginPage', 
		'current_conditions_winter_pluginPage_section' 
	);

	add_settings_section(
		'current_conditions_summer_pluginPage_section', 
		__( 'Summer Settings for Current Conditions', 'current_conditions' ), 
		'current_conditions_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'current_conditions_tubing_summer', 
		__( 'Tubing Open', 'current_conditions' ), 
		'current_conditions_tubing_summer_render', 
		'pluginPage', 
		'current_conditions_summer_pluginPage_section' 
	);
	add_settings_field( 
		'current_conditions_terrain_summer', 
		__( 'Terrain Open', 'current_conditions' ), 
		'current_conditions_terrain_summer_render', 
		'pluginPage', 
		'current_conditions_summer_pluginPage_section' 
	);
	add_settings_field( 
		'current_conditions_slopeside_summer', 
		__( 'Slopeside Open', 'current_conditions' ), 
		'current_conditions_slopeside_summer_render', 
		'pluginPage', 
		'current_conditions_summer_pluginPage_section' 
	);



}


function current_conditions_json_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_json]' value='<?php echo $options['current_conditions_json']; ?>'>
	<?php

}


function current_conditions_activate_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='checkbox' name='current_conditions_settings[current_conditions_activate]' <?php checked( $options['current_conditions_activate'], 1 ); ?> value='1'>
	<?php

}

function current_conditions_sponsor_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_sponsor]' value='<?php echo $options['current_conditions_sponsor']; ?>'>
	<?php

}

function current_conditions_trails_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_trails]' value='<?php echo $options['current_conditions_trails']; ?>'>
	<?php

}
function current_conditions_lifts_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_lifts]' value='<?php echo $options['current_conditions_lifts']; ?>'>
	<?php
}
function current_conditions_tubing_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_tubing]' value='<?php echo $options['current_conditions_tubing']; ?>'>
	<?php

}

function current_conditions_terrain_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_terrain]' value='<?php echo $options['current_conditions_terrain']; ?>'>
	<?php

}

function current_conditions_tubing_summer_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_tubing_summer]' value='<?php echo $options['current_conditions_tubing_summer']; ?>'>
	<?php

}

function current_conditions_terrain_summer_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_terrain_summer]' value='<?php echo $options['current_conditions_terrain_summer']; ?>'>
	<?php

}

function current_conditions_slopeside_summer_render(  ) { 

	$options = get_option( 'current_conditions_settings' );
	?>
	<input type='text' name='current_conditions_settings[current_conditions_slopeside_summer]' value='<?php echo $options['current_conditions_slopeside_summer']; ?>'>
	<?php

}

function current_conditions_settings_section_callback(  ) { 

	echo __( 'Enter and saving your settings below', 'current_conditions' );

}


function current_conditions_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>Current Conditions</h2>
		
		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php

}

?>