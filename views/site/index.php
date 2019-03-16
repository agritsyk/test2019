<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/template/css/style.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.js"></script>
    <title>Test PHP 2019 Gritsyk Andrew</title>
</head>
<body>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-5 my-auto" style="text-align: center">
            <form action="" method="post" enctype="multipart/form-data">
                <label class="control-label">Choose your file</label>
                <input type="file" class="filestyle" name="userfile" id="BSbtnsuccess"/>
                <br>
                <input class="btn btn-success btn-block" type="submit" name="submit" value="Import">
                <a href="/clear/" class="btn btn-danger btn-block">Clear all records</a>
            </form>
            <br>
            <a href="/results/" class="btn btn-info btn-block">View results</a>

            <?php if (isset($errors) && is_array($errors)): ?>
                <br>
                <?php foreach ($errors as $error): ?>
                    <div class="alert alert-danger"> <?php echo $error; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (empty($errors) && isset($infoMessage)): ?>
                <br>
                <div class="alert alert-success"> <?php echo $infoMessage; ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>