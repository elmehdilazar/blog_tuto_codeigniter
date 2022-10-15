<?= $this->extend('layouts/layout'); ?>

<?= $this->section('title'); ?>
change password
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="row mx-4 mt-5 ">
    <div class="colmd-4">

        <div class="card">


            <div class="card-header bg-dark text-white-50 text-center">
                change password
            </div>

            <div class="card-body">
                <?php
                $attributes = ['name' => 'form', 'id' => 'myform'];
                echo   form_open('profile/updatePassword/', $attributes);
                ?>
                <div class="form-group">

                    <input type="password" name="password" id="" class="form-control" value="<?= old('password') ?>" placeholder="password" aria-describedby="helpId">
                    <?php

                    $data = [
                        'name'  => 'new_password',
                        'type'    => 'password',
                        'placeholder' => 'new_password',
                        'class' => 'form-control',
                        'value' => old('new_password')
                    ];



                    echo       form_input($data);

                    ?>
                </div>
                <?php
                echo  form_close();
                ?>
            </div>
            <div class="card-footer text-muted  text-center">
                <input name="env" form="myform" id="" class="me-5 btn btn-primary" type="submit" value="change password">
          
            </div>
        </div>
    </div>
</div>
</div>



<?= $this->endSection(); ?>