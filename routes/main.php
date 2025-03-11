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

    "student/attendance " => "Controller_Student@classesToday",
    "student/attendance/classes_today" => "Controller_Student@classesToday",
    "student/attendance/class_session/:class_session/:class_session_id" => "Controller_Student@classesToday",
    "student/attendance/timeline" => "Controller_Student@timeline"
];
?>
