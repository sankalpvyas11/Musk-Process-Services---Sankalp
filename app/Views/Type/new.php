<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Type</title>
</head>
<body>
    <?= form_open("/type/create") ?>

        <div>
            <label for="type_name">Type Name :</label>
            <input type="text" name="type_name" id="type_name">
        </div>

        <button>Send</button>

    </form> 

</body>
</html>