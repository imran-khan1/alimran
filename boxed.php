<?php
/* Template Name: Boxed Layout */
get_header(); ?>
<div class="container boxed">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="post-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>
