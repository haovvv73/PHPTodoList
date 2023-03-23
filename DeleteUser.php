<?php 
    include "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $maId = (int)check_input($_POST["btnDelete"]);

        // get list student type : student[]
        $data = array();
        $data = GetData();
        $index = 0;

        // delete
        foreach ($data as $std) {
            // find student
            $idStd = (int)$std->getId();
            if($idStd == $maId){ 
                // delete student in array
                array_splice($data,$index,1);
                break;
            }
            $index++;
        }

        // rewrite data
        WriteData($data);

        // redirect
        echo "<script>
        alert('DELETE SUCCESS');
        window.location.href='http://localhost/helloPHP/PHPlab01/';
        </script>";
    }
?>