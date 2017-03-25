<?php
/**
* The right sidebar template for our theme.
* This template is used to display the sidebar on the home template.
*
*/
?>

<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>

	<div class="sidebar sidebar-right">
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	</div>

<?php endif; ?>