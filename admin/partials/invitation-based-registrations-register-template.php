<?php 

	function invitation_based_registrations_invite_register_template_configure(){
		echo '<div>';
			if(isset($_POST['invitation_based_registrations_register_template'])){
				update_option("invbr_registration_header", sanitize_text_field($_POST['invbr_registration_header']));
				update_option("invbr_registration_username", sanitize_text_field($_POST['invbr_registration_username']));
				update_option("invbr_registration_email", sanitize_text_field($_POST['invbr_registration_email']));
				update_option("invbr_registration_password", sanitize_text_field($_POST['invbr_registration_password']));
				update_option("invbr_registration_first_name", sanitize_text_field($_POST['invbr_registration_first_name']));
				update_option("invbr_registration_last_name", sanitize_text_field($_POST['invbr_registration_last_name']));
				update_option("invbr_registration_submit", sanitize_text_field($_POST['invbr_registration_submit']));
				
				echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>Registration page settings has been updated.</b></div>";
			}
			
		invitation_based_registrations_invite_register_template();
		echo '</div>';
		
	}
	
	
	function invitation_based_registrations_invite_register_template(){
		echo '<div style="margin:4px;padding:10px 40px;max-width:850px">
		<a href="https://wordpress.org/support/plugin/invitation-based-registrations" target="_blank"><button style="float:right;background: #58c551;color: #fff;padding: 5px;font-size: 14px;">Request new feature or give feedback</button></a>
		<h3><br>Registration Page Template (Optional)</h3><br>';
		$invbr_registration_header = get_option("invbr_registration_header") ? get_option("invbr_registration_header") : "Complete your Registration";
		$invbr_registration_username = get_option("invbr_registration_username") ? get_option("invbr_registration_username") : "Username";
		$invbr_registration_email = get_option("invbr_registration_email") ? get_option("invbr_registration_email") : "Email Address";
		$invbr_registration_password = get_option("invbr_registration_password") ? get_option("invbr_registration_password") : "Password";
		$invbr_registration_first_name = get_option("invbr_registration_first_name") ? get_option("invbr_registration_first_name") : "First Name";
		$invbr_registration_last_name = get_option("invbr_registration_last_name") ? get_option("invbr_registration_last_name") : "Last Name";
		$invbr_registration_submit = get_option("invbr_registration_submit") ? get_option("invbr_registration_submit") : "Register";
		
		echo '<form  method="POST" action="">
			<input type="hidden" name="invitation_based_registrations_register_template" value="1"/>
			
			<b><font style="color:#f00">* </font>Header : </b><br>
			<input type=text required="true"  name="invbr_registration_header"  placeholder="Header" value="'.esc_html($invbr_registration_header).'" style="min-width:750px;padding:4px;"><br><br>
			
			<b><font style="color:#f00">* </font>Username Label : </b><br>
			<input type=text required="true"  name="invbr_registration_username"  placeholder="Username Label" value="'.esc_html($invbr_registration_username).'" style="min-width:750px;padding:4px;"><br><br>
			
			<b><font style="color:#f00">* </font>Email Label : </b><br>
			<input type=text required="true"  name="invbr_registration_email"  placeholder="Email Label" value="'.esc_html($invbr_registration_email).'" style="min-width:750px;padding:4px;"><br><br>
			
			<b><font style="color:#f00">* </font>Password Label : </b><br>
			<input type=text required="true"  name="invbr_registration_password"  placeholder="Password Label" value="'.esc_html($invbr_registration_password).'" style="min-width:750px;padding:4px;"><br><br>
			
			<b><font style="color:#f00">* </font>First Name Label : </b><br>
			<input type=text required="true"  name="invbr_registration_first_name"  placeholder="First Name Label" value="'.esc_html($invbr_registration_first_name).'" style="min-width:750px;padding:4px;"><br><br>
			
			<b><font style="color:#f00">* </font>Last Name Label : </b><br>
			<input type=text required="true"  name="invbr_registration_last_name"  placeholder="Last Name Label" value="'.esc_html($invbr_registration_last_name).'" style="min-width:750px;padding:4px;"><br><br>
			
			<b><font style="color:#f00">* </font>Submit Button Label : </b><br>
			<input type=text required="true"  name="invbr_registration_submit"  placeholder="Submit Button Label" value="'.esc_html($invbr_registration_submit).'" style="min-width:750px;padding:4px;"><br><br>
			
			
			<input type="submit" class="button button-primary button-large" value="Save Settings">
			</form>
		</div>';
		
	}
?>