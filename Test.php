<?php

require __DIR__ . '/vendor/autoload.php';
//include(__DIR__ . '/vendor/rmccue/requests/library/Requests.php');

Requests::register_autoloader();


$response = Requests::get('https://intranet.rsu.ac.th/signin.aspx');


/*
$postFields= array(
    "txtUserName" => "5890266",
    "txtPassword" => "0s0MhuX5",
    "btnLogIn" => "เข้าระบบ",
    "__VIEWSTATE" => "AVPlXNEA2f0U1bSH036jsZYvoAL2KQik+2Z+Q9yaooa/6XMQ0EwIBAczOQ4XPS4Yoh6tqewvU3FX1j6gUGCZMQ1So3xFe31QaAPc2EXgNXUqH4wd4F/c0r2OiHcVufhcSax+Xii4nnpWSDG7COsGAKAb9MD3x9aP0jREz2O1uzWofxjjDP72HQfVoVLmR9uGFJ7Vruz6d5cIL/Hdt6mgixrPyP7qwhWrG5RkW7CpnYxwLacE+bAgCvFNlaLYfTlk1dOqc2S577qr8UdDNjuxPBvwbvb7RbcS+BKDlNdkvQko6vO8c91QZh/PO+It32BmJ/yTBsFm7PyI1fWEr0ADOlcklUMq6202Y7/ayZL0ojk="
);
*/

//echo $response->body;

?>