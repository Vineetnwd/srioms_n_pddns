<?php
/**
 * Call to action options.
 *
 * @package Buziness
 */

$default = buziness_get_default_theme_options();

// Call to action section
$wp_customize->add_section( 'section_cta',
	array(
		'title'      => __( 'Call To Action', 'buziness' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'home_page_panel',
		)
);
// Disable Cta Section
$wp_customize->add_setting('theme_options[disable_cta_section]', 
	array(
	'default' 			=> $default['disable_cta_section'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'buziness_sanitize_checkbox'
	)
);

$wp_customize->add_control('theme_options[disable_cta_section]', 
	array(		
	'label' 	=> __('Disable Call to action section', 'buziness'),
	'section' 	=> 'section_cta',
	'settings'  => 'theme_options[disable_cta_section]',
	'type' 		=> 'checkbox',	
	)
);

// Cta Background Image
$wp_customize->add_setting('theme_options[background_cta_section]', 
	array(
	'type'              => 'theme_mod',
	'default' 			=> $default['background_cta_section'],
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'buziness_sanitize_image'
	)
);

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'theme_options[background_cta_section]', 
	array(
	'label'       => __('Background Image', 'buziness'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[background_cta_section]',		
	'active_callback' => 'buziness_cta_active',
	'type'        => 'image',
	)
	)
);

// Cta Overlay
$wp_customize->add_setting('theme_options[cta_overlay]', 
	array(
	'default' 			=> $default['cta_overlay'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_overlay]', 
	array(
	'label'       => __('Dark Overlay Opacity', 'buziness'),
	'description' => __('Select Value between 0 to 1.', 'buziness'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_overlay]',		
	'type'        => 'number',
	'active_callback' => 'buziness_cta_active',
	'input_attrs' => array(
			'min'	=> 0,
			'max'	=> 1,
			'step'	=> 0.1,
			'style' => 'width: 55px;',
		),
	)
);

// Cta Big Font Description
$wp_customize->add_setting('theme_options[cta_description]', 
	array(
	'default' 			=> $default['cta_description'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_description]', 
	array(
	'label'       => __('CTA Title', 'buziness'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_description]',
	'active_callback' => 'buziness_cta_active',		
	'type'        => 'textarea'
	)
);

// Cta Small Font Description
$wp_customize->add_setting('theme_options[cta_small_description]', 
	array(
	'default' 			=> $default['cta_small_description'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_small_description]', 
	array(
	'label'       => __('CTA Description', 'buziness'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_small_description]',
	'active_callback' => 'buziness_cta_active',		
	'type'        => 'textarea'
	)
);

// Cta Button Text
$wp_customize->add_setting('theme_options[cta_button_label]', 
	array(
	'default' 			=> $default['cta_button_label'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_button_label]', 
	array(
	'label'       => __('Button Label', 'buziness'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_button_label]',	
	'active_callback' => 'buziness_cta_active',	
	'type'        => 'text'
	)
);
// Cta Button Url
$wp_customize->add_setting('theme_options[cta_button_url]', 
	array(
	'default' 			=> $default['cta_button_url'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control('theme_options[cta_button_url]', 
	array(
	'label'       => __('Button Url', 'buziness'),
	'section'     => 'section_cta',   
	'settings'    => 'theme_options[cta_button_url]',	
	'active_callback' => 'buziness_cta_active',	
	'type'        => 'url'
	)
);