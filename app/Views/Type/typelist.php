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
    <h2>All Types</h2>

    <br>
    <a href="<?= site_url("/type/new") ?>">Add Type</a>
    


    <section class="infos">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Updated_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                
                <?php foreach($types as $type): ?>
                    <tr>
                        <td><?= $type->type_id ?></td>
                        <td><?= $type->type_name ?></td>
                        <td><?= $type->created_at ?></td>
                        <td><?= $type->updated_at ?></td>
                        <td>
                            <a href="<?= site_url('/type/edit/'.$type->type_id) ?>">Edit</a>
                            <a href="<?= site_url('/type/delete/'.$type->type_id) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 

                
            </tbody>
        </table>

    </section>


<?= $this->endSection();  ?>