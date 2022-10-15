<?php $this->extend('layouts/layout');   ?>

<?= $this->section('title'); ?>
login
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="row mx-4 mt-5 ">
    <div class="colmd-4">


        <script>
            var alertList = document.querySelectorAll('.alert');
            alertList.forEach(function(alert) {
                new bootstrap.Alert(alert)
            })
        </script>


        <div class="card ">
            <div class="card-header bg-dark text-white-50 text-center">
                login
            </div>
            <?php if (session()->has("error")) : ?>
                <?php foreach (session("error") as $key => $item) : ?>
                    <div class="alert alert-danger  alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>error</strong> <?= $item; ?>
                    </div>
                <?php endforeach ?>


            <?php endif; ?>
            <div class="card-body">
                <?php
                $attributes = ['name' => 'form', 'id' => 'myform'];
                echo   form_open('Login/auth', $attributes);
                ?>
                <div class="form-group">

                 
                    <?php

                    $data = [

                        'type'  => 'text',
                        'name'  => 'email',
                        'id'  => 'email',
                        'placeholder' => 'email',
                        'class' => 'form-control',
                        'value' => old('email')
                    ];



                    echo       form_input($data);

                    ?>
                    <?php

                    $data = [

                        'type'  => 'password',
                        'name'  => 'password',
                        'id'  => 'password',
                        'placeholder' => 'password',
                        'class' => 'form-control',
                        'value' => old('password')
                    ];



                    echo       form_input($data);

                    ?>
                </div>
                <?php
                echo  form_close();
                ?>
            </div>
            <div class="card-footer text-muted text-center">
                <input name="env" form="myform" id="" class="btn btn-primary" type="submit" value="connect">
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>