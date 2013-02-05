<?php
/*
Plugin Name: Amazon Affiliate Widget Widget
Plugin URI: http://www.garrettpatterson.com/
Description: Amazon Afilliate Widget Placements for displaying custom categories related to content or Okurt random
Author: Garrett Patterson
Version: 1
Author URI: http://www.garrettpatterson.com/
*/
 
function amazonAfilliateWidgetWidget() 
{
  //6up with keywords  http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=14&l=st1&mode=tools&search=paladin, coaxial cable, hdtv&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  //1 with 5           http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=10&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  //6up with images    http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=14&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr
  $amzn= '<iframe src="http://rcm.amazon.com/e/cm?t=garrepatte-20&o=1&p=8&l=bn1&mode=pc-hardware&browse=565108&fc1=000000&lt1=_blank&lc1=3366FF&bg1=FFFFFF&f=ifr"';
  $amzn.= 'marginwidth="0" marginheight="0" width="120" height="240" border="0" frameborder="0" style="border:none;" scrolling="no"></iframe>';
  echo $amzn;
}
 
function widget_amazonAfilliateWidgetWidget($args) {
  extract($args);
  echo $before_widget;
  echo $before_title;?>Amazon<?php echo $after_title;
  amazonAfilliateWidgetWidget();
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
  
 function amazonAfilliateWidgetWidget_admin_actions(){
 	add_options_page("AmazonAfilliate Widget Widget", "AmazonAfilliate Widget Widget", "manage_options", "aaww_admin", "amazonAfilliateWidgetWidget_admin");
 }
 
function amazonAfilliateWidgetWidget_init()
{
  register_sidebar_widget(__('Amazon Affiliate Widget Widget'), 'widget_amazonAfilliateWidgetWidget');     
}
add_action("plugins_loaded", "amazonAfilliateWidgetWidget_init");
add_action('admin_menu', 'amazonAfilliateWidgetWidget_admin_actions'); 
?>