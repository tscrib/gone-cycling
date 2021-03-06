<?php
/**
 * Advertisement 125 Widget Class
 */
class Theme_Widget_Advertisement_125 extends WP_Widget {
	function Theme_Widget_Advertisement_125() {
		$widget_ops = array('classname' => 'widget_advertisement_125', 'description' => __( 'Displays a list of advertisement', 'striking_admin' ) );
		$this->WP_Widget('advertisement_125', THEME_SLUG.' - '.__('Advertisement', 'striking_admin').' 125', $widget_ops);
		if ('widgets.php' == basename($_SERVER['PHP_SELF'])) {
			add_action( 'admin_print_scripts', array(&$this, 'add_admin_script') );
		}
	}
	function add_admin_script(){
		wp_enqueue_script( 'advertisement-widget', THEME_ADMIN_ASSETS_URI . '/js/advertisement-widget.js', array('jquery'));
	}
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		$count = (int)$instance['count'];
		$output = '';
		if( $count > 0){
			for($i=1; $i<= $count; $i++){
				$image = isset($instance['ad_'.$i.'_image'])?$instance['ad_'.$i.'_image']:'';
				$link = isset($instance['ad_'.$i.'_link'])?$instance['ad_'.$i.'_link']:'';
				if(empty($image)){
					$image = THEME_IMAGES.'/ad.gif';
				}
				$output .= '<a href="'.$link.'" rel="nofollow" target="_blank" alt="Advertisment"><img src="'.$image.'" alt="Advertisement"/></a>';
			}
		}
		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title)
				echo $before_title . $title . $after_title;
			echo $output;
			echo $after_widget;
		}
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = (int) $new_instance['count'];
		for($i=1;$i<=$instance['count'];$i++){
			$instance['ad_'.$i.'_image'] = strip_tags($new_instance['ad_'.$i.'_image']);
			$instance['ad_'.$i.'_link'] = strip_tags($new_instance['ad_'.$i.'_link']);
		}
		return $instance;
	}
	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? absint($instance['count']) : 4;
		for($i=1;$i<=10;$i++){
			$ad_image = 'ad_'.$i.'_image';
			$$ad_image = isset($instance[$ad_image]) ? $instance[$ad_image] : '';
			$ad_link = 'ad_'.$i.'_link';
			$$ad_link = isset($instance[$ad_link]) ? $instance[$ad_link] : '';
		}
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'striking_admin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('How many advertisement to display?', 'striking_admin'); ?></label>
		<input id="<?php echo $this->get_field_id('count'); ?>" class="advertisement_count" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>
		<p>
			<em><?php _e("Note: Please input FULL URL <br/>(e.g. <code>http://www.example.com</code>)", 'striking_admin');?></em>
		</p>
		<div class="advertisement_wrap">
		<?php for($i=1;$i<=10;$i++): $ad_image = 'ad_'.$i.'_image';$ad_link = 'ad_'.$i.'_link'; ?>
			<div class="advertisement_<?php echo $i;?>" <?php if($i>$count):?>style="display:none"<?php endif;?>>
				<p><label for="<?php echo $this->get_field_id( $ad_image ); ?>"><?php printf(__('#%s Image URL:', 'striking_admin'),$i);?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $ad_image ); ?>" name="<?php echo $this->get_field_name( $ad_image ); ?>" type="text" value="<?php echo $$ad_image; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $ad_link ); ?>"><?php printf(__('#%s Link:', 'striking_admin'),$i);?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $ad_link ); ?>" name="<?php echo $this->get_field_name( $ad_link ); ?>" type="text" value="<?php echo $$ad_link; ?>" /></p>
			</div>
		<?php endfor;?>
		</div>
<?php
	}
}
