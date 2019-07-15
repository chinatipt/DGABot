<?php

class BOT2Sheet
{
    private $service;
    private $path;

    public function __construct($path)
    {
        require $path . '/vendor/autoload.php';
        $client = new \Google_Client();
        $client->setApplicationName('LineBot PHP');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        $client->setAuthConfig($path . '/credentials.json');
        $this->service = new Google_Service_Sheets($client);
        $this->path = $path;
    }

    public function readRange($sheetId, $range)
    {
        $service = $this->service;
        $response = $service->spreadsheets_values->get($sheetId, $range);
        $value = $response->getValues();
        return $value;
    }

    public function writeRange($sheetId, $range, $values)
    {
        //require_once $this->path . '/vendor/autoload.php';
        $service = $this->service;
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = [
            'valueInputOption' => 'RAW'
        ];
        $result = $service->spreadsheets_values->update(
            $sheetId,
            $range,
            $body,
            $params
        );
    }


}

?>