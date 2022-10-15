<?php $this->extend('layouts/layout'); ?>

<?= $this->section('title'); ?>
show
<?= $this->endSection(); ?>

<?php echo $this->section('content') ?>

<div class="row mx-auto float">
    <div class="colmd-8">
        <div class="card">
            <img src="<?= site_url("post_img/" . $posts->post_image) ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">
                    <h1><span class="badge bg-success"><?= $name ;?></span></h1>
                </h5>

                <h6 class="card-subtitle mb-2 text-muted ">
                    <h3><?= $posts->title ?></h3>
                </h6>
                <p class="card-text">
                <H4><?= $posts->description ?></H4>
                </p>
                <?php $attributes = ['name' => 'form', 'id' => 'dpost'];
                echo form_open('posts/delete/' . $posts->id, $attributes); ?>
                <?php if ($owner) : ?>
                    <!-- TRUE -->
                    <a class="btn btn-info" aria-current="page" href="<?= site_url("/posts/editer/" . $posts->id) ?>">editer</a>

                    <button class="btn btn-sm btn-danger" onclick="event.preventDefault; if(confirm('are you sure deleted this article ?')){
    
                           document.getElementById('dpost').submit(); 
                        }">
                        delete
                    </button>
                <?php endif ?>

                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>


<?php $this->endSection() ?>