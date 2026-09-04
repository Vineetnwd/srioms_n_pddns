<?php
/**
 * Featured Courses options.
 *
 * @package Buziness
 */

$default = buziness_get_default_theme_options();

// Featured Featured Courses Section
$wp_customize->add_section( 'section_home_featured_courses',
	array(
		'title'      => __( 'About Us', 'buziness' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Featured Courses Section
$wp_customize->add_setting('theme_options[disable_featured_courses_section]', 
	array(
	'default' 			=> $default['disable_featured_courses_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'buziness_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_featured_courses_section]', 
	array(		
	'label' 	=> __('Disable Feautured Courses Section', 'buziness'),
	'section' 	=> 'section_home_featured_courses',
	'settings'  => 'theme_options[disable_featured_courses_section]',
	'type' 		=> 'checkbox',	
	)
);

//Featured Courses Section title
$wp_customize->add_setting('theme_options[featured_courses_title]', 
	array(
	'default'           => $default['featured_courses_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[featured_courses_title]', 
	array(
	'label'       => __('Section Title', 'buziness'),
	'section'     => 'section_home_featured_courses',   
	'settings'    => 'theme_options[featured_courses_title]',
	'active_callback' => 'buziness_featured_courses_active',		
	'type'        => 'text'
	)
);

// Number of items
$wp_customize->add_setting('theme_options[number_of_ss_items]', 
	array(
	'default' 			=> $default['number_of_ss_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_ss_items]', 
	array(
	'label'       => __('Number of Items', 'buziness'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 1.', 'buziness'),
	'section'     => 'section_home_featured_courses',   
	'settings'    => 'theme_options[number_of_ss_items]',		
	'type'        => 'number',
	'active_callback' => 'buziness_featured_courses_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 1,
			'step'	=> 1,
		),
	)
);

$wp_customize->add_setting('theme_options[ss_content_type]', 
	array(
	'default' 			=> $default['ss_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[ss_content_type]', 
	array(
	'label'       => __('Content Type', 'buziness'),
	'section'     => 'section_home_featured_courses',   
	'settings'    => 'theme_options[ss_content_type]',		
	'type'        => 'select',
	'active_callback' => 'buziness_featured_courses_active',
	'choices'	  => array(
			'ss_page'	  => __('Page','buziness'),
		),
	)
);

$number_of_ss_items = buziness_get_option( 'number_of_ss_items' );

for( $i=1; $i<=$number_of_ss_items; $i++ ){

	// Additional Information First Page
	$wp_customize->add_setting('theme_options[featured_courses_page_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'buziness_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[featured_courses_page_'.$i.']', 
		array(
		'label'       => sprintf( __('Select Page #%1$s', 'buziness'), $i),
		'section'     => 'section_home_featured_courses',   
		'settings'    => 'theme_options[featured_courses_page_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback' => 'buziness_featured_courses_page',
		)
	);
}