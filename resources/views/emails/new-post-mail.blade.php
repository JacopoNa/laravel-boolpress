<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>E' stato pubblicato un nuovo post nel blog!</h1>

    <h3>Titolo: {{ $new_post->title }}</h3>
    <a href="{{ route('admin.posts.show', ['post' => $new_post->id]) }}">Clicca qui per visualizzare i dettagli del post</a>
</body>
</html>