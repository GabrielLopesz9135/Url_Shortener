<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
</head>
<body>
    <form action="{{route('urls.shortener')}}" method="POST">
        @csrf
        <label for="url">URL:</label>
        <input type="text" id="original_url" name="original_url" required>
        <button type="submit">Shorten</button>
    </form>
</body>
</html>