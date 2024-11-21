<?php do_action( 'alimran_before_footer' ); ?>
<footer>
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Alimran Theme</p>
    </div>
</footer>

<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
    <div id="footer-widgets" class="footer-widgets">
        <?php dynamic_sidebar( 'footer-1' ); ?>
    </div>
<?php endif; ?>


<?php do_action( 'alimran_after_footer' ); ?>
<?php wp_footer(); ?>
</body>
</html>


