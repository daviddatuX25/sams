<?php
class Controller_Dashboard {
    public function index()
    {
        echo "Dashboard index page!";   
    }

    public function records($year, $month){
        echo "Year is: $year and Month is: $month";
    }
}
?>