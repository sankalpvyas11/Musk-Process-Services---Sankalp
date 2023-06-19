<?= $this->extend('layouts/base') ?>

<?= $this->section("content") ?>

    <h1>Type</h1>

    <a href="<?= site_url("/type") ?>">&laquo; back to index</a>

    <dl>
        <dt>ID</dt>
        <dd>
            <?= esc($type->type_id) ?>
        </dd>

        <dt>Site Name</dt>
        <dd><?= esc($type->type_name) ?></dd>

        <dt>Created at</dt>
        <dd><?= $type->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $type->updated_at ?></dd>
    </dl>

<?= $this->endSection() ?>