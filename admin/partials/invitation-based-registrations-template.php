<?php 


	function invitation_based_registrations_invite_tempate(){
		echo '<div>';
			if(isset($_POST['invitation_based_registrations_invite_tempate'])){
				
				$subject = sanitize_text_field($_POST['subject']);
				update_option("invbr_email_subject", $subject);
				$emailbody = stripslashes(sanitize_text_field($_POST['emailbody']));
				update_option("invbr_email_body", $emailbody);
				$emailbody = str_replace(PHP_EOL, "<br>", stripslashes(sanitize_text_field($_POST['emailbody'])));
				update_option("invbr_smtp_from_name", sanitize_text_field($_POST['from_name']));
				update_option("invbr_smtp_from_email", sanitize_text_field($_POST['from_email']));
				
				echo "<div style='max-width:60%;color:black;margin:4px;background: #cdfbaa;padding: 5px 20px;border: 1px solid #b8d6a1;'>Custom template settings has been updated.</b></div>";
				
			}
			
		invitation_based_registrations_template();
		
		echo '</div>';
		
	}
	
	
	function invitation_based_registrations_template(){
		
		echo '<div style="margin:4px;padding:10px 40px;max-width:850px">
		<a href="https://wordpress.org/support/plugin/invitation-based-registrations" target="_blank"><button style="float:right;background: #58c551;color: #fff;padding: 5px;font-size: 14px;">Request new feature or give feedback</button></a>
		<h3>Customize Email Template</h3><br>';
		$subject = 'Invitation to create account | '.get_bloginfo();
		if(get_option("invbr_email_subject"))
			$subject = get_option("invbr_email_subject");
		$emailbody = 'Hey there,&#10;&#10;You have been invited to create account with '.get_bloginfo().'. Click <a href="##INVITE_LINK##">this link</a> to complete registration.&#10;&#10;Regards,&#10;'.get_bloginfo();
		
		$from_name = $from_email = "";
		if(get_option("invbr_smtp_from_name"))
			$from_name = get_option("invbr_smtp_from_name");
		if(get_option("invbr_smtp_from_email"))
			$from_email = get_option("invbr_smtp_from_email");
		
		if(get_option("invbr_email_body")) {
			$emailbody = get_option("invbr_email_body");
		}
		
		echo '<form  method="POST" action="">
			<input type="hidden" name="invitation_based_registrations_invite_tempate" value="1"/>
			<b><font style="color:#f00">* </font>From : </b><br>
			<input type=text required="true"  name="from_name"  placeholder="From Name" value="'.esc_html($from_name).'" style="min-width:750px;padding:5px;"><br><br>
			<b><font style="color:#f00">* </font> From Email: </b><br>
			<input type=text required="true"  name="from_email"  placeholder="From Email" value="'.esc_html($from_email).'" style="min-width:750px;padding:5px;"><br><br>
			<b><font style="color:#f00">* </font>Subject : </b><br>
			<input type=text required="true"  name="subject"  placeholder="Enter email subject" value="'.esc_html($subject).'" style="min-width:750px;padding:5px;"><br><br>
			<b><font style="color:#f00">* </font>Email Template : </b><br>
			<textarea rows="8" cols="120" required="true"  name="emailbody"  placeholder="Enter email message" value="" style="min-width:250px">'.esc_html($emailbody).'</textarea><br><br>
			
			<b>ShortCodes which can be used in Email Body and Subject: </b>
			<br><b>##INVITE_LINK## :</b> Invitation Link
			<br><b>##FROM_EMAIL## :</b> You can use email of the Inviter (From Email) in template subject and body
			<br><b>##FROM_NAME## :</b> You can use name of the Inviter (From Name) in template subject and body
			<br><br>
			<input type="submit" class="button button-primary button-large" value="Update Template">
			</form>
		</div>';
		
	}
	

?>