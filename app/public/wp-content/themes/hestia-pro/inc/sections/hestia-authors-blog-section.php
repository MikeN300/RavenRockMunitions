<?php
/**
 * Authors section for the blog page.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

if ( ! function_exists( 'hestia_authors_blog_section' ) ) :
	/**
	 * Team section content.
	 *
	 * @since Hestia 1.0
	 */
	function hestia_authors_blog_section() {
		$hestia_authors_on_blog = get_theme_mod( 'hestia_authors_on_blog' );
		if ( empty( $hestia_authors_on_blog ) || ( sizeof( $hestia_authors_on_blog ) === 1 && empty( $hestia_authors_on_blog[0] ) ) ) {
			return;
		}
		$members_to_display  = array();
		$default_content     = hestia_get_team_default();
		$hestia_team_content = get_theme_mod( 'hestia_team_content', $default_content );

		if ( ! empty( $hestia_team_content ) ) {

			$hestia_team_content = json_decode( $hestia_team_content, true );
			if ( ! empty( $hestia_team_content ) ) {
				$members_to_display = array_filter( $hestia_team_content, 'hestia_selected_ids' );
			}
			if ( empty( $members_to_display ) ) {
				return;
			}

			$hestia_authors_on_blog_background = get_theme_mod( 'hestia_authors_on_blog_background' );
			?>

			<section class="authors-on-blog<?php echo ( ! empty( $hestia_authors_on_blog_background ) ) ? ' section-image' : ''; ?>" id="authors-on-blog"
														<?php
														if ( ! empty( $hestia_authors_on_blog_background ) ) {
															echo 'style="background-image: url(' . esc_url( $hestia_authors_on_blog_background ) . ');"';}
														?>
>
				<div class="container">
					<div class="row">

						<?php
						foreach ( $members_to_display as $team_item ) {
							$image    = ! empty( $team_item['image_url'] ) ? apply_filters( 'hestia_translate_single_string', $team_item['image_url'], 'Team section', 'Image' ) : '';
							$title    = ! empty( $team_item['title'] ) ? apply_filters( 'hestia_translate_single_string', $team_item['title'], 'Team section', 'Title' ) : '';
							$subtitle = ! empty( $team_item['subtitle'] ) ? apply_filters( 'hestia_translate_single_string', $team_item['subtitle'], 'Team section', 'Subtitle' ) : '';
							$text     = ! empty( $team_item['text'] ) ? apply_filters( 'hestia_translate_single_string', $team_item['text'], 'Team section', 'Text' ) : '';
							$link     = ! empty( $team_item['link'] ) ? apply_filters( 'hestia_translate_single_string', $team_item['link'], 'Team section', 'Link' ) : '';
							?>
							<div class="col-xs-12 col-ms-6 col-sm-6">
								<div class="card card-profile card-plain">
									<div class="col-md-5">
										<div class="card-image">
											<?php
											if ( ! empty( $image ) ) {
												if ( ! empty( $link ) ) {
													?>
													<a href="<?php echo esc_url( $link ); ?>">
													<?php
												}
												?>
													<img class="img" src="<?php echo esc_url( $image ); ?>" 
																						<?php
																						if ( ! empty( $title ) ) {
																							echo 'title="' . esc_attr( $title ) . '"'; }
																						?>
>
												<?php
												if ( ! empty( $link ) ) {
													?>
													</a>
													<?php
												}
											}
											?>
										</div>
									</div>
									<div class="col-md-7">
										<div class="content">
											<?php
											if ( ! empty( $title ) ) {
												?>
												<h4 class="card-title"><?php echo wp_kses_post( html_entity_decode( $title ) ); ?></h4>
												<?php
											}

											if ( ! empty( $subtitle ) ) {
												?>
												<h6 class="category text-muted"><?php echo wp_kses_post( html_entity_decode( $subtitle ) ); ?></h6>
													<?php
											}

											if ( ! empty( $text ) ) {
												?>
												<p class="card-description"><?php echo wp_kses_post( html_entity_decode( $text ) ); ?></p>
												<?php
											}

											if ( ! empty( $team_item['social_repeater'] ) ) {
												$icons         = html_entity_decode( $team_item['social_repeater'] );
												$icons_decoded = json_decode( $icons, true );
												if ( ! empty( $icons_decoded ) ) {
													?>
													<div class="footer">
														<?php
														foreach ( $icons_decoded as $value ) {
															$icon = ! empty( $value['icon'] ) ? apply_filters( 'hestia_translate_single_string', $value['icon'], 'Team section' ) : '';
															$link = ! empty( $value['link'] ) ? apply_filters( 'hestia_translate_single_string', $value['link'], 'Team section' ) : '';
															if ( ! empty( $icon ) ) {
																$hestia_authors_on_blog_background = get_theme_mod( 'hestia_authors_on_blog_background' );
																?>
																<a href="<?php echo esc_url( $link ); ?>" class="btn btn-just-icon btn-simple<?php echo ( ! empty( $hestia_authors_on_blog_background ) ) ? ' btn-white' : ''; ?>">
																	<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
																</a>
																<?php
															}
														}
														?>
													</div>
													<?php
												}
											}
											?>
										</div>
									</div>
								</div>
							</div>
							<?php
						}// End foreach().
						?>
					</div>
				</div>
			</section>
			<?php
		}// End if().
	}
	add_action( 'hestia_after_archive_content', 'hestia_authors_blog_section', 10 );

endif;


/**
 * Function used to filter team members with only options form authors on blog.
 *
 * @param array $arr Array to filter.
 * @since 1.1.40
 * @return bool
 */
function hestia_selected_ids( $arr ) {
	$hestia_authors_on_blog = (array) get_theme_mod( 'hestia_authors_on_blog' );
	if ( empty( $hestia_authors_on_blog ) ) {
		return false;
	}
	return in_array( $arr['id'], $hestia_authors_on_blog );
}
