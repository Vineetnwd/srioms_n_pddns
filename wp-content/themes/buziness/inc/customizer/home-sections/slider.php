<?php
/**
 * Slider options.
 *
 * @package Buziness
 */

$default = buziness_get_default_theme_options();

// Featured Slider Section
$wp_customize->add_section( 'section_featured_slider',
	array(
		'title'      => __( 'Featured Slider', 'buziness' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);

// Disable Slider Section
$wp_customize->add_setting('theme_options[disable_featured_slider]', 
	array(
	'default' 			=> $default['disable_featured_slider'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'buziness_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_featured_slider]', 
	array(		
	'label' 	=> __('Disable Slider Section', 'buziness'),
	'section' 	=> 'section_featured_slider',
	'settings'  => 'theme_options[disable_featured_slider]',
	'type' 		=> 'checkbox',	
	)
);

// Number of items
$wp_customize->add_setting('theme_options[number_of_sr_items]', 
	array(
	'default' 			=> $default['number_of_sr_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_sr_items]', 
	array(
	'label'       => __('Number Of Slides', 'buziness'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 3.', 'buziness'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[number_of_sr_items]',		
	'type'        => 'number',
	'active_callback' => 'buziness_slider_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 3,
			'step'	=> 1,
		),
	)
);

// Slider Overlay
$wp_customize->add_setting('theme_options[featured_slider_overlay]', 
	array(
	'default' 			=> $default['featured_slider_overlay'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[featured_slider_overlay]', 
	array(
	'label'       => __('Dark Overlay Opacity', 'buziness'),
	'description' => __('Select Value between 0 to 1.', 'buziness'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[featured_slider_overlay]',		
	'type'        => 'number',
	'active_callback' => 'buziness_slider_active',
	'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 1,
			'step'	=> 0.1,
			'style' => 'width: 55px;',
		),
	)
);

$wp_customize->add_setting('theme_options[sr_content_type]', 
	array(
	'default' 			=> $default['sr_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[sr_content_type]', 
	array(
	'label'       => __('Content Type', 'buziness'),
	'section'     => 'section_featured_slider',   
	'settings'    => 'theme_options[sr_content_type]',		
	'type'        => 'select',
	'active_callback' => 'buziness_slider_active',
	'choices'	  => array(
			'sr_page'	  => __('Page','buziness'),
		),
	)
);

$number_of_sr_items = buziness_get_option( 'number_of_sr_items' );

for( $i=1; $i<=$number_of_sr_items; $i++ ){

	// Additional Information First Page
	$wp_customize->add_setting('theme_options[slider_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'buziness_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[slider_page_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Page #%1$s', 'buziness'), $i),
		'section'     => 'section_featured_slider',   
		'settings'    => 'theme_options[slider_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'buziness_slider_page',
		)
	);
}

