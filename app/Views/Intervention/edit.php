<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
    <br><br>
    <h2>Edit intervention</h2>


    <?= form_open("/intervention/update/".$intervention->intervention_id) ?>

        <div>
            <label for="comment">Comment</label>
            <input type="text" name="comment" id="comment" value="<?= esc($intervention->comment) ?>">
        </div>

        <div>
            <label for="action_taken">Action Taken</label>
            <input type="text" name="action_taken" id="action_taken" value="<?= esc($intervention->action_taken) ?>">
        </div>

        <div>
            <label for="is_completed">Is Completed</label>
            
            <?php if ($intervention->is_completed == 1){ ?>
                <input type="checkbox" name="is_completed" id="is_completed" checked value="1">
            <?php }else{ ?>
                <input type="checkbox" name="is_completed" id="is_completed">
            <?php } ?>

        </div>

        <div>
            <label for="attachment">Attachment</label>
            <input type="file" name="attachment" id="attachment">
        </div>

        <button>Save</button>

    </form>


<?= $this->endSection();  ?>