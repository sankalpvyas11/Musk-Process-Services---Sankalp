<?= $this->extend('layouts/base') ?>

<?= $this->section('content'); ?>

<br>

<div class="container">
	<div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-6">

            <h1 class="text-center">Register</h1>

            <?php if (session()->has('errors')): ?>
                <ul>
                    <?php foreach(session('errors') as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif ?>

            <?= form_open('signup/create');?>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="<?= old('name') ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= old('email') ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="role_id">Role</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id1" value="1" checked>
                        <label class="form-check-label" for="role_id1">Engineer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id2" value="2">
                        <label class="form-check-label" for="role_id2">Manager</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password confirmation</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <div class="form-group text-center">
                    <input type="submit" name="register" value="Register" class="btn btn-primary">
                </div>

                <div class="form-group text-center">
                    <p>Already have an account? <a href="<?= base_url(); ?>/login">Login here!</a></p>
                </div>

            </form>
        </div>		 
    </div>
</div>

<?= $this->endSection(); ?>