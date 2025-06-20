<?php
/**
 * The template for displaying programmes sidebar.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="col-lg-3 col-md-12">
	<div class="sidebar-widget">
		<?php if ( is_active_sidebar( 'programmes-sidebar' )  ) : ?>
			<?php dynamic_sidebar( 'programmes-sidebar' ); ?>
		<?php endif; ?>
	</div>
</div>