<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <h2>Delete inspection</h2>  

    <p>Are you sure?</p>

    <?= form_open("/inspection/delete/".$inspection->inspection_id) ?>

        <button>Yes</button>
        <a href="<?= site_url('/inspection/show/'.$inspection->inspection_id) ?>">Cancel</a>

    </form>

<?= $this->endSection();  ?>