<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/category/categorylist") ?>">Back</a>
    <br><br>
    <h2>Edit category</h2>


    <?= form_open("/category/update/".$category->category_id) ?>

        <div>
            <label for="category_name">Name</label>
            <input type="text" name="category_name" id="category_name" value="<?= esc($category->category_name) ?>">
        </div>

        <button>Save</button>

    </form>


<?= $this->endSection();  ?>