<?php

include ('bot.php');

$channelSecret = '41a0536c6ac1d4202c8a7c867728c933';
$access_token  = 'lGIPn6XGSZmb1qYpU/kTWGADC/7keEWP0kI9ybaQjtRyaeyflX5b1QEIwcz3itdl4WtWCtB3cB4zG0RRpU+SXzF4j6XEy4V7sliVfu5pfJd8LyPhGuqNkN2KFHjLElwc6ReLkJOIP5v7/msSD0KUxQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

$curl_obj = json_decode($result);
echo $curl_obj->{'channelId'}."<br/>";
echo $curl_obj->{'mid'}."<br/>";

$bot = new BOT_API($channelSecret, $access_token);
	
if (!empty($bot->isEvents)) {
	
	#$bot_obj = json_decode($bot_data);
	
	#$bot->replyMessageNew($bot->replyToken, json_encode($bot->events)); 
	$bot->replyMessageNew($bot->replyToken, $bot->replyToken); 

	if ($bot->isSuccess()) {
		echo 'Succeeded!';
		exit();
	}

	// Failed
	echo $bot->response->getHTTPStatus . ' ' . $bot->response->getRawBody(); 
	exit();
}


?>
