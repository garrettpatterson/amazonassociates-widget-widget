<?php

if($_POST['aaww_postback'] == 'Y') {
	if(isset($_POST['aaww_affiliateid'])
		&& isset($_POST['aaww_awsaccess'])
		&& isset($_POST['aaww_awssecret'])
		){
			update_option('aaww_affiliateid', $_POST['aaww_affiliateid']); 
			update_option('aaww_awsaccess', $_POST['aaww_awsaccess']);
			update_option('aaww_awssecret', $_POST['aaww_awssecret']);
	
	
		}
?><div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p><?php
}else{
	$aaww_affiliateid = get_option('aaww_affiliateid');
	$aaww_awsaccess = get_option('aaww_awsaccess');
	$aaww_awssecret = get_option('aaww_awssecret');
	
?> 

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Amazon Affilliate Widget Widget Options', 'aaww_admin' ) . "</h2>"; ?>  
    <form name="aaww_admin" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="aaww_postback" value="Y">  
        <?php    echo "<h4>" . __( 'AWS Settings', 'aaww_admin' ) . "</h4>"; ?>  
        <p><?php _e("Amazon Affiliate ID: " ); ?><input type="text" name="aaww_affiliateid" value="<?php echo $aaww_affiliateid; ?>" size="20">
        	</p>  
        <p><?php _e("AWS Access Key:" ); ?><input type="text" name="aaww_awsaccess" value="<?php echo $aaww_awsaccess; ?>" size="20">
        	</p>  
        <p><?php _e("AWS Secret Key:" ); ?><input type="password" name="aaww_awssecret" value="<?php echo $aaww_awssecret; ?>" size="20">
        	</p>  
<p class="submit">  
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'aaww_admin' ) ?>" />  
        </p>  
    </form>  
</div>  
<?php
}
?>