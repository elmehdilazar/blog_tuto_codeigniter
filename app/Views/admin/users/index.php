<?= $this->extend('layouts/layout.php'); ?>

<?= $this->section('title'); ?>
all users
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
                    <th>nom et prenom</th>
                    <th>email</th>
                    <th>role</th>
                    <th colspan="3" class="text-center">action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($users as $user) : ?>
                    <tr class="table-light">

                        <td scope="row"><?= $user->id; ?></td>
                        <td><?= $user->name; ?></td>
                        <td><?= $user->email; ?></td>
                        <td>
                            <?php if ($user->is_admin) : ?>


                                <span class="badge bg-success">admin</span>
                            <?php else : ?>
                                <span class="badge bg-secondary">user</span>
                                <!-- FALSE -->
                            <?php endif ?>

                        </td>
                        <td>
                            <?php $attributes = ['name' => 'form', 'id' => $user->id];
                            echo form_open('admin/users/delete/' . $user->id, $attributes); ?>

                            <!-- TRUE -->
                            <button class="btn btn-danger btn-sm " <?= $user->id === session('user_id') ? "disabled " : "" ?> onclick="event.preventDefault; if(confirm('are you sure deleted this article ?')){
    
                           document.getElementById(<?= $user->id ?>).submit(); 
                        }"><i class="fa fa-trash" aria-hidden="true"></i> </button>



                        </td>
                        <td>
                            <?= form_close() ?>
                            <?php $attributes = ['name' => 'form', 'id' => 'up' . $user->id];
                            echo form_open('admin/users/update/' . $user->id, $attributes); ?>

                            <!-- TRUE -->
                            <button class="btn btn-sm <?= $user->is_admin ? "btn-danger " : "btn-success" ?>  " <?= $user->id === session('user_id') ? "disabled " : "" ?> onclick="event.preventDefault; if(confirm('are you sure updated this user ?')){
    
                           document.getElementById('up'+<?= $user->id ?>).submit(); 
                        }"><i class="fa <?= $user->is_admin ? "fa-times" : "fa-user-plus" ?> " aria-hidden="true"></i> </button>



                            <?= form_close() ?>
                        </td>
                        <td>
                            <?= form_close() ?>
                            <?php $attributes = ['name' => 'form', 'id' => 'act' . $user->id];
                            echo form_open('admin/users/Active/' . $user->id, $attributes); ?>

                            <!-- TRUE -->
                            <button class="btn btn-sm <?= $user->is_active ? "btn-danger " : "btn-success" ?>  " <?= $user->id === session('user_id') ? "disabled " : "" ?> onclick="event.preventDefault; if(confirm('are you sure updated this user ?')){
    
                           document.getElementById('act'+<?= $user->id ?>).submit(); 
                        }"><i class="fa <?= $user->is_active ? "fa-times" : "fa-user-plus" ?> " aria-hidden="true"></i> </button>



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