<?php
/*
Plugin Name: Amazon Affiliate Widget Widget
Plugin URI: http://www.garrettpatterson.com/
Description: Amazon Afilliate Widget Placements for displaying custom categories related to content or Okurt random
Author: Garrett Patterson
Version: 1
Author URI: http://www.garrettpatterson.com/
*/
global $product_categories;
global $post;
require 'lib/AmazonECS.class.php';
include 'data/product_categories.php';

function amazonAfilliateWidgetWidget($post) 
{
	$values = array();
	$affiliateid = get_option('aaww_affiliateid');
	$widget = "";
	if(count($post)==1){
		//$values = get_post_meta($post->ID);
		$aaww_category = get_post_meta($post->ID,'aaww_post_category',true);
		$subcategory_mode = get_post_meta($post->ID,'aaww_post_subcat_mode',true);
		$subcat_keyword =get_post_meta($post->ID,'aaww_post_subcategory_kw',true);
		$subcat_category = get_post_meta($post->ID,'aaww_post_subcategory_cat',true);
		
	}
	
	if($aaww_category > ""){
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
 
function widget_amazonAfilliateWidgetWidget($args) {
	global $post;
  extract($args);
  echo $before_widget;
  echo $before_title;?>Amazon<?php echo $after_title;
  //echo "<!--" .print_r($post). "-->";
  amazonAfilliateWidgetWidget($post);
  echo $after_widget;
}

  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
  
 function amazonAfilliateWidgetWidget_admin(){
 	
	include('amazonaffiliate-widget-widget_admin.php');
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

function amazonAfilliateWidgetWidget_ajax_getSubCategories(){
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
  
 function amazonAfilliateWidgetWidget_admin_actions(){
 	add_options_page("AmazonAfilliate Widget Widget", "AmazonAfilliate Widget Widget", "manage_options", "aaww_admin", "amazonAfilliateWidgetWidget_admin");
 	add_meta_box("aaww_posts","Amazon Affiliate Widget", "amazonAffiliateWidgetWidget_posts", "post","side", "low");

 }
 
function amazonAfilliateWidgetWidget_init()
{
  register_sidebar_widget(__('Amazon Affiliate Widget Widget'), 'widget_amazonAfilliateWidgetWidget');     
}


function amazonAfilliateWidgetWidget_save($post_id){
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

add_action("plugins_loaded", "amazonAfilliateWidgetWidget_init");
add_action('admin_menu', 'amazonAfilliateWidgetWidget_admin_actions'); 
add_action('wp_ajax_aaww_getSubCategories', 'amazonAfilliateWidgetWidget_ajax_getSubCategories');
add_action('save_post', 'amazonAfilliateWidgetWidget_save');
?>