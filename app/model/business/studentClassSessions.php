<?php
    class Model_Business_studentClassSessions extends Model_Db{
        public function getLiveClassData($studentID){
            return [
                [
                    "id" =>"1",
                    "time_start" => "7:30",
                    "time_end" => "8:30",
                    "instructor" => "Juliet Paulo",
                    "subject" => "ADET",
                    "year_sec" => "2A"

                ]

            ];
        }
        public function getTodayClasses($studentID){

        }

    }
?>