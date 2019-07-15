<?php

class BOT2Sheet
{
    public $service;

    public function __construct()
    {

    }

    public function connect()
    {
        require './vendor/autoload.php';
        $client = new \Google_Client();
        $client->setApplicationName('LineBot PHP');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig('./credentials.json');
        $this->service = new Google_Service_Sheets($client);
    }

    public function readRange($sheetId, $range)
    {
        $service = $this->service;
        $response = $service->spreadsheets_values->get($sheetId, $range);
        $value = $response->getValues();
        return $value;
    }

}

?>