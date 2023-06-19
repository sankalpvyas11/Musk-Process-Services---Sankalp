<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        .infos{
            width: 75%;
            margin-left: 10%;
            margin-top: 5%;
        }

        .insp_check{
            margin-left: 40%;
        }

        
    </style>

    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
    <br><br>
    <h2>All Users</h2>


    <section class="infos">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created at</th>
                    <th>Updated at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>


                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user->user_id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->email ?></td>

                        <?php if ($user->role_id == 0){ ?>
                            <td>Admin</td>
                        <?php }else if ($user->role_id == 1){ ?> 
                            <td>Engineer</td>
                        <?php }else if ($user->role_id == 2){ ?>
                            <td>Manager</td>
                        <?php } ?>

                        <td><?= $user->created_at ?></td>
                        <td><?= $user->updated_at ?></td>
                        <td>
                            <a href="<?= site_url('/user/edit/'.$user->user_id) ?>">Edit</a>
                            <a href="<?= site_url('/user/delete/'.$user->user_id) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 

                
            </tbody>
        </table>

    </section>


<?= $this->endSection();  ?>