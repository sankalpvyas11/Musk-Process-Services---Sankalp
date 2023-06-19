<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Report</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<style>
    .infos{
            width: 75%;
            margin-left: 10%;
            margin-top: 5%;
    }

    
    .table { 
        display: table; width: 100%; border-collapse: collapse; 
    }
    .table-row { 
        display: table-row; 
    }
    .table-cell { 
        display: table-cell; border: 1px solid black; padding: 1em; 
    }

</style>

<body>

    <section class="infos">

        Site: <?= $site->site_name ?><br>
        Work Area: <?= $inspection->work_area ?><br>
        Supervisor: <?= $user->name ?><br><br>

        Completed By: <?= $site->site_name ?><br>
        Job Description: <?= $inspection->work_area ?><br>
        Inspector: <?= $user->name ?><br>
        Type: <?= $type->type_name ?>

    </section>




    <section class="infos">
        
        <table class="table table-bordered new-site">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Interventions</th>
                    <th scope="col">Comment</th>
                    <th scope="col">Completed</th>
                    <th scope="col">Action Taken</th>
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
                    </tr>
                    <!-- Show all inspection types in each category  -->
                    <?php foreach($inspectiontypes as $inspectiontype): ?>

                        <?php if ($inspectiontype->category_id == $category->category_id): ?>

                            <!-- hidden input for the id of inspection type -->
                            <input type="hidden" id="inspection_type_id" name="inspection_type_id<?= $inspectiontype->inspection_type_id ?>" value="<?= $inspectiontype->inspection_type_id ?>">

                            <!-- All intervention types -->
                            <tr>
                                <td scope="row"><?= $inspectiontype->inspection_type_id ?>. <?= $inspectiontype->inspection_type_name ?></td>
                                <td>             
                                    <div class="">
                                        <!-- nb of intervention -->
                                        <?php $nb = 0; ?>
                                        <?php foreach($interventions as $intervention): ?>
                                            <?php if ($intervention->inspection_type_id == $inspectiontype->inspection_type_id): ?>
                                                <?= $intervention->intervention_nb ?>
                                                <?php $nb++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php if ($nb == 0): ?>
                                            0
                                        <?php endif; ?>
                                    </div> 
                                </td>
                                <td>
                                    <div class="">
                                        <!-- Comment -->
                                        <?php foreach($interventions as $intervention): ?>
                                            <?php if ($intervention->inspection_type_id == $inspectiontype->inspection_type_id): ?>
                                                <?= $intervention->comment ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>                
                                </td>                           
                                <td>   
                                    <div class="check">
                                        <!-- Completed -->
                                        <?php foreach($interventions as $intervention): ?>
                                            <?php if ($intervention->inspection_type_id == $inspectiontype->inspection_type_id): ?>
                                                <?= $intervention->is_completed ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>  
                                </td>
                                <td>
                                    <div class="">
                                        <!-- Action Taken -->
                                        <?php foreach($interventions as $intervention): ?>
                                            <?php if ($intervention->inspection_type_id == $inspectiontype->inspection_type_id): ?>
                                                <?= $intervention->action_taken ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div> 
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                <?php endforeach; ?>


                <tr>
                    <th scope="row">Total Interventions By Section</th>
                    <td></td>
                </tr>
                <?php $overall=0; ?>

                <?php foreach($categories as $category): ?>
                    <?php $totalBySection=0; ?>
                    <tr>
                        <td>
                            <?= $category->category_name ?>
                        </td>
                        <td>
                            <?php foreach($inspectiontypes as $inspectiontype): ?>
                                <?php if ($inspectiontype->category_id == $category->category_id): ?>
                                    <?php foreach($interventions as $intervention): ?>
                                        <?php if ($intervention->inspection_type_id == $inspectiontype->inspection_type_id): ?>
                                            <?php $totalBySection++; ?>
                                            <?php $overall++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?= $totalBySection; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>  

                <tr>
                    <th scope="row">Overall</th>
                    <td><?= $overall; ?></td>
                </tr>

            </tbody>
        </table>

    </section>

    

</body>

</html>