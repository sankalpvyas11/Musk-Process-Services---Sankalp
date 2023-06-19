<?= $this->extend('layouts/base'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

<!-- slider section begins -->
<section>
    <?= $this->include('partials/slider'); ?>
</section>
<!-- slider section ends-->


<!-- features section begins -->
<section>
    <section id="features">
        <?= $this->include('partials/features'); ?>
    </section>
<!-- features section ends -->
    
<!-- about section begins -->
<section id="about">
    <?= $this->include('partials/about');  ?>
</section>
<!-- about section ends -->

<!-- blog section begins -->
<section>
<?= $this->include('partials/blog');  ?>   
</section>
<!-- blog section ends -->

<?= $this->endSection();  ?>