    <?php
        /**
         * augury_hook_content_after hook.
         * 
         */
        do_action( 'augury_hook_content_after' );
    ?>

        <!-- **Footer** -->
        <footer id="footer">
            <div class="container">
            <?php
                /**
                 * augury_footer hook.
                 * 
                 * @hooked augury_ele_footer_template - 10
                 *
                 */
                do_action( 'augury_footer' );
            ?>
            </div>
        </footer><!-- **Footer - End** -->

    </div><!-- **Inner Wrapper - End** -->
        
</div><!-- **Wrapper - End** -->
<?php
    
    do_action( 'augury_hook_bottom' );

    wp_footer();
?>
</body>
</html>