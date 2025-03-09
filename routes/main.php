<?php
$routes = [

    "" => "Controller_Home@index",
    "home" => "Controller_Home@index",
    "home/index" => "Controller_Home@index",

    "home/project" => "Controller_Home@project",
    "home/creators" => "Controller_Home@creators",
    "home/login" => "Controller_Home@login",
    "home/register" => "Controller_Home@register",

    "student" => "Controller_Student@dashboard",
    "student/index" => "Controller_Student@dashboard",
    "student/dashboard" => "Controller_Student@dashboard",
    "student/attendance " => "Controller_Student@live",
    "student/attendance/live" => "Controller_Student@live",
    "student/attendance/records" => "Controller_Student@records"
];
?>
