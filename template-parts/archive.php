<?php
/**
 * The template for displaying archive pages.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $LENITY_STORAGE;
$archive_page_layout	=	get_theme_mod( 'archive_page_layout', $LENITY_STORAGE['archive_page_layout'] );
if($archive_page_layout == 'full-width') {
	$column = 'col-md-12';
}
else{
	$column = 'col-lg-9 col-md-12';
}

$background_image 	= get_theme_mod( 'blog_page_header_background_image', $LENITY_STORAGE['blog_page_header_background_image'] );
if($background_image) {
	$background_image 	= 	wp_get_attachment_image_src( $background_image , 'full' );
	if(isset($background_image[0])) {
		$background_image	=	$background_image[0];
	}
}

?>
<main id="content" class="site-main">
	<div class="page-header" <?php if($background_image) { ?> style="background-image: url('<?php echo esc_url($background_image); ?>')"<?php } ?>>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-12">
					<div class="page-header-box">
						<h1 class="entry-title"><?php 
							$lenity_blog_title_text = lenity_get_archive_title();
							echo wp_kses_data( $lenity_blog_title_text ); ?></h1>
						<?php
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
						<?php do_action('lenity_action_get_breadcrumb'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="page-content">
		<div class="page-blog-archive">
			<div class="container">
				<div class="row">
					<div class="<?php echo esc_attr( $column ); ?>">
						<div class="row">
					<?php
					while ( have_posts() ) {
						the_post();
						$post_link = get_permalink();
						?>
						<div class="col-lg-4 col-md-6">
							<div class="post-item">
								<div class="post-item-header">
									<div class="post-item-meta">
										<p><?php echo get_the_date(); ?></p>
									</div>
									<div class="post-item-content">
										<?php
											printf( '<h2><a href="%s">%s</a></h2>', esc_url( $post_link ), wp_kses_post( get_the_title() ) );
										?>
									</div>
								</div>
								<div class="post-featured-image">
									<?php
										if ( has_post_thumbnail() ) {
											printf( '<a href="%s"><figure class="at-shiny-glass-effect">%s</figure></a>', esc_url( $post_link ), get_the_post_thumbnail( $post, 'large' ) );
										}
									?>
								</div>
								<div class="blog-item-btn">
									<?php
										printf( '<a href="%s">%s </a>', esc_url( $post_link ), __('Read More','lenity'));
									?>
								</div>
							</div>
						</div>
					<?php } ?>
							<div class="col-md-12">
								<?php
									echo get_the_posts_pagination( array(
											'mid_size' => 2,
											'prev_text' => '<i class="fa-solid fa-angle-left"></i>',
											'next_text' => '<i class="fa-solid fa-angle-right"></i>',
										) );
								?>
							</div>
						</div>
					</div>
				<?php 
					if($archive_page_layout == 'with-sidebar'):
						get_sidebar();
					endif;
				?>
				</div>
			</div>
		</div>
	</div>
</main>
