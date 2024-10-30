<?php

require('partials/invitation-based-registrations-admin-display.php');
require('partials/invitation-based-registrations-template.php');
require('partials/invitation-based-registrations-smtp.php');
require('partials/invitation-based-registrations-register.php');
require('partials/invitation-based-registrations-register-template.php');
require('partials/invitation-based-registrations-role-based-access.php');
require('partials/invitation-based-registrations-advanced-settings.php');

class Invitation_Based_Registrations_Admin {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	
	public function invitation_based_registrations_admin_menu(){
		
		$parent = 'users.php';
		
		$addmenuforrole = 'administrator';
		
		$user = wp_get_current_user();
		if ( in_array( 'administrator', (array) $user->roles ) ) {
			//The user has the "administrator" role
		} else {
			
			foreach($user->roles as $role) {
				if(get_option("ibr_role_".$role)) {
					$addmenuforrole = $role;
					break;
				}
			}
			
		}

		$page = add_menu_page( 'Invite Users ' . __( 'Invite Users', 'invite_users' ), 'Invite Users', $addmenuforrole, 'invite_users', array( $this, 'invite_users' ) , dirname(plugin_dir_url(__FILE__)) . '/images/icon.png');
		
		$page = add_submenu_page( 'invite_users', 'Invite Users ' . __('Email Template'), __('Email Template'), $addmenuforrole, 'invite_users_template', array( $this,'invite_users_template') );
				
		$page = add_submenu_page( 'invite_users', 'Invite Users ' . __('Registration Template'), __('Registration Template'), $addmenuforrole, 'invite_register_template_configure', array( $this,'invite_register_template_configure') );
		
		$page = add_submenu_page( 'invite_users', 'Invite Users ' . __('SMTP Setup'), __('SMTP Setup'), $addmenuforrole, 'invite_users_smtp', array( $this,'invite_users_smtp') );
		
		$page = add_submenu_page( 'invite_users', 'Invite Users ' . __('Role Based Access'), __('Role Based Access'), 'administrator', 'invite_role_based_access', array( $this,'invite_role_based_access') );
		
		$page = add_submenu_page( 'invite_users', 'Invite Users ' . __('Advanced Settings'), __('Advanced Settings'), 'administrator', 'invite_advanced_settings', array( $this,'invite_advanced_settings') );
				
		if(!empty(get_option("invbr_smtp_host")))
			add_action( 'phpmailer_init',  array( $this,'invitation_based_registrations_configure_smtp') );
	}
	
	public function invitation_based_registrations_register_user(){
		invitation_based_registrations_register();
	}
	
	
	public function invite_users(){	
		invitation_based_registrations_invite();
	}
	
	public function invite_users_template(){	
		invitation_based_registrations_invite_tempate();
	}
	
	public function invite_users_smtp(){	
		invitation_based_registrations_invite_smtp();
	}

	public function invite_register_template_configure(){	
		invitation_based_registrations_invite_register_template_configure();
	}
	
	public function invite_role_based_access(){	
		invitation_based_registrations_invite_role_based_access();
	}
	
	public function invite_advanced_settings(){	
		invitation_based_registrations_invite_advanced_settings();
	}

	public function invitation_based_registrations_configure_smtp(PHPMailer $phpmailer){	
		$phpmailer->isSMTP();
		$phpmailer->Host = get_option("invbr_smtp_host");
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = get_option("invbr_smtp_port") ? get_option("invbr_smtp_port") : 25;
		$phpmailer->Username = get_option("invbr_smtp_username");
		$phpmailer->Password = get_option("invbr_smtp_password");
		$phpmailer->SMTPSecure = false;
		$phpmailer->From = get_option("invbr_smtp_from_email");
		$phpmailer->FromName= get_option("invbr_smtp_from_name");
	}

}
