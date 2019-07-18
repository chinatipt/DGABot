<?php

require_once('./BOT2Sheet.php');
require_once('./LINEBotTiny.php');

$service = new BOT2Sheet(__DIR__);
$value = $service->readRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A1:B1');
$row = $value[0];

$service->writeRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A3:B3', [ ['aaa','bbb'], ]);

$channelAccessToken = getenv('access_token');
$channelSecret = getenv('channel_secret');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => $message['text'] . $row[0]
                            ]
                        ]
                    ]);
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