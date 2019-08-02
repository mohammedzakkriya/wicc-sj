<?php
//Hook Widget
add_action( 'widgets_init', 'mix_master_widget_basic' );
//Register Widget
function mix_master_widget_basic() {
register_widget( 'mix_master_widget_basic' );
}

class mix_master_widget_basic extends WP_Widget {
	function __construct(){
	$widget_ops = array( 'classname' => 'Mixcloud Master Basic Player', 'description' => __('Mixcloud Master Basic Player is a fast loading and easy to use Widget to broadcast your radio, podcasts, mixes.', 'mix_master') );
	$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'mix_master_widget_basic' );
	parent::__construct( 'mix_master_widget_basic', __('Mixcloud Master Basic Player', 'mix_master'), $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		//Our variables from the widget settings.
		$mix_title = isset( $instance['mix_title'] ) ? $instance['mix_title'] :false;
		$mix_title_new = isset( $instance['mix_title_new'] ) ? $instance['mix_title_new'] :false;
		$show_mixplayer_basic = isset( $instance['show_mixplayer_basic'] ) ? $instance['show_mixplayer_basic'] :false;
		$mixplayer_basic_page = $instance['mixplayer_basic_page'];
		echo $before_widget;
		
		// Display the widget title
	if ( $mix_title ){
		if (empty ($mix_title_new)){
			$mix_title_new = constant('MIX_MASTER_NAME');
			echo $before_title . $mix_title_new . $after_title;
		}
		else{
			echo $before_title . $mix_title_new . $after_title;
		}
	}
	else{
	}
	//Prepare User Page Link
		if (empty ($mixplayer_basic_page)){
		$mixplayer_basic_page = "https://www.mixcloud.com/mixmastermorris/mixmaster-morris-shambala-forest-pt4/";
		}
	//Display Mixcloud Profile
	if ( $show_mixplayer_basic ){
			echo '<iframe src="https://www.mixcloud.com/widget/iframe/?embed_type=widget_standard&amp;feed='.$mixplayer_basic_page.'&amp;hide_cover=1&amp;hide_tracklist=1" frameborder="0" height="180" width="100%"></iframe>';
	}
	else{
	}
	echo $after_widget;
	}
	//Update the widget
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		//Strip tags from title and name to remove HTML
		$instance['mix_title'] = strip_tags( $new_instance['mix_title'] );
		$instance['mix_title_new'] = $new_instance['mix_title_new'];
		$instance['show_mixplayer_basic'] = $new_instance['show_mixplayer_basic'];
		$instance['mixplayer_basic_page'] = $new_instance['mixplayer_basic_page'];
		return $instance;
	}
	function form( $instance ) {
	$plugin_master_name = constant('MIX_MASTER_NAME');
	//Set up some default widget settings.
	$defaults = array( 'mix_title_new' => __('Mix Master', 'mix_master'), 'mix_title' => true, 'mix_title_new' => false, 'show_mixplayer_basic' => false, 'mixplayer_basic_page' => false );
	$instance = wp_parse_args( (array) $instance, $defaults );
	?>
		<br>
		<b>Check the buttons to be displayed:</b>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; height:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['mix_title'], true ); ?> id="<?php echo $this->get_field_id( 'mix_title' ); ?>" name="<?php echo $this->get_field_name( 'mix_title' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'mix_title' ); ?>"><b><?php _e('Display Widget Title', 'mix_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'mix_title_new' ); ?>"><?php _e('Change Title:', 'mix_master'); ?></label>
	<br>
	<input id="<?php echo $this->get_field_id( 'mix_title_new' ); ?>" name="<?php echo $this->get_field_name( 'mix_title_new' ); ?>" value="<?php echo $instance['mix_title_new']; ?>" style="width:auto;" />
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
	<p>
	<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
	&nbsp;
	<input type="checkbox" <?php checked( (bool) $instance['show_mixplayer_basic'], true ); ?> id="<?php echo $this->get_field_id( 'show_mixplayer_basic' ); ?>" name="<?php echo $this->get_field_name( 'show_mixplayer_basic' ); ?>" />
	<label for="<?php echo $this->get_field_id( 'show_mixplayer_basic' ); ?>"><b><?php _e('Activate Mixcloud Player', 'mix_master'); ?></b></label></br>
	</p>
	<p>
	<label for="<?php echo $this->get_field_id( 'mixplayer_basic_page' ); ?>"><?php _e('Mixcloud Radio or Podcast Link:', 'mix_master'); ?></label>
	<input id="<?php echo $this->get_field_id( 'mixplayer_basic_page' ); ?>" name="<?php echo $this->get_field_name( 'mixplayer_basic_page' ); ?>" value="<?php echo $instance['mixplayer_basic_page']; ?>" style="width:auto;" />
	<div class="description">Copy and Paste from your browser the radio, podcast or mix link, example:</div>
	<div class="description">https://www.mixcloud.com/mixmastermorris/mixmaster-morris-shambala-forest-pt4/</div>
	</p>
<div style="background: url(<?php echo plugins_url('images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
		<p>
		<img src="<?php echo plugins_url('images/techgasp-minilogo-16.png', dirname(__FILE__)); ?>" style="float:left; width:18px; vertical-align:middle;" />
		&nbsp;
		<b><?php echo $plugin_master_name; ?> Website</b>
		</p>
		<p><a class="button-secondary" href="https://wordpress.techgasp.com/mix-master/" target="_blank" title="<?php echo $plugin_master_name; ?> Info Page">Info Page</a> <a class="button-secondary" href="https://wordpress.techgasp.com/mix-master-documentation/" target="_blank" title="<?php echo $plugin_master_name; ?> Documentation">Documentation</a> <a class="button-primary" href="https://wordpress.techgasp.com/mix-master/" target="_blank" title="Visit Website">Get Add-ons</a></p>
	<?php
	}
 }
?>
