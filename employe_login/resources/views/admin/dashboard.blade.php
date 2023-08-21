<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline-primary">Button</button>

    </form>
    <a href="{{ route('admin.logout') }}">Logout</a>
    <a href="admin_leave">Employe Leave Data </a>
    <h1>Admin Dashboard</h1>
</body>

</html>
