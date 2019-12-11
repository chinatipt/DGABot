<?php

class BOTFunction
{
    public function checkAuthen($id)
    {
        // Read GET Method of Google Sheet
        $ch = curl_init("https://script.google.com/macros/s/AKfycby3F-8Ry9Ex4IJxN-sVo2R6YKRxdi9u2AdKRCCHsNtZ7RzCxOI/exec?id=".$id);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $page = curl_exec($ch);
        curl_close($ch);
        $status = json_decode($page);
        return $status;
    }

    public function getGoogleSheet($stuid, $type)
    {
        // Read GET Method of Google Sheet
        $ch = "";
        if ($type == "getgrade")
        {
            $ch = curl_init("https://script.google.com/macros/s/AKfycbxqpJIVwnCZz5YMx1MNpgPH1LBy45TapnY39I04shu6ON86EwSX/exec?type=".$type."&stuid=".$stuid);
        }
        elseif ($type == "getclass")
        {
            $ch = curl_init("https://script.google.com/macros/s/AKfycbxqpJIVwnCZz5YMx1MNpgPH1LBy45TapnY39I04shu6ON86EwSX/exec?type=".$type."&stuid=".$stuid);
        }
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $page = curl_exec($ch);
        curl_close($ch);
        $grade = json_decode($page);
        return $grade;
    }

    public function buildText($replyToken,$text)
    {
        $message = [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'text',
                    'text' => $text
                ]
            ]
        ];
        return $message;
    }

    public function buildFlexGrade($replyToken, $queryData)
    {
        $flexMessage = '{'
            . '"type": "carousel",'
            . '"contents": ['
            . '{'
            . '"type": "bubble",'
            . '"body": {'
            .    '"type": "box",'
            .    '"layout": "vertical",'
            .    '"contents": ['
            .        '{'
            .            '"type": "text",'
            .            '"text": "' . $queryData[0][0] . ' : ' . $queryData[0][1] . '",'
            .            '"weight": "bold",'
            .            '"color": "#1DB446",'
            .            '"size": "sm"'
            .        '},';
        
        $i = 1;
        $termData = "";
        while ( strlen($queryData[$i][0]) == 1 )
        {
            $GPA = $queryData[$i][2];
            $AGPA = $queryData[$i][3];
            $termData = $termData . '{'
            .    '"type": "separator",'
            .    '"margin": "md"'
            .'},'
            .'{'
            .    '"type": "text",'
            .    '"text": "Term '.$queryData[$i][0].'/'.$queryData[$i][1].'",'
            .    '"margin": "md",'
            .    '"size": "xxs",'
            .    '"weight": "bold",'
            .    '"color": "#000000"'
            .'},';
            $i++;
            while ( strlen($queryData[$i][0]) == 6 )
            {
                $termData = $termData . '{'
                .    '"type": "box",'
                .    '"layout": "horizontal",'
                .    '"contents": ['
                .        '{'
                .            '"type": "text",'
                .            '"text": "'.$queryData[$i][0].': '.$queryData[$i][1].'",'
                .            '"size": "xxs",'
                .            '"color": "#555555",'
                .            '"flex": 9'
                .        '},'
                .        '{'
                .            '"type": "text",'
                .            '"text": "'.$queryData[$i][3].'",'
                .            '"size": "xxs",'
                .            '"weight": "bold",'
                .            '"color": "#111111",'
                .            '"align": "center"'
                .        '}'
                .    ']'
                .'},';
                $i++;
            }
            $termData = $termData . '{'
            .    '"type": "box",'
            .    '"layout": "horizontal",'
            .    '"contents": ['
            .        '{'
            .            '"type": "text",'
            .            '"text": " ",'
            .            '"size": "xxs",'
            .            '"flex": 1'
            .        '},'
            .        '{'
            .            '"type": "text",'
            .            '"text": "GPA: '.$GPA.'",'
            .            '"size": "xxs",'
            .            '"weight": "bold",'
            .            '"color": "#111111",'
            .            '"align": "start",'
            .            '"flex": 3'
            .        '},'
            .        '{'
            .            '"type": "text",'
            .            '"text": "Accum GPA: '.$AGPA.'",'
            .            '"size": "xxs",'
            .            '"weight": "bold",'
            .            '"color": "#111111",'
            .            '"align": "start",'
            .            '"flex": 6'
            .        '}'
            .    ']'
            .'},';
        }

        $termData = $termData . '{
            "type": "box",
            "layout": "vertical",
            "margin": "md",
            "contents": [
                {
                    "type": "button",
                    "style": "secondary",
                    "height": "sm",
                    "color": "#FFB275",
                    "gravity" : "bottom",
                    "action": {
                        "type": "postback",
                        "label": "Unlock",
                        "data": "unlockid='.$queryData[0][0].'"
                    }
                }
            ]
        }';

        $flexMessage = $flexMessage . $termData . ']}}]}';

        $message = [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'flex',
                    'altText' => 'Query Grade.',
                    'contents' => json_decode($flexMessage)
                ]
            ]
        ];
        return $message;
    }

    public function buildFlexClass($replyToken, $queryData)
    {
        $flexMessage = '{
            "type": "carousel",
            "contents": [
            {
                "type": "bubble",
                "body": {
                    "type": "box",
                    "layout": "vertical",
                    "contents": [
                    {
                        "type": "text",
                        "text": "' . '"อาจารย์ AAAAA BBBBB"
                        "weight": "bold",
                        "color": "#1DB446",
                        "size": "sm"
                    }]
                }
            }]}';

        $message = [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'flex',
                    'altText' => 'Query Grade.',
                    'contents' => json_decode($flexMessage)
                ]
            ]
        ];
        return $message;
    }
}

?>