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
    <a href="<?= site_url("/site/new") ?>">Add Site</a>
    


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

                
                <?php foreach($sites as $site): ?>
                    <tr>
                        <td><?= $site->site_id ?></td>
                        <td><?= $site->site_name ?></td>
                        <td><?= $site->created_at ?></td>
                        <td><?= $site->updated_at ?></td>
                        <td>
                            <a href="<?= site_url('/site/edit/'.$site->site_id) ?>">Edit</a>
                            <a href="<?= site_url('/site/delete/'.$site->site_id) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 

                
            </tbody>
        </table>

    </section>


<?= $this->endSection();  ?>