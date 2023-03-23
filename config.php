<?php
    include "StudentClass.php";

    // check data form user
    function check_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // GET/READ DATA - file txt  
    function GetData(){
        $myfile = fopen("data/data.txt", "r") or die("Unable to open file!");
        $listStudent = array();
        while(!feof($myfile)) {
            // read file each line
            $line = fgets($myfile) ;
            // check data
            $line = check_input($line);
            // convert to array
            $arrStr = explode("|",$line);
            // create obj Student
            $student = new Student($arrStr[0],$arrStr[1],$arrStr[2],$arrStr[3]);
            // add student in list
            array_push($listStudent,$student);
        }
        fclose($myfile);

        return $listStudent; // array
    }

    // PUT DATA - file txt
    function PutData($newStudent){
        $file = 'data/data.txt';
        // Open the file to get existing content
        $current = file_get_contents($file);
        // Append a new person to the file
        $current .= "\n" . $newStudent->getId() . "|" . $newStudent->getName() . "|" . $newStudent->getBirthday() . "|" . $newStudent->getAverageMark();  
        // Write the contents back to the file
        file_put_contents($file, $current);
    }

    // WRITE DATA
    function WriteData($data){
        $file = 'data/data.txt';

        $current = "";
        $index = 0;

        foreach ($data as $std) {
            if($index == 0){
                $current .= $std->getId() . "|" . $std->getName() . "|" . $std->getBirthday() . "|" . $std->getAverageMark(); 
                $index = 1;
            }else{
                $current .= "\n" . $std->getId() . "|" . $std->getName() . "|" . $std->getBirthday() . "|" . $std->getAverageMark();
            }
        }

        file_put_contents($file, $current);
    }
?>