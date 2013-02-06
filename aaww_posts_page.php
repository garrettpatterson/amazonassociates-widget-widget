<?php
$awsaffiliate = get_option('aaww_affiliateid');
$awsaccess = get_option('aaww_awsaccess');
$awssecret = get_option('aaww_awssecret');

$inpostlayouts = array("Banner - 3 product" =>"h3up","Banner - 2 product"=>"h2up");

$tlcats = array('Apparel'=>1036592,
'Appliances'=>2619525011,
'ArtsAndCrafts'=>2617941011,
'Automotive'=>15690151,
'Baby'=>165796011,
'Beauty'=>11055981,
'Books'=>1000,
'Classical'=>301668,
'Collectibles'=>4991425011,
'DigitalMusic'=>195208011,
'DVD'=>2625373011,
'Electronics'=>493964,
'GourmetFood'=>3580501,
'Grocery'=>16310101,
'HealthPersonalCare'=>3760931,
'HomeGarden'=>285080,
'Industrial'=>228239,
'Jewelry'=>3880591,
'KindleStore'=>133141011,
'Kitchen'=>1063498,
'Magazines'=>599872,
'Miscellaneous'=>10304191,
'MobileApps'=>2350149011,
'MP3Downloads'=>195211011,
'Music'=>301668,
'MusicalInstruments'=>11091801,
'OfficeProducts'=>1084128,
'OutdoorLiving'=>1063498,
'PCHardware'=>493964,
'PetSupplies'=>1063498,
'Photo'=>493964,
'Software'=>409488,
'SportingGoods'=>3375251,
'Tools'=>468240,
'Toys'=>493964,
'VHS'=>404272,
'Video'=>130,
'VideoGames'=>493964,
'Watches'=>377110011,
'Wireless'=>508494,
'WirelessAccessories'=>13900851);

//require '../lib/AmazonECS.class.php';


try
{
    //$amazonEcs = new AmazonECS($awsaccess, $awssecret, 'US', $awsaffiliate);
	
	?><p>Amazon Associates Widget Widget options</p>
	<select name="aaww_post_category">
	<?php
		foreach($tlcats as $cat=>$val){
			
			echo '<option value="'. $val . '">'. $cat . '</option>';
		}
	?>
	</select>
	
	<?php
	//$amazonEcs->responseGroup('BrowseNodeInfo');
	
}catch(Exception $e)
{
  echo $e->getMessage();
}


?>

