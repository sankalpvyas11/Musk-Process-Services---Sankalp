<?= $this->extend('layouts/dashboard') ?>

<?= $this->section("content") ?>

    <h1>User</h1>

    <a href="<?= site_url("/inspection") ?>">back</a>

    <dl>
        <dt>ID</dt>
        <dd><?= esc($user->user_id) ?></dd>

        <dt>Name</dt>
        <dd><?= esc($user->name) ?></dd>

        <dt>Email</dt>
        <dd><?= esc($user->email) ?></dd>

        <dt>Role</dt>
        <dd><?= esc($user->role_id) ?></dd>

        <dt>Created at</dt>
        <dd><?= $user->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $user->updated_at ?></dd>
    </dl>
    
    <!-- if admin / user id = inspection->user_id -->
    <a href="<?= site_url('/user/edit/'.$user->user_id) ?>">Edit</a>
    <a href="<?= site_url('/user/delete/'.$user->user_id) ?>">Delete</a>

<?= $this->endSection() ?>