<?php
/*
 * Plugin Name:	Block User Agents
 * Plugin URI: https://github.com/slick2/wp-block-user-agents
 * Description:	Blocking of User agents 
 * Version:		1.0.0
 * Author:			Carey Dayrit
 * Author URI:		http://webtuners.pro
 * */

// A collection of snippets
//
//
// // limit user agents
//
add_action( 'init', 'wt_limit_user_agents' );

function wt_limit_user_agents(){
	$block_user_agents_options = get_option( 'block_user_agents_option_name' ); 
	$bots = $block_user_agents_options['list_0'];
 		foreach ($bots as $bot) {
 				if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== FALSE) {
					header('HTTP/1.0 403 Forbidden');
 					exit;
				}
		}	
}

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class WT_BlockUserAgents {
	private $block_user_agents_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'block_user_agents_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'block_user_agents_page_init' ) );
	}

	public function block_user_agents_add_plugin_page() {
		add_menu_page(
			'Block User Agents', // page_title
			'Block User Agents', // menu_title
			'manage_options', // capability
			'block-user-agents', // menu_slug
			array( $this, 'block_user_agents_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			76 // position
		);
	}

	public function block_user_agents_create_admin_page() {
		$this->block_user_agents_options = get_option( 'block_user_agents_option_name' ); ?>

		<div class="wrap">
			<h2>Block User Agents</h2>
			<p>Simple plugin to block bots by using the user agent tag</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'block_user_agents_option_group' );
					do_settings_sections( 'block-user-agents-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function block_user_agents_page_init() {
		register_setting(
			'block_user_agents_option_group', // option_group
			'block_user_agents_option_name', // option_name
			array( $this, 'block_user_agents_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'block_user_agents_setting_section', // id
			'Settings', // title
			array( $this, 'block_user_agents_section_info' ), // callback
			'block-user-agents-admin' // page
		);

		add_settings_field(
			'list_0', // id
			'List', // title
			array( $this, 'list_0_callback' ), // callback
			'block-user-agents-admin', // page
			'block_user_agents_setting_section' // section
		);
	}

	public function block_user_agents_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['list_0'] ) ) {
			$sanitary_values['list_0'] = esc_textarea( $input['list_0'] );
		}

		return $sanitary_values;
	}

	public function block_user_agents_section_info() {
		
	}

	public function list_0_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="block_user_agents_option_name[list_0]" id="list_0">%s</textarea>',
			isset( $this->block_user_agents_options['list_0'] ) ? esc_attr( $this->block_user_agents_options['list_0']) : ''
		);
	}

}
if ( is_admin() )
	$block_user_agents = new WT_BlockUserAgents();

/* 
 * Retrieve this value with:
 * $block_user_agents_options = get_option( 'block_user_agents_option_name' ); // Array of All Options
 * $list_0 = $block_user_agents_options['list_0']; // List
 */
