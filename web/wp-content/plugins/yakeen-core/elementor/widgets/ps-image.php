<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Yakeen_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PS_Image extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ) {
		$this->rt_name = esc_html__( 'PS Image', 'yakeen-core' );
		$this->rt_base = 'ps-image';
		parent::__construct( $data, $args );
	}
	private function rt_tween_load_scripts() {
		wp_enqueue_script( 'tween-max' );
	}

	public function rt_fields() {
		$fields = array(
			array(
				'mode'  => 'section_start',
				'id'    => 'sec_general',
				'label' => esc_html__( 'General', 'yakeen-core' ),
			),
			/*image default*/
			array(
				'type'        => Controls_Manager::MEDIA,
				'id'          => 'main_image',
				'label'       => esc_html__( 'Image', 'yakeen-core' ),
				'default'     => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'description' => esc_html__( 'Recommended full image', 'yakeen-core' ),
			),
			array(
				'type'      => Group_Control_Image_Size::get_type(),
				'mode'      => 'group',
				'label'     => esc_html__( 'image size', 'yakeen-core' ),
				'name'      => 'icon_image_size',
				'separator' => 'none',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'rt_header',
				'label'   => esc_html__( 'Header', 'yakeen-core' ),
				'default' => esc_html__( 'Our anthem', 'yakeen-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'rt_label',
				'label'   => esc_html__( 'Label', 'yakeen-core' ),
				'default' => esc_html__( 'Coming Monday, Jun. 9, 2022', 'yakeen-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'rt_title',
				'label'   => esc_html__( 'Title', 'yakeen-core' ),
				'default' => esc_html__( "Free, limited-edition Father's Day Poop Bag Cards", 'yakeen-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'rt_p_content',
				'label'   => esc_html__( 'Paragraph Content', 'yakeen-core' ),
				'default' => esc_html__( '', 'yakeen-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cta_style',
				'label'   => esc_html__( 'CTA Style', 'yakeen-core' ),
				'options' => array(
					'ps-cta-1' => esc_html__( 'CTA 1', 'yakeen-core' ),
					'ps-cta-2' => esc_html__( 'CTA 2', 'yakeen-core' ),
				),
				'default' => 'ps-cta-1',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'rt_cta_label',
				'label'   => esc_html__( 'CTA Label', 'yakeen-core' ),
				'default' => esc_html__( 'Learn more', 'yakeen-core' ),
			),
			array(
				'type'        => Controls_Manager::URL,
				'id'          => 'button_url',
				'label'       => esc_html__( 'CTA URL', 'yakeen-core' ),
				'placeholder' => 'https://your-link.com',
			),

			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		switch ( $data['style'] ) {
			case 'style2':
				$template = 'rt-image-2';
				break;
			default:
				$template = 'ps-image-1';
				break;
		}

		return $this->rt_template( $template, $data );
	}
}
