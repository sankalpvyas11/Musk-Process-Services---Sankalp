<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <h2>Delete user</h2>  

    <p>Are you sure?</p>

    <?= form_open("/user/delete/".$user->user_id) ?>

        <button>Yes</button>
        <a href="<?= site_url('/user/show/'.$user->user_id) ?>">Cancel</a>

    </form>

<?= $this->endSection();  ?>