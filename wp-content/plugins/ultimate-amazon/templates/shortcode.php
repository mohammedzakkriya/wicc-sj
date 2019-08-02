<style type="text/css">

#owl-demo .item{

	margin: 3px;

}

#owl-demo .item img {

    display: block;

    height: auto;

    max-height: 208px;

    width: 100%;

}

.owl-controls {

	display: none;

}

.next {

	float:left; width: 10%; text-align:right; margin-top:9.5%; cursor:pointer;

}

.prev {

	float:left; margin-top:9.5%; cursor:pointer; width: 10%;

}

.prev img, .next img

{

	max-width: 100%;

}

.owl-container- {

	width:80%;float: left;

}

</style>

<?php

    $carousel = get_option('asinp_rnd_amazon_data');

if( !empty($carousel) ) {

?>

	<div class="prev"><img src="<?php echo plugins_url($this->plugin_name).'/images/prev.png' ?>"></div>

	<div class="owl-container-">

		<div id="owl-demo" class="owl-carousel owl-theme">

		    <?php 

		   

		    	foreach ($carousel as $key => $_car) {

		            echo '<div class="item"><a target="_blank" href="'.$_car['url'].'"><img src="'.$_car['medium_page_url'].'" alt=""></a></div>';

		        }

		    ?>

		</div>

	<div>Powered by <a href="http://www.publir.com" target="_blank">Publir</a></div>

	</div>

	<div class="next"><img src="<?php echo plugins_url($this->plugin_name).'/images/next.png' ?>"></div>

<?php } ?>