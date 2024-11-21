<?php get_header(); ?>

<div class="container">
    <div class="main-content">
        <?php if ( have_posts() ) : the_post(); ?>
            <div class="portfolio-single">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>

                <div class="portfolio-details">
                    <p><strong>Client:</strong> <?php echo get_post_meta( get_the_ID(), '_client_name', true ); ?></p>
                    <p><strong>Project Year:</strong> <?php echo get_post_meta( get_the_ID(), '_project_year', true ); ?></p>
                    <p><strong>Project Link:</strong> <a href="<?php echo get_post_meta( get_the_ID(), '_project_link', true ); ?>" target="_blank">View Project</a></p>
                </div>

                <?php
                    // Display categories for the portfolio item
                    $terms = get_the_terms( get_the_ID(), 'portfolio_category' );
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        $term_list = array();
                        foreach ( $terms as $term ) {
                            $term_list[] = $term->name;
                        }
                        echo '<p><strong>Categories:</strong> ' . implode( ', ', $term_list ) . '</p>';
                    }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>
