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
    <h2>All Inspection Types</h2>

    <br>
    <a href="<?= site_url("/inspectiontype/new") ?>">Add Inspection Type</a>
    


    <section class="infos">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Created at</th>
                    <th>Updated_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                
                <?php foreach($inspectiontypes as $inspectiontype): ?>
                    <tr>
                        <td><?= $inspectiontype->inspection_type_id ?></td>
                        <td><?= $inspectiontype->inspection_type_name ?></td>
                        <td><?= $inspectiontype->category_id ?></td>
                        <td><?= $inspectiontype->created_at ?></td>
                        <td><?= $inspectiontype->updated_at ?></td>
                        <td>
                            <a href="<?= site_url('/inspectiontype/edit/'.$inspectiontype->inspection_type_id) ?>">Edit</a>
                            <a href="<?= site_url('/inspectiontype/delete/'.$inspectiontype->inspection_type_id) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 

                
            </tbody>
        </table>

    </section>


<?= $this->endSection();  ?>