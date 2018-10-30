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
<form action="/api/auth" method="post">
    <h2>Auth</h2>
    <input type="text" name="login" value="admin"><br>
    <input type="text" name="password" value="admin"><br>
    <input type="submit">
</form>

<form action="api/product" enctype="multipart/form-data" method="post">
    <h2>Product</h2>
    <input type="text" name="title" placeholder="Название"><br>
    <input type="text" name="manufacturer" placeholder="Производитель"><br>
    <input type="text" name="text" placeholder="Описание"><br>
    <input type="text" name="tags" placeholder="Теги через запятую"><br>
    <input name="picture" type="file" /><br>
    <input type="submit"/>
</form>
</body>
</html>