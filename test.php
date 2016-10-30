<?php 
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
include 'api.php';?>

<html>
<title>AirWatch API Test</test>
<body>

<?php
/*
###### AirWatch internal App size API page #######

Author: Adam Matthews (matthewsa@vmware.com)
Date: 25th October 2016

TODO (AS OF 25/10/16): 
	* Currently total app size count does not match storage used. Attempted to filter out by BundleId which has helped but not enough
	* +/- indicator with percentage under total (as total is a hard stop in the Console)
	* Handle REST API Error display
*/

	$appcount = CallAPI("GET","https://aw.em-emm.uk/api/system/groups/570/storage");
	$allapps = CallAPI("GET","https://aw.em-emm.uk/api/mam/apps/search?type=app&applicationtype=internal");
	
	$count = (json_decode($appcount,true));
	//var_dump($count); //USE IF YOU GET REST API ERRORS
		
	$totalsize = 0; // size count var
	$data = JSON_DECODE($allapps);
	
	$bid = ""; //bundle id - tracking var
	
	foreach($data->Application as $app)
	{
		//if($app->Status == "Active") //only count if active
		//echo $app->BundleId." <br />";

		if($bid !== $app->BundleId){ //account for duplicate bundle ID's (ASSUMPTION - refences in DB dont match with physical storage)
			$totalsize = $totalsize + (float)substr($app->ApplicationSize, 0, -3); //convert to float and add to total, remove ' MB' fom string	
		}
		$bid = $app->BundleId;
	}
	
	//Display
	echo "<br />Total Storage: ".$count['ApplicationCapacity'];
	echo "<br />Used: ".$totalsize;

?>
</textarea>

</body>
</html>