<?php 
/*
Plugin Name: 24Seven Chat
Plugin URI: http://24seven.chat/
Description: Plugin for displaying live chat button
Version: 1.0
Author: 24Seven Digital
*/

class live_chat {    
	public function __construct()
    {
        add_action("admin_menu",array($this,"my_menu_pages"));
        add_action("wp_head",array($this,"add_track_button"));
    }  
	public function my_menu_pages(){
		add_menu_page("24Seven Chat","24Seven Chat", "manage_options", "live-chat",array($this,'live_chat_admin_function'));
	}
	public function live_chat_admin_function()
	{
		if(isset($_REQUEST["add_track_btn"]))
		{
			update_option("live_chat_track_code",$_REQUEST['track_code']);
			update_option("dashboard_code",$_REQUEST['dashboard_code']);
		}
		?>
		<style>
			.child_div {
		
				display: inline-block;
				width: auto;
			}
					.child_div .form {
				
			}
			.child_div .form button{
						margin-top: 20px;

			}
			
			.child_div h1{font-size: 23px;
    font-weight: 400;
    margin: 0;
    padding: 9px 0 4px;
    line-height: 29px;}
		
		</style>
		<div class="add_track_div">
			<div class="child_div">
				<div class="title"><h1>
					Add 24Seven LiveChat Tracking Code</h1>
				<p>
					Add your Tracking Code and Dashboard prefix to enable the LiveChat functionality.<br>
					This will add the customised <code>live-chat</code> div below the opening body tag and the required .CSS and .JS files to the footer.<br>				 
					
					</p></div>
				<div class="form">
					<form method="post" action="">
					   <label for="default_post_format" style="font-weight:bold">Tracking Code:</label><br>
						<input type="text" name="track_code" placeholder="Add Track Code" value="<?php echo get_option('live_chat_track_code'); ?>" />
							<p class="description">							
					This is the can be found in your 24Seven Dashboard in the Enable/Disable section</p> 
					  <label for="default_post_format" style="font-weight:bold">Dashboard Prefix: </label><br>
						<input type="text" name="dashboard_code" placeholder="Dashboard Prefix" value="<?php echo get_option('dashboard_code'); ?>" /><code>.24seven.chat</code><br>
						<p class="description">							
					This is the text before the <i>.24seven.chat </i> when you login to your Dashboard	</p> 
						<button type="submit" class="button button-primary" name="add_track_btn">Save</button>
					</form>

				</div>
				</div>
		</div>
		<?php
	}
	public function add_track_button()
	{
		if(get_option('live_chat_track_code'))
		{
		?>
		 	<link rel="stylesheet" type="text/css" href="//files.24seven.chat/css/connect_live_chat.css" />
			<script src="//<?php echo get_option('dashboard_code'); ?>.24seven.chat/files/connect_live_chat.js" type="text/javascript" ></script>
	<div id="live_chat" data-trackcode="<?php echo get_option('live_chat_track_code'); ?>" ></div>
		<?php
		}
	}
	
} new live_chat();


?>
