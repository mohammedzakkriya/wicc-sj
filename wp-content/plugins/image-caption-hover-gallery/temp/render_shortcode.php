<div class="wcp-prefix">
    
    <?php $padding = (isset($atts['padding'])) ? $atts['padding'] : '20px' ; ?>
    <div class="grid grid-pad" style="padding-top: <?php echo $padding; ?>;
    padding-left: <?php echo $padding; ?>;
    padding-right: 0px;">
        <?php
            $all_data = get_post_meta( $atts['id'], 'wcpop', true );
            $arr_count = count($all_data);
            $css_class = 'col-1-'.$arr_count;
        ?>

        <?php foreach ($all_data as $key => $data) { ?>
            <?php $css_class_width = (isset($data['captionwidth']) && $data['captionwidth'] != 'auto') ? 'col-'.$data['captionwidth'].'-12' : $css_class ; ?>
            <div class="<?php echo $css_class_width; ?>" style="padding-right: <?php echo $padding; ?>;">
                
                <div class="ih-gallery-plugin" id="ih-gallery-<?php echo $key; ?>">
                    <?php if(isset($data['captionlink']) && $data['captionlink'] != '') { ?>
                        <a href="<?php echo $data['captionlink']; ?>" target="<?php echo $data['captiontarget']; ?>">
                    <?php } ?>
                        <div class="ih-caption-box">
                    <div class="ih-caption-wrap">
                            <div class="ih-caption-outer animated <?php echo $data['hoverstyle']; ?>" style="
                                    background-color: <?php echo $data['captionbg']; ?>;
                                    color: <?php echo $data['captioncolor']; ?>;
                                    opacity: <?php echo $data['captionopacity']; ?>;
                                    -webkit-animation-duration: 1s;
                                    animation-duration: 1s;
                            ">  
                                <div class="ih-caption-inner" style="padding: 5px;">
                                    <<?php echo $data['captionwrap']; ?> style="text-align: <?php echo $data['captionalignment']; ?>;">
                                        <?php echo stripcslashes($data['captiontext']); ?>
                                    </<?php echo $data['captionwrap']; ?>>
                                </div>
                            </div>
                    </div>
                            <img class="ih-gallery-image" src="<?php echo $data['imageurl']; ?>" title="<?php echo $data['imagetitle']; ?>" alt="<?php echo $data['imagealt']; ?>"/>
                        </div>
                    <?php if(isset($data['captionlink']) && $data['captionlink'] != '') { ?>
                        </a>
                    <?php } ?>
                </div>

            </div>
        <?php } ?>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="wcp_loader"></div>
</div>