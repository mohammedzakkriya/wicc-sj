<div class="group" id="1">
	<h3><?php _e( 'Column', 'ich-effects' ); ?> 1</h3>
	<div>
		<table style="padding: 5px;">
			<tr>
				<td><?php _e( 'Paste URL or use from Media', 'ich-effects' ); ?>
				<td>
					<input name="wcpop[1][imageurl]" type="text" value="" class="image-url">
					<button class="button-secondary upload_image_button"
						data-title="<?php _e( 'Select Image', 'ich-effects' ); ?>"
						data-btntext="<?php _e( 'Select', 'ich-effects' ); ?>"><?php _e( 'Media', 'ich-effects' ); ?></button>
				</td>
				<td>
					<p class="description"><?php _e( 'Use media to upload image', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Title', 'ich-effects' ); ?></td>
				<td>
					<input name="wcpop[1][imagetitle]" type="text" value="" class="widefat image-title" class="widefat">
				</td>
				<td>
					<p class="description"><?php _e( 'It will be used as title attribute of image tag', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Alternate Text', 'ich-effects' ); ?></td>
				<td>
					<input name="wcpop[1][imagealt]" type="text" value="" class="widefat alt-text">
				</td>
				<td>
					<p class="description"><?php _e( 'It will be used as alt attribute of image tag', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Caption Text', 'ich-effects' ); ?></td>
				<td><textarea class="widefat" name="wcpop[1][captiontext]"></textarea></td>
				<td>
					<p class="description"><?php _e( 'HTML tags can be used when caption wrapper is none', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Caption Wrapper', 'ich-effects' ); ?></td>
				<td>
					<select class="widefat" name="wcpop[1][captionwrap]">
						<option value="h1"><?php _e( 'Heading', 'ich-effects' ); ?> 1</option>
						<option value="h2"><?php _e( 'Heading', 'ich-effects' ); ?> 2</option>
						<option value="h3"><?php _e( 'Heading', 'ich-effects' ); ?> 3</option>
						<option value="h4"><?php _e( 'Heading', 'ich-effects' ); ?> 4</option>
						<option value="h5"><?php _e( 'Heading', 'ich-effects' ); ?> 5</option>
						<option value="h6"><?php _e( 'Heading', 'ich-effects' ); ?> 6</option>
						<option value="div" selected><?php _e( 'None', 'ich-effects' ); ?></option>
					</select>
				</td>
				<td>
					<p class="description"><?php _e( 'Wrap caption in markup', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Caption Alignment', 'ich-effects' ); ?></td>
				<td>
					<select name="wcpop[1][captionalignment]" class="widefat">
						<option value="auto"><?php _e( 'Auto', 'ich-effects' ); ?></option>
						<option value="center"><?php _e( 'Center', 'ich-effects' ); ?></option>
						<option value="right"><?php _e( 'Right', 'ich-effects' ); ?></option>
						<option value="left"><?php _e( 'Left', 'ich-effects' ); ?></option>
						<option value="justify"><?php _e( 'Justify', 'ich-effects' ); ?></option>
					</select>
				</td>
				<td>
					<p class="description"><?php _e( 'How you want to align caption', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Caption Background Color', 'ich-effects' ); ?></td>
				<td><input name="wcpop[1][captionbg]" type="text" value="" class="widefat"></td>
				<td>
					<p class="description"><?php _e( 'Use Color Picker from right sidebar', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Caption Text Color', 'ich-effects' ); ?></td>
				<td><input name="wcpop[1][captioncolor]" type="text" value="" class="widefat"></td>
				<td>
					<p class="description"><?php _e( 'Use Color Picker from right sidebar', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Background Opacity', 'ich-effects' ); ?></td>
				<td><input name="wcpop[1][captionopacity]" type="number" max="1" min="0" step="0.1" value="" class="widefat"></td>
				<td>
					<p class="description"><?php _e( 'Use from 0.1 to 1.0', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Link To', 'ich-effects' ); ?></td>
				<td><input name="wcpop[1][captionlink]" type="text" class="widefat" value=""></td>
				<td>
					<p class="description"><?php _e( 'Paste URL here or leave blank', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Enable LightBox', 'ich-effects' ); ?> (<b><?php _e( 'Pro Feature', 'ich-effects' ); ?></b>)</td>
				<td><input name="wcpop[1][lightbox]" type="checkbox"></td>
				<td>
					<p class="description"><?php _e( 'It will open images in popup on clicking', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Link Target', 'ich-effects' ); ?></td>
				<td>
					<select name="wcpop[1][captiontarget]" class="widefat">
						<option value="_blank"><?php _e( 'New window', 'ich-effects' ); ?></option>
						<option value="_self"><?php _e( 'Same Window', 'ich-effects' ); ?></option>
						<option value="_parent"><?php _e( 'Parent frameset', 'ich-effects' ); ?></option>
						<option value="_top"><?php _e( 'Full body of the window', 'ich-effects' ); ?></option>
					</select>
				</td>
				<td>
					<p class="description"><?php _e( 'Open link in new tab or same', 'ich-effects' ); ?>.</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Hover Style', 'ich-effects' ); ?></td>
				<td>
					<select name="wcpop[1][hoverstyle]" class="widefat">
						<?php foreach ($all_styles as $stylename) { ?>
							<option value="<?php echo $stylename; ?>"><?php echo ucwords(preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $stylename)); ?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<p class="description"><?php _e( 'Choose hover style', 'ich-effects' ); ?> (<b>31 more effects in Pro Version</b>)</p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Border Width', 'ich-effects' ); ?> (<b><?php _e( 'Pro Feature', 'ich-effects' ); ?></b>)</td>
				<td>
					<input type="text" class="widefat" name="wcpop[1][borderwidth]">
				</td>
				<td>
					<p class="description"><?php _e( 'Width of border. Leaving blank will disable border.', 'ich-effects' ); ?></p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Border Type', 'ich-effects' ); ?> (<b><?php _e( 'Pro Feature', 'ich-effects' ); ?></b>)</td>
				<td>
					<select name="wcpop[1][bordertype]" class="widefat">
						<option value="dotted"><?php _e( 'Dotted', 'ich-effects' ); ?></option>
						<option value="dashed"><?php _e( 'Dashed', 'ich-effects' ); ?></option>
						<option value="solid"><?php _e( 'Solid', 'ich-effects' ); ?></option>
						<option value="double"><?php _e( 'Double', 'ich-effects' ); ?></option>
						<option value="groove"><?php _e( 'Groove', 'ich-effects' ); ?></option>
						<option value="ridge"><?php _e( 'Ridge', 'ich-effects' ); ?></option>
						<option value="inset"><?php _e( 'Inset', 'ich-effects' ); ?></option>
						<option value="outset"><?php _e( 'Outset', 'ich-effects' ); ?></option>
					</select>
				<td>
					<p class="description"><?php _e( 'Some styles may depend on border color.', 'ich-effects' ); ?></p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Border Color', 'ich-effects' ); ?> (<b><?php _e( 'Pro Feature', 'ich-effects' ); ?></b>)</td>
				<td>
					<input type="text" class="widefat" name="wcpop[1][bordercolor]">
				</td>
				<td>
					<p class="description"><?php _e( 'Name of color or color code.', 'ich-effects' ); ?></p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Border Radius', 'ich-effects' ); ?> (<b><?php _e( 'Pro Feature', 'ich-effects' ); ?></b>)</td>
				<td>
					<input type="text" class="widefat" name="wcpop[1][borderradius]">
				</td>
				<td>
					<p class="description"><?php _e( 'Radius of border eg: 5px or 50%.', 'ich-effects' ); ?></p>
				</td>
			</tr>
			<tr>
				<td><?php _e( 'Width', 'ich-effects' ); ?></td>
				<td>
					<select class="widefat" name="wcpop[1][captionwidth]">
						<option value="1">1 <?php _e( 'Column', 'ich-effects' ); ?></option>
						<option value="2">2 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="3">3 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="4">4 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="5">5 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="6">6 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="7">7 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="8">8 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="9">9 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="10">10 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="11">11 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="12">12 <?php _e( 'Columns', 'ich-effects' ); ?></option>
						<option value="auto"><?php _e( 'Auto Adjust', 'ich-effects' ); ?></option>
					</select>
				</td>
				<td>
					<p class="description"><?php _e( 'Select width from 12 Columns Grid', 'ich-effects' ); ?></p>
				</td>
			</tr>
		</table>
		<button class="button button-delete"><?php _e( 'Remove', 'ich-effects' ); ?></button>
		<br style="clear: both;">
		<br>		
	</div>
</div>