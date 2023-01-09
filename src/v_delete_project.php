<?php
include 'function_CRUD.php';
$id = $_GET['id'];

if (hapus($id) > 0) {
    echo "
    <style>
    .berhasil {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 99;
        transition: .5s;
    }

    .wrap {
        top: 75%;
    }
    </style>
    <div class=\"mx-auto my-auto berhasil m-2 position-fixed\">
        <div class=\"row\">
            <div class=\"col-md-4\"></div>
            <div class=\"col-md-4\">
                <div class=\"wrap rounded p-2 shadow-xl bg-white border border-secondary d-block d-flex flex-column position-relative\">
                    <h3 class=\"text-center text-success d-block p-3\">Project Deleted Successfully!</h3>
                    <i class=\"align-self-center text-success far fa-check-circle fa-6x p-2\">
                    </i>
                    <div class=\" align-self-center kotak-tombol p-3\">
                        <a href=\"index.php\" class=\"btn btn-secondary\">Back</a>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4\"></div>
        </div>
    </div>
    ";
} else {
    echo "
    <style>
    .berhasil {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, .5);
        z-index: 99;
        transition: .5s;
    }

    .wrap {
        top: 75%;
    }
    </style>
    <div class=\"mx-auto my-auto berhasil m-2 position-fixed\">
        <div class=\"row\">
            <div class=\"col-md-4\"></div>
            <div class=\"col-md-4\">
                <div class=\"wrap rounded p-2 shadow-xl bg-white border border-secondary d-block d-flex flex-column position-relative\">
                    <h3 class=\"text-center text-muted d-block p-3\">Data Gagal dihapus !</h3>
                    <i class=\"align-self-center text-danger far fa-times-circle fa-6x p-2\">
                    </i>
                    <div class=\" align-self-center kotak-tombol p-3\">
                        <a href=\"index.php\" class=\"btn btn-secondary\">Kembali</a>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4\"></div>
        </div>
    </div>
    ";
}
?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Delete Project</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
</body>

</html>