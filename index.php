<?php


require __DIR__ . '/vendor/autoload.php';
$client = new \Google_Client();
$client->setApplicationName('LineBot PHP');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId = '10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M';

$range = 'Sheet1!A1:B1';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$value = $response->getValues();
$row = $value[0];/*
*/

require_once('./LINEBotTiny.php');



$channelAccessToken = getenv('access_token');
$channelSecret = getenv('channel_secret');

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $reText = $message['text'] . ' Test1' . $row[0];
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                'text' => $reText
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
