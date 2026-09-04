<?php
/**
 * Gallery options.
 *
 * @package Buziness
 */

$default = buziness_get_default_theme_options();

// Featured Gallery Section
$wp_customize->add_section( 'section_home_gallery',
	array(
		'title'      => __( 'Our Gallery', 'buziness' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Gallery Section
$wp_customize->add_setting('theme_options[disable_gallery_section]', 
	array(
	'default' 			=> $default['disable_gallery_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'buziness_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_gallery_section]', 
	array(		
	'label' 	=> __('Disable Gallery Section', 'buziness'),
	'section' 	=> 'section_home_gallery',
	'settings'  => 'theme_options[disable_gallery_section]',
	'type' 		=> 'checkbox',	
	)
);

//Gallery Section title
$wp_customize->add_setting('theme_options[gallery_title]', 
	array(
	'default'           => $default['gallery_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[gallery_title]', 
	array(
	'label'       => __('Section Title', 'buziness'),
	'section'     => 'section_home_gallery',   
	'settings'    => 'theme_options[gallery_title]',
	'active_callback' => 'buziness_gallery_active',		
	'type'        => 'text'
	)
);

// Number of counter
$wp_customize->add_setting('theme_options[number_of_gy_column]', 
	array(
	'default' 			=> $default['number_of_gy_column'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_gy_column]', 
	array(
	'label'       => __('Column Per Row', 'buziness'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 4', 'buziness'),
	'section'     => 'section_home_gallery',   
	'settings'    => 'theme_options[number_of_gy_column]',		
	'type'        => 'number',
	'active_callback' => 'buziness_gallery_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 4,
			'step'	=> 1,
		),
	)
);
// Number of items
$wp_customize->add_setting('theme_options[number_of_gy_items]', 
	array(
	'default' 			=> $default['number_of_gy_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_gy_items]', 
	array(
	'label'       => __('Number Of Gallery', 'buziness'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 12.', 'buziness'),
	'section'     => 'section_home_gallery',   
	'settings'    => 'theme_options[number_of_gy_items]',		
	'type'        => 'number',
	'active_callback' => 'buziness_gallery_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 12,
			'step'	=> 1,
		),
	)
);

$wp_customize->add_setting('theme_options[gy_content_type]', 
	array(
	'default' 			=> $default['gy_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[gy_content_type]', 
	array(
	'label'       => __('Gallery Type', 'buziness'),
	'section'     => 'section_home_gallery',   
	'settings'    => 'theme_options[gy_content_type]',		
	'type'        => 'select',
	'active_callback' => 'buziness_gallery_active',
	'choices'	  => array(
			'gy_page'	  => __('Page','buziness'),
		),
	)
);

$number_of_gy_items = buziness_get_option( 'number_of_gy_items' );

for( $i=1; $i<=$number_of_gy_items; $i++ ){

	// Additional Information First Page
	$wp_customize->add_setting('theme_options[gallery_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'buziness_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[gallery_page_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Page #%1$s', 'buziness'), $i),
		'section'     => 'section_home_gallery',   
		'settings'    => 'theme_options[gallery_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'buziness_gallery_page',
		)
	);
}