<?php
$routes = [

    "" => "Controller_Home@index",
    "home" => "Controller_Home@index",
    "home/index" => "Controller_Home@index",

    "home/project" => "Controller_Home@project",
    "home/creators" => "Controller_Home@creators",
    "home/login" => "Controller_Auth@login",
    "home/register" => "Controller_Auth@register",

    "student" => "Controller_Student@dashboard",
    "student/index" => "Controller_Student@dashboard",
    "student/dashboard" => "Controller_Student@dashboard",

    "student/attendance " => "Controller_Student@classesToday",
    "student/attendance/live_class" => "Controller_Student@liveClass",
    "student/attendance/class_session/:class_session/:class_session_id" => "Controller_Student@live_class",
    "student/attendance/timeline" => "Controller_Student@timeline"
];
?>
