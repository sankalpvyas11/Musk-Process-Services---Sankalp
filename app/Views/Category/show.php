<?= $this->extend('layouts/base') ?>

<?= $this->section("content") ?>

    <h1>Category</h1>

    <a href="<?= site_url("/inspection") ?>">&laquo; back to index</a>

    <dl>
        <dt>ID</dt>
        <dd>
            <?= esc($category->category_id) ?>
        </dd>

        <dt>Site Name</dt>
        <dd><?= esc($category->category_name) ?></dd>

        <dt>Created at</dt>
        <dd><?= $category->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $category->updated_at ?></dd>
    </dl>

<?= $this->endSection() ?>