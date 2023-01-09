<?php 
include 'function_CRUD.php';
$projects = query("SELECT project.*, DATE_FORMAT(start_date, '%k:%i,%d %M %Y') as start_date_formatted, DATE_FORMAT(end_date, '%k:%i,%d %M %Y') as end_date_formatted FROM project ORDER BY end_date");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body class="bgCustom">
    <div class="row py-2">
        <div class="col-md-12">
            <h1 class="alert text-center p-4">Project Monitoring</h1>
        </div>
    </div>
    <div class="container bg-white pt-4 ">
        <div class="row pb-4">
            <div class="col-md-8">
                <a href="index.php" class="btn btn-primary mr-2 my-1"><i class="fas fa-home"></i> Home</a>
                <a href="v_add_project.php" class="btn btn-success mr-2 my-1"><i class="fas fa-plus"></i> Add</a>
            </div>
            <div class="col-md-4">
                <form action="index.php" method="post">
                    <div class="form-group d-flex justify-content-end">
                        <input class="btn btn-outline-success me-2" type="text" name="keyword" placeholder="Search" autocomplete="off">
                        <button class="btn btn-outline-success" type="submit" name="submit"> <span class="fas fa-search"></span> Find</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped table-hover table-responsive">
                    <thead class="bg-white">
                        <tr class="text-center text-uppercase">
                            <th>Project Name</th>
                            <th>Client</th>
                            <th>Project Leader</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($projects as $project) { ?>
                            <tr>
                                <td><?= $project['project_name'] ?></td>
                                <td><?= $project['client'] ?></td>
                                <td>
                                    <div class="row text-center">
                                        <div class="col">
                                            <img src="../assets/img/<?= $project['leader_photo'] ?>" alt="" class="img-thumbnail rounded" width="50" height="500" style="object-fit: cover;">
                                        </div>

                                    </div>
                                    <div class="row text-center">
                                        <div class="col">
                                            <p class="fw-bold m-0"><?= $project['leader'] ?></p>
                                            <p class="fst-italic m-0"><?= $project['leader_email'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td><?= $project['start_date_formatted'] ?></td>
                                <td><?= $project['end_date_formatted'] ?></td>
                                <td>
                                    <div class="progress">
                                        <?php
                                        $progress = $project['progress'];
                                        $warna_progress = "bg-danger";
                                        if ($progress >= 0 && $progress < 50) {
                                            $warna_progress = "bg-danger";
                                        } elseif ($progress >= 50 && $progress < 80) {
                                            $warna_progress = "bg-warning";
                                        } elseif ($progress >= 80 && $progress <= 100) {
                                            $warna_progress = "bg-success";
                                        }
                                        ?>
                                        <div class="progress-bar <?= $warna_progress ?> progress-bar-animated" role="progressbar" style="width: <?= $project['progress'] ?>%" aria-valuenow="<?= $project['progress'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $project['progress'] ?>%</div>
                                    </div>

                                </td>
                                <td class="text-center">
                                    <div class="d-flex flex-row align-items-center">
                                        <a class="btn btn-warning mx-1" href="v_edit_project.php?id=<?= $project['id'] ?>"><i class="fas fa-edit"></i> Edit</a>
                                        <a class="btn btn-danger mx-1" href="v_delete_project.php?id=<?= $project['id'] ?>" onclick="return(confirm('Are you sure wanna delete the project?'))"><i class="fas fa-trash"></i> Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>
</html>