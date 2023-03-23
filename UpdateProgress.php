<?php
include "config.php";

// check data form user
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // attribute
    $StudentIDerr = $StudentNameErr = $BirthDayErr = $AverageMarkErr = "";
    $StudentID = $StudentName = $BirthDay = $AverageMark = "";
    // flag check
    $isCheck = true;

    // method validations
    function checkId()
    {
        global $StudentID, $StudentIDerr;
        if (empty($_POST["StudentID"])) {
            $StudentIDerr = "ID is required";
            return false;
        } else {
            $StudentID = test_input($_POST["StudentID"]);
            // check format
            if (!preg_match("/^\d+$/", $StudentID)) {
                $StudentIDerr = "only number";
                return false;
            }
            // check is create

        }
        return true;
    }

    function checkName()
    {
        global $StudentName, $StudentNameErr;
        if (empty($_POST["StudentName"])) {
            $StudentNameErr = "Name is required";
            return false;
        } else {
            $StudentName = test_input($_POST["StudentName"]);
            // check
            if (!preg_match("/^[a-zA-Z-' ]*$/", $StudentName)) {
                $StudentNameErr = "Only letters and white space allowed";
                return false;
            }
        }
        return true;
    }

    function checkBirthday()
    {
        global $BirthDay, $BirthDayErr;
        if (empty($_POST["BirthDay"])) {
            $BirthDayErr = "BirthDay is required";
            return false;
        } else {
            $BirthDay = test_input($_POST["BirthDay"]);
        }
        return true;
    }

    function checkAverageMark()
    {
        global $AverageMark, $AverageMarkErr;
        if (empty($_POST["AverageMark"])) {
            $AverageMarkErr = "AverageMark is required";
            return false;
        } else {
            $AverageMark = test_input($_POST["AverageMark"]);
            // check
            if (!preg_match("/^\d*\.?\d*$/", $AverageMark)) {
                $AverageMarkErr = "Only float number";
                return false;
            }

            if ((float)$AverageMark < floatval(0) || (float)$AverageMark > floatval(10)) {
                $AverageMarkErr = "Only float number and AverageMark 0 -> 10";
                return false;
            }
        }
        return true;
    }

    // validation

    $isCheck &= checkId();
    $isCheck &= checkName();
    $isCheck &= checkBirthday();
    $isCheck &= checkAverageMark();

    // true
    if ($isCheck == true) {

        // get list student type : student[]
        $data = array();
        $data = GetData();
        // student has updated
        $newStudent = new Student($StudentID, $StudentName, $BirthDay, $AverageMark);

        $maId = (int)$newStudent->getId();
        $index = 0;

        foreach ($data as $std) {
            // find student
            $idStd = (int)$std->getId();
            if ($idStd == $maId) {
                // replace old student to new student
                $data[$index] = $newStudent; 
                break;
            }
            $index++;
        }

        // rewrite data
        WriteData($data);

        echo "<script>
        alert('UPDATE SUCCESS');
        window.location.href='http://localhost/helloPHP/PHPlab01/';
        </script>";
    }

    // false => form again
}
?>

<html>

<head>
    <!-- CSS BOOSTRAP 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>

<body style="background-image: linear-gradient(to right bottom ,bisque, aliceBlue);background-repeat: no-repeat;background-size: cover;min-height: 100vh;">

    <div class="container mt-5">
        <!-- FORM input -->
        <div class="border p-3 bg-info rounded shadow">
            <h2 class="text-white">Form Update User</h2>
            <form action="UpdateProgress.php" method="POST">
                <!-- id and name -->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="StudentIdInput" class="form-label">Student ID</label>
                            <input disabled type="text" class="form-control" id="StudentIdInput" name="FakeStudentID" value="<?php echo $StudentID ?>">
                            <input hidden type="text" class="form-control" id="StudentIdInput" name="StudentID" value="<?php echo $StudentID ?>">
                            <?php echo "<span class='text-danger'> $StudentIDerr </span>" ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="StudentNameInput" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="StudentNameInput" name="StudentName" value="<?php echo $StudentName ?>">
                            <?php echo "<span class='text-danger'> $StudentNameErr </span>" ?>
                        </div>
                    </div>
                </div>

                <!-- birthday and average mark -->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="BirthDayInput" class="form-label">BirthDay</label>
                            <input type="date" class="form-control" id="BirthDayInput" name="BirthDay" value="<?php echo $BirthDay ?>">
                            <?php echo "<span class='text-danger'> $BirthDayErr </span>" ?>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="AverageMarkInput" class="form-label">Average Mark</label>
                            <input type="text" class="form-control" id="AverageMarkInput" name="AverageMark" value="<?php echo $AverageMark ?>">
                            <?php echo "<span class='text-danger'> $AverageMarkErr </span>" ?>
                        </div>
                    </div>
                </div>

                <!-- button submit (update) -->
                <div>
                    <input type="submit" class="btn btn-warning" name="submit" value="Update User">
                </div>
            </form>
        </div>
    </div>

    <!-- JS BOOTSTRAP 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>