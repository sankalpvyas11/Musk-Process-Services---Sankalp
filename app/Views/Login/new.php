<?= $this->extend('layouts/base') ?>

<?= $this->section("content") ?>

<div class="container">
	<div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-6">

            <h1 class="text-center">Login</h1>

    <?= form_open('login/create')?>

    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?= old('email') ?>" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
        <button>Log in</button>
        </div>
    </div>
</div>

    </form>

<?= $this->endSection() ?>