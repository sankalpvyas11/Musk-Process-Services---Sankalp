<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <!-- if token = 1 -->
    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
  
    <br><br>
    <h2>Change Password</h2>


    <?php if (session()->has('errors')): ?>
        <ul>
            <?php foreach(session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>


    <?= form_open("/user/updatepwd/".$user->user_id) ?>

        <div>
            <label for="password">New password</label>
            <input type="password" name="password">
        </div>

        <div>
            <label for="password_confirmation">Confirm your password</label>
            <input type="password" name="password_confirmation">
        </div>


        <button>Save</button>

    </form>

<?= $this->endSection();  ?>