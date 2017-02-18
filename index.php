<?php
define ("BASE_URL","https://shop.sellerlinx.com/");
define ("HOME_URL",BASE_URL."sandbox/");

define ("MY_PAGE_ID","239765822736397");


$app_id     = "756039411215951";
$app_secret = "33cff28fd24280c1c72b83635e244410";

error_reporting(E_ALL);
ini_set('display_errors', '1');
ob_start();

include_once("php-graph-sdk/src/Facebook/Facebook.php");
include_once("php-graph-sdk/src/Facebook/SignedRequest.php");
include_once("php-graph-sdk/src/Facebook/FacebookApp.php");
include_once("php-graph-sdk/src/Facebook/FacebookClient.php");
include_once("php-graph-sdk/src/Facebook/HttpClients/FacebookHttpClientInterface.php");
include_once("php-graph-sdk/src/Facebook/HttpClients/FacebookStream.php");
include_once("php-graph-sdk/src/Facebook/HttpClients/FacebookStreamHttpClient.php");
include_once("php-graph-sdk/src/Facebook/HttpClients/HttpClientsFactory.php");
include_once("php-graph-sdk/src/Facebook/HttpClients/FacebookCurl.php");
include_once("php-graph-sdk/src/Facebook/HttpClients/FacebookCurlHttpClient.php");
include_once("php-graph-sdk/src/Facebook/Url/UrlDetectionInterface.php");
include_once("php-graph-sdk/src/Facebook/Url/FacebookUrlDetectionHandler.php");
include_once("php-graph-sdk/src/Facebook/PersistentData/PersistentDataInterface.php");
include_once("php-graph-sdk/src/Facebook/PersistentData/FacebookMemoryPersistentDataHandler.php");
include_once("php-graph-sdk/src/Facebook/PersistentData/FacebookSessionPersistentDataHandler.php");
include_once("php-graph-sdk/src/Facebook/PersistentData/PersistentDataFactory.php");
include_once("php-graph-sdk/src/Facebook/Helpers/FacebookSignedRequestFromInputHelper.php");
include_once("php-graph-sdk/src/Facebook/Helpers/FacebookCanvasHelper.php");
include_once("php-graph-sdk/src/Facebook/Authentication/OAuth2Client.php");
include_once("php-graph-sdk/src/Facebook/Helpers/FacebookPageTabHelper.php");



$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.5',
  ]);

echo 'POST<br/>';
print_r($_POST);
echo '<br/>SR<br/>';
$helper = $fb->getPageTabHelper();
$signedRequest = $helper->getSignedRequest();
print_r($signedRequest);


if($signedRequest==null){
	//direct access
	header("location:https://sellerlinx.com");
}
else{
	//properly linked from Facebook tab
	//check if app_data exists
	$app_data = $signedRequest->getPayload()["app_data"];

	//echo $signedRequest[];

	if($signedRequest->getPayload()["page"]["id"]==MY_PAGE_ID){
		$url = HOME_URL;
		if(!empty($app_data)){
			$url.="";
			//header("location:".$app_data);
		}
		//echo $url.'?access_method=facebook';
		header("location:".$url.'?access_method=facebook');
	}

}

ob_flush();

/*
Facebook\SignedRequest Object ( 
	[app:protected] => Facebook\FacebookApp Object ( 
		[id:protected] => 756039411215951 
		[secret:protected] => 33cff28fd24280c1c72b83635e244410 ) 
	[rawSignedRequest:protected] => deFbGrmgvSJgYDLo1GqqQt_dlU7GaHCBdzp8kPJ1boU.eyJhbGdvcml0aG0iOiJITUFDLVNIQTI1NiIsImlzc3VlZF9hdCI6MTQ4NjM2ODY3NywicGFnZSI6eyJpZCI6IjIzOTc2NTgyMjczNjM5NyIsImFkbWluIjp0cnVlfSwidXNlciI6eyJjb3VudHJ5IjoidHciLCJsb2NhbGUiOiJlbl9VUyIsImFnZSI6eyJtaW4iOjIxfX19 
	[payload:protected] => Array ( 
		[algorithm] => HMAC-SHA256 
		[issued_at] => 1486368677 
		[page] => Array ( 
			[id] => 239765822736397 
			[admin] => 1 ) 
		[user] => Array ( 
			[country] => tw 
			[locale] => en_US 
			[age] => Array ( 
				[min] => 21 ) 
			) 
		) 
	)
	*/
//header("location:".HOME_URL);

?>