<?php
//Delete Transients after  week
require_once( dirname( __FILE__ ) . '/spam-master-admin-registrations-transients.php');
		/** function/method
		* Usage: hooking (registering) the plugin menu
		* Arg(0): null
		* Return: void
		*/
		function menu_reg_single(){
		if ( is_admin() )
		add_submenu_page( 'spam-master', 'Registrations', 'Registrations', 'manage_options', 'spam-master-registrations', 'spam_master_registrations' );
		}

		///////////////////////
		// WORDPRESS ACTIONS //
		///////////////////////
		if( is_multisite() ) {
		add_action( 'admin_menu', 'menu_reg_single' );
		}
		else {
		add_action( 'admin_menu', 'menu_reg_single' );
		}

function spam_master_registrations(){
global $wpdb, $blog_id;
$plugin_master_name = constant('SPAM_MASTER_NAME');
///////////////////////////////
//Prepare Registrations Graph//
///////////////////////////////
//Prepare 5 Days
$spam_master_users_today = date( 'Y-m-d' );
$spam_master_users_today_minus_1 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
$spam_master_users_today_minus_2 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-2, date("Y")));
$spam_master_users_today_minus_3 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-3, date("Y")));
$spam_master_users_today_minus_4 = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")-4, date("Y")));
//QUERY DATABASE FOR BLOCKED
if (is_multisite()){
	$blog_prefix = $wpdb->get_blog_prefix();
	$table_prefix = $wpdb->base_prefix;
	$query_blocked = "SELECT meta_value FROM {$table_prefix}sitemeta WHERE site_id = {$blog_id} AND meta_key LIKE '_site_transient_spam_master_invalid_email{$spam_master_users_today}%'";
	$query_blocked_1 = "SELECT meta_value FROM {$table_prefix}sitemeta WHERE site_id = {$blog_id} AND meta_key LIKE '_site_transient_spam_master_invalid_email{$spam_master_users_today_minus_1}%'";
	$query_blocked_2 = "SELECT meta_value FROM {$table_prefix}sitemeta WHERE site_id = {$blog_id} AND meta_key LIKE '_site_transient_spam_master_invalid_email{$spam_master_users_today_minus_2}%'";
	$query_blocked_3 = "SELECT meta_value FROM {$table_prefix}sitemeta WHERE site_id = {$blog_id} AND meta_key LIKE '_site_transient_spam_master_invalid_email{$spam_master_users_today_minus_3}%'";
	$query_blocked_4 = "SELECT meta_value FROM {$table_prefix}sitemeta WHERE site_id = {$blog_id} AND meta_key LIKE '_site_transient_spam_master_invalid_email{$spam_master_users_today_minus_4}%'";
}
else{
	$table_prefix = $wpdb->base_prefix;
	$query_blocked = "SELECT option_value FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_invalid_email{$spam_master_users_today}%'";
	$query_blocked_1 = "SELECT option_value FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_invalid_email{$spam_master_users_today_minus_1}%'";
	$query_blocked_2 = "SELECT option_value FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_invalid_email{$spam_master_users_today_minus_2}%'";
	$query_blocked_3 = "SELECT option_value FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_invalid_email{$spam_master_users_today_minus_3}%'";
	$query_blocked_4 = "SELECT option_value FROM {$table_prefix}options WHERE option_name LIKE '_transient_spam_master_invalid_email{$spam_master_users_today_minus_4}%'";
}
$totalitems_blocked = $wpdb->query($query_blocked);
$totalitems_blocked_1 = $wpdb->query($query_blocked_1);
$totalitems_blocked_2 = $wpdb->query($query_blocked_2);
$totalitems_blocked_3 = $wpdb->query($query_blocked_3);
$totalitems_blocked_4 = $wpdb->query($query_blocked_4);
?>
<div class="wrap">
<h1><?php echo $plugin_master_name; ?> Registrations</h1>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Registrations Blocked by Spam Master'],
          ['<?php echo $spam_master_users_today_minus_4; ?>',	<?php echo $totalitems_blocked_4; ?>],
          ['<?php echo $spam_master_users_today_minus_3; ?>',	<?php echo $totalitems_blocked_3; ?>],
          ['<?php echo $spam_master_users_today_minus_2; ?>',	<?php echo $totalitems_blocked_2; ?>],
          ['<?php echo $spam_master_users_today_minus_1; ?>',	<?php echo $totalitems_blocked_1; ?>],
          ['<?php echo $spam_master_users_today; ?>',			<?php echo $totalitems_blocked; ?>],
        ]);

        var options = {
          title: '',
          curveType: 'function',
          legend: { position: 'bottom' },
          vAxis: {title: 'Registrations Blocked'},
          logScale:true,
          series: {
			0: { color: '#E8052B', pointSize: '10'}
			},
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
</script>
<div id="curve_chart" style="width: 100%; height: 300px"></div>
<br>

<form method="post" width='1'>
<fieldset class="options">
<?php
if(!class_exists('spam_master_registrations_header_blocked')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-registrations-header-blocked.php');
}

if(!class_exists('spam_master_registrations_table_blocked')){
	require_once( dirname( __FILE__ ) . '/spam-master-admin-registrations-table-blocked.php');
}

//Prepare Table of elements
$wp_list_table = new spam_master_registrations_header_blocked();
//Table of elements
$wp_list_table->display();

//Prepare Table of elements
$wp_list_table = new spam_master_registrations_table_blocked();
$wp_list_table->prepare_items();
//Table of elements
$wp_list_table->display();

//Export Button
function spam_master_load_registrations_export(){
	echo plugins_url( 'spam-master-admin-registrations-export.php', __FILE__);
}

?>
<p class="submit" style="margin:0px; padding:0px; height:30px;"><input class='button-primary' type='submit' name='update' value='<?php _e("Refresh Lists", 'spam_master'); ?>' id='submitbutton' /> <a class="button-primary" href="<?php spam_master_load_registrations_export() ?>" title="Export Blocked List">Export Blocked List</a></p>
</fieldset>
</form>

<br>
<h2>IMPORTANT: Makes no use of Javascript or Ajax to keep your website fast and conflicts free</h2>

<div style="background: url(<?php echo plugins_url('../images/techgasp-hr.png', dirname(__FILE__)); ?>) repeat-x; height: 10px"></div>
<br>
<p>
<a class="button-secondary" href="https://wordpress.techgasp.com" target="_blank" title="Visit Website">More TechGasp Plugins</a>
<a class="button-secondary" href="https://wordpress.techgasp.com/support/" target="_blank" title="TechGasp Support">TechGasp Support</a>
<a class="button-primary" href="https://wordpress.techgasp.com/spam-master/" target="_blank" title="Visit Website"><?php echo $plugin_master_name; ?> Info</a>
<a class="button-primary" href="https://wordpress.techgasp.com/spam-master-documentation/" target="_blank" title="Visit Website"><?php echo $plugin_master_name; ?> Documentation</a>
<a class="button-primary" href="https://wordpress.org/plugins/spam-master/" target="_blank" title="Visit Website">RATE US *****</a>
</p>
</div>
<?php
}
