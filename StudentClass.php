<?php
    class Student {        
        // PROPERTY
        private $StudentID;
        private $StudentName;
        private $BirthDay;
        private $AverageMark;
        public $max = false;
        public $min = false;

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

        public function setMax(){
            $this->max = true;
        }
        public function setMin(){
            $this->min = true;
        }
        public function getMax(){
            return $this->max;
        }
        public function getMin(){
            return $this->min;
        }

    }
?>