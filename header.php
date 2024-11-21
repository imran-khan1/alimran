<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">
    <meta name="author" content="<?php bloginfo( 'name' ); ?>">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>">

    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "<?php bloginfo( 'name' ); ?>",
            "url": "<?php echo esc_url( home_url( '/' ) ); ?>",
            "logo": "<?php echo esc_url( get_theme_mod( 'alimran_logo' ) ); ?>"
        }
    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'alimran_before_header' ); ?>

<header id="masthead" class="site-header">
    <div class="site-branding">
        <?php if ( has_custom_logo() ) : ?>
            <div class="site-logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php else : ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <?php endif; ?>
    </div>


    <button class="menu-toggle" aria-label="Toggle menu">
        <span class="menu-icon"></span>
    </button>


    <!-- Primary Navigation Menu -->
    <nav id="primary-navigation" class="main-navigation">
        <!-- Main Menu -->
        <?php
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'menu_class'     => 'menu',
            'walker' => new Alimran_Nav_Walker(), // Use the custom walker
            'container'      => false,
            'fallback_cb'    => false,
        ) );
        ?>
    </nav><!-- #primary-navigation -->
        

    </header><!-- #masthead -->



<?php do_action( 'alimran_after_header' ); ?>

<div id="site-breadcrumb">
    <?php alimran_breadcrumbs(); ?>
</div>