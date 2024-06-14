<?php
/**
* The sidebar containing the main widget area
*/

if ( ! is_active_sidebar( 'standard-sidebar-left' ) ) {
return;
}?>
<!-- Secondary -->
<section id="secondary-left" class="secondary-sidebar">
<?php dynamic_sidebar( 'standard-sidebar-left' ); ?>
</section>