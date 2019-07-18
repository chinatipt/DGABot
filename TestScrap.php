<?php

    include "simple_html_dom.php";

    $postFields = array(
        "txtUserName" => "5890266",
        "txtPassword" => "0s0MhuX5",
        "btnLogIn" => "เข้าระบบ"
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://intranet.rsu.ac.th/Signin.aspx");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . "/etc/cer.crt");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_POST, true);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
    $response = curl_exec($ch);

    if(curl_errno($ch)) // check for execution errors
    {
        echo 'Scraper error: ' . curl_error($ch);
        exit;
    }

    curl_close($ch);

    echo($response);
    //$html = new simple_html_dom();
    //$html->load($response);

    //echo($html);

?>