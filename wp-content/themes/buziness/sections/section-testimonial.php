<?php 
/**
 * Template part for displaying Testimonial Section
 *
 *@package Buziness
 */

    $testimonial_title      = buziness_get_option( 'testimonial_title' );
    $testimonial_overlay    = buziness_get_option( 'testimonial_overlay' );
    $tl_content_type        = buziness_get_option( 'tl_content_type' );
    $number_of_testi_items  = buziness_get_option( 'number_of_testi_items' );
    
    for( $i=1; $i<=$number_of_testi_items; $i++ ) :
        $testimonial_slider_posts[] = buziness_get_option( 'testimonial_slider_'.$i );
    endfor;
    ?>

    <div class="overlay" style="opacity: <?php echo esc_html($testimonial_overlay);?>;"></div>
        <div class="wrapper">
            <?php if(!empty($testimonial_title)):?>
                <div class="section-header">
                    <h2 class="section-title"><?php echo esc_html($testimonial_title);?></h2>
                    <div class="divider"></div>
                </div><!-- .section-header -->
            <?php endif;?>

            <?php if( $tl_content_type == 'tl_page' ) : ?>
                <div class="testimonial-slider-wrapper" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": true, "arrows":false, "autoplay": true, "fade": false }'>
                    <?php $args = array (
                        'post_type'     => 'page',
                        'post_per_page' => count( $testimonial_slider_posts ),
                        'post__in'      => $testimonial_slider_posts,
                        'orderby'       =>'post__in',
                    );   

                    $loop = new WP_Query($args);                        
                        if ( $loop->have_posts() ) :
                        $i=-1;  
                            while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                                <article class="slick-item">
                                    <div class="featured-image">
                                        <?php if ( has_post_thumbnail() ) { ?>
                                            <img src="<?php the_post_thumbnail_url( 'large' ); ?>">
                                        <?php } ?>
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                                        </header>
                                    </div><!-- .featured-image -->

                                    <div class="entry-content">
                                        <?php
                                            $excerpt = buziness_the_excerpt( 25 );
                                            echo wp_kses_post( wpautop( $excerpt ) );
                                        ?>
                                    </div><!-- .entry-content -->
                                </article><!-- .slick-item -->
                            <?php endwhile;?>
                            <?php wp_reset_postdata();
                        endif;?>
                </div><!-- .testimonial-slider-wrapper -->
            <?php endif;?>
        </div><!-- .wrapper -->

