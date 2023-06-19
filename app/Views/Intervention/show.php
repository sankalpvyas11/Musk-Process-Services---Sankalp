<?= $this->extend('layouts/dashboard') ?>

<?= $this->section("content") ?>

    <h1>Intervention</h1>

    <a href="<?= site_url("/inspection") ?>">back</a>

    <dl>
        <dt>ID</dt>
        <dd>
            <?= esc($intervention->inspection_id) ?>
        </dd>

        <dt>Comment</dt>
        <dd><?= esc($intervention->comment) ?></dd>

        <dt>Is completed</dt>
        <dd><?= esc($intervention->is_completed) ?></dd>

        <dt>action_taken</dt>
        <dd><?= esc($intervention->action_taken) ?></dd>

        <dt>attachment</dt>
        <dd><?= esc($intervention->attachment) ?></dd>

        <dt>Inspection</dt>
        <dd><?= esc($intervention->inspection_id) ?></dd>

        <dt>Inspection Type</dt>
        <dd><?= esc($intervention->inspection_type_id) ?></dd>

        <dt>Created at</dt>
        <dd><?= $intervention->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $intervention->updated_at ?></dd>
    </dl>
    
    <!-- if admin / user id = inspection->user_id -->
    <a href="<?= site_url('/intervention/edit/'.$intervention->intervention_id) ?>">Edit</a>
    <a href="<?= site_url('/intervention/delete/'.$intervention->intervention_id) ?>">Delete</a>

<?= $this->endSection() ?>