<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>
     <div>
        Name : {{ $data->name}} <br>
        SurName : {{ $data->surname}} <br>
        Email : {{ $data->email}} <br>
        Mobile : {{ $data->mobile}} <br>
        Password : {{ $data->password}} <br>
        Profile Image :
        @if ($data->profile_pic)
            <img src="{{ asset('storage/' . $data->profile_pic) }}" alt="{{ $data->name }} profile picture" width="160" class="rounded mt-2">
        @else
            No image
        @endif
        <br>

     </div>
</body>
</html>
