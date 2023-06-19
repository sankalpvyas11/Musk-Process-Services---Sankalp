<?= $this->extend('layouts/base') ?>

<?= $this->section("content") ?>

    <h1>Site</h1>

    <a href="<?= site_url("/site") ?>">&laquo; back to index</a>

    <dl>
        <dt>ID</dt>
        <dd>
            <?= esc($site->site_id) ?>
        </dd>

        <dt>Site Name</dt>
        <dd><?= esc($site->site_name) ?></dd>

        <dt>Created at</dt>
        <dd><?= $site->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $site->updated_at ?></dd>
    </dl>

<?= $this->endSection() ?>