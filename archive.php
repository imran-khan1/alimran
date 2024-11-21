<?php get_header(); ?>
<div class="container">
    <h1><?php the_archive_title(); ?></h1>
    <?php if ( have_posts() ) : ?>
        <ul>
            <?php while ( have_posts() ) : the_post(); ?>
                <li>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else : ?>
        <p><?php _e( 'No posts found.', 'alimran' ); ?></p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
