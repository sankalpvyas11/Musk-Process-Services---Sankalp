<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Inspection Type</title>
</head>
<body>
    <?= form_open("/inspectiontype/create") ?>

        <div>
            <label for="inspection_type_name">Inspection Type Name :</label>
            <input type="text" name="inspection_type_name" id="inspection_type_name">
        </div>

        <select name="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
            <?php endforeach; ?>
        </select>

        <button>Send</button>

    </form> 

</body>
</html>