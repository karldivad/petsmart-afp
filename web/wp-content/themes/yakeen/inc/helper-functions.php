<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

if ( !class_exists( 'YakeenTheme_Helper' ) ) {
	
	class YakeenTheme_Helper {
		
		use IconTrait;  

		public static function pagination() {
			
			if( is_singular() )
				return;

			global $wp_query;

			/** Stop execution if there's only 1 page */
			if( $wp_query->max_num_pages <= 1 )
				return;
			
			$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
			$max   = intval( $wp_query->max_num_pages );

			/**	Add current page to the array */
			if ( $paged >= 1 )
				$links[] = $paged;

			/**	Add the pages around the current page to the array */
			if ( $paged >= 3 ) {
				$links[] = $paged - 1;
				$links[] = $paged - 2;
			}

			if ( ( $paged + 2 ) <= $max ) {
				$links[] = $paged + 2;
				$links[] = $paged + 1;
			}
			include YAKEEN_VIEW_DIR . 'pagination.php';
		}	

		public static function comments_callback( $comment, $args, $depth ){
			include YAKEEN_VIEW_DIR . 'comments-callback.php';
		}


		public static function hex2rgb($hex) {
			$hex = str_replace("#", "", $hex);
			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgb = "$r, $g, $b";
			return $rgb;
		}

		public static function filter_social( $args ){
			return ( $args['url'] != '' );
		}
		
		public static function fonts_url(){
			$fonts_url = '';
			$subsets = 'latin';
			$bodyFont = 'Jost';
			$bodyFW = '400';
			$menuFont = 'Source Serif Pro';
			$menuFontW = '400';
			$hFont = 'Source Serif Pro';
			$hFontW = '600';
			$h1Font = '';
			$h2Font = '';
			$h3Font = '';
			$h4Font = '';
			$h5Font = '';
			$h6Font = '';

			// Body Font
			$body_font  = json_decode( YakeenTheme::$options['typo_body'], true );
			if ($body_font['font'] == 'Inherit') {
				$bodyFont = 'Jost';
			} else {
				$bodyFont = $body_font['font'];
			}
			$bodyFontW = $body_font['regularweight'];

			// Menu Font
			$menu_font  = json_decode( YakeenTheme::$options['typo_menu'], true );
			if ($menu_font['font'] == 'Inherit') {
				$menuFont = 'Source Serif Pro';
			} else {
				$menuFont = $menu_font['font'];
			}
			$menuFontW = $menu_font['regularweight'];

			// Heading Font Settings
			$h_font  = json_decode( YakeenTheme::$options['typo_heading'], true );
			if ($h_font['font'] == 'Inherit') {
				$hFont = 'Source Serif Pro';
			} else {
				$hFont = $h_font['font'];
			}
			$hFontW = $h_font['regularweight'];
			$h1_font  = json_decode( YakeenTheme::$options['typo_h1'], true );
			$h2_font  = json_decode( YakeenTheme::$options['typo_h2'], true );
			$h3_font  = json_decode( YakeenTheme::$options['typo_h3'], true );
			$h4_font  = json_decode( YakeenTheme::$options['typo_h4'], true );
			$h5_font  = json_decode( YakeenTheme::$options['typo_h5'], true );
			$h6_font  = json_decode( YakeenTheme::$options['typo_h6'], true );

			if ( 'off' !== _x( 'on', 'Google font: on or off', 'yakeen' ) ) {

				if (!empty($h1_font['font'])) {
					if ($h1_font['font'] == 'Inherit') {
						$h1Font = $hFont;
						$h1FontW = $hFontW;
					} else {
						$h1Font = $h2_font['font'];
						$h1FontW = $h1_font['regularweight'];
					}
				} if (!empty($h2_font['font'])) {
					if ($h2_font['font'] == 'Inherit') {
						$h2Font = $hFont;
						$h2FontW = $hFontW;
					} else {
						$h2Font = $h2_font['font'];
						$h2FontW = $h2_font['regularweight'];
					}
				} if (!empty($h3_font['font'])) {
					if ($h3_font['font'] == 'Inherit') {
						$h3Font = $hFont;
						$h3FontW = $hFontW;
					} else {
						$h3Font = $h3_font['font'];
						$h3FontW = $h3_font['regularweight'];
					}
				} if (!empty($h4_font['font'])) {
					if ($h4_font['font'] == 'Inherit') {
						$h4Font = $hFont;
						$h4FontW = $hFontW;
					} else {
						$h4Font = $h4_font['font'];
						$h4FontW = $h4_font['regularweight'];
					}
				} if (!empty($h5_font['font'])) {
					if ($h5_font['font'] == 'Inherit') {
						$h5Font = $hFont;
						$h5FontW = $hFontW;
					} else {
						$h5Font = $h5_font['font'];
						$h5FontW = $h5_font['regularweight'];
					}
				} if (!empty($h6_font['font'])) {
					 if ($h6_font['font'] == 'Inherit') {
						$h6Font = $hFont;
						$h6FontW = $hFontW;
					} else {
						$h6Font = $h6_font['font'];
						$h6FontW = $h6_font['regularweight'];
					}
				}

				$check_families = array();
				$font_families = array();

				// Body Font
				if ( 'off' !== $bodyFont )
					$font_families[] = $bodyFont.':400,500,'.$bodyFW;
					$check_families[] = $bodyFont;

				// Menu Font
				if ( 'off' !== $menuFont )
					if ( !in_array( $menuFont, $check_families ) ) {
						$font_families[] = $menuFont.':400,600,700,'.$menuFontW;
						$check_families[] = $menuFont;
					}

				// Heading Font
				if ( 'off' !== $hFont )
					if (!in_array( $hFont, $check_families )) {
						$font_families[] = $hFont.':400,600,700,'.$hFontW;
						$check_families[] = $hFont;
					}

				// Heading 1 Font
				if (!empty($h1_font['font'])) {
					if ( 'off' !== $h1Font )
						if (!in_array( $h1Font, $check_families )) {
							$font_families[] = $h1Font.':'.$h1FontW;
							$check_families[] = $h1Font;
						}
				}
				// Heading 2 Font
				if (!empty($h2_font['font'])) {
					if ( 'off' !== $h2Font )
						if (!in_array( $h2Font, $check_families )) {
							$font_families[] = $h2Font.':'.$h2FontW;
							$check_families[] = $h2Font;
						}
				}
				// Heading 3 Font
				if (!empty($h3_font['font'])) {
					if ( 'off' !== $h3Font )
						if (!in_array( $h3Font, $check_families )) {
							$font_families[] = $h3Font.':'.$h3FontW;
							$check_families[] = $h3Font;
						}
				}
				// Heading 4 Font
				if (!empty($h4_font['font'])) {
					if ( 'off' !== $h4Font )
						if (!in_array( $h4Font, $check_families )) {
							$font_families[] = $h4Font.':'.$h4FontW;
							$check_families[] = $h4Font;
						}
				}

				// Heading 5 Font
				if (!empty($h5_font['font'])) {
					if ( 'off' !== $h5Font )
						if (!in_array( $h5Font, $check_families )) {
							$font_families[] = $h5Font.':'.$h5FontW;
							$check_families[] = $h5Font;
						}
				}
				// Heading 6 Font
				if (!empty($h6_font['font'])) {
					if ( 'off' !== $h6Font )
						if (!in_array( $h6Font, $check_families )) {
							$font_families[] = $h6Font.':'.$h6FontW;
							$check_families[] = $h6Font;
						}
				}
				$final_fonts = array_unique( $font_families );
				$query_args = array(
					'family' => urlencode( implode( '|', $final_fonts ) ),
					'display' => urlencode( 'fallback' ),
				);

				$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
			}
			
			return esc_url_raw( $fonts_url );
		}

		public static function socials(){
			$yakeen_socials = array(
				'social_facebook' => array(
					'icon' => 'fa-facebook-f',
					'url'  => YakeenTheme::$options['social_facebook'],
				),
				'social_twitter' => array(
					'icon' => 'fa-twitter',
					'url'  => YakeenTheme::$options['social_twitter'],
				),
				'social_behance' => array(
					'icon' => 'fa-behance',
					'url'  => YakeenTheme::$options['social_behance'],
				),
				'social_dribbble' => array(
					'icon' => 'fa-dribbble',
					'url'  => YakeenTheme::$options['social_dribbble'],
				),
				'social_linkedin' => array(
					'icon' => 'fa-linkedin-in',
					'url'  => YakeenTheme::$options['social_linkedin'],
				),
				'social_youtube' => array(
					'icon' => 'fa-youtube',
					'url'  => YakeenTheme::$options['social_youtube'],
				),
				'social_pinterest' => array(
					'icon' => 'fa-pinterest-p',
					'url'  => YakeenTheme::$options['social_pinterest'],
				),
				'social_instagram' => array(
					'icon' => 'fa-instagram',
					'url'  => YakeenTheme::$options['social_instagram'],
				),
				'social_skype' => array(
					'icon' => 'fa-skype',
					'url'  => YakeenTheme::$options['social_skype'],
				),
				'social_rss' => array(
					'icon' => 'fas fa-rss',
					'url'  => YakeenTheme::$options['social_rss'],
				),
				'social_snapchat' => array(
					'icon' => 'fa-snapchat-ghost',
					'url'  => YakeenTheme::$options['social_snapchat'],
				),
			);
			return array_filter( $yakeen_socials, array( 'YakeenTheme_Helper' , 'filter_social' ) );
		}
		public static function team_socials(){
			$team_socials = array(
				'facebook' => array(
					'label' => esc_html__( 'Facebook', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-facebook-f',
				),
				'twitter' => array(
					'label' => esc_html__( 'Twitter', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-twitter',
				),
				'linkedin' => array(
					'label' => esc_html__( 'Linkedin', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-linkedin-in',
				),
				'behance' => array(
					'label' => esc_html__( 'Behance', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-behance',
				),
				'dribbble' => array(
					'label' => esc_html__( 'Dribbble', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-dribbble',
				),
				'skype' => array(
					'label' => esc_html__( 'Skype', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-skype',
				),
				'youtube' => array(
					'label' => esc_html__( 'Youtube', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-youtube',
				),
				'pinterest' => array(
					'label' => esc_html__( 'Pinterest', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-pinterest-p',
				),
				'instagram' => array(
					'label' => esc_html__( 'Instagram', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-instagram',
				),
				'github' => array(
					'label' => esc_html__( 'Github', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-github',
				),
				'stackoverflow' => array(
					'label' => esc_html__( 'Stackoverflow', 'yakeen' ),
					'type'  => 'text',
					'icon'  => 'fa-stack-overflow',
				),
			);
			return apply_filters( 'YakeenTheme_Helper', $team_socials );
		}

		public static function nav_menu_args(){
			$yakeen_pagemenu = false;			
			if ( ( is_single() || is_page() ) ) {
				$layout_settings2 = get_post_meta( get_the_id(), 'yakeen_layout_settings', true );
				if ( !empty( $layout_settings2 ) ) {
					$yakeen_menuid = $layout_settings2['yakeen_page_menu'];
				} else {
					$yakeen_menuid = '';
				}
				if ( !empty( $yakeen_menuid ) && $yakeen_menuid != 'default' ) {
					$yakeen_pagemenu = $yakeen_menuid;
				}
			}
			if ( $yakeen_pagemenu ) {
				$nav_menu_args = array( 'menu' => $yakeen_pagemenu,'container' => 'nav' );
			}
			else {
				$nav_menu_args = array( 'theme_location' => 'primary','container' => 'nav' );
			}
			return $nav_menu_args;		
		}
				
		public static function has_footer(){
				
			if ( YakeenTheme::$footer_style == 2  ) {
				$footer_column = YakeenTheme::$options['footer_column_2'];
				for ( $i = 1; $i <= $footer_column; $i++ ) {
					if ( is_active_sidebar( 'footer-'. $i ) ) {
						return true;
					}
				}
				return false;
			} else if ( YakeenTheme::$footer_style == 3 ) {
				$footer_column = YakeenTheme::$options['footer_column_3'];
				for ( $i = 1; $i <= $footer_column; $i++ ) {
					if ( is_active_sidebar( 'footer-'. $i ) ) {
						return true;
					}
				}
				return false;				
			} else if ( YakeenTheme::$footer_style == 4 ) {
				$footer_column = YakeenTheme::$options['footer_column_4'];
				for ( $i = 1; $i <= $footer_column; $i++ ) {
					if ( is_active_sidebar( 'footer-'. $i ) ) {
						return true;
					}
				}
				return false;
			} else if ( YakeenTheme::$footer_style == 5 ) {
				$footer_column = YakeenTheme::$options['footer_column_5'];
				for ( $i = 1; $i <= $footer_column; $i++ ) {
					if ( is_active_sidebar( 'footer-'. $i ) ) {
						return true;
					}
				}
				return false;
			}
			
		}
		
		public static function get_img( $img ){
			$img = get_stylesheet_directory_uri() . '/assets/img/' . $img;
			return $img;
		}
		
		public static function get_asset_file($file) {
			return get_template_directory_uri() . '/assets/' . $file;
		}
		
		public static function get_font_css( $filename ){
			$path = '/assets/fonts/flaticon-yakeen/' . $filename . '.css';
			return self::get_file( $path );
		}
		public static function get_file( $path ){
			$file = get_stylesheet_directory_uri() . $path;
			if ( !file_exists( $file ) ) {
			  $file = get_template_directory_uri() . $path;
			}
			return $file;
		}
		
		public static function has_active_widget(){

			if ( YakeenTheme::$layout == 'left-sidebar' ) {
				$sidebar_order = 'order-lg-2 order-md-1';
			} else {
				$sidebar_order = 'no-order';
			}
				
			if ( YakeenTheme::$sidebar ) {
				if ( is_active_sidebar( YakeenTheme::$sidebar ) ) {
					$yakeen_layout_class = "col-xl-9 col-lg-8 {$sidebar_order}";
				} else {
					$yakeen_layout_class = 'col-12';
				}
			} else {
				if ( is_active_sidebar( 'sidebar' ) ) {
					$yakeen_layout_class = "col-xl-9 col-lg-8 {$sidebar_order}";
				} else {
					$yakeen_layout_class = 'col-12';
				}
			}
			
			return $yakeen_layout_class;
			
		}
		
		// query reset object
		public static function wp_set_temp_query( $query ) {
			global $wp_query;
			$temp = $wp_query;
			$wp_query = $query;
			return $temp;
		}

		public static function wp_reset_temp_query( $temp ) {
			global $wp_query;
			$wp_query = $temp;
			wp_reset_postdata();
		}
		
		public static function filter_content( $content ){
			// wp filters
			$content = wptexturize( $content );
			$content = convert_smilies( $content );
			$content = convert_chars( $content );
			$content = wpautop( $content );
			$content = shortcode_unautop( $content );

			// remove shortcodes
			$pattern= '/\[(.+?)\]/';
			$content = preg_replace( $pattern,'',$content );

			// remove tags
			$content = strip_tags( $content );

			return $content;
		}
		// get post function
		public static function get_current_post_content( $post = false ) {
			if ( !$post ) {
				$post = get_post();
			}
			$content = has_excerpt( $post->ID ) ? $post->post_excerpt : $post->post_content;
			$content = self::filter_content( $content );
			return $content;
		}

		private static function minified_css( $css ) {
			/* remove comments */
			$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
			/* remove tabs, spaces, newlines, etc. */
			$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), ' ', $css );
			return $css;
		}
		
		public static function custom_sidebar_fields(){
			$sidebar_fields = array();

			$sidebar_fields['sidebar'] = esc_html__( 'Sidebar', 'yakeen' );

			$sidebars = get_option( 'yakeen_custom_sidebars', array() );
			if ( $sidebars ) {
				foreach ( $sidebars as $sidebar ) {
					$sidebar_fields[$sidebar['id']] = $sidebar['name'];
				}
			}

			return $sidebar_fields;
		}
		
		public static function dynamic_internal_style(){
			ob_start();
			include YAKEEN_INC_DIR . 'variable-style.php';
			include YAKEEN_INC_DIR . 'variable-style-elementor.php';
			$dynamic_css  = ob_get_clean();
			$dynamic_css  = self::minified_css( $dynamic_css );
			wp_register_style( 'yakeen-dynamic', false );
			wp_enqueue_style( 'yakeen-dynamic' );
			wp_add_inline_style( 'yakeen-dynamic', $dynamic_css );			
		}
	}
}