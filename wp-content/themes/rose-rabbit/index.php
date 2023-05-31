<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rose_and_Rabbit
 */

get_header(); ?>

<main id="primary" class="site-main">
<div class="space-top space-extra-bottom1 bg-gradient-1  mb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-ms-12">
                <div>
					<h1 class="breadcumb-title story__tital text-first"><?php single_post_title();?></h1>
					<span class="breadcumb-titlespan"><?php echo get_post_field( 'post_content', get_queried_object_id() ); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="overflow-hidden space-extra-bottom">
    <div class="hero-shape-3 jump overflojumphid">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner-leaf-2.png" alt="shape">
    </div>
    <div class="hero-shape-3 jump overflojumphid1">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner-leaf-3.png" alt="shape">
    </div>
    <div class="container">
        <div class="row">
			<?php if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile;
				do_shortcode('[rose_and_rabbit_pagination]');
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
    </div>
</section>
</main><!-- #main -->
<?php get_footer();
