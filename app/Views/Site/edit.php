<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/site/sitelist") ?>">Back</a>
    <br><br>
    <h2>Edit site</h2>


    <?= form_open("/site/update/".$site->site_id) ?>

        <div>
            <label for="site_name">Name</label>
            <input type="text" name="site_name" id="site_name" value="<?= esc($site->site_name) ?>">
        </div>

        <button>Save</button>

    </form>


<?= $this->endSection();  ?>