<?php

require_once('./BOT2Sheet.php');
require_once('./LINEBotTiny.php');

/* Read Google Sheet
$service = new BOT2Sheet(__DIR__);
$value = $service->readRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A1:B1');
$row = $value[0];

$service->writeRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A3:B3', [ ['aaa','bbb'], ]);
*/

$ch = curl_init('https://script.google.com/macros/s/AKfycbxqpJIVwnCZz5YMx1MNpgPH1LBy45TapnY39I04shu6ON86EwSX/exec');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$page = curl_exec($ch);

curl_close($ch);

$grade = json_decode($page);

//echo($grade[0][1]);

$channelAccessToken = getenv('access_token');
$channelSecret = getenv('channel_secret');

$test = '{
    "type": "bubble",
    "styles": {
      "footer": {
        "separator": true
      }
    },
    "body": {
      "type": "box",
      "layout": "vertical",
      "contents": [
        {
          "type": "text",
          "text": "5890266 : Chinatip",
          "weight": "bold",
          "color": "#1DB446",
          "size": "sm"
        },
        {
          "type": "separator",
          "margin": "md"
        },
        {
          "type": "box",
          "layout": "vertical",
          "margin": "md",
          "spacing": "sm",
          "contents": [
            {
              "type": "text",
              "text": "Term 1",
              "size": "xxs",
              "weight": "bold",
              "color": "#000000"
            },
            {
              "type": "box",
              "layout": "horizontal",
              "contents": [
                {
                  "type": "text",
                  "text": "VFX-311: Shading Lighting and Rendering for visual effect",
                  "size": "xxs",
                  "color": "#555555",
                  "flex": 9
                },
                {
                  "type": "text",
                  "text": "A",
                  "size": "xxs",
                  "weight": "bold",
                  "color": "#111111",
                  "align": "center"
                }
              ]
            },
            {
              "type": "box",
              "layout": "horizontal",
              "contents": [
                {
                  "type": "text",
                  "text": "VFX-311: Shading Lighting and Rendering for visual effect",
                  "size": "xxs",
                  "color": "#555555",
                  "flex": 9
                },
                {
                  "type": "text",
                  "text": "B+",
                  "size": "xxs",
                  "weight": "bold",
                  "color": "#111111",
                  "align": "center"
                }
              ]
            },
            {
              "type": "box",
              "layout": "horizontal",
              "contents": [
                {
                  "type": "text",
                  "text": " ",
                  "size": "xxs",
                  "flex": 1
                },
                {
                  "type": "text",
                  "text": "GPA: 3.12",
                  "size": "xxs",
                  "weight": "bold",
                  "color": "#111111",
                  "align": "start",
                  "flex": 3
                },
                {
                  "type": "text",
                  "text": "Total GPA: 1.23",
                  "size": "xxs",
                  "weight": "bold",
                  "color": "#111111",
                  "align": "start",
                  "flex": 6
                }
              ]
            }
          ]
        }
      ]
    }
}';

$temp = json_decode($test);

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    /*
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                //'text' => $message['text'] . $grade[0][1]
                                'text' => $grade[0][0] . $grade[0][1] . $grade[0][2]
                            ]
                        ]
                    ]);
                    */
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'flex',
                                'altText' => 'This is flex',
                                'contents' => $temp
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