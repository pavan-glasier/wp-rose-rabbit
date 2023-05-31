<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rose_and_Rabbit
 */
?>
<div class="col-xl-4">
    <div class="vs-blog blog-style1 mb-5">
        <div class="blog-img">
            <a href="<?php the_permalink();?>">
                <?php echo do_shortcode('[post_featured_image]');?>
            </a>
        </div>
        <div class="blog-content text-center">
            <h3 class="blog-title h5">
                <a href="<?php the_permalink();?>"><?php echo the_title();?></a>
            </h3>
            <div class="blog-meta">
                <a href="#"><?php the_author();?></a>
                <a href="#"><?php echo get_the_date( 'd M, Y', $post->ID ); ?></a>
            </div>
        </div>
        <div class="package-btn">
            <a href="<?php the_permalink();?>" class="vs-btn" target="_blank">See More</a>
        </div>
    </div>
</div>