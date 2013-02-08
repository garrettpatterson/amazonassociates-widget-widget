<?php

require 'data/product_categories.php';
$awsaffiliate = get_option('aaww_affiliateid');
$awsaccess = get_option('aaww_awsaccess');
$awssecret = get_option('aaww_awssecret');


$aaww_category = get_post_meta($post->ID,'aaww_post_category',true);
$subcategory_mode = get_post_meta($post->ID,'aaww_post_subcat_mode',true);
$subcat_keyword =get_post_meta($post->ID,'aaww_post_subcategory_kw',true);
$subcat_category = get_post_meta($post->ID,'aaww_post_subcategory_cat',true);

include 'aaww_category_selector.php';


?>