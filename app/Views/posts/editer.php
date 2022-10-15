<?= $this->extend('layouts/layout'); ?>

<?= $this->section('title'); ?>
edit post
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="row mx-4 mt-5 ">
    <div class="colmd-4">

        <div class="card">


            <div class="card-header bg-dark text-white-50 text-center">
                edit post
            </div>

            <div class="card-body">
                <?php
                $attributes = ['name' => 'form', 'id' => 'myform'];
                echo   form_open('posts/update/' . $post->id, $attributes);
                ?>
                <div class="form-group">

                    <input type="text" name="title" id="" class="form-control" value="<?= old('title', $post->title) ?>" placeholder="title" aria-describedby="helpId">
                    <?php

                    $data = [
                        'name'  => 'description',
                        'row'    => '4',
                        'placeholder' => 'description',
                        'class' => 'form-control',
                        'value' => old('description', $post->description)
                    ];



                    echo       form_textarea($data);

                    ?>
                </div>
                <?php
                echo  form_close();
                ?>
            </div>
            <div class="card-footer text-muted text-center">
                <input name="env" form="myform" id="" class="btn btn-primary" type="submit" value="edit">
            </div>
        </div>
    </div>
</div>
</div>



<?= $this->endSection(); ?>