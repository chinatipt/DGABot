<?php

    $ch = curl_init('https://script.google.com/macros/s/AKfycbxqpJIVwnCZz5YMx1MNpgPH1LBy45TapnY39I04shu6ON86EwSX/exec?stuid=6100345');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $page = curl_exec($ch);

    curl_close($ch);

    $grade = json_decode($page);

    echo($grade);



    /*
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                //'text' => $message['text'] . $grade[0][1]
                                'text' => $helper->buildFlexGrade('','')
                            ]
                        ]
                    ]);*/
?>