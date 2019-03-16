<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Test PHP 2019 Gritsyk Andrew</title>
    <link rel="stylesheet" href="/template/css/style.css">
</head>
<body>
<?php if ($usersList): ?>
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">UID</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Gender</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($usersList as $user): ?>
            <tr>
                <th scope="row"><?php echo $user['uid']; ?></th>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['age']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone']; ?></td>
                <td><?php echo $user['gender']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/export/" class="btn btn-info">Export to CSV</a>
<?php else: ?>
    <p class="alert alert-danger"><b>There is no records in database!</b></p>
<?php endif; ?>
<a href="/" class="btn btn-success">Import data</a>
</body>
</html>