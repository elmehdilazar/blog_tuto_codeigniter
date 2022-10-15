<?= $this->extend('layouts/layout'); ?>

<?= $this->section('title'); ?>
edit profile
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="row mx-4 mt-5 ">
    <div class="colmd-4">

        <div class="card">


            <div class="card-header bg-dark text-white-50 text-center">
                edit profile
            </div>

            <div class="card-body">
                <?php
                $attributes = ['name' => 'form', 'id' => 'myform'];
                echo   form_open('profile/updateProfile/', $attributes);
                ?>
                <div class="form-group">

                    <input type="text" name="name" id="" class="form-control" value="<?= old('name', $users->name) ?>" placeholder="name" aria-describedby="helpId">
                    <?php

                    $data = [
                        'name'  => 'email',
                        'type'    => 'email',
                        'placeholder' => 'email',
                        'class' => 'form-control',
                        'value' => old('email', $users->email)
                    ];



                    echo       form_input($data);

                    ?>
                </div>
                <?php
                echo  form_close();
                ?>
            </div>
            <div class="card-footer text-muted  text-center">
                <input name="env" form="myform" id="" class="me-5 btn btn-primary" type="submit" value="edit">
                <a href="<?= site_url('/Profile/editPassword') ?>" class="ms-5 p-2 btn btn-sm btn-warning">
                 change password  <i class="fa fa-edit" aria-hidden="true"></i>       
            </a>
            </div>
        </div>
    </div>
</div>
</div>



<?= $this->endSection(); ?>