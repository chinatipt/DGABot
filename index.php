<?php
//use function GuzzleHttp\Promise\each;

require_once('./BOT2Sheet.php');
require_once('./LINEBotTiny.php');
require_once('./BOTFunction.php');

/* Read Google Sheet
$service = new BOT2Sheet(__DIR__);
$value = $service->readRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A1:B1');
$row = $value[0];

$service->writeRange('10HCCj0qKKf4OS0xzaBUrk2LdYozoZv3fOQe9Ar1cO1M','Sheet1!A3:B3', [ ['aaa','bbb'], ]);
*/

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
                    if (strtolower(substr($message['text'],0,5)) == 'regis'){
                        $replytext = $event['source']['userId'];
                        $client->replyMessage($helper->buildText($event['replyToken'],'id is ' . $replytext));
                    }
                    else {
                        $isRegis = $helper->checkAuthen($event['source']['userId']);
                        if ($isRegis == "true")
                        {
                            // Return Flex Message
                            if (strtolower(substr($message['text'],0,5)) == 'grade')
                            {
                                $stuid = trim(substr($message['text'],5,strlen($message['text']))," ");
                                $client->replyMessage($helper->buildFlexGrade($event['replyToken'],$helper->getGoogleSheet($stuid,'getgrade')));
                            }
                            elseif (strtolower(substr($message['text'],0,5)) == 'class')
                            {
                                $client->replyMessage($helper->buildFlexClass($event['replyToken'],$helper->getGoogleSheet($stuid,'getclass')));
                            }
                        }
                        else
                        {
                            // Return To Regis
                            $client->replyMessage($helper->buildText($event['replyToken'],'Register, Type: regis'));
                        }
                    }
                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        case 'postback':
            $stuid = $event['postback']['data'];
            $isSuccess = $helper->getGoogleSheet(substr($stuid,strlen($stuid)-7),'unlock');

            $client->replyMessage($helper->buildText($event['replyToken'],$isSuccess));
            
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};

?>