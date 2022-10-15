<?php $this->extend('layouts/layout');   ?>

<?= $this->section('title'); ?>
add
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
                add post
            </div>
            <div class="card-body">
                <?php
                $attributes = ['name' => 'form', 'id' => 'myform'];
                echo   form_open_multipart('posts/store', $attributes);
                ?>
                <div class="form-group">

                    <input type="text" name="title" id="" class="form-control" value="<?= old("title") ?>" placeholder="title" aria-describedby="helpId">
                    <?php

                    $data = [
                        'name'  => 'description',
                        'row'    => '4',
                        'placeholder' => 'description',
                        'class' => 'form-control',
                        'value' => old('description')
                    ];

   echo form_textarea($data);

                    ?>
                   
                        <div class="custom-file">
                            <div class="input-group mb-3">
                                <input id="file_upload" name="post_image" type="file" class="custom-file-input form-control" aria-label="File Upload" />
                            </div>
                        </div>
                    </div>
                    <?php
                    echo  form_close();
                    ?>
                </div>



            </div>
            <?php
            echo  form_close();
            ?>
        </div>
        <div class="card-footer text-muted text-center">
            <input name="env" form="myform" id="" class="btn btn-primary" type="submit" value="add">
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>