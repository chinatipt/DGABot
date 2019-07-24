<?php

class BOT2Sheet
{
    private $client;
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
        $this->client = $client;
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

    public function queryRange()
    {
        /*
        $service = $this->service;
        $datastore = new Google_Service_Datastore($this->client);

        // build the query - this maps directly to the JSON
        $query = new Google_Service_Datastore_Query([
            'kind' => [
                [
                    'name' => 'linename',
                ],
            ],
            'order' => [
                'property' => [
                    'name' => 'title',
                ],
                'direction' => 'descending',
            ],
            'limit' => 10,
        ]);

        // build the request and response
        $request = new Google_Service_Datastore_RunQueryRequest(['query' => $query]);
        $response = $datastore->projects->runQuery('YOUR_DATASET_ID', $request);
        */
    }


}

?>