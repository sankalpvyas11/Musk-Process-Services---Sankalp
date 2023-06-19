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
    <h2>All Categories</h2>

    <br>
    <a href="<?= site_url("/category/new") ?>">Add Category</a>
    


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

                
                <?php foreach($categories as $category): ?>
                    <tr>
                        <td><?= $category->category_id ?></td>
                        <td><?= $category->category_name ?></td>
                        <td><?= $category->created_at ?></td>
                        <td><?= $category->updated_at ?></td>
                        <td>
                            <a href="<?= site_url('/category/edit/'.$category->category_id) ?>">Edit</a>
                            <a href="<?= site_url('/category/delete/'.$category->category_id) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?> 

                
            </tbody>
        </table>

    </section>


<?= $this->endSection();  ?>