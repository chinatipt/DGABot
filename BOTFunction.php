<?php

class BOTFunction
{
    public function buildFlexGrade($replyToken, $headName)
    {
        $flexMessage = '{
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
                        "text": '.$headName.',
                        "weight": "bold",
                        "color": "#1DB446",
                        "size": "sm"
                    },';

        for ($i=0; $i<3; $i++)
        {
            $termData = '{
                "type": "separator",
                "margin": "md"
            },
            {
                "type": "text",
                "text": "Term 1",
                "margin": "md",
                "size": "xxs",
                "weight": "bold",
                "color": "#000000"
            },';
            for ($j=0; $j<5; $j++)
            {
                $termData = $termData . '{
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
                },';
            }
            $termData = $termData . '{
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
            },';
        }
        $flexMessage = $flexMessage . $termData .  ']
            }
        }';

        $message = [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'flex',
                    'altText' => 'This is flex',
                    'contents' => $flexMessage
                ]
            ]
        ];
        return $message;
    }
}