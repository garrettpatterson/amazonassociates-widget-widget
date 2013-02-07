<?php

require 'data/product_categories.php';
$awsaffiliate = get_option('aaww_affiliateid');
$awsaccess = get_option('aaww_awsaccess');
$awssecret = get_option('aaww_awssecret');

wp_enqueue_script('aaww_post_meta_script', plugins_url('/js/post_meta.js', __FILE__),array('jquery'));
wp_enqueue_style('aaww_post_meta_style',plugins_url('/css/post_meta.css', __FILE__));
$inpostlayouts = array("Banner - 3 product" =>"h3up","Banner - 2 product"=>"h2up");

try
{
    //$amazonEcs = new AmazonECS($awsaccess, $awssecret, 'US', $awsaffiliate);
	
	?><p>Amazon Associates Widget Widget options</p>
	<label for="aaww_post_category">Select Product Line <span></span></label><br />
	<select name="aaww_post_category" id="awww_post_category">
		<option value="0">-- Select --</option>
	<?php
		//echo "<!--";
	    //echo print_r($product_categories);
		//echo "-->";
		foreach($product_categories as $cat=>$o){
			
			echo '<option value="'. $cat . '">'. $o['name'] . '</option>';
		}
	?>
	</select>
	<fieldset id="aaww_subcat">
		<input type="radio" id="aaww_subcategory_kw" name="aaww_subcategory" value="keyword" />
		<label for="aaww_subcategory_kw">Enter keywords</label><br />
		<input type="text" id="aaww_post_subcategory_kw" size="40" name="aaww_post_subcategory_kw" disabled="disabled" /><br />
		-- OR --<br />
		<input type="radio" id="aaww_subcategory_cat" name="aaww_subcategory" value="category" />
		<label for="aaww_subcategory_cat" id="aaww_subcategory_cat_label">Select a Subcategory</label><br />
		<select name="aaww_post_subcategory_cat" id="aaww_post_subcategory_cat" disabled="disabled">
			
		</select>
		
	</fieldset>
	<label id="aaww_error" class="error"></label>
	<?php
	//$amazonEcs->responseGroup('BrowseNodeInfo');
	
}catch(Exception $e)
{
  echo $e->getMessage();
}


?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               