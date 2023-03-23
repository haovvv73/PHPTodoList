<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $maId = (int)check_input($_POST["btnUpdate"]);

    // get list student type : student[]
    $data = array();
    $data = GetData();
    $userUpdate;

    foreach ($data as $std) {
        // find student
        $idStd = (int)$std->getId();
        if ($idStd == $maId) {
            // get student
            $userUpdate = $std;
            break;
        }
    }

    // binding data
    $StudentID = $userUpdate->getId();
    $StudentName = (string)$userUpdate->getName();
    $AverageMark = $userUpdate->getAverageMark();

    // birthday format
    $BirthDay = $userUpdate->getBirthday();
    $time = strtotime($BirthDay);
    $newformatBirthDay = date('Y-m-d', $time);
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
                            <input disabled type="text" class="form-control" id="StudentIdInput" name="FakeStudentID" value="<?php echo $StudentID; ?>">
                            <input hidden type="text" class="form-control" id="StudentIdInput" name="StudentID" value="<?php echo $StudentID; ?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="StudentNameInput" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="StudentNameInput" name="StudentName" value = "<?php echo $StudentName; ?>">
                        </div>
                    </div>
                </div>

                <!-- birthday and average mark -->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="BirthDayInput" class="form-label">BirthDay</label>
                            <input type="date" class="form-control" id="BirthDayInput" name="BirthDay" value="<?php echo $newformatBirthDay; ?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="AverageMarkInput" class="form-label">Average Mark</label>
                            <input type="text" class="form-control" id="AverageMarkInput" name="AverageMark" value="<?php echo $AverageMark; ?>">
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