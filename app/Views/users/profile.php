<?= $this->extend('layouts/layout'); ?>
<?= $this->section('title'); ?>
<!-- CODE HERE -->
<?= $this->endSection(); ?>
<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url("/css/style.css") ?>">
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>

<div class="row my-4">
    <div class="col-md-8 mx-auto">
        <div class="card p-3 d-flex flex-row justify-content-around   ">
            <img class="rounded-circle shadow-lg" src="<?= base_url("uers_post/". $user->user_image) ;?>" alt="..." width="200" height="200">
            <div class="rp p-2">
                <p>
                    Nom & prenom
                    <span class="text-primary">
                        <?= $user->name; ?>
                    </span>
                </p>
                
                <p>
                    email:
                    <span class="text-danger">
                        <?= $user->email; ?>
                    </span>
                </p>
                <a href="<?=site_url('/Profile/editProfileForm') ?>" class="btn btn-sm btn-warning">
                    <i class="fa fa-edit" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>