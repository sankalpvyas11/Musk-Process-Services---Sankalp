<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        .infos{
            width: 75%;
            margin-left: 10%;
            margin-top: 5%;
        }

        .insp_check{
            margin-left: 40%;
        }

        

    </style>

    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
    <br><br>
    <h2>Site Inspection List</h2>

    <section class="infos">
        
        <?= form_open("/inspection/inspectionlist") ?>
            <div class="form-row row">
                <div class="col">
                    <label class="label" for="">Site :</label>
                    <select class="form-select" id="site_id" name="site_id">
                        <option value="All">All</option>
                        <?php foreach($sites as $site): ?>
                            <option value="<?= $site->site_id ?>"><?= $site->site_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php if($role_id != 1){ ?>
                    <div class="col">
                        <label class="label" for="">Entered By :</label>
                        <select class="form-select" id="user_id" name="user_id">
                            <option selected>All</option>
                            <?php foreach($users as $user): ?>
                                <option value="<?= $user->user_id ?>"><?= $user->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php } ?>
                <div class="col">
                    <label class="label" for="">Date :</label>
                    <div class="row">
                        <div class="col"> 
                        <select class="form-select" id="inlineFormCustomSelect" name="month">
                            <option value="All" selected>All</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        </div>
                        <div class="col">
                        <select class="form-select" id="inlineFormCustomSelect" name="year">
                            <option value="All" selected>All</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                            <option value="2019">2019</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <label class="label" for=""></label><br>
                    <button type="submit" class="btn btn-light search">Search</button>
                </div>
            </div>
        </form>

    </section>



    <section class="infos">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Site</th>
                    <th>Work Area</th>
                    <th>Inspector</th>
                    <th>Entered By</th>
                    <th>Total<br>Interventions</th>
                    <th>Outstanding ?</th>
                    <th>Inspection report</th>
                    <th>Details</th>

                    <?php if($role_id == 0){ ?>  
                        <th>Actions</th>
                    <?php } ?> 

                </tr>
            </thead>
            <tbody>
                <?php foreach($inspections as $inspection): ?>
                    <tr>
                        <td><?= changeDateFormat($inspection->date) ?></td>

                        <?php foreach($sites as $site): ?>
                            <?php if($site->site_id == $inspection->site_id): ?>
                                <td><?= $site->site_name ?></td>
                            <?php endif; ?>            
                        <?php endforeach; ?>

                        <td><?= $inspection->work_area ?></td>
                        <td><?= $inspection->inspection_inspector ?></td>
                        <td><?= $inspection->user_id ?></td>

                        <?php $countinter = 0; ?>
                        <?php foreach($interventions as $intervention): ?>
                            <?php if($intervention->inspection_id == $inspection->inspection_id): ?>
                                <?php $countinter += $intervention->intervention_nb; ?>
                            <?php endif; ?>            
                        <?php endforeach; ?>
                        <td><?= $countinter ?></td>
                        <td></td>
                        <td>
                            <?php if($inspection->user_id == current_user()->user_id || $inspection->manager_id == current_user()->user_id || $role_id == 0){ ?>
                                <a href="<?= site_url("/inspection/report/$inspection->inspection_id") ?>">View</a>
                            <?php } ?> 
                        </td>

                        <td><a href="<?= site_url("/inspection/show/$inspection->inspection_id") ?>">View</a></td>

                        <?php if($role_id == 0){ ?>
                            <td>
                                <a href="<?= site_url('/inspection/edit/'.$inspection->inspection_id) ?>">Edit</a>
                                <a href="<?= site_url('/inspection/delete/'.$inspection->inspection_id) ?>">Delete</a>
                            </td>  
                        <?php } ?>

                    </tr>
                <?php endforeach; ?>                
            </tbody>
        </table>

    </section>


<?= $this->endSection();  ?>