<?php

// Enable error reporting to help us debug issues
error_reporting(E_ALL);

// Start PHP sessions
session_start();

require_once('./config.php');

function doPost($sMethod, $aPost = array())
{
	// Build the request string we are going to POST to the API server. We include some of the required params.
	$sPost = 'public_key=' . APP_PUBLIC_KEY . '&private_key=' . APP_PRIVATE_KEY . '&method=' . $sMethod . '&token=' . $_REQUEST['token'];
	foreach ($aPost as $sKey => $sValue)
	{
		$sPost .= '&' . $sKey . '=' . $sValue;
	}		
		
	// Start curl request.
	$hCurl = curl_init();		
		
	curl_setopt($hCurl, CURLOPT_URL, APP_URL . 'api.php');
	curl_setopt($hCurl, CURLOPT_HEADER, false);
	curl_setopt($hCurl, CURLOPT_RETURNTRANSFER, true);			

	curl_setopt($hCurl, CURLOPT_SSL_VERIFYPEER, false);
			
	curl_setopt($hCurl, CURLOPT_POST, true);
	curl_setopt($hCurl, CURLOPT_POSTFIELDS, $sPost);
		
	// Run the exec
	$sData = curl_exec($hCurl);
			
	// Close the curl connection
	curl_close($hCurl);	
	
	// print(APP_URL . 'api.php?' . $sPost);

	// Return the curl request and since we use JSON we decode it.
	return json_decode(trim($sData));		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
	<head>
		<title>Angry Birds Rio</title>		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo APP_URL; ?>static/style.php?public_key=<?php echo APP_PUBLIC_KEY; ?>" />
		<script type="text/javascript">
			$(document).ready(function(){				
				$('body').append('<iframe id="crossdomain_frame" src="<?php echo APP_URL; ?>static/crossdomain.php?height=' + document.body.scrollHeight + '&nocache=' + Math.random() + '" height="0" width="0" frameborder="0"></iframe>');
			});		
		</script>
	</head>
	<body>


<table>
<tr>
<td height="540" width="750">
<object width="750" height="540" style="position:absolute;left:50px;top:0px;z-index:0;"
codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0">
<param name="wmode" value="transparent">
<param name="movie" value="/tools/apps/ПАПКА_НАЗВАНИЕ_ПРИЛОЖЕНИЯ/НАЗВАНИЕ_ПРИЛОЖЕНИЯ.swf" /> <param name="quality" value="medium" /> 
<embed type="application/x-shockwave-flash" style="position:absolute;left:80px;top:0px;z-index:0;" width="750" height="540"  src="/tools/apps/ПАПКА_НАЗВАНИЕ_ПРИЛОЖЕНИЯ/НАЗВАНИЕ_ПРИЛОЖЕНИЯ.swf" 
pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" quality="medium">
</embed>
</object>
</td>
</tr>
</table>


	</body>
</html>