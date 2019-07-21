<?php

class BOTFunction
{
    public function buildFlexGrade($replyToken, $headName)
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
            .            '"text": "' . $headName . '",'
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
            for ($j=0; $j<1; $j++) {
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