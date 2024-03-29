<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Yakeen_Core;

use YakeenTheme_Helper;

use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
extract( $data );

$attr = '';
$cta  = '';
if ( ! empty( $data['button_url']['url'] ) ) {
	$attr  = 'href="' . $data['button_url']['url'] . '"';
	$attr .= ! empty( $data['button_url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= ! empty( $data['button_url']['nofollow'] ) ? ' rel="nofollow"' : '';

	$cta = '<a class="button-style-2" ' . $attr . '>' . esc_html( $data['rt_cta_label'] ) . '</a>';

}

	$rt_logo = Group_Control_Image_Size::get_attachment_image_html( $data, 'icon_image_size', 'rt_logo' );


?>
<!---->
<style>
	.rt-image img {
		transform: none !important;
	}
</style>

<div class="col-12 wow fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-delay: 0.5s; animation-name: fadeInUp;">
	<div class="rt-item rt-single-item">
		<div class="rt-image">
			<?php echo wp_kses_post( $rt_logo ); ?>
		</div>
		<div class="entry-content">
			<h4><?php echo esc_html( $data['rt_category'] ); ?></h4>
			<h1><?php echo esc_html( $data['rt_title'] ); ?></h1>
			<div class="post_excerpt"><p><?php echo esc_html( $data['rt_text'] ); ?></p></div>
			<?php if ( ! empty( $data['button_url'] ) ) { ?>
				<br/>
				<div class="cta">
					<?php echo wp_kses_post( $cta ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
