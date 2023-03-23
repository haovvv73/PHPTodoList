<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search page</title>

    <!-- CSS BOOSTRAP 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>

<body style="background-image: linear-gradient(to right bottom ,bisque, aliceBlue);background-repeat: no-repeat;background-size: cover;min-height: 100vh;">
    <?php

    include "config.php";
    // danh sach student
    define("DANHSACH", GetData());

    $nameStudentSearch = check_input($_GET["SearchUser"]);
    $arrStudentResult = array();
    $resultCount = 0;

    // find
    foreach (DANHSACH as $student) {
        $nameStudent = $student->getName();
        if (str_contains($nameStudent, $nameStudentSearch)) {
            $resultCount++;
            array_push($arrStudentResult, $student);
        }
    }

    ?>

    <div class="container mt-5">
        <div>
            <?php

            if ($resultCount <= 0) {
                echo " <h3 class='text-danger' >NOT FOUND<h3/>";
                return;
            }

            echo "<h3>Found: " . (string)$resultCount . "</h3>";

            ?>
        </div>

        <!-- list user search -->
        <table class="table table-secondary table-striped">
            <thead>
                <tr>
                    <th scope="col">Student ID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Birth Day</th>
                    <th scope="col">Average Mark</th>
                    <th scope="col">Option</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!-- // render DANHSACH student -->
                <?php foreach ($arrStudentResult as $student) : ?>
                    <tr>
                        <th scope="row"> <?php echo $student->getId() ?> </th>
                        <td> <?php echo $student->getName() ?> </td>
                        <td> <?php echo $student->getBirthday() ?> </td>
                        <td> <?php echo $student->getAverageMark() ?> </td>
                        <td>
                            <form action="DeleteUser.php" method="POST">
                                <button type="submit" value="<?php echo $student->getId(); ?>" name="btnDelete" class="btn btn-danger">delete</button>
                            </form>
                        </td>
                        <td>
                            <form action="UpdateUser.php" method="POST">
                                <button type="submit" value="<?php echo $student->getId(); ?>" name="btnUpdate" class="btn btn-info">update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <!-- JS BOOTSTRAP 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

</body>

</html>