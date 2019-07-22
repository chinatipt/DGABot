<?php

class BOTFunction
{
    public function getGrade($stuid)
    {
        $ch = curl_init('https://script.google.com/macros/s/AKfycbxqpJIVwnCZz5YMx1MNpgPH1LBy45TapnY39I04shu6ON86EwSX/exec?stuid='.$stuid);
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
            . '"type": "bubble",'
            . '"styles": {'
            .    '"footer": {'
            .        '"separator": true'
            .    '}'
            .'},'
            .'"body": {'
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
        
        $termData = "";
        for ($i=0; $i<1; $i++) {
            $termData = $termData . '{'
            .    '"type": "separator",'
            .    '"margin": "md"'
            .'},'
            .'{'
            .    '"type": "text",'
            .    '"text": "Term 1",'
            .    '"margin": "md",'
            .    '"size": "xxs",'
            .    '"weight": "bold",'
            .    '"color": "#000000"'
            .'},';
            for ($j=0; $j<5; $j++) {
                $termData = $termData . '{'
                .    '"type": "box",'
                .    '"layout": "horizontal",'
                .    '"contents": ['
                .        '{'
                .            '"type": "text",'
                .            '"text": "VFX-311: Shading Lighting and Rendering for visual effect",'
                .            '"size": "xxs",'
                .            '"color": "#555555",'
                .            '"flex": 9'
                .        '},'
                .        '{'
                .            '"type": "text",'
                .            '"text": "A",'
                .            '"size": "xxs",'
                .            '"weight": "bold",'
                .            '"color": "#111111",'
                .            '"align": "center"'
                .        '}'
                .    ']'
                .'},';
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
            .            '"text": "GPA: 3.12",'
            .            '"size": "xxs",'
            .            '"weight": "bold",'
            .            '"color": "#111111",'
            .            '"align": "start",'
            .            '"flex": 3'
            .        '},'
            .        '{'
            .            '"type": "text",'
            .            '"text": "Total GPA: 1.23",'
            .            '"size": "xxs",'
            .            '"weight": "bold",'
            .            '"color": "#111111",'
            .            '"align": "start",'
            .            '"flex": 6'
            .        '}'
            .    ']'
            .'},';
        }
        $flexMessage = $flexMessage . substr($termData,0,-1) . ']}}';

        
        $message = [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'flex',
                    'altText' => 'This is flex',
                    'contents' => json_decode($flexMessage)
                ]
            ]
        ];
        return $message;
    }
}

?>