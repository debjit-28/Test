<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <div class=" mb-3">
        <h2>All Contacts</h2>
        <p><a href="{{ route('contacts.create') }}" class="btn btn-primary">Add New Contact</a></p>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Surname
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Mobile
                    </th>
                    <th>
                        Password
                    </th>
                    <th>
                        Profile Image
                    </th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>
                            {{ $data->id}}
                        </td>
                        <td>
                           {{ $data->name}}
                        </td>
                        <td>
                            {{ $data->surname}}
                        </td>
                        <td>
                            {{ $data->email}}
                        </td>
                        <td>
                            {{ $data->mobile}}
                        </td>
                        <td>
                            {{ $data->password}}
                        </td>
                        <td>
                            @if ($data->profile_pic)
                                <img src="{{ route('contacts.image', $data->id) }}" alt="{{ $data->name }} profile picture" width="100" class="rounded">
                            @else
                                No image
                            @endif
                        </td>
                        <td>
                            <a href={{ route("contacts.show" , $data-> id)}}>Show</a>
                        </td>
                        <td>
                            <a href={{ route("contacts.edit" , $data-> id)}}>Update</a>
                        </td>
                        <td>
                            <form action={{ route("contacts.destroy" , $data-> id)}} method="POST" data-confirm="Are you sure?">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div>
        {{ $datas->links()}}
    </div>
</body>

</html>
