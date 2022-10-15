<?php $this->extend('layouts/layout'); ?>

<?= $this->section('title'); ?>
post
<?= $this->endSection(); ?>

<?php echo $this->section('content') ?>
<div class="row justify-content-around my-4 float">
    <?php if ($posts) : ?>
        <!-- TRUE -->
        <?php foreach ($posts as $post) : ?>
            <div class=" col-4">

                <div class="card shadow float" style="width:18rem;">
                    <img src="<?= site_url("post_img/" . $post->post_image) ?>" class="card-img-top" alt="...">

                    <div class="card-body">
                        <h1 class="bg-secondary badge p-2 fs-6">date <?= $post->updated_at !== null ? "updated" : "created" ?> : <span class="badge bg-danger"><?= $post->updated_at !== null ? $post-> updated_at->humanize() : $post-> created_at->humanize() ?></span></h1>
                        <span class="badge bg-primary"><?= $name->getUsers($post->user_id); ?></span>
                        <h5 class="card-title">
                            <h1><?= $post->id ?></h1>
                        </h5>

                        <h6 class="card-subtitle mb-2 text-muted ">
                            <h3><?= $post->title ?></h3>
                        </h6>
                        <p class="card-text">
                        <H4><?= $post->description ?></H4>
                        </p>
                        <a href="<?= site_url("posts/show/" . $post->id) ?>" class="btn btn-primary" type="button">show</a>

                    </div>
                </div>
            </div>


        <?php endforeach ?>
    <?php else : ?>



        <div class="alert alert-info" role="alert">
            <strong>no post click </strong> <a href="<?= site_url("posts/ajouter") ?>" class="alert-link badge-success"><span class=" badge text-bg-secondary">here for add article</span> </a>
        </div>

    <?php endif ?>
</div>





<?php $this->endSection() ?>