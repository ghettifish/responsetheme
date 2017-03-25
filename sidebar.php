<?php
/**
* The default sidebar template for our theme.
* This template is used to display the sidebar on posts and pages.
*
* @package Response
* @since Response 1.0
*
*/
?>

<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>

	<div class="sidebar">
		<?php dynamic_sidebar( 'sidebar-right' ); ?>
	</div>

<?php endif; ?>