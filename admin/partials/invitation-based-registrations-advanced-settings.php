<?php 

	function invitation_based_registrations_invite_advanced_settings(){
		echo '<div>';
			if(isset($_POST['invitation_based_registrations_invite_advanced_settings'])){
				
				$redirect_url = "";
				if(isset($_POST['redirect_url'])) $redirect_url = sanitize_text_field($_POST['redirect_url']);
				update_option('invbr_register_redirect_url', $redirect_url);
				echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>Advanced settings has been updated.</b></div>";
			}
			
		invitation_based_registrations_invite_advanced_settings_view();
		echo '</div>';
		
	}
	
	
	function invitation_based_registrations_invite_advanced_settings_view() {
		
		$redirect_url = '';
		if(get_option("invbr_register_redirect_url")) {
			$redirect_url = get_option("invbr_register_redirect_url");
		}
		
		echo '<div style="margin:4px;padding:10px 40px;max-width:850px">
		<a href="https://wordpress.org/support/plugin/invitation-based-registrations" target="_blank"><button style="float:right;background: #58c551;color: #fff;padding: 5px;font-size: 14px;">Request new feature or give feedback</button></a>
		<h3><br>Advanced Settings</h3>
		<hr>
		
		<form  method="POST" action="">
		<input type="hidden" name="invitation_based_registrations_invite_advanced_settings" value="1"/>
		<b>After Register Redirect URL</b> ( Select where you want to redirect users after registration )<br><br>
		<input type=text  name="redirect_url"  placeholder="Redirect URL" value="'.esc_html($redirect_url).'" style="min-width:750px;padding:5px;"><br><br>
		<br><input type="submit" class="button button-primary button-large" value="Save Settings"></form></div>';
	}
	
	
?>