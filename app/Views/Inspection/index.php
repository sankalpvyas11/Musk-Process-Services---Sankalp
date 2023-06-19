<?= $this->extend('layouts/dashboard'); ?>


<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <div class="div-box2">
        <h3>Welcome <?= esc(current_user()->name) ?>! 
        <?php if (current_user()->role_id == 0){ ?>
            (Admin)
        <?php }else if (current_user()->role_id == 1){ ?>
            (Engineer)
        <?php }else if (current_user()->role_id == 2){ ?>
            (Manager)
        <?php } ?>
        </h3>
        <p>No. of interventions: <?= $nb_interventions; ?></p>
        <p><a href="<?= base_url('/intervention/interventionlist/'.current_user()->user_id); ?>">All of my interventions</a></p>
    </div>

    <h3 class="text-center">All Sites:</h3>
    <div class="div-box1">
        <iframe class="text-center" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9704.124498492634!2d-0.3264364!3d52.5509619!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xae5e2f8032b0891a!2sMusk%20Process%20Services!5e0!3m2!1sen!2suk!4v1647858062490!5m2!1sen!2suk" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <div class="text-center menu">
    <?php if (current_user()->role_id == 1){ ?>
        <a href="<?= site_url("/inspection/newinspection") ?>" class="btn btn-primary menu_insp" role="button">New Site Inspection</a><br>
    <?php } ?>
    <!-- To be checked for specific permissions as per role table -->
    <?php if (current_user()->role_id == 0){ ?>
        <a href="<?= site_url("/Site/new") ?>" class="btn btn-primary menu_insp" role="button">Add Sites</a><br>
        <a href="<?= site_url("/Signup/new") ?>" class="btn btn-primary menu_insp" role="button">Register User</a><br>
    <?php } ?>
        
        <a href="<?= site_url("/inspection/inspectionlist") ?>" class="btn btn-primary menu_insp" role="button">Site Inspection List</a><br>
        <!-- <a href="<?= site_url("/inspection/newinspection") ?>" class="btn btn-primary menu_insp" role="button">Inspections Action List</a> -->
    </div>

<?= $this->endSection();  ?>
















