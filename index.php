<?php
include ('bot.php');

$channelSecret = '41a0536c6ac1d4202c8a7c867728c933';
$access_token  = 'lGIPn6XGSZmb1qYpU/kTWGADC/7keEWP0kI9ybaQjtRyaeyflX5b1QEIwcz3itdl4WtWCtB3cB4zG0RRpU+SXzF4j6XEy4V7sliVfu5pfJd8LyPhGuqNkN2KFHjLElwc6ReLkJOIP5v7/msSD0KUxQdB04t89/1O/w1cDnyilFU=';

#$url = 'https://api.line.me/v1/oauth/verify';
#$headers = array('Authorization: Bearer ' . $access_token);
#$ch = curl_init($url);
#curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
#curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
#$result = curl_exec($ch);
#curl_close($ch);
#$curl_obj = json_decode($result);
#echo $curl_obj->{'channelId'}."<br/>";
#echo $curl_obj->{'mid'}."<br/>";

#    public $content         = null;
#    public $events          = null;	
#    public $isEvents        = false;
#    public $isText          = false;
#    public $isImage         = false;
#    public $isSticker       = false;
	
#    public $text            = null;
#    public $replyToken      = null;
#    public $source          = null;
#    public $userId          = null;
#    public $userType        = null;    
#    public $message         = null;
#    public $timestamp       = null;
	
#    public $response        = null;


$bot = new BOT_API($channelSecret, $access_token);

$bot->verify(access_token);
	
if (!empty($bot->isEvents)) {

	switch ($bot->eventType) {
    case "text":
    	if ( strtolower($bot->text) == "getevent") {
    		# code...
    		$bot->replyMessageNew( $bot->replyToken, json_encode($bot->events));
    	} else if ( strtolower($bot->text) == "signup") {
    		# code...
    		if ( strtolower($bot->userType) == "group") {
    			# code...
    			$bot->replyMessageNew( $bot->replyToken, "Go to your private box!");
    			$bot->sendMessageNew( $bot->userId, "Group TokenID : ");
    			$bot->sendMessageNew( $bot->userId, $bot->groupId);
    			$bot->sendMessageNew( $bot->userId, "Link to signup : https://bacom.dyndns.org:4433");
    		} else {
    			# code...
    			$bot->replyMessageNew( $bot->replyToken, "Your TokenID : ");
    			$bot->sendMessageNew( $bot->userId, $bot->userId);
    			$bot->sendMessageNew( $bot->userId, "Link to signup : https://bacom.dyndns.org:4433");
    		}
    		
    	} else if ( strtolower($bot->text) == "help"  || $bot->text == "?" ) {
    		# code...
    		if (strtolower($bot->userType) == "group") {
    			# code...
    			$bot->replyMessageNew( $bot->replyToken, 
    			"Hi"
    			."\n"."Welcome to Bacom Internetwork");
	    		$bot->sendMessageNew( $bot->groupId, "System can action only command below");
	    		$bot->sendMessageNew( $bot->groupId, "1 : Signup");
	    		$bot->sendMessageNew( $bot->groupId, "Link to signup : https://bacom.dyndns.org:4433");
    		} else {
    			# code...
    			$bot->replyMessageNew( $bot->replyToken, 
    			"Hi"
    			."\n"."Welcome to Bacom Internetwork");
	    		$bot->sendMessageNew( $bot->userId, "System can action only command below");
	    		$bot->sendMessageNew( $bot->userId, "1 : Signup");
	    		$bot->sendMessageNew( $bot->userId, "Link to signup : https://bacom.dyndns.org:4433");
    		}    		
    		
    	} else {
    		# code...
    	}
    	
        
        break;
    case "sticker":
        $bot->replyMessageNew( $bot->replyToken, $bot->message);
        break;
    case "image":
        // $bot->replyMessageNew( $bot->replyToken, json_encode($bot->events));
        break;
    case "video":
        // $bot->replyMessageNew( $bot->replyToken, json_encode($bot->events));
        break;
    
    default:
        
}

	// if ($bot->text == "getEvent") {
	// 	# code...
	// 	$bot->replyMessageNew( $bot->replyToken, json_encode($bot->events).$bot->$userType);
	// } else if ($bot->text == "getgroupId") {
	// 	$bot->replyMessageNew( $bot->replyToken, $bot->groupId);
	// } else if ($bot->text == "getuserType") {
	// 	$bot->replyMessageNew( $bot->replyToken, $bot->userType);
	// } else {
	// 	# code...
	// 		function availableUrl($host, $port=80, $timeout=10) {
	// 		  $fp = fSockOpen($host, $port, $errno, $errstr, $timeout); 
	// 		  return $fp!=false;
	// 		}
		
	//         $linkState = availableUrl($bot->text);
	        
	//         if ($linkState == true) {

	//         	$bot->replyMessageNew	($bot->replyToken, 
	// 				"Your ID : ".$bot->userId
	// 				."\n"."Link UP"
	// 				."\n"."Your Link : ".$bot->text					
	// 				."\n"."Link IP : ".gethostbyname($bot->text)
	// 			);					
	// 		} else {

	// 			$bot->replyMessageNew	($bot->replyToken, 
	// 				"Your ID : ".$bot->userId
	// 				."\n"."Link DOWN"
	// 				."\n"."Your Link : ".$bot->text					
	// 				."\n"."Link IP : ".gethostbyname($bot->text)
	// 			);				
	// 		}
		
	// }	

	

	//Return "true" if the url is available, false if not.
		
	
	#$bot->replyMessageNew($bot->replyToken, json_encode($bot->events));
	
		
	if ($bot->isSuccess()) {
		echo 'Succeeded!';
		exit();
	}

	// Failed
	echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
	exit();
}


?>
