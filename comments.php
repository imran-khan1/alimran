<?php if ( comments_open() || get_comments_number() ) : ?>
    <div class="comments-section">
        <h3><?php comments_number( 'No Comments', 'One Comment', '% Comments' ); ?></h3>
        <?php
            wp_list_comments();
            comment_form();
        ?>
    </div>
<?php endif; ?>
