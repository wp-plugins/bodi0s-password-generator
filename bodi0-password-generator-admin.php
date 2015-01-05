<?php
defined( 'ABSPATH' ) or exit();
/*
Plugin`s Administration panel
Author: Budiony Damyanov
Email: budiony@gmail.com
Version: 0.2
License: GPL2

		Copyright 2014  bodi0  (email : budiony@gmail.com)
		
		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.
		
		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.
		
		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Important: Check if current user is logged
if ( !is_user_logged_in( ) )  die();

?>
<div class="wrap">
<h2><?php _e("Administration", "bodi0-password-generator"); ?></h2>

<p><?php _e("This page shows you how to generate and use a random sequence of numbers and/or text or special characters in password fields while creating or editing users", "bodi0-password-generator"); ?>.<br>
<?php _e("The password is with variable length and can be generated on-the-fly (no page reload is necessary). It consists from lower letters, upper letters, numbers and/or special characters.", "bodi0-password-generator"); ?></p>
<p><?php _e("To continue, go to", "bodi0-password-generator"); ?> <a href="<?php echo home_url(); ?>/wp-admin/users.php">Users</a> <?php _e("and", "bodi0-password-generator"); ?> <a href="<?php echo home_url(); ?>/wp-admin/user-new.php"><?php _e("Add new one", "bodi0-password-generator"); ?></a> <?php _e("or edit existing one", "bodi0-password-generator"); ?>.</p>
<hr>
<p>
<?php _e("If you find this plugin useful, I wont mind if you buy me a beer", "bodi0-password-generator"); ?>
  :
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:inline-block !important">
    <input type="hidden" name="cmd" value="_s-xclick"/>
    <input type="hidden" name="hosted_button_id" value="LKG7EXVNPJ7EN"/>
    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!"  style="vertical-align: middle !important; border:0"/>
  </form>
</p>
</div>