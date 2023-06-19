<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <h2>Delete intervention</h2>  

    <p>Are you sure?</p>

    <?= form_open("/intervention/delete/".$intervention->intervention_id) ?>

        <button>Yes</button>
        <a href="<?= site_url('/intervention/show/'.$intervention->intervention_id) ?>">Cancel</a>

    </form>

<?= $this->endSection();  ?>