<div class="wrap">  
    <?php    echo "<h2>" . __( 'Amazon Affilliate Widget Widget Options', 'aaww_admin' ) . "</h2>"; ?>  
    <form name="aaww_admin" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="aaww_postback" value="Y">  
        <?php    echo "<h4>" . __( 'AWS Settings', 'aaww_admin' ) . "</h4>"; ?>  
        <p><?php _e("Amazon Affiliate ID: " ); ?><input type="text" name="aaww_affiliateid" value="<?php echo $dbhost; ?>" size="20">
        	<?php _e(" ex: myname-10" ); ?></p>  
        <p><?php _e("AWS Access Key:" ); ?><input type="text" name="aaww_awsaccess" value="<?php echo $dbname; ?>" size="20">
        	<?php _e(" ex: oscommerce_shop" ); ?></p>  
        <p><?php _e("AWS Secret Key:" ); ?><input type="text" name="aaww_awssecret" value="<?php echo $dbuser; ?>" size="20">
        	<?php _e(" ex: root" ); ?></p>  
<p class="submit">  
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'aaww_admin' ) ?>" />  
        </p>  
    </form>  
</div>  