<?php 

	function invitation_based_registrations_invite_smtp(){
		
		if(defined("IVBR_SMTP_ACCESS") && IVBR_SMTP_ACCESS == 'hidden') {
			wp_die("Permissions denied. Contact your administrator.");
			exit;
		}
		
		echo '<div>';
			if(isset($_POST['invitation_based_registrations_configure_smtp'])){
				update_option("invbr_smtp_host", sanitize_text_field($_POST['smtp_host']));
				update_option("invbr_smtp_port", sanitize_text_field($_POST['smtp_port']));
				update_option("invbr_smtp_username", sanitize_text_field($_POST['smtp_username']));
				update_option("invbr_smtp_password", sanitize_text_field($_POST['smtp_password']));
				update_option("invbr_smtp_from_email", sanitize_text_field($_POST['smtp_from_email']));
				update_option("invbr_smtp_from_name", sanitize_text_field($_POST['smtp_from_name']));
				echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>SMTP settings has been updated.</b></div>";
			}  else if(isset($_POST['invitation_based_registrations_reset_smtp'])){
				update_option("invbr_smtp_host", "");
				update_option("invbr_smtp_port", "");
				update_option("invbr_smtp_username", "");
				update_option("invbr_smtp_password", "");
				echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>SMTP settings has been reset to default.</b></div>";
			}
			
		invitation_based_registrations_configure_smtp();
		echo '</div>';
		
	}
	
	
	function invitation_based_registrations_configure_smtp(){
		echo '<div style="margin:4px;padding:10px 40px;max-width:850px">
		<a href="https://wordpress.org/support/plugin/invitation-based-registrations" target="_blank"><button style="float:right;background: #58c551;color: #fff;padding: 5px;font-size: 14px;">Request new feature or give feedback</button></a>
		<h3><br>SMTP Settings (Optional)</h3>Configure only if your emails are not getting sent or you want to use different SMTP server.<br><br>
		If you want to <b>hide this setting from users</b> for security reasons add below line in wp-config.php.<br>
		<code>define("IVBR_SMTP_ACCESS", "hidden");</code>
		<br><br>
		';
		echo '<form  method="POST" action="" id="reset_smpt"><input type="hidden" name="invitation_based_registrations_reset_smtp" value="1"/></form>';
		$smtp_host = get_option("invbr_smtp_host") ? get_option("invbr_smtp_host") : "";
		$smtp_port = get_option("invbr_smtp_port") ?  get_option("invbr_smtp_port") : "25";
		$smtp_username = get_option("invbr_smtp_username") ?  get_option("invbr_smtp_username") : "";
		$smtp_password = get_option("invbr_smtp_password") ?  get_option("invbr_smtp_password") : "";
		$smtp_from_email = get_option("invbr_smtp_from_email") ?  get_option("invbr_smtp_from_email") : "";
		$smtp_from_name = get_option("invbr_smtp_from_name") ?  get_option("invbr_smtp_from_name") : "";
		
		echo '<form  method="POST" action="">
			<input type="hidden" name="invitation_based_registrations_configure_smtp" value="1"/>
			<b><font style="color:#f00">* </font>SMTP Host : </b><br>
			<input type=text required="true"  name="smtp_host"  placeholder="Enter SMTP host" value="'.esc_html($smtp_host).'" style="min-width:750px;padding:4px;"><br><br>
			<b><font style="color:#f00">* </font>SMTP Port : </b><br>
			<input type=text required="true"  name="smtp_port"  placeholder="Enter SMTP Port" value="'.esc_html($smtp_port).'" style="min-width:750px;padding:4px;"><br><br>
			<b><font style="color:#f00">* </font>Username : </b><br>
			<input type=text required="true"  name="smtp_username"  placeholder="Enter SMTP Username" value="'.esc_html($smtp_username).'" style="min-width:750px;padding:4px;"><br><br>
			<b><font style="color:#f00"></font>Password : </b><br>
			<input type=password  name="smtp_password"  placeholder="Enter SMTP Password" value="'.esc_html($smtp_password).'" style="min-width:750px;padding:4px;"><br><br>
			<b><font style="color:#f00">* </font>From email : </b><br>
			<input type=text required="true"  name="smtp_from_email"  placeholder="Enter From Email Address" value="'.esc_html($smtp_from_email).'" style="min-width:750px;padding:4px;"><br><br>
			<b><font style="color:#f00"></font>From Name : </b><br>
			<input type=text  name="smtp_from_name"  placeholder="Enter From Name" value="'.esc_html($smtp_from_name).'" style="min-width:750px;padding:4px;"><br><br>
			<input type="submit" class="button button-primary button-large" value="Save Settings">
			<input type="button" class="button button-primary button-large" value="Reset Settings to Default SMTP" onclick="document.getElementById(\'reset_smpt\').submit()">
			</form>
		</div>';
		
	}
?>