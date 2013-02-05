<?php
/*
Plugin Name: Contextual Amazon Affiliate
Plugin URI: http://www.garrettpatterson.com/
Description: Amazon Product Carousel for Sidebar displaying custom categories related to content
Author: Garrett Patterson
Version: 1
Author URI: http://www.garrettpatterson.com/
*/
 
function contextualAmazonAffiliate() 
{
  //1 with 5           http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=10&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  //6up with images    http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=14&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  $amzn= '<iframe src="http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=8&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr"';
  $amzn.= 'marginwidth="0" marginheight="0" width="120" height="240" border="0" frameborder="0" style="border:none;" scrolling="no"></iframe>';
  echo $amzn;
}
 
function widget_contextualAmazonAffiliate($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;?>Amazon<?php echo $after_title;
  contextualAmazonAffiliate();
  echo $after_widget;
}
 
function contextualAmazonAffiliate_init()
{
  register_sidebar_widget(__('Contextual Amazon Affiliate'), 'widget_contextualAmazonAffiliate');     
}
add_action("plugins_loaded", "contextualAmazonAffiliate_init");
?>