<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
    <br><br>
    <h2>Edit inspection</h2>


    <?= form_open("/inspection/update/".$inspection->inspection_id) ?>


        <div>
            <label for="site_id">Please select a site</label>
            <select class="form-control" name="site_id">
                <option value="<?= $siteCurr->site_id ?>" selected><?= $siteCurr->site_name ?></option>
                <hr class="dropdown-divider">

                <?php foreach($sites as $site): ?>
                    <option value="<?= $site->site_id ?>"><?= $site->site_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>


        <div>
            <label for="work_area">Work Area</label>
            <input type="text" name="work_area" id="work_area" value="<?= esc($inspection->work_area) ?>">
        </div>

        <div>
            <label for="inspection_supervisor">Supervisor</label>
            <input type="text" name="inspection_supervisor" id="inspection_supervisor" value="<?= esc($inspection->inspection_supervisor) ?>">
        </div>

        <div>
            <label for="date">Inspection Date</label>
            <input type="date" name="date" value="<?= esc($inspection->date) ?>">
        </div>



        <div>
            <label for="job_description">Job Description</label>
            <input type="text" name="job_description" id="job_description" value="<?= esc($inspection->job_description) ?>">
        </div>

        <div>
            <label for="inspection_inspector">Supervisor</label>
            <input type="text" name="inspection_inspector" id="inspection_inspector" value="<?= esc($inspection->inspection_inspector) ?>">
        </div>

        <div>
            <label for="type_id">Type</label>
            <select class="form-control" name="type_id">

                <option value="<?= $typeCurr->type_id ?>" selected><?= $typeCurr->type_name ?></option>
                <hr class="dropdown-divider">

                <?php foreach($types as $type): ?>
                    <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                <?php endforeach; ?>
            </select>
        </div>

    

        <button>Save</button>

    </form>


<?= $this->endSection();  ?>