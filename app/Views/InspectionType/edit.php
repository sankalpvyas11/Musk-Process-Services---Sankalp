<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/inspectiontype/inspectiontypelist") ?>">Back</a>
    <br><br>
    <h2>Edit site</h2>


    <?= form_open("/inspectiontype/update/".$inspectiontype->inspection_type_id) ?>

        <div>
            <label for="inspection_type_name">Name</label>
            <input type="text" name="inspection_type_name" id="inspection_type_name" value="<?= esc($inspectiontype->inspection_type_name) ?>">
        </div>

        <select name="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
            <?php endforeach; ?>
        </select>

        <button>Save</button>

    </form>


<?= $this->endSection();  ?>