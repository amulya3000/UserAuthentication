<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
</head>
<body>
<h1> i am admin</h1>

<h2>Pending Employee Registrations</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if($pendingUsers->isEmpty())
    <p>No pending registrations.</p>
@else
    <table border="1" cellpadding="8">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach($pendingUsers as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Approve</button>
                </form>

                <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Reject</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endif

</body>
</html>