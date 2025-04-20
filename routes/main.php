<?php
$routes = 
[

    "" => "controller_Home@index",
    "home" => "controller_Home@index",
    "home/index" => "controller_Home@index",

    "home/project" => "controller_Home@project",
    "home/creators" => "controller_Home@creators",
    "login" => "controller_Auth@login",
    "register" => "controller_Auth@register",

    // Routers to Student controllers
        // Classes
        "student" => "controller_student_Dashboard@index",
        "student/dashboard" => "controller_student_Dashboard@index",
        "student/classes" => "controller_student_Classes@index",
    
    // Routers to Teacher controllers
        "teacher" => "controller_teacher_Main@index"
];
?>
