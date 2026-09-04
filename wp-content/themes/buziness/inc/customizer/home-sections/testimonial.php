<?php
/**
 * Testimonial Slider options.
 *
 * @package Buziness
 */

$default = buziness_get_default_theme_options();

// Testimonial Slider Section
$wp_customize->add_section( 'section_testimonial_slider',
	array(
		'title'      => __( 'Client Testimonials', 'buziness' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);

// Disable Slider Section
$wp_customize->add_setting('theme_options[disable_testimonial_slider]', 
	array(
	'default' 			=> $default['disable_testimonial_slider'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'buziness_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_testimonial_slider]', 
	array(		
	'label' 	=> __('Disable Slider Section', 'buziness'),
	'section' 	=> 'section_testimonial_slider',
	'settings'  => 'theme_options[disable_testimonial_slider]',
	'type' 		=> 'checkbox',	
	)
);

// Testimonial Background Image
$wp_customize->add_setting('theme_options[background_testimonial_section]', 
	array(
	'type'              => 'theme_mod',
	'default' 			=> $default['background_testimonial_section'],
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_image'
	)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'theme_options[background_testimonial_section]', 
	array(
	'label'       => __('Background Image', 'buziness'),
	'section'     => 'section_testimonial_slider',   
	'settings'    => 'theme_options[background_testimonial_section]',	
	'active_callback' => 'buziness_testimonial_active',			
	'type'        => 'image',
	)
	)
);

//Testimonial Section title
$wp_customize->add_setting('theme_options[testimonial_title]', 
	array(
	'default'           => $default['testimonial_title'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[testimonial_title]', 
	array(
	'label'       => __('Section Title', 'buziness'),
	'section'     => 'section_testimonial_slider',   
	'settings'    => 'theme_options[testimonial_title]',
	'active_callback' => 'buziness_testimonial_active',		
	'type'        => 'text'
	)
);

// Testimonial Overlay
$wp_customize->add_setting('theme_options[testimonial_overlay]', 
	array(
	'default' 			=> $default['testimonial_overlay'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[testimonial_overlay]', 
	array(
	'label'       => __('Dark Overlay Opacity', 'buziness'),
	'description' => __('Select Value between 0 to 1.', 'buziness'),
	'section'     => 'section_testimonial_slider',   
	'settings'    => 'theme_options[testimonial_overlay]',		
	'type'        => 'number',
	'active_callback' => 'buziness_testimonial_active',
	'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 1,
			'step'	=> 0.1,
			'style' => 'width: 55px;',
		),
	)
);

// Number of items
$wp_customize->add_setting('theme_options[number_of_testi_items]', 
	array(
	'default' 			=> $default['number_of_testi_items'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_number_range'
	)
);

$wp_customize->add_control('theme_options[number_of_testi_items]', 
	array(
	'label'       => __('Number Of Testimonial', 'buziness'),
	'description' => __('Save & Refresh the customizer to see its effect. Maximum is 3.', 'buziness'),
	'section'     => 'section_testimonial_slider',   
	'settings'    => 'theme_options[number_of_testi_items]',		
	'type'        => 'number',
	'active_callback'	=> 'buziness_testimonial_active',
	'input_attrs' => array(
			'min'	=> 1,
			'max'	=> 3,
			'step'	=> 1,
		),
	)
);

$wp_customize->add_setting('theme_options[tl_content_type]', 
	array(
	'default' 			=> $default['tl_content_type'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[tl_content_type]', 
	array(
	'label'       => __('Testimonial Type', 'buziness'),
	'section'     => 'section_testimonial_slider',   
	'settings'    => 'theme_options[tl_content_type]',		
	'type'        => 'select',
	'active_callback'	=> 'buziness_testimonial_active',
	'choices'	  => array(
			'tl_page'	  => __('Page','buziness'),
		),
	)
);

$number_of_testi_items = buziness_get_option( 'number_of_testi_items' );

for( $i=1; $i<=$number_of_testi_items; $i++ ){

	// Testimonial Slider First Page
	$wp_customize->add_setting('theme_options[testimonial_slider_'.$i.']', 
		array(
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',	
		'sanitize_callback' => 'buziness_dropdown_pages'
		)
	);

	$wp_customize->add_control('theme_options[testimonial_slider_'.$i.']', 
		array(
		'label'       => sprintf( __('Testimonial Page #%1$s', 'buziness'), $i ),
		'section'     => 'section_testimonial_slider',   
		'settings'    => 'theme_options[testimonial_slider_'.$i.']',		
		'type'        => 'dropdown-pages',
		'active_callback'	=> 'buziness_testimonial_page'
		)
	);
}