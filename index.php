<?php

require_once('./BOT2Sheet.php');
require_once('./LINEBotTiny.php');
require_once('./BOTFunction.php');

/* Read Google Sheet
$service = new BOT2Sheet(__DIR__);
$value = $service->readRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A1:B1');
$row = $value[0];

$service->writeRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A3:B3', [ ['aaa','bbb'], ]);
*/



//echo($grade[0][1]);

$channelAccessToken = getenv('access_token');
$channelSecret = getenv('channel_secret');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$helper = new BOTFunction();
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    if (substr($message['text'],0,5) == 'grade')
                    {
                        $stuid = trim(substr($message['text'],5,strlen($message['text']))," ");
                        $client->replyMessage($helper->buildFlexGrade($event['replyToken'],$helper->getGrade($stuid)));
                    }
                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};

?>