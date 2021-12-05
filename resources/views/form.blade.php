<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('announcements.store') }}" method="POST">
    <label for="name">Name</label>
    <input id="name" type="text" name="name">
    <label for="description">description</label>
    <input id="description" type="text" name="description">
    <label for="photos">Photos</label>
    <input id="photos" type="text" name="photos[]">
    <label for="price">Price</label>
    <input id="price" type="text" name="price">
    <input type="submit" value="send">
    @csrf
</form>
</body>
</html>
