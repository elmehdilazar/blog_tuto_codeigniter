<?= $this->extend('layouts/layout.php'); ?>

<?= $this->section('title'); ?>
all posts
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="col-md-10 mx-auto">
    <div class="table-responsive-lg">
        <table class="table table-striped
    table-hover	
    table-borderless
    table-dark
    align-middle">
            <thead class="table-dark">
                <!-- <caption>Table Name</caption> -->
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>description</th>
                    <th>created_at</th>
                    <th>updated_at</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($posts as $post) : ?>
                    <tr class="table-light">

                        <td scope="row"><?= $post->id; ?></td>
                        <td><?= $post->title; ?></td>
                        <td><?= substr($post->description, 0, 50); ?></td>
                        <td><?= $post->created_at; ?></td>
                        <td><?= $post->updated_at; ?></td>
                        <td>
                            <?php $attributes = ['name' => 'form', 'id' => $post->id];
                            echo form_open('admin/posts/delete/' . $post->id, $attributes); ?>

                            <!-- TRUE -->
                            <a class="btn btn-danger btn-sm " href="#" role="button" onclick="event.preventDefault; if(confirm('are you sure deleted this article ?')){
    
                           document.getElementById(<?= $post->id ?>).submit(); 
                        }"><i class="fa fa-trash" aria-hidden="true"></i> </a>



                            <?= form_close() ?>
                        </td>

                    </tr>

                <?php endforeach ?>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>
    <div class="d-flex justify-content-center my-3">
        <?= $pager->links(); ?>
    </div>

</div>
<?= $this->endSection(); ?>