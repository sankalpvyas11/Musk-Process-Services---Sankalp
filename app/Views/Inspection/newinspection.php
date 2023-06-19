<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        .infos{
            width: 75%;
            margin-left: 10%;
            margin-top: 5%;
        }

        .test{
            display:inline-flex;
            margin-top: 5%;
        }

        .insp_input{
            margin-left:5%;
        }

        .badge{
            width:130px;
            font-weight: 5;
        }

        .check{
            text-align: center;
        }

    </style>

    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
    <br><br>
    <h2>New Site Inspection</h2>

    <br>
    <?php if (session()->has('errors')): ?>
        <ul>
            <?php foreach(session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif ?>
    <br>

    <?= form_open_multipart("/inspection/create") ?>

        <!-- user_id -->
        <input type="hidden" id="user_id" name="user_id" value="<?= $user_id ?>">

        <section class="infos" name="">
            <div class="form-group">
                <label for="site_id">Please select a site</label>
                <select class="form-control" style="width: 35%;" name="site_id">
                <?php foreach($sites as $site): ?>
                    <option value="<?= $site->site_id ?>"><?= $site->site_name ?></option>
                <?php endforeach; ?>
                </select>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group test">
                        <h5><span class="badge bg-primary">Work Area</span></h5>
                        <input type="text" class="form-control insp_input" name="work_area">
                    </div>
                    <div class="form-group test">
                        <h5><span class="badge bg-primary">Supervisor</span></h5>
                        <input type="text" class="form-control insp_input" name="inspection_supervisor"> 
                    </div> 
                    <div class="form-group test">
                        <h5><span class="badge bg-primary">Inspection Date</span></h5>
                        <input type="date" class="form-control insp_input" name="date">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group test">
                        <h5><span class="badge bg-primary">Job Description</span></h5>
                        <input type="text" class="form-control insp_input" name="job_description">
                    </div>
                    <div class="form-group test">
                    <h5><span class="badge bg-primary">Inspector</span></h5>
                        <input type="text" class="form-control insp_input" name="inspection_inspector">
                    </div>
                    <br>
                    <div class="form-group test">
                    <h5><span class="badge bg-primary">Type</span></h5>
                        <select class="form-control insp_input" style="width: auto;" id="insp_type" name="type_id">
                        <?php foreach($types as $type): ?>
                            <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div> 
                </div>
            </div>
        </section>

        <section class="infos" name ="">

            <table class="table table-bordered new-site">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Interventions</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Completed</th>
                        <th scope="col">Action Taken</th>
                        <td scope="col">Optionnal Attachment <br>(PDF or JPG)</td>
                    </tr>
                </thead>
                <tbody>
                    <!-- For each category (A. , B. , ..) -->
                    <?php foreach($categories as $category): ?>
                        <tr>
                            <th scope="row"><?= $category->category_name ?></th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <!-- Show all inspection types in each category  -->
                        <?php foreach($inspection_types as $inspection_type): ?>

                            <?php if ($inspection_type->category_id == $category->category_id): ?>

                                <!-- hidden input for the id of inspection type -->
                                <input type="hidden" id="inspection_type_id" name="inspection_type_id<?= $inspection_type->inspection_type_id ?>" value="<?= $inspection_type->inspection_type_id ?>">

                                <!-- All intervention types -->
                                <tr>
                                    <td scope="row"><?= $inspection_type->inspection_type_id ?>. <?= $inspection_type->inspection_type_name ?></td>
                                    <td>             
                                        <div class="form-group">
                                            <select class="form-control" id="intervention_nb" name="intervention_nb<?= $inspection_type->inspection_type_id ?>">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div> 
                                    </td>
                                    <td>
                                        <div class="">
                                            <input type="text" class="form-control" id="comment" name="comment<?= $inspection_type->inspection_type_id ?>">
                                        </div>                
                                    </td>                           
                                    <td>   
                                        <div class="check">
                                            <input type="checkbox" class="form-check-input insp_check" id="is_completed" name="is_completed<?= $inspection_type->inspection_type_id ?>" value="1">
                                        </div>  
                                    </td>
                                    <td>
                                        <div class="">
                                            <input type="text" class="form-control" id="action_taken" name="action_taken<?= $inspection_type->inspection_type_id ?>">
                                        </div> 
                                    </td>
                                    <td>
                                        <div class="mb-3">
                                            <input class="form-control form-control-sm" id="attachment" name="attachment<?= $inspection_type->inspection_type_id ?>" type="file">
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    <?php endforeach; ?>
                </tbody>
            </table>


        </section>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit Audit</button>
        </div>

    </form>

<?= $this->endSection();  ?>





