<?php
    class Student {        
        // PROPERTY
        private $StudentID;
        private $StudentName;
        private $BirthDay;
        private $AverageMark;

        // METHOD
        function __construct($id = null, $name = null, $birthday = null, $averagemark = null)
        {
            $this->StudentID = $id;
            $this->StudentName = $name;
            $this->BirthDay = $birthday;
            $this->AverageMark = $averagemark;
        }

        public function getId(){
            return $this->StudentID;
        }

        public function getName(){
            return $this->StudentName;
        }

        public function getBirthday(){
            return $this->BirthDay;
        }

        public function getAverageMark(){
            return $this->AverageMark;
        }

    }
?>