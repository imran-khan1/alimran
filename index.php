<?php get_header(); ?>

<main id="content" class="site-content">

    <!-- Check if there are any posts or content -->
    <?php if ( have_posts() ) : ?>

        <!-- If there are posts, loop through and display them -->
        <div class="post-list">
            <?php while ( have_posts() ) : the_post(); ?>
                
                <!-- Single Post Item -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <!-- Post Thumbnail -->
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Post Title -->
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                    </header>

                    <!-- Post Content or Excerpt -->
                    <div class="entry-content">
                        <?php
                            // If it's a single post, show full content, else show excerpt
                            if ( is_single() ) :
                                the_content();
                            else :
                                the_excerpt();
                            endif;
                        ?>
                    </div>

                    <!-- Post Meta (Date, Categories, Tags, etc.) -->
                    <footer class="entry-footer">
                        <span class="posted-on">
                            <?php echo get_the_date(); ?>
                        </span>
                        <span class="category-links">
                            <?php the_category( ', ' ); ?>
                        </span>
                        <span class="tag-links">
                            <?php the_tags( '', ', ' ); ?>
                        </span>
                    </footer>

                </article>

            <?php endwhile; ?>

        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            // Display pagination links (next, previous)
            the_posts_pagination( array(
                'mid_size' => 2,
                'prev_text' => '&laquo; Previous',
                'next_text' => 'Next &raquo;',
            ) );
            ?>
        </div>

    <?php else : ?>

        <!-- If no posts found -->
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'alimran' ); ?></p>

    <?php endif; ?>

</main>

<?php get_footer(); ?>