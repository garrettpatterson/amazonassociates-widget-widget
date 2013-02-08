<?php

require 'data/product_categories.php';
/*
$awsaffiliate = get_option('aaww_affiliateid');
$awsaccess = get_option('aaww_awsaccess');
$awssecret = get_option('aaww_awssecret');
*/
wp_enqueue_script('aaww_post_meta_script', plugins_url('/js/post_meta.js', __FILE__),array('jquery'));
wp_enqueue_style('aaww_post_meta_style',plugins_url('/css/post_meta.css', __FILE__));
$inpostlayouts = array("Banner - 3 product" =>"h3up","Banner - 2 product"=>"h2up");

try
{
    //$amazonEcs = new AmazonECS($awsaccess, $awssecret, 'US', $awsaffiliate);
			echo "<!--";
	    //echo print_r($product_categories);
	    	//cho print_r($post);
	    	echo "current post?:" .$post->ID;
	    	echo "saved-cat:" . empty($aaww_category)?"empty":"full";
			echo "saved-mode:" . $subcategory_mode;
			echo "saved-subcat:" . $subcat_category;
			echo "saved-sbukey:" . $subcat_keyword;
		echo "-->";
		
	?>
	<label for="aaww_post_category">Select Product Line <span></span></label><br />
	<select name="aaww_post_category" id="awww_post_category">
		<option value="0">-- Select --</option>
	<?php
		foreach($product_categories as $cat=>$o){
			$selected = $cat == $aaww_category?' selected':'';
			echo '<option value="'. $cat . '" '.$selected.'>'. $o['name'] . '</option>';
		}
	?>
	</select>
	<br />-- THEN --<br />
	<fieldset id="aaww_subcat" <?php echo empty($aaww_category )==false?"":'disabled="disabled"' ?>>
		<input type="radio" id="aaww_subcategory_kw" name="aaww_subcategory" value="keyword" <?php echo $subcategory_mode=="keyword"?"checked":"" ?> />
		<label for="aaww_subcategory_kw">Enter keywords</label><br />
		<input type="text" id="aaww_post_subcategory_kw" value="<?php echo $subcat_keyword ?>" size="40" name="aaww_post_subcategory_kw" <?php echo $subcategory_mode=="category"?"":' diabled="disabled"' ?> /><br />
		-- OR --<br />
		<input type="radio" id="aaww_subcategory_cat" <?php echo $subcategory_mode=="category"?"checked":"" ?> name="aaww_subcategory" value="category" />
		<label for="aaww_subcategory_cat" id="aaww_subcategory_cat_label">Select a Subcategory</label><br />
		<select name="aaww_post_subcategory_cat" id="aaww_post_subcategory_cat" <?php echo $subcategory_mode=="category"?"":' diabled="disabled"' ?>>
			<?php
			
			if($subcategory_mode=="category"){
				$sc = getSubcategories($aaww_category);
				//echo "<!--" . print_r($sc) . "-->";
				foreach($sc as $i=>$o){
					foreach($o as $k=>$v){
						$selected = $v == $subcat_category?' selected':'';
						echo '<option value="'.$v.'" '.$selected.' >'.$k.'</option>';
					}
					
				}
				
				
			}
			
			?>
		</select>
		
	</fieldset>
	<label id="aaww_error" class="error"></label>
	<?php

	
}catch(Exception $e)
{
  echo $e->getMessage();
}


?>

