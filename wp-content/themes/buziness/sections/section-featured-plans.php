<?php 
/**
 * Template part for displaying About Section
 *
 *@package Buziness
 */
    $logo_title      = buziness_get_option( 'logo_title' );
    $cs_content_type    = buziness_get_option( 'cs_content_type' );
    $number_of_cs_column= buziness_get_option( 'number_of_cs_column' );
    $number_of_cs_items = buziness_get_option( 'number_of_cs_items' );
    for( $i=1; $i<=$number_of_cs_items; $i++ ) :
        $featured_plans_page_posts[] = absint(buziness_get_option( 'featured_plans_page_'.$i ) );
    endfor;
    ?>

    <?php if(!empty($logo_title)):?>
        <div class="section-header">
            <h2 class="section-title"><?php echo esc_html($logo_title);?></h2>
            <div class="divider"></div>
        </div><!-- .section-header -->
    <?php endif;?>

    <?php if( $cs_content_type == 'cs_page' ) : ?>
        <div class="section-content clear col-<?php echo esc_attr( $number_of_cs_column ); ?>">
            <?php $args = array (
                'post_type'     => 'page',
                'post_per_page' => count( $featured_plans_page_posts ),
                'post__in'      => $featured_plans_page_posts,
                'orderby'       =>'post__in',
            );        
            $loop = new WP_Query($args);                        
            if ( $loop->have_posts() ) :
            $i=-1;  
                while ($loop->have_posts()) : $loop->the_post(); $i++;?>
                
                <article>
                    <div class="featured-image">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title();?>"></a>
                    </div><!-- .featured-image -->
                </article>

              <?php endwhile;?>
              <?php wp_reset_postdata(); ?>
            <?php endif;?>
        </div>        
    <?php endif; ?>