<?php global $post; ?>
    <div id="wcpinner" class="wcp-main-wrap">
    <?php //74 Styles
        $all_styles = array(
            'bounce',
            'flash',
            'pulse',
            'rubberBand',
            'shake',
            'swing',
            'tada',
            'wobble',
            'jello',
            'bounceIn',
            'bounceInDown',
            'bounceInLeft',
            'bounceInRight',
            'bounceInUp',
            // 'bounceOut',
            // 'bounceOutDown',
            // 'bounceOutLeft',
            // 'bounceOutRight',
            // 'bounceOutUp',
            'fadeIn',
            'fadeInDown',
            'fadeInDownBig',
            'fadeInLeft',
            'fadeInLeftBig',
            'fadeInRight',
            'fadeInRightBig',
            'fadeInUp',
            'fadeInUpBig',
            // 'fadeOut',
            // 'fadeOutDown',
            // 'fadeOutDownBig',
            // 'fadeOutLeft',
            // 'fadeOutLeftBig',
            // 'fadeOutRight',
            // 'fadeOutRightBig',
            // 'fadeOutUp',
            // 'fadeOutUpBig',
            'flipInX',
            'flipInY',
            // 'flipOutX',
            // 'flipOutY',
            'lightSpeedIn',
            'lightSpeedOut',
            'rotateIn',
            'rotateInDownLeft',
            'rotateInDownRight',
            'rotateInUpLeft',
            'rotateInUpRight',
            // 'rotateOut',
            // 'rotateOutDownLeft',
            // 'rotateOutDownRight',
            // 'rotateOutUpLeft',
            // 'rotateOutUpRight',
            // 'hinge',
            'rollIn',
            // 'rollOut',
            'zoomIn',
            'zoomInDown',
            'zoomInLeft',
            'zoomInRight',
            'zoomInUp',
            // 'zoomOut',
            // 'zoomOutDown',
            // 'zoomOutLeft',
            // 'zoomOutRight',
            // 'zoomOutUp',
            'slideInDown',
            'slideInLeft',
            'slideInRight',
            'slideInUp',
            // 'slideOutDown',
            // 'slideOutLeft',
            // 'slideOutRight',
            // 'slideOutUp',
            'noHoverCaptionBottom',
            'noHoverCaptionTop',
            'none'
        );
    //get the saved meta as an arry
    $wcp_settings = get_post_meta($post->ID,'wcpop',true);

    $column = 1;
    if ( count( $wcp_settings ) > 0 && is_array($wcp_settings)) {
        foreach( $wcp_settings as $key => $options ) {
            include 'temp/saved_options.php';
            $column = $column +1;
        }
    } else {
        include 'temp/load_first.php';
    }
    ?>
</div>
<br>
<span class="add button button-primary"><?php _e('Add New', 'ich-effects'); ?></span>