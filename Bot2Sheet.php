<?php

class BOT2Sheet
{
    private $tmpClient;
    public function __construct()
    {
        require __DIR__ . '/vendor/autoload.php';
        $client = new \Google_Client();
        $client->setApplicationName('LineBot PHP');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig(__DIR__ . '/credentials.json');
        $service = new Google_Service_Sheets($client);

        $this->$tmpClient = $service;
    }

    public function readSheet($spreadsheetId, $range)
    {
        $response = $this->$tmpClient->spreadsheets_values->get($spreadsheetId, range);
        $value = $response->getValues();

        return $value;
    }


}

?>