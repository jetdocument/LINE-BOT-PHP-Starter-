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

	function availableUrl($host, $port=80, $timeout=10) {

	  $fp = fSockOpen($host, $port, $errno, $errstr, $timeout); 
	  return $fp!=false;
	}

	//Return "true" if the url is available, false if not.
	try {
	        $result = availableUrl($bot->text);
	        if ($result == true) {

	        	$bot->replyMessageNew	($bot->replyToken, 
					"Your ID : ".$bot->userId
					."\n"."Link UP"
					."\n"."Your Link : ".$bot->text					
					."\n"."Link IP : ".gethostbyname($bot->text);
				);					
			} else {

				$bot->replyMessageNew	($bot->replyToken, 
					"Your ID : ".$bot->userId
					."\n"."Link DOWN"
					."\n"."Your Link : ".$bot->text					
					."\n"."Link IP : ".gethostbyname($bot->text);
				);				
			}

	} catch (Exception $e) {
	        
	}	
	
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
