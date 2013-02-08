<?php
wp_enqueue_script('aaww_options_script', plugins_url('/js/aaww_options.js', __FILE__),array('jquery'));
if($_POST['aaww_postback'] == 'Y') {
	if(isset($_POST['aaww_affiliateid'])
		&& isset($_POST['aaww_awsaccess'])
		&& isset($_POST['aaww_awssecret'])
		){
			update_option('aaww_affiliateid', $_POST['aaww_affiliateid']); 
			update_option('aaww_awsaccess', $_POST['aaww_awsaccess']);
			update_option('aaww_awssecret', $_POST['aaww_awssecret']);
			update_option('aaww_blog_display', $_POST['aaww_blog_display']);
			update_option('aaww_category', $_POST['aaww_post_category']);
			update_option('aaww_subcat_mode', $_POST['aaww_subcategory']);
			update_option('aaww_subcategory_kw', $_POST['aaww_post_subcategory_kw']);
			update_option('aaww_subcategory_cat', $_POST['aaww_post_subcategory_cat']);
			
	
		}
?><div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p><?php
}else{
	$aaww_affiliateid = get_option('aaww_affiliateid');
	$aaww_awsaccess = get_option('aaww_awsaccess');
	$aaww_awssecret = get_option('aaww_awssecret');
	$aaww_blog_display = get_option("aaww_blog_display");
	$aaww_category = get_option('aaww_category');
	$subcategory_mode = get_option('aaww_subcat_mode');
	$subcat_keyword =get_option('aaww_subcategory_kw');
	$subcat_category = get_option('aaww_subcategory_cat');
	
	
?> 

<div class="wrap">  
    <?php    echo "<h2>" . __( 'Amazon Affilliate Widget Widget Options', 'aaww_admin' ) . "</h2>"; ?>  
    <form name="aaww_admin" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="aaww_postback" value="Y">  
        <?php    echo "<h3>" . __( 'AWS Settings', 'aaww_admin' ) . "</h3>"; ?>  
        <p><?php _e("Amazon Affiliate ID: " ); ?><input type="text" name="aaww_affiliateid" value="<?php echo $aaww_affiliateid; ?>" size="20">
        	</p>  
        <p><?php _e("AWS Access Key:" ); ?><input type="text" name="aaww_awsaccess" value="<?php echo $aaww_awsaccess; ?>" size="20">
        	</p>  
        <p><?php _e("AWS Secret Key:" ); ?><input type="password" name="aaww_awssecret" value="<?php echo $aaww_awssecret; ?>" size="20">
        	</p>  
        	
   <h3>Plugin Options</h3>
   <p>
   
    <h4>Default behavior when mulitple-posts or no post specific category is set up</h4>
   	<dl>
   		<dt><input type="radio" name="aaww_blog_display" id="aaww_blog_display_o" value="omakase"
   			<?php echo $aaww_blog_display=="omakase"?"checked":""?>
   			 />
   			<label for="aaww_blog_display_o">Omakase</label>
   			
   		</dt>
   		<dd>From Amazon: "Automatically feature ideal products based on Amazon's unique knowledge about what works for your site, for your users and for the content of your page"</dd>
   	   		<dt><input type="radio" name="aaww_blog_display" id="aaww_blog_display_c" value="category" <?php echo $aaww_blog_display=="category"?"checked":""?> />
   			<label for="aaww_blog_display_c">Featured Category</label>
   			</dt>
   		<dd>
   			<fieldset id="aaww_featured_category" style="<?php echo $aaww_blog_display=="category"?"":'display:none;' ?>">
   			<?php
   			include('aaww_category_selector.php');
   			?>
   			</fieldset>
   	</dl>
   	
   	
   	
   </p>     	
        	
<p class="submit">  
		<label class="error" id="aaww_options_error"></label><br />
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'aaww_admin' ) ?>" />  
        </p>  
    </form>  
</div>  
<?php
}
?>