<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>codeigniter 4 | <?= $this->renderSection('title'); ?></title>
    
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <?= $this->renderSection('style') ;?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark justify-content-center">
        <div class="container-fluid  ">
            <a class="navbar-brand" href="<?= site_url("/") ?>">blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent text-center">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center w-100">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url("/") ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= site_url("/posts/ajouter") ?>">ajouter</a>
                    </li>
                    <?php if (session()->has("logged")) : ?>
                        <!-- TRUE -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= site_url("/posts") ?>">my articles</a>
                        </li>
                        <li class="nav-item float-end">
                            <a class="nav-link active" aria-current="page" href="<?= site_url("profile") ?>"><?= session("name") ?></a>
                        </li>
                        <li class="nav-item float-end">
                            <a class="nav-link active" aria-current="page" href="<?= site_url("/logout") ?>">logout</a>
                        </li>
                        <?php if (session("admin")) : ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">admin</a>
                                <ul class="dropdown-menu ">
                                    <li><a class="dropdown-item" href="<?= site_url("/admin/posts/") ?>">posts</a></li>
                                    <li><a class="dropdown-item" href="<?= site_url("/admin/users/") ?>">all users</a></li>
                                </ul>
                            </li>
                        <?php endif ?>
                    <?php else : ?>
                        <!-- FALSE -->
                        <li class="nav-item  float-end">
                            <a class="nav-link active " aria-current="page" href="<?= site_url("/Register") ?>">Register</a>
                        </li>
                        <li class="nav-item float-end">
                            <a class="nav-link active" aria-current="page" href="<?= site_url("/login") ?>">login</a>
                        </li>
                    <?php endif ?>



                </ul>

            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-8 mx-auto my-3">
            <?php if (session()->has("errors")) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>errors</strong> <?= session("errors"); ?>

                    <script>
                        var alertList = document.querySelectorAll('.alert');
                        alertList.forEach(function(alert) {
                            new bootstrap.Alert(alert)
                        })
                    </script>

                <?php endif ?>
                <?php if (session()->has("success")) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>good !</strong> <?= session("success"); ?>
                    </div>

                    <script>
                        var alertList = document.querySelectorAll('.alert');
                        alertList.forEach(function(alert) {
                            new bootstrap.Alert(alert)
                        })
                    </script>


                <?php endif ?>
                <?php if (session()->has("warrning")) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>good !</strong> <?= session("warrning"); ?>
                    </div>

                    <script>
                        var alertList = document.querySelectorAll('.alert');
                        alertList.forEach(function(alert) {
                            new bootstrap.Alert(alert)
                        })
                    </script>


                <?php endif ?>

                </div>

        </div>
        <div class="container">

            <?php
            $this->renderSection('content');

            ?>
        </div>
</body>

</html>