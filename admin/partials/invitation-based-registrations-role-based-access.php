<?php 

	function invitation_based_registrations_invite_role_based_access(){
		echo '<div>';
			if(isset($_POST['invitation_based_registrations_invite_role_based_access'])){
				
				global $wp_roles;
				foreach($wp_roles->roles as $key=>$value ) 
					update_option("ibr_role_".$key, false);
				
				foreach($_POST as $key => $value) {
					if(strpos($key, 'ibr_role_') !== false){
						update_option(sanitize_text_field($key), true);
					}
				}
				
				echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>Role based access settings has been updated.</b></div>";
			}
			
		invitation_based_registrations_invite_role_based_access_view();
		echo '</div>';
		
	}
	
	
	function invitation_based_registrations_invite_role_based_access_view() {
		echo '<div style="margin:4px;padding:10px 40px;max-width:850px">
		<a href="https://wordpress.org/support/plugin/invitation-based-registrations" target="_blank"><button style="float:right;background: #58c551;color: #fff;padding: 5px;font-size: 14px;">Request new feature or give feedback</button></a>
		<h3><br>Role Based Access</h3><h4>Allow access to other roles than Administrator</h4><br>
		<form  method="POST" action="">
			<input type="hidden" name="invitation_based_registrations_invite_role_based_access" value="1"/> ';
		
		global $wp_roles;
		foreach($wp_roles->roles as $key=>$value ) {
			if($key!='administrator') {
				echo '<input type="checkbox" ';
				if(get_option("ibr_role_".$key)) echo 'checked'; 
				echo ' name="ibr_role_'.esc_html($key).'"> '.esc_html(ucwords($key)).'<br><br>';
			}
		}
		echo '<br><input type="submit" class="button button-primary button-large" value="Save Settings"></form></div>';
	}
	
	
?>