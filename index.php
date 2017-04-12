<?php
$access_token = 'lGIPn6XGSZmb1qYpU/kTWGADC/7keEWP0kI9ybaQjtRyaeyflX5b1QEIwcz3itdl4WtWCtB3cB4zG0RRpU+SXzF4j6XEy4V7sliVfu5pfJd8LyPhGuqNkN2KFHjLElwc6ReLkJOIP5v7/msSD0KUxQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

			// $event['message']['text'] = $_SERVER['SERVER_NAME'];

			
			$getMessage = $event['message']['text'];

			if ($getMessage == "ว่าไง") {
				$setMessage = "ต้องการอะไร";
			} else {
				function availableUrl($host, $port=80, $timeout=10) {

				  $fp = fSockOpen($host, $port, $errno, $errstr, $timeout); 
				  return $fp!=false;
				}

				//Return "true" if the url is available, false if not.
				try {
				        $result = availableUrl($getMessage);
				} catch (Exception $e) {
				        
				}

				if ($result == true) {
						$setMessage = 
						"Link is UP"."\r\n".
						"Your Domain is : ".$getMessage."\r\n".
						"Your IP Address is : ".gethostbyname($getMessage);
				} else {
						$setMessage = 
						"Link is Down"."\r\n".
						"Your Domain is : ".$getMessage."\r\n".
						"Your IP Address is : ".gethostbyname($getMessage);
				}				
			}

			$event['message']['text'] = $setMessage;

			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
			$response = $bot->pushMessage('Ua19821cd93141008d26221f16381d256', $textMessageBuilder);

			echo $result . "\r\n";

		}
	}
}

echo "Ready!";
