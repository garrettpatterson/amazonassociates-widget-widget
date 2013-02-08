jQuery(document).ready(function(){
	
	jQuery('#aaww_blog_display_c,#aaww_blog_display_o').change(function(){
		
		var mode = jQuery(this).val();
		
		if(mode=='category'){
			if(jQuery('input[name="aaww_affiliateid"]').val().length > 0
				&& jQuery('input[name="aaww_awsaccess"]').val().length>0
				&& jQuery('input[name="aaww_awssecret"]').val().length>0
			){
			jQuery('#aaww_featured_category').show();
			jQuery('#aaww_options_error').text("");
			}else{
				jQuery('#aaww_options_error').text("Please make sure you enter a valid Amazon Affiliate ID, AWS Access, and Secret key before selecting a category");
				jQuery('#aaww_blog_display_c').removeAttr("checked");
				return false;
			}
		}else{
			jQuery('#aaww_featured_category').hide();
		}
		
	});
	
});
