<style type="text/css">
table.aws-settings-section {
    background: none repeat scroll 0 0 #fff;
    margin-top: 20px;
    width: 70%;
}
.aws-settings-section thead {
    background-color: #0074a2;
    color: #fff;
    font-size: 24px;
    height: 44px;
}
.aws-settings-section input[type="text"] {
    background: none repeat scroll 0 0 #fff;
    height: 32px !important;
    width: 98%;
}
.aws-settings-section tr td:nth-child(1) {
    font-weight: bold;
    padding-left: 10px !important;
}
.aws-settings-section tbody tr td {
    height: 50px !important;
}
.aws-settings-section tfoot {
    background-color: #0074a2;
    color: #fff;
    font-size: 10px;
    height: 30px;
}
.aws-settings-section a {
   color: #ccc;
}
</style>
<form action="" method="post">
	<table class="aws-settings-section">
		<thead>
			<tr>
				<th colspan="2">AWS Settings</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th colspan="2">Powered by Ultimate Amazon for WordPress</a></th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td>AWS Public Key</td>
				<td><input type="text" value="<?php echo get_option('asinp_aws_public_key'); ?>" required name="aws_public_key" style="height:25px;" placeholder="AWS Public Key"></td>
			</tr>
			<tr>
				<td>AWS Private Key</td>
				<td><input type="text" value="<?php echo get_option('asinp_aws_private_key'); ?>" required name="aws_private_key" style="height:25px;" placeholder="AWS Private Key"></td>
			</tr>
			<!-- <tr>
				<td>AWS Associate Tag</td>
				<td><input type="text" readonly value="<?php echo get_option('asinp_aws_associate_tag'); ?>" required name="aws_associate_tag" style="height:25px;" placeholder="AWS Associate Tag"></td>
			</tr>  -->
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="aws_settings_save" class="button-primary" value="Save Settings">
					<input type="submit" name="aws_first_run" class="button-primary" value="Scan All">
				</td>
			</tr>
		</tbody>
	</table>
</form>

<?php 
echo do_shortcode('[all-items]');
?>