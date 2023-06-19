<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Site</title>
</head>
<body>
    <?= form_open("/site/create") ?>

        <div>
            <label for="site_name">Site Name :</label>
            <input type="text" name="site_name" id="site_name">
        </div>

        <button>Send</button>

    </form> 

</body>
</html>