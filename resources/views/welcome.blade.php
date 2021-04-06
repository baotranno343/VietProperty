<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="api/hinh" method="post" enctype="multipart/form-data">
        @csrf
        <input required type="file" class="form-control" name="images[]" placeholder="image" multiple>
        <input type="submit" value="Submit">
    </form>

    <form action="api/hinh/37" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input required type="file" class="form-control" name="images[]" placeholder="image" multiple>
        <input type="submit" value="update">
    </form>
</body>

</html>