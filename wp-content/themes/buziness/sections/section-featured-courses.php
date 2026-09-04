<?php 
/**
 * Template part for displaying Services Section
 *
 *@package Buziness
 */

    $featured_courses_title       = buziness_get_option( 'featured_courses_title' );
    $ss_content_type     = buziness_get_option( 'ss_content_type' );
    $number_of_ss_column = buziness_get_option( 'number_of_ss_column' );
    $number_of_ss_items  = buziness_get_option( 'number_of_ss_items' );

    for( $i=1; $i<=$number_of_ss_items; $i++ ) :
        $featured_courses_page_posts[] = absint(buziness_get_option( 'featured_courses_page_'.$i ) );
    endfor;
    ?>

    <?php if(!empty($featured_courses_title)):?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($featured_courses_title);?></h2>
            <div class="divider"></div>
        </div><!-- .section-header -->
    <?php endif;?>

    <?php if( $ss_content_type == 'ss_page' ) : ?>
    <div class="section-content">
        <?php $args = array (
            'post_type'     => 'page',
            'post_per_page' => count( $featured_courses_page_posts ),
            'post__in'      => $featured_courses_page_posts,
            'orderby'       =>'post__in',
        );        
        $loop = new WP_Query($args);                        
        if ( $loop->have_posts() ) :
        $i=-1;  
            while ($loop->have_posts()) : $loop->the_post(); $i++;?>
            
            <article>
                <div class="course-item-wrapper">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="featured-image" style="background-image: url('<?php the_post_thumbnail_url(); ?>');">
                            <a href="<?php the_permalink();?>" class="post-thumbnail-link"></a>
                        </div><!-- .featured-image -->
                    <?php endif; ?>
                    
                    <div class="entry-container">
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
                        </header>

                        <div class="entry-content">
                            <?php
                                $excerpt = buziness_the_excerpt( 25 );
                                echo wp_kses_post( wpautop( $excerpt ) );
                            ?>
                        </div><!-- .entry-content -->

                        <div class="read-more">
                            <?php $readmore_text = buziness_get_option( 'readmore_text' );?>
                            <a href="<?php the_permalink();?>" class="btn btn-primary"><?php echo esc_html($readmore_text);?></a>
                        </div><!-- .read-more -->
                    </div><!-- .entry-container -->
                </div><!-- .course-item-wrapper -->
            </article>

          <?php endwhile;?>
          <?php wp_reset_postdata(); ?>
        <?php endif;?>
    </div>
    
    <?php endif;