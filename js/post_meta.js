jQuery(document).ready(function(){
	jQuery('#aaww_subcategory_cat').click(function(){
		jQuery('#aaww_post_subcategory_cat').removeAttr('disabled');
		jQuery('#aaww_post_subcategory_kw').attr('disabled','disabled');
		if(jQuery('#aaww_post_subcategory_cat').attr('cat') != jQuery('#awww_post_category').val()){
			aaww_getSubCategories();

		}
		
	});
	
	jQuery('#aaww_subcategory_kw').click(function(){
		jQuery('#aaww_post_subcategory_kw').removeAttr('disabled');
		jQuery('#aaww_post_subcategory_cat').attr('disabled','disabled');
	});
	
	function aaww_getSubCategories(){
		if(jQuery('#awww_post_category').val()!=0){
			var data = {
				'action':'aaww_getSubCategories',
				'aaww_post_category':jQuery('#awww_post_category').val()
			}
			jQuery('#aaww_post_subcategory_cat').children().remove()
			jQuery('#aaww_subcategory_cat_label').toggleClass("progress");
			jQuery.post(ajaxurl,data,function(response){
				response = JSON.parse(response);
				if(response.status=="success"){
					var data = response.data;
					jQuery('#aaww_post_subcategory_cat').children().remove().append('<option value="0">-- Select --</option>');
					jQuery('#aaww_post_subcategory_cat').attr('cat',jQuery('#awww_post_category').val())
					jQuery.each(data,function(i,obj){
						jQuery.each(obj,function(k,v){
							jQuery('#aaww_post_subcategory_cat').append('<option value="'+v+'">'+k+'</option>');
						});
					});
					jQuery('#aaww_subcategory_cat_label').toggleClass("progress");
					jQuery("#aaww_error").text("");
				}else{
					jQuery('#aaww_subcategory_cat_label').toggleClass("progress");
					jQuery("#aaww_error").text(response.data.Message);
				}
			});
			}
	}
	
	jQuery('#awww_post_category').change(function(){
		if(jQuery('#aaww_subcategory_cat').attr('checked')=='checked'){
			aaww_getSubCategories();
		}
		
		if(jQuery("#aaww_subcat").attr("disabled")){
			jQuery("#aaww_subcat").removeAttr("disabled");
		}
		
	});
	
});
