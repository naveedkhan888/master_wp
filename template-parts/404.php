<?php
/**
 * The template for displaying 404 pages (not found).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $MASTERWP_STORAGE;

$background_image 	= get_theme_mod( 'header_background_image', $MASTERWP_STORAGE['header_background_image'] );
if($background_image) {
	$background_image 	= 	wp_get_attachment_image_src( $background_image , 'full' );
	if(isset($background_image[0])) {
		$background_image	=	$background_image[0];
	}
}

?>
<main id="content" class="site-main">
	<div class="page-header" <?php if($background_image) { ?> style="background-image: url('<?php echo esc_url($background_image); ?>')" <?php } ?>>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-box">
						<h1><?php echo esc_html__( 'Page Not Found', 'masterwp' ); ?></h1>
						<?php do_action('masterwp_action_get_breadcrumb');		?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="error-page">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="error-page-image">
						<img src="<?php echo esc_url( $MASTERWP_STORAGE['404_image'] ); ?>" alt="">
					</div>

					<div class="error-page-content">
						<div class="error-page-content-heading">
							<h2><?php echo esc_html__( 'Oops! page not found', 'masterwp' ); ?></h2>
						</div>
						<div class="error-page-content-body">
							<p><?php echo esc_html__( 'Sorry, We can\'t find the page you\'re looking.', 'masterwp' ); ?></p>
							<?php
							printf( '<a class="btn-default" href="%s">%s %s</a>', esc_url( home_url() ), __('Back To Home','masterwp'), masterwp_render_svg($MASTERWP_STORAGE['read_more_icon']));
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
