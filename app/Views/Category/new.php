<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Category</title>
</head>
<body>
    <?= form_open("/category/create") ?>

        <div>
            <label for="category_name">Category Name :</label>
            <input type="text" name="category_name" id="category_name">
        </div>

        <button>Send</button>

    </form> 

</body>
</html>