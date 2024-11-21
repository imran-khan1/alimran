<?php get_header(); ?>

<div class="container">
    <div class="main-content">
        <h1>Portfolio Category: <?php single_term_title(); ?></h1>

        <?php if ( have_posts() ) : ?>
            <div class="portfolio-items" style="background-color: <?php echo esc_attr( get_theme_mod( 'alimran_portfolio_bg_color', '#f9f9f9' ) ); ?>;">

                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="portfolio-item">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p><?php the_excerpt(); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="pagination">
                <?php echo paginate_links(); ?>
            </div>
        <?php else : ?>
            <p>No portfolio items found in this category.</p>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
