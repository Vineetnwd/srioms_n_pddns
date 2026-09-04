<?php
/**
 * Default theme options.
 *
 * @package Buziness
 */

if ( ! function_exists( 'buziness_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function buziness_get_default_theme_options() {

	$defaults = array();

	$defaults['show_header_contact_info'] 	= true;
    $defaults['header_email']             	= __( 'info@creativthemes.com','buziness' );
    $defaults['header_phone' ]            	= __( '+1-541-754-3010','buziness' );
    $defaults['header_location' ]           = __( 'London, UK','buziness' );
    $defaults['show_header_social_links'] 	= true;
    $defaults['header_social_links']		= array();

	// Featured Slider Section
	$defaults['disable_featured_slider']	= true;
	$defaults['number_of_sr_items']			= 3;
	$defaults['featured_slider_overlay']	= 0.6;
	$defaults['sr_content_type']			= 'sr_page';

	// Featured Courses Section
	$defaults['disable_featured_courses_section']	= true;
	$defaults['featured_courses_title']	   	 		= esc_html__( 'About Us', 'buziness' );
	$defaults['number_of_ss_items']					= 1;
	$defaults['ss_content_type']					= 'ss_page';

	//Featured Plans Section	
	$defaults['disable_featured_plans_section']	= true;
	$defaults['logo_title']	   	 				= esc_html__( 'Our Partners', 'buziness' );
	$defaults['number_of_cs_column']			= 6;
	$defaults['number_of_cs_items']				= 6;
	$defaults['cs_content_type']				= 'cs_page';

	// Our Services Section
	$defaults['disable_additional_info_section']	= true;
	$defaults['additional_info_section_title']	   	= esc_html__( 'Our Services', 'buziness' );
	$defaults['number_of_column']					= 3;
	$defaults['number_of_items']					= 6;
	$defaults['ad_content_type']					= 'ad_page';

	//Cta Section	
	$defaults['disable_cta_section']	   	= true;
	$defaults['background_cta_section']		= get_template_directory_uri() .'/assets/images/default-header.jpg';
	$defaults['cta_small_description']	   	= esc_html__( 'Start your projects now.', 'buziness' );
	$defaults['cta_description']	   	 	= esc_html__( 'Trusted by over 1000+ worldwide business!', 'buziness' );
	$defaults['cta_overlay']				= 0.8;
	$defaults['cta_button_label']	   	 	= esc_html__( 'Download Now', 'buziness' );
	$defaults['cta_button_url']	   	 		= '#';

	// Gallery Section
	$defaults['disable_gallery_section']	= true;
	$defaults['gallery_title']	   	 		= esc_html__( 'Completed Cases', 'buziness' );
	$defaults['number_of_gy_column']		= 3;
	$defaults['number_of_gy_items']			= 6;
	$defaults['gy_content_type']			= 'gy_page';
	
	// Testimonial Slider Section
	$defaults['disable_testimonial_slider']		= true;
	$defaults['background_testimonial_section']	= get_template_directory_uri() .'/assets/images/default-header.jpg';
	$defaults['testimonial_title']	   	 		= esc_html__( 'Client Testimonials', 'buziness' );
	$defaults['testimonial_overlay']			= 0.8;
	$defaults['number_of_testi_items']			= 3;
	$defaults['tl_content_type']				= 'tl_page';

	// Blog Section
	$defaults['disable_blog_section']		= true;
	$defaults['blog_title']	   	 			= esc_html__( 'Latest News & Blog', 'buziness' );
	$defaults['blog_subtitle']				= esc_html__( 'Business consulting excepteur sint occaecat cupidatat consulting non proident, sunt in culpa qui officia deserunt laborum Market.', 'buziness' );
	$defaults['blog_category']	   			= 0; 
	$defaults['blog_number']				= 3;

	//General Section
	$defaults['readmore_text']				= esc_html__('Read More','buziness');
	$defaults['excerpt_length']				= 40;
	$defaults['layout_options']				= 'right-sidebar';	

	//Footer section 		
	$defaults['copyright_text']				= esc_html__( 'Copyright &copy; All rights reserved.', 'buziness' );

	// Pass through filter.
	$defaults = apply_filters( 'buziness_filter_default_theme_options', $defaults );
	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'buziness_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function buziness_get_option( $key ) {

		$default_options = buziness_get_default_theme_options();
		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;