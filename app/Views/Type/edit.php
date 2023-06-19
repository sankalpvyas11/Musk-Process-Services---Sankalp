<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/type/typelist") ?>">Back</a>
    <br><br>
    <h2>Edit site</h2>


    <?= form_open("/type/update/".$type->type_id) ?>

        <div>
            <label for="type_name">Name</label>
            <input type="text" name="type_name" id="type_name" value="<?= esc($type->type_name) ?>">
        </div>

        <button>Save</button>

    </form>


<?= $this->endSection();  ?>