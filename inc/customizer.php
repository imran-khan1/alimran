<?php

// Add Customizer Settings and Controls
function alimran_customize_register( $wp_customize ) {
    // 1. Add Custom Logo Section
    $wp_customize->add_section( 'alimran_logo_section' , array(
        'title'    => __( 'Logo', 'alimran' ),
        'priority' => 30,
    ) );

    // Custom Logo Setting
    $wp_customize->add_setting( 'alimran_logo', array(
        'default'   => '',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'alimran_logo', array(
        'label'    => __( 'Upload Logo', 'alimran' ),
        'section'  => 'alimran_logo_section',
        'settings' => 'alimran_logo',
    )));

    // 2. Add Color Customization Section
    // $wp_customize->add_section( 'alimran_color_section' , array(
    //     'title'    => __( 'Text Colors', 'alimran' ),
    //     'priority' => 40,
    // ) );

    // Custom Color Settings
    $wp_customize->add_setting( 'alimran_primary_color', array(
        'default'   => '#3498db',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alimran_primary_color', array(
        'label'    => __( 'Primary Color', 'alimran' ),
        'section'  => 'colors',
        'settings' => 'alimran_primary_color',
    ) ) );

    $wp_customize->add_setting( 'alimran_secondary_color', array(
        'default'   => '#2ecc71',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alimran_secondary_color', array(
        'label'    => __( 'Secondary Color', 'alimran' ),
        'section'  => 'colors',
        'settings' => 'alimran_secondary_color',
    ) ) );

    // 3. Add Typography Settings Section
    $wp_customize->add_section( 'alimran_typography_section' , array(
        'title'    => __( 'Typography', 'alimran' ),
        'priority' => 50,
    ) );

    // Font family for Heading (h1, h2, etc.)
    $wp_customize->add_setting( 'alimran_heading_font', array(
        'default'   => 'Arial, sans-serif',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( 'alimran_heading_font', array(
        'label'    => __( 'Heading Font', 'alimran' ),
        'section'  => 'alimran_typography_section',
        'type'     => 'text',
    ) );

    // Font family for Body Text
    $wp_customize->add_setting( 'alimran_body_font', array(
        'default'   => 'Arial, sans-serif',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( 'alimran_body_font', array(
        'label'    => __( 'Body Font', 'alimran' ),
        'section'  => 'alimran_typography_section',
        'type'     => 'text',
    ) );

    // 4. Add Custom Post Type (Portfolio) Settings
    $wp_customize->add_section( 'alimran_portfolio_section' , array(
        'title'    => __( 'Portfolio', 'alimran' ),
        'priority' => 60,
    ) );

    // Portfolio Background Color
    $wp_customize->add_setting( 'alimran_portfolio_bg_color', array(
        'default'   => '#f9f9f9',
        'transport' => 'refresh',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'alimran_portfolio_bg_color', array(
        'label'    => __( 'Portfolio Background Color', 'alimran' ),
        'section'  => 'alimran_portfolio_section',
        'settings' => 'alimran_portfolio_bg_color',
    ) ) );
}
add_action( 'customize_register', 'alimran_customize_register' );


// Apply Customizer Styles to Frontend
function alimran_customize_css() {
    ?>
    <style type="text/css">
        /* Custom Logo */
        <?php if ( get_theme_mod( 'alimran_logo' ) ) : ?>
            .site-logo {
                background-image: url(<?php echo esc_url( get_theme_mod( 'alimran_logo' ) ); ?>);
            }
        <?php endif; ?>

        /* Custom Colors */
        <?php if ( get_theme_mod( 'alimran_primary_color' ) ) : ?>
            .primary-color {
                color: <?php echo esc_attr( get_theme_mod( 'alimran_primary_color' ) ); ?>;
            }
            .button {
                background-color: <?php echo esc_attr( get_theme_mod( 'alimran_primary_color' ) ); ?>;
            }
        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'alimran_secondary_color' ) ) : ?>
            .secondary-color {
                color: <?php echo esc_attr( get_theme_mod( 'alimran_secondary_color' ) ); ?>;
            }
        <?php endif; ?>

        /* Custom Typography */
        <?php if ( get_theme_mod( 'alimran_heading_font' ) ) : ?>
            h1, h2, h3, h4, h5, h6 {
                font-family: <?php echo esc_attr( get_theme_mod( 'alimran_heading_font' ) ); ?>;
            }
        <?php endif; ?>

        <?php if ( get_theme_mod( 'alimran_body_font' ) ) : ?>
            body {
                font-family: <?php echo esc_attr( get_theme_mod( 'alimran_body_font' ) ); ?>;
            }
        <?php endif; ?>

        /* Portfolio Background Color */
        <?php if ( get_theme_mod( 'alimran_portfolio_bg_color' ) ) : ?>
            .portfolio-items {
                background-color: <?php echo esc_attr( get_theme_mod( 'alimran_portfolio_bg_color' ) ); ?>;
            }
        <?php endif; ?>
    </style>
    <?php
}
add_action( 'wp_head', 'alimran_customize_css' );

