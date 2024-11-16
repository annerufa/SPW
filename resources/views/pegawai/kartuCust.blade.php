<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<img src="data:image/png;base64,<?= base64_encode(file_get_contents( public_path('assets/img/logo.png')) )?>" alt="Image">

    <!-- <img src="{{ URL::asset('assets/img/avatars/1.png')}}" alt=""> -->
</body>
</html>