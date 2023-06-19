<?= $this->extend('layouts/dashboard'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>

    <style>
        
    </style>

    <br>
    <a href="<?= site_url("/inspection") ?>">Back</a>
    <br><br>
    <h2>Edit User</h2>


    <?= form_open("/user/update/".$user->user_id) ?>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?= esc($user->name) ?>">
        </div>

        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= esc($user->email) ?>">
        </div>


        <?php if ($role_id == 0){ ?>

            <div>
                <label for="role_id">Role</label><br>

                <?php if ($user->role_id == 1){ ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id1" value="1" checked>
                        <label class="form-check-label" for="role_id1">Engineer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id2" value="2">
                        <label class="form-check-label" for="role_id2">Manager</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id0" value="0">
                        <label class="form-check-label" for="role_id0">Admin</label>
                    </div>

                <?php }else if ($user->role_id == 2){ ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id1" value="1">
                        <label class="form-check-label" for="role_id1">Engineer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id2" value="2" checked>
                        <label class="form-check-label" for="role_id2">Manager</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id0" value="0">
                        <label class="form-check-label" for="role_id0">Admin</label>
                    </div>

                <?php }else if ($user->role_id == 0){ ?>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id0" value="0" checked>
                        <label class="form-check-label" for="role_id0">Admin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id1" value="1">
                        <label class="form-check-label" for="role_id1">Engineer</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="role_id" id="role_id2" value="2">
                        <label class="form-check-label" for="role_id2">Manager</label>
                    </div>

                <?php } ?>
                    
            </div>

        <?php } ?>
        

        <button>Save</button>

    </form>

    <br>
    <a href="<?= site_url("/user/editpwd/".$user->user_id) ?>">Change password</a>


<?= $this->endSection();  ?>