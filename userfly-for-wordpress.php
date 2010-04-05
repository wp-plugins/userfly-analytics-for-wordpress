<?php
/*
Plugin Name: Userfly For Wordpress
Plugin URI: http://serversideguy.com
Description: Lets the user input the Userfly code needed for Userfly analytics
Author: Andy Stramer
Version: 1.0
Author URI: http://serversideguy.com
*/

function ufw_addOptions()
{
	add_option('ufw_meta');
}
register_activation_hook(__FILE__, 'ufw_addOptions');

function ufw_plugin_menu() {
  add_options_page('Userfly Analytics Code', 'Userfly', 'administrator', 'ufw', 'ufw_plugin_options');
}

function ufw_plugin_options() {
echo '
<div class="wrap">
<h2>Userfly Analytics Code</h2>

<form method="post" action="options.php">';
wp_nonce_field('update-options'); 

echo '

<table class="form-table">

<tr valign="top">
<th scope="row"><h2>Your Current Inserted Code</h2></th></tr>
<tr>
<td>';

if(get_option('ufw_meta') == ''){
	echo "No code inserted yet!";
}
else{
	echo str_replace(">", "&gt;",str_replace("<", "&lt;", get_option('ufw_meta')));
}
echo '
</td></tr>
<tr>
<td><h2>Change Code</h2></td></tr>
<td><input type="text" name="ufw_meta"  size="200" value="';


echo '" /></td>
</tr>
 

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="ufw_meta" />

<p class="submit">
<input type="submit" class="button-primary" value="';
echo  _e('Save Changes');
echo '" />
</p>

</form>
</div>
';

}


add_action('admin_menu', 'ufw_plugin_menu');


function add_ufw_meta()
{
	echo get_option('ufw_meta');
}
add_action('wp_head', 'add_ufw_meta');

?>
