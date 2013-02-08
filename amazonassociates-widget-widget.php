<?php
/*
Plugin Name: Amazon Associates Widget Widget
Plugin URI: https://github.com/garrettpatterson/amazonassociates-widget-widget
Description: Amazon Associates Widget Placements for displaying custom categories related to content or Okurt random
Author: Garrett Patterson
Version: 1
Author URI: http://www.garrettpatterson.com/
*/
global $product_categories;
global $post;
global $widgetsizes;

require 'lib/AmazonECS.class.php';
include 'data/product_categories.php';
include 'data/widget_sizes.php';

function amazonAssociatesWidgetWidget($post) 
{
	$values = array();
	$affiliateid = get_option('aaww_affiliateid');
	$widget = "";
	
	//blog plugin settings
	$aaww_blog_display = get_option("aaww_blog_display");
	$aaww_blog_category = get_option('aaww_category');
	$blog_subcategory_mode = get_option('aaww_subcat_mode');
	$blog_subcat_keyword =get_option('aaww_subcategory_kw');
	$blog_subcat_category = get_option('aaww_subcategory_cat');
	
	if(count($post)==1){
		//$values = get_post_meta($post->ID);
		$aaww_category = get_post_meta($post->ID,'aaww_post_category',true);
		$subcategory_mode = get_post_meta($post->ID,'aaww_post_subcat_mode',true);
		$subcat_keyword =get_post_meta($post->ID,'aaww_post_subcategory_kw',true);
		$subcat_category = get_post_meta($post->ID,'aaww_post_subcategory_cat',true);
		
	}
	
	if(count($post)==1 && empty($aaww_category)==true){
		$aaww_category = $aaww_blog_category;
		$subcategory_mode = $blog_subcategory_mode;
		$subcat_keyword= $blog_subcat_keyword;
		$subcat_category= $blog_subcat_category;
	}
	
	
	if($aaww_blog_display=="category" && empty($aaww_category)==false){
		//do category one
		$subq = "";
		if($subcategory_mode=="category"){
			$subq = "&browse=" . $subcat_category . "&l=bn1";
		}else{
			$subq = "search=" . $subcat_keyword . "&l=st1";
		}
		$widget = 'http://rcm.amazon.com/e/cm?t='.$affiliateid.'&o=1&p=14&mode='.$aaww_category.'&';
		$widget .= $subq;
		$widget .= '&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr';
	}else{
		//omakase
		$widget ="http://rcm.amazon.com/e/cm?t=".$affiliateid."&o=1&p=14&l=op1&pvid=".uniqid();
		$widget.="&ref-url=".urlencode(get_site_url())."&ref-title=&ref-ref=&bgc=FFFFFF&bdc=000000&pcc=990000&tec=000000&tic=3399FF&ac=CC6600&pvc=6E6E6E&lgl=1&mp=1&dsc=1&f=ifr&e=iso-8859-1";
	}
	
	
  //echo "<!--" . $post->ID . "-->";
  //6up with keywords  http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=14&l=st1&mode=tools&search=paladin, coaxial cable, hdtv&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  //1 with 5           http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=10&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  //6up with images    http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=14&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  $amzn= '<iframe src="'.$widget.'"';
  $amzn.= 'marginwidth="0" marginheight="0" width="160" height="600" border="0" frameborder="0" style="border:none;" scrolling="no"></iframe>';
  echo $amzn;
}
 
function widget_amazonAssociatesWidgetWidget($args) {
	global $post;
  extract($args);
  echo $before_widget;
  echo $before_title;?>Amazon<?php echo $after_title;
  //echo "<!--" .print_r($post). "-->";
  amazonAssociatesWidgetWidget($post);
  echo $after_widget;
}

  function options_amazonAssociatesWidgetWidget()
  {
		$widgetsizes = array(
			"6"=>"One Product, small, 120x150",
			"8"=>"One Product, 120x240",
			"10"=>"Six produts, top with image, 120x450",
			"14"=>"Six products with images, 120x600"
		);
		$aaww_widget_display = get_option('aaww_widget_display');
		echo '<input type="hidden" name="aaww_widget_options_postback" value="true" />';
		echo '<select name="aaww_widget_display"><option value="0">--Select--</option>';
		foreach($widgetsizes as $k=>$v){
			$seleted = $k == $aaww_widget_display?" selected":"";
			echo '<option value="'.$k.$seleted. '">'.$v.'</option>';
			
			
		}
		echo '</select>';
		if($_POST['aaww_widget_options_postback']==true && $_POST['aaww_widget_display'] > 0){
			update_option('aaww_widget_display',$_POST['aaww_widget_display']);
			
		}

  }
  
 function amazonAssociatesWidgetWidget_admin(){
 	
	include('amazonassociates-widget-widget_admin.php');
 }
 
 function amazonAffiliateWidgetWidget_posts($post){
 	include('aaww_posts_page.php');
 }

function getSubcategories($cat){
		
	include 'data/product_categories.php';
	$categoryid = $product_categories[$cat]['id'];
	$awsaffiliate = get_option('aaww_affiliateid');
	$awsaccess = get_option('aaww_awsaccess');
	$awssecret = get_option('aaww_awssecret');	
	
	$amazonEcs = new AmazonECS($awsaccess, $awssecret, 'com', $awsaffiliate);
	$amazonEcs->responseGroup('BrowseNodeInfo');
	$response = $amazonEcs->browseNodeLookup($categoryid);
	$subcats = array();
	$nodes = $response->BrowseNodes->BrowseNode->Children->BrowseNode;
/*	print_r($response);
	die();
	return; */
	if($nodes){
		foreach($nodes as $node){
			array_push($subcats,array($node->Name=>$node->BrowseNodeId));
		}
	}else{
		if($response->BrowseNodes->Request->Errors->Error->Message){
			$subcats = $response->BrowseNodes->Request->Errors;
		}
		//print_r($response);
	}
	return $subcats;
}

function amazonAssociatesWidgetWidget_ajax_getSubCategories(){
	include 'data/product_categories.php';
	
	
//	echo print_r($categoryid);

	$subcats = getSubcategories($_POST['aaww_post_category']);
	
	$res = array();
	if($subcats->Error){
		$res = array("status"=>"error","data"=>$subcats->Error);
	}else{
		$res = array("status"=>"success","data"=>$subcats);
	}
	
	echo( json_encode($res));
	
	die();
}
  
 function amazonAssociatesWidgetWidget_admin_actions(){
 	add_options_page("AmazonAssociates Widget Widget", "AmazonAssociates Widget Widget", "manage_options", "aaww_admin", "amazonAssociatesWidgetWidget_admin");
 	add_meta_box("aaww_posts","Amazon Associates Widget", "amazonAssociatesWidgetWidget_posts", "post","side", "low");

 }
 
function amazonAssociatesWidgetWidget_init()
{
  register_sidebar_widget(__('Amazon Associates Widget Widget'), 'widget_amazonAssociatesWidgetWidget'); 
  register_widget_control(__('Amazon Associates Widget Widget'), 'options_amazonAssociatesWidgetWidget');
}


function amazonAssociatesWidgetWidget_save($post_id){
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return;
	}
	//include 'data/product_categories.php';
	//$categoryid = $product_categories[$cat]['id'];
	$category = $_POST['aaww_post_category'];
	$subcategory_mode  = $_POST['aaww_subcategory'];
	$subcat_kewyord = $_POST['aaww_post_subcategory_kw'];
	$subcat_category= $_POST['aaww_post_subcategory_cat'];
	
	//if($category <> 0 && ($subcategory_mode == 'keyword'&& $subcat_kewyord > "" || $subcategory_mode=="category"&&$subcat_category <> null)){
	if($category >""){
		//save it
		update_post_meta($post_id,'aaww_post_category',$category);
		update_post_meta($post_id,'aaww_post_subcat_mode',$subcategory_mode);
		update_post_meta($post_id,'aaww_post_subcategory_kw',$subcat_kewyord);
		update_post_meta($post_id,'aaww_post_subcategory_cat',$subcat_category);
	}
	
	//update_post_meta($post,'filed','data);
	
}

add_action("plugins_loaded", "amazonAssociatesWidgetWidget_init");
add_action('admin_menu', 'amazonAssociatesWidgetWidget_admin_actions'); 
add_action('wp_ajax_aaww_getSubCategories', 'amazonAssociatesWidgetWidget_ajax_getSubCategories');
add_action('save_post', 'amazonAssociatesWidgetWidget_save');
?>