<?php
defined( 'ABSPATH' ) or exit();
?>
<style type="text/css">
#random_password_text {
	border:2px dotted orange;padding:4px;margin:4px;font-family:Consolas, "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", Monaco, "Courier New", monospace !important;background-color:#fff !important;color:#000 !important;
	}
</style>
<script type="text/javascript">
var $ = jQuery.noConflict();

function generate_random_password(l,u,n,s) {
	//Initialize
	var chars = ""; var chars1 = "";	var chars2 = ""; var chars3 = ""; var chars4 = ""; var randomstring = ""; var string_length= "";
	//
	if (l) chars1 = "abcdefghiklmnopqrstuvwxyz"; 
	if (u) chars2 = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	if (n) chars3 = "0123456789"
	if (s) chars4 = ".,;][{}()~/\\#@*=-+!?^%_";
	
	chars = chars1 + chars2 + chars3 + chars4;
	
	//
	string_length = parseInt($('#random_password_length').val());
	if (string_length < 1) string_length = 1;
	//
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	$('#random_password_text').html(randomstring);
}
</script>
<table class="form-table">
<thead></thead>
<tbody>
<tr>
<th scope="row">
<label for="random_password_length"><?php _e("Random Password Length", "bodi0-password-generator"); ?></label>
</th>
<td><input type="number" step="1" name="random_password_length" id="random_password_length" size="3" value="8" max="4096" style="width:64px" title="<?php _e("Wordpress limit password length up to 4096 characters","bodi0-password-generator");?>"> <a href="javascript:void(0);" onClick="generate_random_password($('#character_lowercase').attr('checked'),$('#character_uppercase').attr('checked'), $('#character_numbers').attr('checked'), $('#character_specials').attr('checked'))"><?php _e("Generate", "bodi0-password-generator"); ?></a> <span id="random_password_text"></span> <a href="javascript:void(0)" onClick="$('#pass1').val($('#random_password_text').html()); $('#pass2').val($('#random_password_text').html()); "><?php _e("Use this password", "bodi0-password-generator"); ?></a></td>
</tr>
<tr>
<th scope="row">
<label for="letter-charsets">
<?php _e("Character Sets", "bodi0-password-generator"); ?></label></th>
<td><span><input type="checkbox" name="character_lowercase" id="character_lowercase" checked><?php _e("lower case", "bodi0-password-generator"); ?></span> <span><input type="checkbox" name="character_uppercase" id="character_uppercase" checked><?php _e("UPPER CASE", "bodi0-password-generator"); ?></span> <span><input type="checkbox" name="character_numbers" id="character_numbers" checked><?php _e("Numbers", "bodi0-password-generator"); ?></span> <span><input type="checkbox" name="character_specials" id="character_specials" checked><?php _e("Special", "bodi0-password-generator"); ?></span></td>
</tr>
</tbody>
<tfoot></tfoot>
</table>
