<?php
/**
 * Subscribe section for the blog page.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_subscribe_blog_section' ) ) :
	/**
	 * Subscribe on blog page section content.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_subscribe_blog_section() {
		$hestia_subscribe_title    = get_theme_mod( 'hestia_blog_subscribe_title', esc_html__( 'Subscribe to our Newsletter', 'hestia-pro' ) );
		$hestia_subscribe_subtitle = get_theme_mod( 'hestia_blog_subscribe_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ) );

		if ( ! empty( $hestia_subscribe_title ) || ! empty( $hestia_subscribe_subtitle ) || is_active_sidebar( 'blog-subscribe-widgets' ) ) :
			?>

			<section class="subscribe-line" id="subscribe-on-blog">

				<div class="container">

					<div class="row">
						<div class="col-md-6">
							<?php if ( ! empty( $hestia_subscribe_title ) || is_customize_preview() ) : ?>
								<h3 class="hestia-title"><?php echo esc_html( $hestia_subscribe_title ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $hestia_subscribe_subtitle ) || is_customize_preview() ) : ?>
								<p class="description"><?php echo esc_html( $hestia_subscribe_subtitle ); ?></p>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<div class="card card-plain card-form-horizontal">
								<div class="content">
									<form method="" action="">
										<div class="row">
											<?php if ( is_active_sidebar( 'blog-subscribe-widgets' ) ) : ?>
												<?php dynamic_sidebar( 'blog-subscribe-widgets' ); ?>
											<?php endif; ?>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>

			</section>
			<?php
		endif;

	}

endif;

add_action( 'hestia_after_archive_content', 'hestia_subscribe_blog_section', 20 );
