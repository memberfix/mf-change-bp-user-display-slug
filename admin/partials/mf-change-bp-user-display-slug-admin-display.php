<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://memberfix.rocks/
 * @since      1.0.0
 *
 * @package    Mf_Change_Bp_User_Display_Slug
 * @subpackage Mf_Change_Bp_User_Display_Slug/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

<h2>WP Change BuddyPress User Display Name and Slug - Settings</h2>

<?php
	
global $wpdb;	
	
$pref = $wpdb->prefix;

// if this fails, check_admin_referer() will automatically print a "failed" page and die.
if ( ! empty( $_POST ) && check_admin_referer( 'submit_replace_form_mf', 'nonce_mf' ) ) {
	
$user_login = strip_tags(trim($_POST['user_login']));
	
$user = get_user_by('login',$user_login);
	
$user_id = $user->id;
	
$user_nicename = $user->user_nicename;

$user_display_name = $user->display_name;

// new user Display name
$new_user_display_name=strip_tags(trim($_POST['newuserdisplayname']));

// new user nicename (slug) - lowercase
$new_user_nicename=strip_tags(strtolower(trim($_POST['newuserdisplayname'])));

$new_user_nicename=str_replace(" ","-",$new_user_nicename);
	
if($user_id) { 

if (($new_user_nicename)) {
	
$user_nicename_exists = $wpdb->get_results("SELECT ID FROM ".$pref."users WHERE user_nicename = '$new_user_nicename'");	
$user_nicename_existsNum = $wpdb->num_rows;
	
if ( $user_nicename_existsNum > 0 ) { 

echo '<p style="color:red;"><strong>Please choose a different user nicename (slug). The one you have chosen already exists.</strong></p>';

} elseif (!preg_match('/^[a-z0-9-]+$/', $new_user_nicename)) {
	
    echo "<p style='color:red;'><strong>The Display Name uses invalid characters. Please use only letters, numbers and dashes.</strong></p>";
	
}  else {
	
	
echo '<p style="color:green;">The user nicename (slug) for '.$user_login.' was: <strong>'.$user_nicename.'</strong></p>';
	
$wpdb->update( 
	$pref.'users', 
	array( 
		'user_nicename' => $new_user_nicename
	), 
	array( 'ID' => $user_id ), 
	array( 
		'%s'
	), 
	array( '%d' ) 
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_activity
		 SET action = REPLACE(action,'%s','%s') WHERE action LIKE '%%s%' 
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_activity
		 SET content = REPLACE(content,'%s','%s') WHERE content LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_activity
		 SET primary_link = REPLACE(primary_link,'%s','%s') WHERE primary_link LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	

$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."posts
		 SET post_content = REPLACE(post_content,'%s','%s') WHERE post_content LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."posts
		 SET post_title = REPLACE(post_title,'%s','%s') WHERE post_title LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_messages_messages
		 SET message = REPLACE(message,'%s','%s') WHERE message LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_messages_messages
		 SET subject = REPLACE(subject,'%s','%s') WHERE subject LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_messages_meta
		 SET meta_value = REPLACE(meta_value,'%s','%s') WHERE meta_value LIKE '%%s%'
		",
	        $user_nicename, $new_user_nicename ,$user_nicename
        )
);
	
	
echo '<p style="color:green;">The user nicename (slug) for '.$user_login.' is now: <strong>'.$new_user_nicename.'</strong></p>';
	
	
	
echo '<p style="color:green;">The Display Name for '.$user_login.' was: <strong>'.$user_display_name.'</strong></p>';	
	
$wpdb->update( 
	$pref.'users', 
	array( 
		'display_name' => $new_user_display_name
	), 
	array( 'ID' => $user_id ), 
	array( 
		'%s'
	), 
	array( '%d' ) 
);	
	
$wpdb->update( 
	$pref.'usermeta', 
	array( 
		'meta_value' => $new_user_display_name
	), 
	array( 'user_id' => $user_id, 'meta_key' => 'nickname'  ), 
	array( 
		'%s'
	), 
	array( '%d','%s' ) 
);
	
$wpdb->update( 
	$pref.'bp_xprofile_data', 
	array( 
		'value' => $new_user_display_name
	), 
	array( 'user_id' => $user_id, 'field_id' => 1 ), 
	array( 
		'%s'
	), 
	array( '%d','%d' ) 
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_activity
		 SET action = REPLACE(action,'%s','%s') WHERE action LIKE '%%s%'
		",
	        $user_display_name, $new_user_display_name ,$user_display_name
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_activity
		 SET content = REPLACE(content,'%s','%s') WHERE content LIKE '%%s%'
		",
	        $user_display_name, $new_user_display_name ,$user_display_name
        )
);	
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."posts
		 SET post_content = REPLACE(post_content,'%s','%s') WHERE post_content LIKE '%%s%'
		",
	        $user_display_name, $new_user_display_name ,$user_display_name
        )
);	
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."posts
		 SET post_title = REPLACE(post_title,'%s','%s') WHERE post_title LIKE '%%s%'
		",
	        $user_display_name, $new_user_display_name ,$user_display_name
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_messages_messages
		 SET message = REPLACE(message,'%s','%s') WHERE message LIKE '%%s%'
		",
	        $user_display_name, $new_user_display_name ,$user_display_name
        )
);
	
$wpdb->query( 
	$wpdb->prepare( 
		"
		UPDATE ".$pref."bp_messages_messages
		 SET subject = REPLACE(subject,'%s','%s') WHERE subject LIKE '%%s%'
		",
	        $user_display_name, $new_user_display_name ,$user_display_name
        )
);
	

echo '<p style="color:green;">The Display Name for '.$user_login.' is now: <strong>'.$new_user_display_name.'</strong></p>';
	
}
}	
else {
	
    echo "<p style='color:red;'><strong>There was no new display name. No changes done.</strong></p>";
	
};	
} else {

    echo '<p style="color:red;"><strong>Please choose a different Username. The one you have chosen does not exist.</strong></p>'; 
 } 

};
 ?>


<form method="POST" action="">
<p style="color:red;">*IMPORTANT: Please perform a database backup before using this plugin.</p>
<p><strong>Enter Username:</strong><br>
<input type="text" name="user_login" value="" class="regular-text"/></p>
<p><strong>Enter new user Display Name (e.g. MikeJohn):</strong><br>  
<input type="text" name="newuserdisplayname" value="" class="regular-text"/></p>
     
<?php wp_nonce_field( 'submit_replace_form_mf', 'nonce_mf' ); ?>
<input type="submit" value="SUBMIT" class="button button-primary button-large">
</form>

</div>