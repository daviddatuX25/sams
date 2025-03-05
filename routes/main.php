<?php
$routes = [

    "" => "Controller_Home@index",
    "home" => "Controller_Home@index",
    "home/index" => "Controller_Home@index",
    "home/guides" => "Controller_Home@guides",
    "home/about" => "Controller_Home@about",

    "login" => "Controller_Auth@index",
    "dashboard" => "Controller_Dashboard@index",
    "dashboard/records/:year/:month" => "Controller_Dashboard@records"
];
?>
