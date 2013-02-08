amazonassociates-widget-widget
==============================

Wordpress plugin for a widget for placing Amazon Associates Widgets, either random on contextually per-post.  Meant to widget-ize, 
and provide an easy admin within Wordpress to add various types of the Widgets available at: https://widgets.amazon.com/.  This plugin 
and widget requires an Amazon Associates account (https://affiliate-program.amazon.com/) and AWS API keys.

### Other Projects Used
* https://github.com/Exeu/Amazon-ECS-PHP-Library

## Feature Overview
* Currently only has Recommended Product Links, and Omakase widget
	* Both these widgets rely on iframes for display
	* I don't want to try and reverse engineer any of the JS widgets or re-create some kind of custom widget.
* Ability to customize appearance of the widget
	* currently only supports the 120px wide formats
	* Change layout from 1 product, to many, with and without pictures.
	* Colors (TODO)
* Choose what widget to display
	* By default it will display the Omakase widget
	* Display related products by category/keyword
	* Display wishlist (TODO)
* Add specific category per-post
	* For each post, choose which category to display products from when in single-post view
	* choose either a list of keywords or a subcategory

## Configuration
1. Configure plugin options
	* AffiliateID
	* AWS Access Key
	* AWS Secret Key
2. Configure plugin display behavior
	* Omakase or global Product Category for Blog
3. Add Widget to Sidebar
	* Select display size (TODO)
4. Update posts with Amazon Category and keywords or subcategory

## Widget Display Decisioning
* If multi-post view
	* Display either set Prodcut Category for plugin or Omakase (configurable)
* If single-post view
	* If post has product cateogry metadata then show related products as defined.
	* Otherwise show the Omakase, or blog category widget

## Future improvements: TODO
* Figure out proper Amazon Category "modes" per browsenode
	* map for all regions
* Support color customization
* support wishlist, and other widgets
* add within-post widget/append to add
* support other ad-placement areas.

