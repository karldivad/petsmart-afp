<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$thumb_size = 'yakeen-size6';

$yakeen_has_entry_meta  = ( YakeenTheme::$options['blog_date'] || YakeenTheme::$options['blog_author_name'] || YakeenTheme::$options['blog_comment_num'] || YakeenTheme::$options['blog_length'] && function_exists( 'yakeen_reading_time' ) || YakeenTheme::$options['blog_view'] && function_exists( 'yakeen_views' ) ) ? true : false;

$yakeen_time_html       = sprintf( '<span class="date">%s</span><span class="month">%s</span>', get_the_time( 'd' ), get_the_time( 'M' ), get_the_time( 'Y' ) );
$yakeen_time_html       = apply_filters( 'yakeen_single_time', $yakeen_time_html );

$yakeen_comments_number = number_format_i18n( get_comments_number() );
$yakeen_comments_html = $yakeen_comments_number == 1 ? esc_html__( 'Comment' , 'yakeen' ) : esc_html__( 'Comments' , 'yakeen' );
$yakeen_comments_html = '<span class="comment-number">'. $yakeen_comments_number .'</span> ' . $yakeen_comments_html;

$id = get_the_ID();
$content = get_the_content();
$content = apply_filters( 'the_content', $content );
$content = wp_trim_words( get_the_excerpt(), YakeenTheme::$options['post_content_limit'], '.' );

$wow = YakeenTheme::$options['blog_animation'];
$effect = YakeenTheme::$options['blog_animation_effect'];

if (  YakeenTheme::$layout == 'right-sidebar' || YakeenTheme::$layout == 'left-sidebar' ){
	$post_classes = array( 'col-12 rt-grid-item blog-layout-4 ' . $wow . ' ' . $effect );
	$ul_class = 'side_bar';
} else {
	$post_classes = array( 'col-md-10 col-12 mx-auto rt-grid-item blog-layout-4 ' . $wow . ' ' . $effect );
	$ul_class = '';
}

if ( empty(has_post_thumbnail() ) ) {
	$img_class ='no-image';
}else {
	$img_class ='show-image';
}

if( YakeenTheme::$options['display_no_preview_image'] == '1' ) {
	$preview = 'show-preview';
}else {
	$preview = 'no-preview';
}

if( YakeenTheme::$options['image_blend'] == 'normal' ) {
	$blend = 'normal';
}else {
	$blend = 'blend';
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?> data-wow-duration="1.5s">
	<div class="blog-box <?php echo esc_attr($img_class); ?> <?php echo esc_attr($preview); ?>">
		<?php if ( has_post_thumbnail() || YakeenTheme::$options['display_no_preview_image'] == '1'  ) { ?>
		<div class="blog-img-holder">
			<div class="blog-img <?php echo esc_attr($blend); ?>">
				<a href="<?php the_permalink(); ?>" class="img-opacity-hover"><?php if ( has_post_thumbnail() ) { ?>
					<?php the_post_thumbnail( $thumb_size, ['class' => 'img-responsive'] ); ?>
					<?php } else {
						if ( YakeenTheme::$options['display_no_preview_image'] == '1' ) {
							if ( !empty( YakeenTheme::$options['no_preview_image']['id'] ) ) {
								$thumbnail = wp_get_attachment_image( YakeenTheme::$options['no_preview_image']['id'], $thumb_size );						
							}
							elseif ( empty( YakeenTheme::$options['no_preview_image']['id'] ) ) {
								$thumbnail = '<img class="wp-post-image" src="'.YAKEEN_IMG_URL.'noimage_732X520.jpg" alt="'. the_title_attribute( array( 'echo'=> false ) ) .'">';
							}
							echo wp_kses( $thumbnail , 'alltext_allow' );
						}
					}
					?>
				</a>
				<?php if ( YakeenTheme::$options['blog_date'] == 1 && has_post_thumbnail() ) { ?>
				<div class="post-date style-1"><?php echo wp_kses($yakeen_time_html, 'alltext_allow'); ?></div>			
				<?php } ?>
			</div>				
		</div>
		<?php } ?>
		<div class="entry-content">
			<?php if ( YakeenTheme::$options['blog_cats'] ) { ?>
				<span class="entry-categories style-1"><?php echo yakeen_category_prepare(); ?></span>
			<?php } ?>
			<h3 class="entry-title title-animation-underline size-2"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<?php if ( $yakeen_has_entry_meta ) { ?>
			<ul class="entry-meta">
				<?php if ( YakeenTheme::$options['blog_author_name'] ) { ?>
				<li class="post-author"><?php echo yakeen_meta_icon_admin(); ?><?php esc_html_e( 'by ', 'yakeen' );?><?php the_author_posts_link(); ?></li>
				<?php } if ( YakeenTheme::$options['blog_date'] == 1 && !has_post_thumbnail() ) { ?>
				<li class="post-date"><?php echo yakeen_meta_icon_calendar(); ?><?php echo get_the_date(); ?></li>
				<?php } if ( YakeenTheme::$options['blog_comment_num'] ) { ?>
				<li class="post-comment"><i class="far fa-comments"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo wp_kses( $yakeen_comments_html , 'alltext_allow' );?></a></li>
				<?php } if ( YakeenTheme::$options['blog_length'] && function_exists( 'yakeen_reading_time' ) ) { ?>
				<li class="post-reading-time meta-item"><?php echo yakeen_meta_icon_clock(); ?><?php echo yakeen_reading_time(); ?></li>
				<?php } if ( YakeenTheme::$options['blog_view'] && function_exists( 'yakeen_views' ) ) { ?>
				<li><span class="post-views"><i class="fas fa-signal"></i><?php echo yakeen_views(); ?></span></li>
				<?php } ?>
			</ul>
			<?php } ?>	
			<?php if ( YakeenTheme::$options['blog_content'] ) { ?>
			<div class="entry-text"><p><?php echo wp_kses( $content , 'alltext_allow' ); ?></p></div>
			<?php } ?>	
		</div>
	</div>
</div>