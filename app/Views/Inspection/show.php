<?= $this->extend('layouts/inspection') ?>

<?= $this->section("content") ?>


    <h1>Inspection</h1>

    <a href="<?= site_url("/inspection") ?>">&laquo; back to index</a>

    <dl>
        <dt>ID</dt>
        <dd>
            <?= esc($inspection->inspection_id) ?>
        </dd>

        <dt>Job Description</dt>
        <dd><?= esc($inspection->job_description) ?></dd>
        <dt>Work Area</dt>
        <dd><?= esc($inspection->work_area) ?></dd>
        <dt>supervisor</dt>
        <dd><?= esc($inspection->inspection_supervisor) ?></dd>

        <dt>Created at</dt>
        <dd><?= $inspection->created_at ?></dd>

        <dt>Updated at</dt>
        <dd><?= $inspection->updated_at ?></dd>
    </dl>

<?= $this->endSection() ?>