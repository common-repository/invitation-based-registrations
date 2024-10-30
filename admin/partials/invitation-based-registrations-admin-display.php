<?php 


	function invitation_based_registrations_invite(){
		echo '<div>';
			if(isset($_POST['invitation_based_registrations_send_invite']) && isset($_POST['emails'])){
				
				$subject = get_option("invbr_email_subject");
				$emailbody = get_option("invbr_email_body");
				$emailbody = str_replace(PHP_EOL, "<br>", $emailbody);
				$emailsarray = preg_split('/\r\n|[\r\n]/', sanitize_text_field($_POST['emails']));
				$from_name = get_option("invbr_smtp_from_name");
				$from_email = get_option("invbr_smtp_from_email");
		
				if(!empty($from_name) && !empty($from_email)) {
					$headers = array('From: '.$from_name.' <'.$from_email.'>', 'Content-Type: text/html; charset=UTF-8');
				} else
					$headers = array('Content-Type: text/html; charset=UTF-8');
				 
				if(sizeof($emailsarray)==0) {
					echo "<span style='color:red'>No email address provided.</span><br><br>";
				} else {
					foreach($emailsarray as $email) {
						$email = trim(sanitize_text_field($email));
						if(empty($email))
							continue;
						else if(email_exists( $email )) {
							echo "<div style='max-width:60%;color:black;margin:4px;background:#ffc3c3;padding: 5px 20px;border: 1px solid #ff8c8c;'>User with email <b>".esc_html($email)." already exists.</b></div>";
							continue;
						}
						$invitationkey = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(32/strlen($x)) )),1,32);
						update_option("invbr_".$invitationkey, $email);
						$emailbodyinner = str_replace("##INVITE_LINK#", site_url().'?invbractiveuser='.$invitationkey ,$emailbody);
						$emailbodyinner = str_replace("##FROM_EMAIL##", $from_email, $emailbodyinner);
						$emailbodyinner = str_replace("##FROM_NAME##", $from_name, $emailbodyinner);
						
						$subject = str_replace("##FROM_EMAIL##", $from_email, $subject);
						$subject = str_replace("##FROM_NAME##", $from_name, $subject);
						
						wp_mail( $email, $subject, $emailbodyinner, $headers );
						echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>Invitation has been sent to <b>".esc_html($email)."</b></div>";
						update_option("invbr_".$invitationkey, $email);
					}
					echo "<br>";
				}
		
			}
			
		invitation_based_registrations_send_invite();
		
		echo '</div>';
		
	}
	
	
	function invitation_based_registrations_send_invite(){
		
		echo '<div style="margin:4px;padding:10px 40px;max-width:850px">
		<a href="https://wordpress.org/support/plugin/invitation-based-registrations" target="_blank"><button style="float:right;background: #58c551;color: #fff;padding: 5px;font-size: 14px;">Request new feature or give feedback</button></a>
		<h3>Invite Users to Register</h3>';
		$subject = 'Invitation to create account | '.get_bloginfo();
		if(get_option("invbr_email_subject"))
			$subject = get_option("invbr_email_subject");
		$emailbody = 'Hey there,&#10;&#10;You have been invited to create account with '.get_bloginfo().'. Click <a href="##INVITE_LINK#">this link</a> to complete registration.&#10;&#10;Regards,&#10;'.get_bloginfo();
		if(get_option("invbr_email_body")) {
			$emailbody = get_option("invbr_email_body");
		}
		$emailbody = str_replace(PHP_EOL, "<br>", $emailbody);
		
		echo '<form  method="POST" action="">
			<input type="hidden" name="invitation_based_registrations_send_invite" value="1"/>
			<a href="'.add_query_arg( array('page' => 'invite_users_template'), $_SERVER['REQUEST_URI'] ).'">Customize Email Templates</a><br><br>
			<font style="color:#f00">* </font>Email ID\'s to invite </b> (each on new line) : <br>
			<textarea rows="8" cols="120" required="true"  name="emails"  placeholder="List of email addresses, each on new line" value="" style="min-width:250px"></textarea><br><br>
			<input type="submit" class="button button-primary button-large" value="Send Invitation">
			
			</form>
		</div>';
		
	}
	

?>