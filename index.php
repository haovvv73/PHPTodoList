<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>

    <!-- CSS BOOSTRAP 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</head>

<body style="background-image: linear-gradient(to right bottom ,bisque, aliceBlue);background-repeat: no-repeat;background-size: cover;min-height: 100vh;">

    <?php

    include "config.php";
    // danh sach student
    define("DANHSACH", GetData())

    ?>

    <div class="container mt-5">

        <!-- FORM input -->
        <div class="border p-3 bg-info rounded shadow">
            <h2 class="text-white">Form Add User </h2>
            <form action="InsertUser.php" method="POST">
                <!-- id and name -->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="StudentIdInput" class="form-label">Student ID</label>
                            <input type="text" class="form-control" id="StudentIdInput" name="StudentID">
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="StudentNameInput" class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="StudentNameInput" name="StudentName">
                        </div>
                    </div>
                </div>

                <!-- birthday and average mark -->
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="BirthDayInput" class="form-label">BirthDay</label>
                            <input type="date" class="form-control" id="BirthDayInput" name="BirthDay">

                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label for="AverageMarkInput" class="form-label">Average Mark</label>
                            <input type="text" class="form-control" id="AverageMarkInput" name="AverageMark">
                        </div>
                    </div>
                </div>

                <!-- button submit (add) -->
                <div>
                    <input type="submit" class="btn btn-success" name="submit" value="Add New User">
                </div>
            </form>
        </div>

        <!-- CONTENT -->
        <div class="mt-5">
            <h2>List User</h2>

            <!-- FORM input search user -->
            <div>
                <form action="SearchUser.php" method="GET">
                    <div class="my-3 d-flex gap-3" style="width: 30%;">
                        <input type="text" class="form-control" id="SearchUserInput" name="SearchUser">
                        <button class="btn btn-info" type="submit"> Search </button>
                    </div>
                </form>
            </div>

            <!-- Table list user -->
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
                    <?php foreach (DANHSACH as $student) : ?>
                        <tr>
                            <th scope="row"> <?php echo $student->getId() ?> </th>
                            <td> <?php echo $student->getName() ?> </td>
                            <td> 
                                <?php 
                                    $BirthDay = $student->getBirthday() ;
                                    $time = strtotime($BirthDay);
                                    $newformatBirthDay = date('m-d-Y', $time);
                                    echo $newformatBirthDay;
                                ?> 
                            </td>
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
    </div>

    <!-- JS BOOTSTRAP 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>