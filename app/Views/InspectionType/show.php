<?= $this->extend('layouts/base') ?>

<?= $this->section("content") ?>

    <h1>Type</h1>

    <a href="<?= site_url("/inspectiontype") ?>">&laquo; back to index</a>

    <dl>
        <dt>ID</dt>
        <dd>
            <?= esc($inspection_type->inspection_type_id) ?>
        </dd>

        <dt>Site Name</dt>
        <dd><?= esc($inspection_type->inspection_type_name) ?></dd>

        <dt>Created at</dt>
        <dd><?= $inspection_type->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $inspection_type->updated_at ?></dd>
    </dl>

<?= $this->endSection() ?>