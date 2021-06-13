<?php

$WanStatus = [
    "ConnectionType",
    "ConnectionStatus",
    "ConnectionDuration",
    "IPaddress",
    "SubnetMask",
    "DefaultGateway",
    "PrimaryDns",
    "SecondaryDns",
    "MacAddress",
    "WifiConfig" => [
        "name" => "Default_WIFI",
        "pass" => 12345678
    ],
];



$categoryList = json_decode(file_get_contents("category.json"), true);

$categories =  [];

foreach ($categoryList as $key => $category) {
    // echo $subCategory->sub . "\n";
    // echo $category["name"] . "\n";
     echo "$key \n";

    if (isset($category["sub"])) {
        foreach ($category["sub"] as  $subCategory) {
            // echo $subCategory . "\n";
            echo "$key \n";
        }
    }
}
// print_r($categoryList[0]["name"]);