<?php
define('TOKEN', 'qx2jUnNS95vIVmRwlYBY0V3R6dmWDgxz1wZV3BmBwvknhoPH16lSTznPrtZfser9+XbYMjlV7JFmI3QxGIKsazMTUvE+oedjFXati5vjNxlpstQo6+IXSiME3A8ftJkei80HxVjKVspVYKTdffkfsgdB04t89/1O/w1cDnyilFU=');

$stdout= fopen( 'php://stdout', 'w' );

//callback確認
$obj = json_decode(file_get_contents('php://input'));

//textとreplyToken取得
$event = $obj->{"events"}[0];
$text = $event->{"message"}->{"text"};
$replyToken = $event->{"replyToken"};

$post = [
	"replyToken" => $replyToken,
	"messages" => array(
		[
			"type" => "text",
			"text" => $text
		]
	)
];

$ch = curl_init("https://api.line.me/v2/bot/message/reply");

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Authorization: Bearer ' . TOKEN
	)
);
$result = curl_exec($ch);
fwrite( $stdout, $result);
curl_close($ch);
?>