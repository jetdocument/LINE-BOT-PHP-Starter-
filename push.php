<?php
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('lGIPn6XGSZmb1qYpU/kTWGADC/7keEWP0kI9ybaQjtRyaeyflX5b1QEIwcz3itdl4WtWCtB3cB4zG0RRpU+SXzF4j6XEy4V7sliVfu5pfJd8LyPhGuqNkN2KFHjLElwc6ReLkJOIP5v7/msSD0KUxQdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '41a0536c6ac1d4202c8a7c867728c933']);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello');
$response = $bot->pushMessage('Ua19821cd93141008d26221f16381d256', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>